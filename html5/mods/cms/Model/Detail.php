<?php
class Detail{
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
		if((!isset($_GET['id']))||($_GET['id']=='')) Base::showmessage('错误的url','./');

		$id=$_GET['id'];
		$detail=$this->db->get_one(TB.'cms','id='.$id,'*','1','id');
		$this->tpl->smarty->assign('detail',$detail);

		$nid=$detail['nid'];
		$detail_novel=$this->db->get_one(TB.'novel','id='.$nid,'*','1','id');
		if(isset($detail_novel['cat'])&&(isset($detail_novel['id']))){
			$nid=$detail_novel['id'];
			$cat=$detail_novel['cat'];
			if(isset($detail_novel['author'])){
				$detail_author=$this->db->get_one(TB.'author','id='.$detail_novel['author'],'*','1','id');
				$detail_novel['author_name']=isset($detail_author['author'])?$detail_author['author']:'';
			}
		}else{
			Base::showmessage('无效的数据页面','./');exit;
		}
		$catname=$detail['name'];
		$this->tpl->smarty->assign('catname',$catname);
		$this->tpl->smarty->assign('detail_novel',$detail_novel);
		
		//分类
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

		$detail_prev=$this->db->get_one(TB.'cms','nid='.$nid.' AND id<'.$id,'*','1','id DESC');
		$detail_next=$this->db->get_one(TB.'cms','nid='.$nid.' AND id>'.$id,'*','1','id');

		$this->_addView($id);//累加一次
		$this->tpl->smarty->assign('detail_novel',$detail_novel);
		$this->tpl->smarty->assign('detail_prev',$detail_prev);
		$this->tpl->smarty->assign('detail_next',$detail_next);
		$tpl_path = App::getTpl(6);
		$this->tpl->smarty->display($tpl_path);
	}

	function Cover(){
		if(!isset($_GET['id'])||($_GET['id']=='')) Base::showmessage('错误的url','./');
		$id = $_GET['id'];
		$detail_novel=$this->db->get_one(TB.'novel',1,'*','1','id');
		if(isset($detail_novel['cat'])&&(isset($detail_novel['id']))){
			$nid=$detail_novel['id'];
			$cat=$detail_novel['cat'];
			if(isset($detail_novel['author'])){
				$detail_author=$this->db->get_one(TB.'author','id='.$detail_novel['author'],'*','1','id');
				$detail_novel['author_name']=isset($detail_author['author'])?$detail_author['author']:'';
			}
		}else{
			Base::showmessage('无效的数据页面','./');exit;
		}

		$detail=$this->db->get_one(TB.'category',1,'*','1','id');
		$catname=$detail['name'];
		$this->tpl->smarty->assign('catname',$catname);
		$this->tpl->smarty->assign('detail_novel',$detail_novel);

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
		
		//小说分页

		$cmslist=$this->db->getlist(TB.'cms','nid='.$id,'*','10','id DESC');
		$this->tpl->smarty->assign('cmslist',$cmslist);

		$tpl_path = App::getTpl(4);
		$this->tpl->smarty->display($tpl_path);
	
	}

	function Contents(){
		if(!isset($_GET['id'])||($_GET['id']=='')) Base::showmessage('错误的url','./');
		$id = $_GET['id'];
		$detail_novel=$this->db->get_one(TB.'novel',1,'*','1','id');
		if(isset($detail_novel['cat'])&&(isset($detail_novel['id']))){
			$nid=$detail_novel['id'];
			$cat=$detail_novel['cat'];
			if(isset($detail_novel['author'])){
				$detail_author=$this->db->get_one(TB.'author','id='.$detail_novel['author'],'*','1','id');
				$detail_novel['author_name']=isset($detail_author['author'])?$detail_author['author']:'';
			}
		}else{
			Base::showmessage('无效的数据页面','./');exit;
		}
		
		$detail=$this->db->get_one(TB.'category',1,'*','1','id');
		$catname=$detail['name'];
		$this->tpl->smarty->assign('catname',$catname);
		$this->tpl->smarty->assign('detail_novel',$detail_novel);


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
		
		//小说分页

        $page         = isset ( $_GET ['page'] ) ? intval ( $_GET ['page'] ) : 1; 
        $pageQuery    ='';
        $pageSize     = 10;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='nid='.$id;
        $url ='detail.php?m=contents&id='.$id. $pageQuery; 
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
        $datalist=$this->db->getlist(TB.'cms',$where,"*",$limit,"id DESC");
		$this->tpl->smarty->assign('datalist',$datalist);
		$tpl_path = App::getTpl(5);
		$this->tpl->smarty->display($tpl_path);
	
	}


	function _addView($id){
		$detail=$this->db->get_one(TB.'cms','id='.$id,'*','1','id');
		if (isset($detail['nid'])){
			$query="INSERT INTO ".TB."viewlogs (cat,nid,cid,ip,create_time) VALUES ('".$detail['cat']."','".$detail['nid']."','".$detail['id']."','".$_SERVER['REMOTE_ADDR']."',".time().")";
			$this->db->query($query);
			$this->db->query("UPDATE ".TB."cms SET views=views+1 WHERE id=".$id);
			$this->db->query("UPDATE ".TB."novel SET views=views+1 WHERE id=".$detail['nid']);

			if(isset($_SESSION['member']['id'])){
				$data=array();
				$data['user_id']	=$_SESSION['member']['id'];
				$data['cat_id']		=isset($detail['cat'])?$detail['cat']:NULL;
				$data['nid']		=isset($detail['nid'])?$detail['nid']:NULL;
				$data['cms_id']		=$detail['id'];
				$data['create_time']=time();
				$sql=App::autoFormatSql(TB."user_logs",$data);
				$this->db->query($sql);
			}
		}
		return;
	}

    function _getTotalCount($where =''){
        $result = $this->db->get_one(TB.'cms',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }	
}

?>