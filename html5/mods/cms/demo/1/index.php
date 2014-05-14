<?php
include("./config.php");
include("./include/common.php");

if(isset($_GET['c']) && !empty($_GET['c']))
{
	$controller = strtolower($_GET['c']);
}else{
	$controller = 'index';
}


$c = isset($_REQUEST['c'])?$_REQUEST['c']:NULL;
$m = isset($_REQUEST['m'])?$_REQUEST['m']:NULL;
echo 11111111111;
if(class_exists($c)){
	echo 222222222;
	$model=new $c($c);
	if (method_exists($c,$m)) {
		$model->$m();
		
	}
}


?>