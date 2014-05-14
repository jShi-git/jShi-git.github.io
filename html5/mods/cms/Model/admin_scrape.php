<?php
class admin_scrape{
	public $table;
	public $db;
	public $id;
	public $menu;
	public $api_scrape_url='http://localhost/phpcms/index.php?m=content&c=api';
	
	function __construct($table,$id=0){
		$this->table=TB."category";
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
		$this->menu='system';
		$this->eachpage=10;
		
		include_once(SYS_ROOT.INC.'/xml.class.php');
		include_once(SYS_ROOT.INC.'/character.class.php');
		include_once(SYS_ROOT.INC.'/cls_image.class.php');
	}

	function init(){
		$cat_id=isset($_REQUEST['cat_id'])?intval($_REQUEST['cat_id']):'';
		if(empty($cat_id)) die();
		
		$cls_admincategory = new admin_category('');
		$cat_options=$cls_admincategory->get_tree_categories(0,true);
		$this->tpl->smarty->assign('cat_options',$cat_options);

		$this->tpl->smarty->assign('cat_id',$cat_id);
		$this->tpl->smarty->assign('api_url',$this->api_scrape_url.'&first_catid='.$cat_id.'&page_start=1');
		$this->tpl->smarty->assign('api_url_encode',urlencode($this->api_scrape_url.'&first_catid='.$cat_id.'&page_start=1'));
	
		$this->tpl->smarty->display('scrape_index.html');
	}

	//预览效果
	function preview(){
	
		$action=isset($_REQUEST['action'])?trim($_REQUEST['action']):'';
		$cat_id=isset($_REQUEST['cat_id'])?trim($_REQUEST['cat_id']):'';
		$scrape_page=isset($_REQUEST['scrape_page'])?trim($_REQUEST['scrape_page']):'';
		$xml_url=isset($_REQUEST['xml_url'])?trim($_REQUEST['xml_url']):'';
		if(empty($action)) die();
		if(empty($cat_id)) die();
		if(empty($scrape_page)) die();
		if(strpos($xml_url,'page_start')===false){
			if(strpos($xml_url,'?')===false){
				$xml_url.="?page_start=1";
			}else{
				$xml_url.="&page_start=1";
			}
		}
		if(preg_match('/page_start=([^&]*)/is',$xml_url,$m)){
			if(isset($m[1]) and $m[1]>0){
				$temp=$m[1];
			}else{
				$temp=1;
			}
			--$scrape_page;
			$xml_url=preg_replace('/(page_start=)([^&]*)/is','${1}'.($temp+$scrape_page),$xml_url);
		}
		$xml_str=$this->get_html($xml_url); //var_dump($xml_str);
		
		$xml_obj=new xml();
		$xml_arr=$xml_obj->xml_unserialize($xml_str);

		$str_obj=new character();

		if(!isset($xml_arr['root']['item'])){
			die();
		}
		if(!is_array($xml_arr['root']['item'])){
			die();
		}

		if(isset($xml_arr['root']['item'])){
			if(isset($xml_arr['root']['item']['id'])){
				$temp=$xml_arr['root']['item'];
				unset($xml_arr);
				$xml_arr['root']['item'][0]=$temp;
			}
			
			if($action=='look'){
				foreach($xml_arr['root']['item'] as $k=>$v){
					echo '['.$k.'] <br />';
					foreach($v as $key=>$value){
						echo '&nbsp;&nbsp;['.$key.'] '.htmlspecialchars($str_obj->str_cut($value,20)).'<br />';
					}
				}
				die();
			}
			elseif($action=='save'){
				$num = $newnum = $oldnum = 0;
				$output_arr=array();
				foreach($xml_arr['root']['item'] as $k=>$v){
					++$num;
					//检查是否已经抓取
					$phpcmsid=$v['id'];
					$inputtime=$v['inputtime'];
					$where=" phpcmsid='".$phpcmsid."' AND inputtime='".$inputtime."' ";
					$row=$this->db->get_one(TB.'cms_history',$where,'*',1,' id asc');
					$arr=array();
					$arr['title']=$v['title'];
					if(isset($row['id'])){
						++$oldnum;
						$arr['type']='old';
					}else{
						++$newnum;
						$arr['type']='new';
						//保存前，需要的话处理图片
						$save_pic='';
						if(isset($v['thumb']) and $v['thumb']!=''){
							$temp='';
							$temp=$this->get_html($v['thumb']);
							$save_pic=$this->save_pic_from_data($temp);
						}
						//保存
						$data=array();
						$data['name']=$v['title'];
						$data['link']=$v['url'];
						$data['content']=$v['content'];
						$data['cat']=$cat_id;
						$data['nid']=0;
						$data['times']=time();
						$data['ips']='';
						$data['allowcmt']=1;
						$data['status']=1;
						$data['thumbpic']=$save_pic;
						$data['views']=0;
						$data['user_id']=0;
						$data['slug']='';
						$data['tags']='';
						$data['staticurl']='';
						$sql=$this->autoFormatSql(TB.'cms', $data);
						if( $this->db->query($sql) ){
							$last_id=$this->db->insert_id();
							if($last_id>0){
								$data['staticurl']='?id='.$last_id;
								$sql="UPDATE ".TB.'cms'." SET staticurl='".$data['staticurl']."' WHERE id='".$last_id."'  ";
								$this->db->query($sql);
							}
							//记录历史
							$data=array('phpcmsid'=>$phpcmsid,'inputtime'=>$inputtime,'nowcmsid'=>$last_id,);
							$sql=$this->autoFormatSql(TB.'cms_history', $data);
							$this->db->query($sql);
						}
					}
					$output_arr[]=$arr;
				}
				if(count($output_arr)>0){
					//抓取成功，输出成功信息
					echo '[ok] [已存在:'.$oldnum.'] [新数据:'.$newnum.'] <br />['.$xml_url.']';
					foreach($output_arr as $v){
						echo '<br>';
						if($v['type']=='old'){
							echo '[已存在]';
						}else{
							echo '[新数据]';
						}
						echo strip_tags($v['title']);
					}
				}
				die();
			}
		}
		die();
	}

	
	//保存二进制内容的图片
	function save_pic_from_data($temp){
		$t_filename=false;
		if($temp!=''){
			$dirpath=SYS_ROOT.'upload/'.date('Y').'/'.date('m').'/'.date('d').'/';
			if(!file_exists($dirpath)){
				if (!make_dir($dirpath)){ /* 创建目录失败 */
					return false;
				}
			}
			$cls_image=new cls_image();
			$filename=$cls_image->unique_name($dirpath);
			if($filename){
				//临时图片
				$img=$dirpath.$filename;
				$tp = @fopen($img, 'wb');  
				fwrite($tp, $temp);  
				fclose($tp);
				/* 检查原始文件是否存在及获得原始文件的信息 */
				$org_info = @getimagesize($img);
				if(!$org_info){
					unlink($img);//del临时图片
					return false;
				}else{
					$t_filename=$cls_image->make_thumb($img, $org_info[0], $org_info[1], $dirpath);
					/*switch($org_info[2]){
						case 1: $t_filename .= $img.'.gif'; copy($img ,$t_filename); break;
						case 2:	$t_filename .= $img.'.jpg'; copy($img ,$t_filename); break;
						case 3: $t_filename .= $img.'.png'; copy($img ,$t_filename); break;
						default:
					}*/
					unlink($img);//del临时图片
				}
			}
		}
		return $t_filename;
	}

	//抓取网页
	function get_html($url=null,$needcookie=false,$usecookie=false){
		if(empty($url)) return '';
		$SET_HTTP_USER_AGENT='Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 (.NET CLR 2.0.50727)';
		$info=array();
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url ); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:$SET_HTTP_USER_AGENT);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		curl_setopt($ch, CURLOPT_TIMEOUT, 300);
		if($needcookie==1){
			curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);
		}elseif($needcookie==2){
			curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);
		}
		$info['html']=curl_exec($ch);
		$info['info']=curl_getinfo($ch);
		curl_close($ch);
		if(isset($info['html']) and $info['info']['http_code']=='200'){
			return $info['html'];
		}elseif($needcookie==1 or $needcookie==2){
			return $info['html'];
		}else{
			if(substr($url,0,4)!='http'){
				$url='http://'.$url;
			}
			if(empty($info['html'])){
				return @file_get_contents($url);
			}else{
				return $info['html'];
			}
		}
	}

	//建立插入表的sql语句
	function autoFormatSql($table='', $field_values, $mode='INSERT', $where=''){
        $sql = '';
		if(empty($field_values)){ $field_values=array(); }
		if ($mode == 'INSERT') {
			$fields = $values = array();
			foreach ($field_values as $key => $value){
				$fields[] = $key;
				if (PHP_VERSION >= '4.3') {
					$values[] = "'" . mysql_real_escape_string($value) . "'";
				} else {
					$values[] = "'" . mysql_escape_string($value) . "'";
				}
			}
			if (!empty($fields)) {
				$sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
			}
		}else{
			$sets = array();
			foreach ($field_values as $key => $value){
				if (PHP_VERSION >= '4.3') {
					$sets[] = $key . " = '" . mysql_real_escape_string($value) . "'";
				} else {
					$sets[] = $key . " = '" . mysql_escape_string($value) . "'";
				}
			}
			if (!empty($sets)) {
				$sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
			}
		}
		return $sql;
	}


}

?>