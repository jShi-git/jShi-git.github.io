<?php

$src_url = $_GET['url'];
$tempu=parse_url($src_url);  
$message=explode(".",$tempu['host']);
$media = $message[1];
$info = file_get_contents("http://192.168.0.222:3000/".$media."/?url=".$src_url);

$urls = json_decode($info, true);
$urls = $urls['down_urls']['urls'];

?>
<!DOCTYPE HTML> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>HTML5 视频播放器</title>
<style type="text/css">
<!--
hmtl{ height:100%;}
body {
	height:100%;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#000000;
}
.player{ width:100%; height:100%; padding:0px; margin:0px;}
.landscape{width:100%;height:100%; margin:0px; padding:0px;}
.portrait{ width:100%;height:100%; margin:0px; padding:0px;}
-->
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
<!--
	var supportsOrientationChange = "onorientationchange" in window,  
    orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";  

	window.addEventListener(orientationEvent, function() {  
		if (window.orientation == 90
            || window.orientation == -90) {
        }
        else {
        }
	}, false);  
	
	document.addEventListener("touchmove", function(e){
        e.preventDefault();
        return false;
    }, false);
	
	function reSize(w,h)
	{
		$("#myVideo").attr("width",w);
		$("#myVideo").attr("height",h);
	}
	
	function fakeClick(fn) {
				var $a = $('<a href="#" id="fakeClick"></a>');
					$a.bind("click", function(e) {
						e.preventDefault();
						fn();
					});
				
				$("body").append($a);
						
				var evt, 
					el = $("#fakeClick").get(0);
				
				if (document.createEvent) {
					evt = document.createEvent("MouseEvents");
					if (evt.initMouseEvent) {
						evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
						el.dispatchEvent(evt);
					}
				}
				
				$(el).remove();
			}
			
			$(function() {
				var video = $("#myVideo").get(0);
				
				fakeClick(function() {
					video.play();
				});
			});
-->
</script>
</head>
    <body >
    	<div class="player">
    	<video id="myVideo"  controls
          preload="auto" width="100%" height="100%">
           <?php
			  foreach($urls as $k=>$url) {
				  if($url['url'] != "") {
					echo '<source src="'.$url['url'].'" />';
				  }
			  }
			?>
        </video>
        </div>
    </body>
</html>
