<?php
class User{
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
		if((!isset($_SESSION['member']['id']))||($_SESSION['member']['id']=='')) Base::showmessage('错误的url','./');
		if ($_SESSION['member']['username']=='') Base::showmessage('请先完善用户信息','./user.php?m=update');
		$user_id=$_SESSION['member']['id'];

		$detail=$this->db->get_one(TB.'users','id='.$user_id,'*','1','id');
		$this->tpl->smarty->assign('detail',$detail);

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

		$query = "SELECT * FROM ".TB."user_logs WHERE user_id =".$user_id." ORDER BY id DESC LIMIT 4";
		$result = $this->db->query($query);
		$tmp=array();
		while ($row = $this->db->fetch_array($result)){
			$detail_novel = $this->_getNovelDetail($row['nid']);
			$row['novel_name'] = $detail_novel['name'];
			$detail_cms = $this->_getCmsDetail($row['cms_id']);
			$row['cms_name'] = $detail_cms['name'];
			$row['url']="./detail.php?id=".$row['cms_id'];
			$lastlist[$row['cms_id']]=$row;
		}
		if(isset($lastlist))
			$this->tpl->smarty->assign('lastlist',$lastlist);

		$tpl_path = App::getTpl(8);
		$this->tpl->smarty->display($tpl_path);
	}

	function Update(){
		if(isset($_POST['name'])){
			$detail['username']=trim($_POST['name']);
			if (isset($_POST['password'])){
				$detail['password']=md5(trim($_POST['name']));
			}


			if(!isset($_SESSION['member']['id']))  Base::showmessage('请重新登入','./');
			$user_id=$_SESSION['member']['id'];
			$sql=App::autoFormatSql(TB."users",$detail,"update","id=".$user_id);
			$this->db->query($sql);

			$detail=$this->db->get_one(TB."users",'id='.$user_id,'*');
			if (isset($detail['id'])){
				$_SESSION['member']=$detail; Base::showmessage('修改成功','./');
			}
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
		
		$tpl_path = App::getTpl(9);
		$this->tpl->smarty->display($tpl_path);
	
	}

    function _getNovelDetail($id){
        $ret = $this->db->get_one(TB.'novel','id='.$id,'*',1,'id DESC');
        return $ret;
    }

    function _getCmsDetail($id){
        $ret = $this->db->get_one(TB.'cms','id='.$id,'*',1,'id DESC');
        return $ret;
    }



}

?>