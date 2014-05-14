<?php /* Smarty version 2.6.18, created on 2011-12-12 19:05:07
         compiled from content.html */ ?>
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>文章页</title>
<link rel="stylesheet"  href="./style/css/jquery.mobile-1.0rc2.min.css" />  
<link rel="stylesheet" href="./style/css/jqm-docs.css"/> 
<link rel="stylesheet" href="./style/css/add.css"/> 
<script src="./style/js/jquery-1.6.4.min.js"></script> 
<script src="./style/js/jquery.mobile.themeswitcher.js"></script> 
<script src="./style/js/jqm-docs.js"></script> 
<script src="./style/js/jquery.mobile-1.0rc2.min.js"></script> 
</head> 
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Content-->	
<div  data-role="controlgroup" data-type="horizontal" class="localnav novel_set"> 
    <a href="./mod.php?id=<?php echo $this->_tpl_vars['detail']['parent_id']; ?>
" data-icon="back" data-role="button">&nbsp;&nbsp;&nbsp;&nbsp;返回</a>  
    <a href="./content.php?id=<?php echo $this->_tpl_vars['front_id']; ?>
" data-icon="arrow-u" data-role="button">&nbsp;&nbsp;&nbsp;&nbsp;上一章</a> 
    <a href="./content.php?id=<?php echo $this->_tpl_vars['back_id']; ?>
" data-icon="arrow-d" data-role="button">&nbsp;&nbsp;&nbsp;&nbsp;下一章</a>
    <a href="index.html" data-icon="plus" data-role="button">&nbsp;&nbsp;&nbsp;&nbsp;加入书签</a> 
</div>
    


<!--文章页-->
<div class="bd_con novel_bd">
	 <ul id="swipeallery">
		 <li id="test1">
			<?php echo $this->_tpl_vars['detail']['content']; ?>
		 
		 </li>
	 </ul>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>