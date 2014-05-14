<?php
define('MYCMS', true);
require(dirname(__FILE__) . '/includes/init.php');

$query="SELECT * FROM ".DB_PREFIX."cms WHERE parent_id IS NULL LIMIT 10";
$datalist=$db->get_all($query);

$smarty->assign('datalist',$datalist);
$smarty->display('index.html');
?>