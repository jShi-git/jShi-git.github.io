<?php
class Admin_collection{
	public $table;
	public $db;
	public $id;
	public $menu;
	public $eachpage;
	
	function __construct($table,$id=0){
		$this->table=$table;
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
		$this->menu='system';
		$this->eachpage=10;
	}

	function del($wheres=''){
		$status=$this->db->delist(TB."collection",$this->id,$wheres);
		if(MEMCACHE)
		foreach((array)$this->id as $id){
			$this->mem->delete($id.'_collection');
		}
		Base::execmsg("删除","?action=".$this->table.'&ctrl=lists',$status);
	}
    
        function tocat(){
        $int=0;
        $ids=(array)$_REQUEST['id'];
        $type=isset($_REQUEST['type'])?$_REQUEST['type']:0;
        $cat=$_SESSION[TB.'admin_cat']?$_SESSION[TB.'admin_cat']:$_POST['cat'];
        if($cat=='1')
        { $tatle ='fiction' ;}
        else if($cat=='2')
        { $tatle ='cms' ;}
        foreach($ids as $id){
         $addsql=' and id='.$id;
         $collection=$this->db->get_one(TB."collection","status=1".$addsql,"*",1);
         $wheres='id='.$collection['id']; 
         if($type==1)
         {
            $status=$this->db->delist(TB."collection",$collection['id'],$wheres);   
         }
         unset($collection['id']);
         $status=$this->db->add_one(TB.$tatle,$collection);
         $data['staticurl']="?id=".$status;
         $statusto=$this->db->updatelist(TB.$tatle,$data,$status);

         $int++;
        }  
        Base::execmsg("批量移动成功".$int."个数","?action=collectionlist&ctrl=lists",$int);
    }

	function lists(){
        $keyword   = isset( $_POST ['keyword']) ? $_POST ['keyword'] : (isset($_GET['keyword'])?$_GET['keyword']:"");  
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = $this->eachpage;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='1=1';
        if(!empty($keyword)){
            $where.=" AND name like '%".$keyword."%'"; 
            $pageQuery .='&keyword='.$keyword;
        }
        $url ='index.php?c=admin_collection&m=lists'. $pageQuery; 
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
        $list=$this->db->getlist(TB."collection",$where,"*",$limit,"orders DESC,id DESC");
		$this->tpl->smarty->assign('keyword',$keyword);
		$this->tpl->smarty->assign('list',$list);
		$this->tpl->smarty->display('collection_lists.html');
	}

	function add(){
		$detail='';
		echo 21111;
		$this->tpl->smarty->assign('detail',$detail);
		$this->tpl->smarty->display('collection_add.html');
	
	}

    function _getTotalCount($where =''){
        $result = $this->db->get_one(TB.'collection',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }	
}

?>