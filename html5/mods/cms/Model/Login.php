<?php

/*
	后台登陆，类

*/


class Login{
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

	// 后台登陆界面
	function Index(){

		$this->tpl->smarty->display('index_login.html');
	}

	// 后台登陆操作处理
	function gotologin(){
		
		$f_admin_name=isset($_POST['f_name'])?trim($_POST['f_name']):'';
		$f_password=isset($_POST['f_pwd'])?($_POST['f_pwd']):'';
		if($f_admin_name!='' and $f_password!='' ){
			$where=" admin_name='".$f_admin_name."' ";
			$row=$this->db->get_one(TB.'admin_user',$where,'*',1,' id ');
			if(isset($row['id'])){
				if(md5($f_password)==$row['password']){
					$_SESSION[TB.'admin']['id']=$row['id'];
					$_SESSION[TB.'admin']['name']=$row['admin_name'];
					//updatelist(TB.'admin_user',array('last_login'=>time(),'last_ip'=>$this->getRealIpAddr()),'id',array($row['id']));
					$sql="UPDATE ".TB."admin_user SET last_login='".time()."',last_ip ='".$this->getRealIpAddr()."' WHERE id='".$row['id']."' ";
					$this->db->query($sql);
					Base::showmessage('',"index.php?",'');
				}else{
					Base::showmessage(' 密码错误 ',"index.php?c=login",'');
				}
			}else{
				Base::showmessage(' 无该帐号 ',"index.php?c=login",'');
			}
		}
		Base::showmessage('',"index.php?c=login",'');
	}

	// 后台退出操作处理
	function logout(){
		if(isset($_SESSION[TB.'admin']['id'])){
			unset($_SESSION[TB.'admin']['id']);
		}
		Base::showmessage('',"index.php?c=login",'');
	}


	function getRealIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//to check ip is pass from proxy
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}


}


?>