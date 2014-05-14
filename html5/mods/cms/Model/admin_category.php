<?php
class admin_category{
	public $table;
	public $db;
	public $id;
	public $menu;
	
	function __construct($table,$id=0){
		$this->table=TB."category";
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
		$this->menu='system';
		$this->eachpage=10;
	}

	function Index(){
        $keyword   = isset( $_POST ['keyword']) ? $_POST ['keyword'] : (isset($_GET['keyword'])?$_GET['keyword']:"");
		$fid = isset($_GET['fid'])?$_GET['fid']:0;
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = $this->eachpage;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='fid='.$fid;
        if(!empty($keyword)){
            $where.=" AND name like '%".$keyword."%'"; 
            $pageQuery .='&keyword='.$keyword;
        }
        $url ='index.php?c=admin_category&m=lists'. $pageQuery; 
        $totalCounts= $this->_getTotalCount($where); 
        if ($totalCounts > $pageSize) {
            $pageConfig ['base_url']   = $url;
            $pageConfig ['total_rows'] = $totalCounts;
            $pageConfig ['cur_page']   = $current_page;
            $pageConfig ['per_page']   = $pageSize;
            $pageConfig ['num_links']  = 5;
            $pagination = new Pagination ( $pageConfig );
            $pageStr = $pagination->create_links ();
            $this->tpl->smarty->assign ( 'page_str', $pageStr );
        }
        $limit = $pageCursor.','.$pageSize;
        $list=$this->db->getlist($this->table,$where,"*",$limit,"orders DESC,id DESC");
		$this->tpl->smarty->assign('keyword',$keyword);
		$this->tpl->smarty->assign('list',$list);
		$this->tpl->smarty->display('category_index.html');
		
	}

	// 添加分类
    function add(){
		if(isset($_POST['is_submit'])&&($_POST['is_submit']==1)) {
			$name		=isset($_POST['name'])?trim($_POST['name']):'';
			$nickname	=isset($_POST['nickname'])?trim($_POST['nickname']):'';
			$fid		=isset($_POST['fid'])?intval($_POST['fid']):0;
			$intro		=isset($_POST['intro'])?trim($_POST['intro']):'';

			if(empty($name)){
				Base::showmessage(' 请输入 ',"-1",'');
			}

			$data=array();
			$data['name']=$name;
			$data['nickname']=empty($nickname)?$data['name']:$nickname;
			$data['fid']=$fid;
			$data['intro']=$intro;
			$data['orders']=0;
			$data['status']=1;
			$data['staticurl']='';
			$data['cattpl']='';
			$data['listtpl']='';
			$data['distpl']='';
			
			//检查是否重复
			$row=array();
			$where=" name='".$data['name']."' ";
			$row=$this->db->get_one($this->table,$where,'id',1,' id asc');
			if(isset($row['id'])){
				Base::showmessage(' 重复 ',"-1",'');
			}

			$sql=$this->autoFormatSql($this->table, $data);
			if($this->db->query($sql)) {
				$last_id=$this->db->insert_id();
				if($last_id>0){
					$data['staticurl']='?cat='.$last_id;
					$sql="UPDATE ".$this->table." SET staticurl='".$data['staticurl']."' WHERE id='".$last_id."'  ";
					$this->db->query($sql);
				}
				Base::showmessage('',"index.php?c=admin_category&m=index",'');
			}else{
				Base::showmessage(' 失败 ',"-1",'');
			}
        }

		$cat_options=$this->get_tree_categories(0,true);
		$this->tpl->smarty->assign('cat_options',$cat_options);

		$this->tpl->smarty->assign('is_edit', 'add');

        $this->tpl->smarty->display('category_add.html');
    }

	// 编辑分类
    function edit(){
		//验证是否有效ID
		$edit_id=isset($_REQUEST['edit_id'])?intval($_REQUEST['edit_id']):0;
		$edit_row=array();
		$where=" id='".$edit_id."' ";
		$edit_row=$this->db->get_one($this->table,$where,'*',1,' id asc');
		if(!isset($edit_row['id'])){
			Base::showmessage(' 对象不存在 ',"-1",'');
		}

		if(isset($_POST['is_submit'])&&($_POST['is_submit']==1)) {
			$name		=isset($_POST['name'])?trim($_POST['name']):'';
			$nickname	=isset($_POST['nickname'])?trim($_POST['nickname']):'';
			$fid		=isset($_POST['fid'])?intval($_POST['fid']):0;
			$intro		=isset($_POST['intro'])?trim($_POST['intro']):'';

			if(empty($name)){
				Base::showmessage(' 请输入 ',"-1",'');
			}

			$data=array();
			$data['name']=$name;
			$data['nickname']=empty($nickname)?$data['name']:$nickname;
			$data['fid']=$fid;
			$data['intro']=$intro;

			//检查是否重复
			$row=array();
			$where=" name='".$data['name']."' AND id!='".$edit_id."' ";
			$row=$this->db->get_one($this->table,$where,'id',1,' id asc');
			if(isset($row['id'])){
				Base::showmessage(' 重复 ',"-1",'');
			}

			$sql=$this->autoFormatSql($this->table, $data, 'UPDATE', " id='".$edit_id."' ");
			if($this->db->query($sql)) {
				Base::showmessage('',"index.php?c=admin_category&m=index",'');
			}else{
				Base::showmessage(' 失败 ',"-1",'');
			}
        }

		$cat_options=$this->get_tree_categories(0,true);
		$this->tpl->smarty->assign('cat_options',$cat_options);

		$this->tpl->smarty->assign('is_edit', 'edit');
		$this->tpl->smarty->assign('edit_id', $edit_id);
		$this->tpl->smarty->assign('edit_row', $edit_row);
		

		$this->tpl->smarty->display('category_add.html');
    }

	// 删除分类
    function del(){
		//验证是否有效ID
		$del_ids=isset($_REQUEST['del_ids'])?trim($_REQUEST['del_ids']):'';
		$del_ids=str_replace('`',',',$del_ids);
		$del_arr=explode(',',$del_ids);
		$del_num=count($del_arr);
		if($del_num>0){
			foreach($del_arr as $k=>$v){
				//检查
				$row=array();
				$where=" fid='".$v."' ";
				$row=$this->db->get_one($this->table,$where,'*',1,' id asc');
				if(isset($row['id'])){
					Base::showmessage($v.' 存在下级数据 ',"-1",'');
				}
			}
			foreach($del_arr as $k=>$v){
				$status=$this->db->delist($this->table, array($v));
				if($status){
				}else{
					Base::showmessage(' 操作失败 ',"-1",'');
				}
			}
		}
		Base::showmessage('',"index.php?c=admin_category&m=index",'');
		die();
	}

    function _getTotalCount($where =''){
        $result = $this->db->get_one($this->table,$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }	




	//获取数据库中的分类树形关系
	function get_tree_categories($parent_id='0' ,$option=false ,$num=0 ){
		$arr=array();
		$options='';
		$sql="SELECT * FROM ".$this->table." WHERE fid='".$parent_id."' ORDER BY id ";
		$query = $this->db->query($sql);
		if($query){
			$key=0;
			while($row = $this->db->fetch_array($query)) {
				$arr[$key]['id']	=Base::magic2word($row['id']);
				$arr[$key]['name']	=Base::magic2word($row['name']);

				if($option){
					$nbsp_all='';
					for($i=0;$i<$num;$i++){
						$nbsp_all.='&nbsp;&nbsp;';
					}
					$options.='<option value="'.$arr[$key]['id'].'">'.$nbsp_all.$arr[$key]['name'].'</option>';
					$num_next=$num+1;
					$options.=$this->get_tree_categories($arr[$key]['id'] ,true ,$num_next );
				}else{
					$arr[$key]['child']=$this->get_tree_categories($arr[$key]['id']);
				}

				$key++;
			}
		}
		if($option){
			return $options;
		}else{
			return $arr;
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