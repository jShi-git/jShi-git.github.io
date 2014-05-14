<?php
unset($HTTP_ENV_VARS, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_POST_FILES, $HTTP_COOKIE_VARS);
@set_magic_quotes_runtime(0);
//error_reporting('E_ERROR | E_WARNING | E_PARSE');
//公共函数
include(SYS_ROOT.'Model/Base.php');
//模板引擎
include(SYS_ROOT.'Model/Template.php');
//数据库函数
include(SYS_ROOT.INC.'/mysql.php');
include(SYS_ROOT.INC.'/smarty_class/smarty.class.php');
//分页
include(SYS_ROOT.INC.'/pagination.class.php'); 

function __autoload($name) {
	$path=SYS_ROOT.'Model/'.ucfirst($name). '.php';
	if(file_exists($path)){
		 include $path;
	}else{
		return false;
	}
}
$smarty = new smarty();
$smarty->template_dir = './templates/';
$smarty->compile_dir  = './templates_c/';
$smarty->config_dir   = './config/';
$smarty->cache_dir    = './cache/';
$smarty->caching      = false;
$smarty->left_delimiter = "<{";
$smarty->right_delimiter = "}>";
$smarty->cache_lifetime = 1800;
?>