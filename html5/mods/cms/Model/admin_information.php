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
		//栏目缓存
        include(SYS_ROOT.CACHE.'cat_collection.php');
		$eachpage=EACHPAGE;
		$addsql=' ';
		$addsql.=($_GET['name']!='')?(' and name like "%'.$_GET['name'].'%"'):'';;
		$totaldata=$this->db->getlist(TB."collection",'1=1'.$addsql,"count(*)");
		$total=$totaldata[0]['count(*)'];
		$page=$_GET['p'];
		$uppage=$page>0?$page-1:0;
		$downpage=($page+1)*$eachpage<$total?$page+1:$page;
		$list=$this->db->getlist(TB."collection",'1=1'.$addsql,"*",$eachpage*$page.','.$eachpage,"orders DESC,id DESC");
		include($this->tpl->myTpl('manage'.$this->table));
	}
	
}

?>