<?php
class Index{
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
		if(isset($_GET['cid'])&&($_GET['cid']<>'')) { $this->Cat();exit;}
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

		//我看过的小说
		if(isset($_SESSION['member']['id'])){
			$user_id=$_SESSION['member']['id'];
			$query = "SELECT * FROM ".TB."user_logs WHERE user_id =".$user_id." GROUP BY nid ORDER BY id DESC LIMIT 4";
			$result = $this->db->query($query);
			$tmp=array();
			while ($row = $this->db->fetch_array($result)){
				$detail_novel = $this->_getNovelDetail($row['nid']);
				$row['novel_name'] = $detail_novel['name'];
				$row['url']="./detail.php?m=cover&id=".$row['nid'];
				if(isset($detail_novel['author'])){
					$detail_author=$this->db->get_one(TB.'author','id='.$detail_novel['author'],'*','1','id');
					$row['author_name']=isset($detail_author['author'])?$detail_author['author']:'';
				}
				$novellist[$row['cms_id']]=$row;
			}
			if(isset($novellist))
				$this->tpl->smarty->assign('novellist',$novellist);
		}
		
		$authorlist=$this->db->getlist(TB.'author',1,'*','10','id');
		if (!empty($authorlist)){
			$tmp=array();
			foreach ($authorlist As $value){
				$tmp[$value['id']]['name']=$value['author'];
				$tmp[$value['id']]['url']='./search.php?aid='.$value['id'];
			}
			$authorlist=$tmp;
		}
		$this->tpl->smarty->assign('authorlist',$authorlist);
		
		//热门
		$hotlist=$this->db->getlist(TB.'novel','1','*','6','views DESC');
		if (!empty($hotlist)){
			$tmp=array();
			foreach ($hotlist As $value){
				$tmp[$value['id']]['name']=$value['name'];
				$tmp[$value['id']]['url']='./detail.php?m=cover&id='.$value['id'];
			}
			$hotlist=$tmp;
		}
		$this->tpl->smarty->assign('hotlist',$hotlist);

		//完结的
		$endlist=$this->db->getlist(TB.'novel','end=1','*','5','id DESC');
		if (!empty($endlist)){
			$tmp=array();
			foreach ($endlist As $value){
				$tmp[$value['id']]['name']=$value['name'];
				$tmp[$value['id']]['url']='./detail.php?m=cover&id='.$value['id'];
			}
			$endlist=$tmp;
		}
		$this->tpl->smarty->assign('endlist',$endlist);
		$endCount = $this->_getTotalCount('end=1');
		$this->tpl->smarty->assign('endCount',$endCount);

	
		//非完结的
		$serilist=$this->db->getlist(TB.'novel','end=0','*','5','id DESC');
		if (!empty($serilist)){
			$tmp=array();
			foreach ($serilist As $value){
				$tmp[$value['id']]['name']=$value['name'];
				$tmp[$value['id']]['url']='./detail.php?m=cover&id='.$value['id'];
			}
			$serilist=$tmp;
		}
		$this->tpl->smarty->assign('serilist',$serilist);
		$seriCount = $this->_getTotalCount('end=0');
		$this->tpl->smarty->assign('seriCount',$seriCount);
	

		$tpl_path = App::getTpl(1);
		$this->tpl->smarty->display($tpl_path);
	}

	function Cat(){
		$cid = $_GET['cid'];
		$detail=$this->db->get_one(TB.'category',1,'*','1','id');
		$catname=$detail['name'];
		$this->tpl->smarty->assign('catname',$catname);

		$order=(isset($_GET['order']))?$_GET['order']:1;
		switch ($order){
			case 1:
				$orderQuery = " ORDER BY n.id DESC";
				break;
			case 2:
				$orderQuery = " ORDER BY n.views DESC";
				break;
			case 3:
				$orderQuery = " ORDER BY n.reviews DESC";
				break;
			case 4:
				$orderQuery = " ORDER BY n.recommend DESC";
				break;
			default:
				$orderQuery = " ORDER BY n.id DESC";
		}

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
        $pageSize     = 4;  
        $current_page = $page;
        $pageCursor   = ($current_page - 1) * $pageSize;     
        $where        ='cat='.$cid;
        if(!empty($keyword)){
            $where.=" AND name like '%".$keyword."%'"; 
        }
		$curl ='index.php?cid='.$cid.$pageQuery;
        $url ='index.php?cid='.$cid.(isset($_GET['order'])?'&order='.$_GET['order']:''). $pageQuery; 
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
		$query = "SELECT n.*,a.author AS author_name FROM ".TB."novel AS n LEFT JOIN ".TB."author AS a ON n.author=a.id WHERE ".$where .$orderQuery;
		$datalist = $this->db->getdata($query);
		$this->tpl->smarty->assign('datalist',$datalist);

		$tpl_path = App::getTpl(3);
		$this->tpl->smarty->assign('order',$order);
		$this->tpl->smarty->assign('curl',$curl);
		$this->tpl->smarty->display($tpl_path);
	
	}

    function _getTotalCount($where =''){
        $result = $this->db->get_one(TB.'novel',$where,'count( * ) AS count_int',1,'id DESC');
        $ret =$result['count_int'];
        return $ret;
    }
	
    function _getNovelDetail($id){
        $ret = $this->db->get_one(TB.'novel','id='.$id,'*',1,'id DESC');
        return $ret;
    }
}

?>