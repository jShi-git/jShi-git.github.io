<?php
class admin_template{
	public $table;
	public $db;
	public $id;
	public $menu;
	
	function __construct($table,$id=0){
		$this->table=$table;
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
		$this->menu='system';
		$this->eachpage=10;
	}

	function Index(){
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = $this->eachpage;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='1=1';
        $url ='index.php?c=admin_template'. $pageQuery; 
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
        $list=$this->db->getlist(TB."template_module",$where,"*",$limit,"id DESC");
		if(!empty($list)){
			$tmp=array();
			foreach ($list As $key=>$value){
				$value['used']=$this->_getUsed($value['id']);
				$tmp[$key]=$value;
			}
			$list=$tmp;
		}
		$this->tpl->smarty->assign('list',$list);
		$this->tpl->smarty->display('template_index.html');
		
	}

	function Select(){
		if (!isset($_REQUEST['id'])) Base::showmessage('错误url');
		if (isset($_REQUEST['tid'])){
			$ret=$this->_changeUsed($_REQUEST['tid']);
			if ($ret==false) Base::showmessage('已经是这个模版');
			Base::showmessage('选择成功','index.php?c=admin_template&m=select&id='.$_REQUEST['id']);
		}
		$id=$_REQUEST['id'];
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = $this->eachpage;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='position='.$id;
        $url ='index.php?c=admin_template&m=select'. $pageQuery; 
        $totalCounts= $this->_getTotalTemplateCount($where); 
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
        $list=$this->db->getlist(TB."template",$where,"*",$limit,"id DESC");
		if(!empty($list)){
			$tmp=array();
			foreach ($list As $key=>$value){
				$value['template']=$this->_getTemplateName($value['lid']);
				$tmp[$key]=$value;
			}
			$list=$tmp;
		}
		$this->tpl->smarty->assign('list',$list);
		$this->tpl->smarty->assign('lid',$id);
		$this->tpl->smarty->display('template_select.html');
		
	}


    function _getTotalCount($where =''){
        $result = $this->db->get_one(TB.'template_module',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }

    function _getTotalTemplateCount($where =''){
        $result = $this->db->get_one(TB.'template',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }

	function _getUsed($id){
		$where = 'position='.$id.' AND used=1';
        $result = $this->db->get_one(TB.'template',$where,'*',1,'id DESC');
		$ret=0;
		if(isset($result['id'])) $ret=1;
		return $ret;
	}

	function _getTemplateName($id){
		$where = 'id='.$id;
        $result = $this->db->get_one(TB.'template_list',$where,'*',1,'id DESC');
		$ret='';
		if(isset($result['template_name'])) $ret=$result['template_name'];
		return $ret;
	}

	function _changeUsed($id){
		$where = 'id='.$id;
		$ret=false;
        $result = $this->db->get_one(TB.'template',$where,'*',1,'id DESC');
		if (isset($result['used'])&&($result['used']==1)){
			return $ret;
		}
		$position=$result['position'];
		$query='UPDATE '.TB.'template SET used=0 WHERE position='.$position;
		$this->db->query($query);
		$query='UPDATE '.TB.'template SET used=1 WHERE position='.$position.' AND id='.$id;
		$this->db->query($query);
		$ret = true;
		return $ret;
	
	}
	
}

?>