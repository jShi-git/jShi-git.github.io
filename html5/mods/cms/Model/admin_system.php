<?php
class Admin_system{
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
		echo 111111;
		$this->tpl->smarty->display('index.html');
		
	}
	function add(){
		echo 222222;
		
	}
}

?>