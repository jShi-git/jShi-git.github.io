<?php
define('MYCMS', true);
require(dirname(__FILE__) . '/includes/init.php');

$id=isset($_REQUEST['id'])?$_REQUEST['id']:NULL;
$query="SELECT * FROM ".DB_PREFIX."cms WHERE cat=$id AND parent_id IS NULL LIMIT 10";
$datalist=$db->get_all($query);

$smarty->assign('cat_id',$id);
$smarty->assign('datalist',$datalist);
$smarty->display('index.html');

?>