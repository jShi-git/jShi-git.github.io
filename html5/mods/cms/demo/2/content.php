<?php
define('MYCMS', true);
require(dirname(__FILE__) . '/includes/init.php');

$id=isset($_REQUEST['id'])?$_REQUEST['id']:NULL;
$query="SELECT * FROM ".DB_PREFIX."cms WHERE id=$id LIMIT 1";
$detail=$db->get_one($query);
if (isset($detail['content'])) $detail['content']=html_entity_decode($detail['content']);

if (isset($detail['parent_id'])){
	$query="SELECT * FROM ".DB_PREFIX."cms WHERE parent_id=".$detail['parent_id']." AND orders=". ((($detail['orders']-1)>0)?($detail['orders']-1):1)." LIMIT 1";
	$data_tmp=$db->get_one($query);
}
$front_id=isset($data_tmp['id'])?$data_tmp['id']:$detail['id'];
unset($data_tmp);

if (isset($detail['parent_id'])){
	$query="SELECT * FROM ".DB_PREFIX."cms WHERE parent_id=".$detail['parent_id']." AND orders=". ($detail['orders']+1)." LIMIT 1";
	$data_tmp=$db->get_one($query);
}
$back_id=isset($data_tmp['id'])?$data_tmp['id']:$detail['id'];
unset($data_tmp);


$smarty->assign('detail',$detail);
$smarty->assign('front_id',$front_id);
$smarty->assign('back_id',$back_id);
$smarty->display('content.html');

?>