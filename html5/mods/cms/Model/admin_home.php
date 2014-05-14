<?php
class Admin_home{
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
	}

	function Index(){
		//$category=$this->db->getlist(TB.'fictionlist',$_SESSION[TB.'admin_cat']?'id='.$_SESSION[TB.'admin_cat']:'1=1');
		$this->tpl->smarty->display('index.html');
		
	}
	function Top(){
		$this->tpl->smarty->display('top.html');
		
	}
	function Left(){
		$menu= require('data/menu.php');
		if (isset($_REQUEST['init'])){ $this->menu=str_replace('admin_','',$_REQUEST['init']); }
			foreach($menu as $key=>$val){
				if($this->menu==$val['value']){
					$display_title=$val['title']['name'];
					$this->tpl->smarty->assign('display_title',$display_title);
					foreach($val['items'] as $ikey=>$ival){
						$data[$ikey]['name']=$ival['name'];
						$data[$ikey]['url']='index.php?c='.$ival['c'].'&m='.$ival['m'];
					}
					$menu=$data;
					break;
				}else{
					continue;
				}
			}

		$this->tpl->smarty->assign('menu',$menu);
		$this->tpl->smarty->display('menu.html');
	}
	function Main(){
		
		$this->tpl->smarty->display('main.html');
		
	}
}

?>