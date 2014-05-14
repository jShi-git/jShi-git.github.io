<?php
define('MYCMS', true);
require(dirname(__FILE__) . '/includes/init.php');

$id=isset($_REQUEST['id'])?$_REQUEST['id']:NULL;
$query="SELECT * FROM ".DB_PREFIX."cms WHERE id=$id AND parent_id IS NULL LIMIT 1";
$detail=$db->get_one($query);
if (isset($detail['author_id'])){
	$query="SELECT * FROM ".DB_PREFIX."author WHERE id=".$detail['author_id']." LIMIT 1";
	$data_tmp=$db->get_one($query);
	if (isset($data_tmp['author'])) $detail['author'] = $data_tmp['author'];
}
if (isset($detail['cat'])){
	$query="SELECT * FROM ".DB_PREFIX."category WHERE id=".$detail['cat']." LIMIT 1";
	$data_tmp=$db->get_one($query);
	if (isset($data_tmp['name'])) $detail['cat_name'] = $data_tmp['name'];
}
$query="SELECT * FROM ".DB_PREFIX."cms WHERE parent_id=$id";
$datalist=$db->get_all($query);

$query="SELECT count(id) AS count FROM ".DB_PREFIX."cms WHERE parent_id=$id";
$num_total=$db->get_one($query);

$num_total = $num_total['count'];

$smarty->assign('detail',$detail);
$smarty->assign('datalist',$datalist);
$smarty->assign('num_total',$num_total);

$smarty->display('mod.html');

?>