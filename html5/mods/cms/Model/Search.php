<?php
class Search{
	public $table;
	public $db;
	public $id;

	function __construct($table,$id=0){
		$this->table=$table;
		$this->db=new Dbclass(SYS_ROOT.DB_NAME);
		//$this->mem=MEMCACHE?new Memcached(MEMCACHE):null;
		$this->tpl=new Template();
		$this->id=$id;
	}

	function Index(){
		$keyword=isset($_GET['keyword'])?urldecode($_GET['keyword']):"";
		if (!Base::is_utf8($keyword)) iconv('gbk','utf-8',$keyword);
        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = 4;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ="name like '%".$keyword."%'";
        $url ='search.php?&keyword='.$keyword. $pageQuery; 
        $totalCounts= $this->_getTotalCount($where); 
        if ($totalCounts > $pageSize) {
            $pageConfig ['base_url']   = $url;
            $pageConfig ['total_rows'] = $totalCounts;
            $pageConfig ['cur_page']   = $current_page;
            $pageConfig ['per_page']   = $pageSize;
            $pageConfig ['num_links']  = 5;
            $pagination = new Newpagination ( $pageConfig );
            $pageStr = $pagination->create_links ();
            $this->tpl->smarty->assign ( 'page_str', $pageStr );
        }
        $limit = $pageCursor.','.$pageSize;
        $datalist=$this->db->getlist(TB.'novel',$where,"*",$limit,"id DESC");
		if(!empty($datalist)){
			$tmp=array();
			foreach ($datalist AS $key=>$value){
				if(isset($value['author'])){
					$detail_author=$this->db->get_one(TB.'author','id='.$value['author'],'*','1','id');
					$value['author_name']=isset($detail_author['author'])?$detail_author['author']:'';
				}
				$tmp[$key]=$value;
			}
			$datalist=$tmp;
		}
		$this->tpl->smarty->assign('datalist',$datalist);

		$catlist=$this->db->getlist(TB.'category',1,'*','10','id');
		if (!empty($catlist)){
			$tmp=array();
			foreach ($catlist As $value){
				$tmp[$value['id']]['name']=$value['name'];
				$tmp[$value['id']]['url']='./index.php?cid='.$value['id'];
			}
			$catlist=$tmp;
		}
		$this->tpl->smarty->assign('catlist',$catlist);
		$this->tpl->smarty->assign('keyword',$keyword);

		$tpl_path = App::getTpl(7);
		$this->tpl->smarty->display($tpl_path);
	}


    function _getTotalCount($where =''){
        $result = $this->db->get_one(TB.'novel',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }	
}

?>