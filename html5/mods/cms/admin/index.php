<?php
session_start();
include "../config.php";
include "../include/common.php";
include "./init.php";


$c=isset($_REQUEST['c'])?$_REQUEST['c']:'admin_home';
$m=isset($_REQUEST['m'])?$_REQUEST['m']:'index';
$id=isset($_REQUEST['id'])?(array)$_REQUEST['id']:array();
$_SESSION[TB.'admin']['menu']['c']=$c;
$_SESSION[TB.'admin']['menu']['m']=$m;

if(!Base::checkadmin()&&$c!='login'&&$m!='checkUser'){
    Base::showmessage('',"index.php?c=login",'');
}
if(Base::catauth($c)){
    if(class_exists($c)){
        $model=new $c($c,$id);
        if (method_exists($c,$m)) {
            $model->$m();
            
        }
    }
}
?>