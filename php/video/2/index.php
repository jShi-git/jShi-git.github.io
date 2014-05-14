<?php
$src_url = $_GET['url'];
$info = file_get_contents("http://www.html5video.info/convert?url=".$src_url);

print_r($info);

?>