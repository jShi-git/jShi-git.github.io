<?php
if (!defined('MYCMS')){
    die('Hacking attempt');
}

if (__FILE__ == ''){
    die('Fatal error code: 0');
}

/* 取得当前所在的根目录 */
define('ROOT_PATH', str_replace('includes/init.php', '', str_replace('\\', '/', __FILE__)));

//引入数据库等配置
require(ROOT_PATH . 'config.php');

if(SET_ERROR_REPORT==1){
	error_reporting(E_ALL);
}else{
	error_reporting(0);
}



/* 初始化设置 */
@ini_set('memory_limit',          SET_PHP_MEMORY_LIMIT);
@ini_set('session.cache_expire',  180);
@ini_set('session.use_trans_sid', 0);

session_start();
header('content-type: text/html; charset=utf-8');
if(defined('HTML_NO_CACHE')){
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1987 05:00:00 GMT"); // 过去的时间
}


if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path', '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path', '.:' . ROOT_PATH);
}


if (PHP_VERSION >= '5.1' && SET_TIMEZONE!='')
{
    date_default_timezone_set(SET_TIMEZONE);
}

$php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
if ('/' == substr($php_self, -1)){
    $php_self .= 'index.php';
}
define('PHP_SELF', $php_self);


//引入其他函数，类
require(ROOT_PATH . 'includes/mysql_class.php');
require(ROOT_PATH . 'includes/page_class.php');
require(ROOT_PATH . 'includes/lib_base.php');


/* 对用户传入的变量进行转义操作。*/
if (!get_magic_quotes_gpc()){
    if (!empty($_GET))		{
        $_GET  = addslashes_deep($_GET);
    }
    if (!empty($_POST))	{
        $_POST = addslashes_deep($_POST);
    }
	if (!empty($_COOKIE))	{
    	$_COOKIE   = addslashes_deep($_COOKIE);
	}
	if (!empty($_REQUEST))	{
    	$_REQUEST  = addslashes_deep($_REQUEST);
	}
}


/*	数据库实例化类：*/
$db=new Db_class(DB_HOST,DB_USER,DB_PASS,DB_DATABASE);


/*	smarty模版实例化类	*/
require(ROOT_PATH . 'includes/smarty_class/smarty.class.php');
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