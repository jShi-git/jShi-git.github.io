<?php
header("Content-type:text/html;charset=utf8");
date_default_timezone_set('PRC');
session_start();
ob_start();
include('config.php');
include "./include/common.php";
if(isset($_GET['url'])){
	$url=$_GET['url'];
	$c=basename($url,'.php');
}else{
	$c='index';
}
$m=(isset($_GET['m']))?$_GET['m']:'index';
if(Base::catauth($c)){
    if(class_exists($c)){
        $model=new $c($c);
        if (method_exists($c,$m)) {
			Base::getSession();
            $model->$m();
            
        }
    }
}
?>