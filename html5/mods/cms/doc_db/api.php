<?php
/**
 *	api.php 自定义的接口数据 api xml
 *	phpcms
 *	注意：	1.本文件放置在网站的目录 /phpcms/modules/content/api.php
 *			2.访问地址 /index.php?m=content&c=api&first_catid=* 或者 /index.php?c=api&first_catid=**&****
 *
 *	startar
 *
 */
defined('IN_PHPCMS') or exit('No permission resources.');
//模型缓存路径
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
pc_base::load_app_func('util','content');
class api {
	private $db;
	function __construct() {
		$this->db = pc_base::load_model('content_model');
		$this->_userid = param::get_cookie('_userid');
		$this->_username = param::get_cookie('_username');
		$this->_groupid = param::get_cookie('_groupid');
	}
	//api首页
	public function init() {
		//需要参数 -- start --
		$page_start=isset($_REQUEST['page_start'])?intval($_REQUEST['page_start']):0;
		$page_size=isset($_REQUEST['page_size'])?intval($_REQUEST['page_size']):0;
		$first_catid=isset($_REQUEST['first_catid'])?intval($_REQUEST['first_catid']):'';
		$second_catid=isset($_REQUEST['second_catid'])?intval($_REQUEST['second_catid']):'';

		if($page_start<=0) $page_start=1;
		if($page_size<=0) $page_size=10;
		$page_limit=" ".(($page_start-1)*$page_size).",".$page_size." ";
		
		$data['catid']=$first_catid;
		$data['limit']=$page_limit;
		$data['order']=" id DESC ";
		$data['where']=NULL;
		$data['thumb']='';
		
		$catid=$data['catid'];
		if(empty($catid)){
			echo '需要输入分类的id';
			die();
		}
		
		//需要参数 -- end --
		
		if(isset($_GET['siteid'])) {
			$siteid = intval($_GET['siteid']);
		} else {
			$siteid = 1;
		}
		$siteid = $GLOBALS['siteid'] = max($siteid,1);
		define('SITEID', $siteid);
		$_userid = $this->_userid;
		$_username = $this->_username;
		$_groupid = $this->_groupid;
		//SEO
		$SEO = seo($siteid);

		$sitelist  = getcache('sitelist','commons');
		$default_style = $sitelist[$siteid]['default_style'];
		
		//开始处理分类的模块
		$siteids = getcache('category_content','commons');
		$siteid = $siteids[$catid];
		$CATEGORYS = getcache('category_content_'.$siteid,'commons');

		if(!isset($CATEGORYS[$catid]) || $CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
		$this->category = $CAT = $CATEGORYS[$catid];
		
		$MODEL = getcache('model','commons');
		$modelid = $CAT['modelid'];

		$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
		
		if(isset($data['where'])) {
			$sql = $data['where'];
		} else {
			$thumb = intval($data['thumb']) ? " AND thumb != ''" : '';
			if($this->category['child']) {
				$catids_str = $this->category['arrchildid'];
				$pos = strpos($catids_str,',')+1;
				$catids_str = substr($catids_str, $pos);
				$sql = "status=99 AND catid IN ($catids_str)".$thumb;
			} else {
				$sql = "status=99 AND catid='$catid'".$thumb;
			}
		}
		$order = $data['order'];
		$list_data = $this->db->select($sql, '*', $data['limit'], $order, '', 'id'); //查询主表

		if(!empty($list_data)) {
			$this->db->table_name = $this->db->table_name.'_data';
			foreach($list_data as $k=>$v){
				$v2 = $this->db->get_one(array('id'=>$v['id'])); //查询_data表
				if($v2){
					$temp=array_merge($v,$v2);
				}else{
					$temp=$v;
				}
				$list_data[$k]=$temp;
			}
			reset($list_data);
		}
		//var_dump($list_data);
		
		//输出xml文件
		$xml_obj=pc_base::load_sys_class('xml');
		$output=$xml_obj->xml_serialize($list_data);
		echo $output;
		//echo ' startar test end';
		die();
	}

}
?>