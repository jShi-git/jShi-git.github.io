<?php /* Smarty version 2.6.18, created on 2011-12-13 00:41:38
         compiled from mod.html */ ?>
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

<div class="bd_con novel_bd">
	 <div class="novel_list">
     	  <div class="pic">
   	      	   <img src="./style/images/slide3.jpg">
          </div>
          <div class="bd">
          	   <h3><?php echo $this->_tpl_vars['detail']['name']; ?>
</h3>
          	   <ul>
               	  <li><b>作者：</b><?php echo $this->_tpl_vars['detail']['author']; ?>
</li>
               	  <li><b>总点击：</b><?php echo $this->_tpl_vars['detail']['views']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<b>月点击：</b><?php echo $this->_tpl_vars['detail']['views']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<b>周点击：</b><?php echo $this->_tpl_vars['detail']['views']; ?>
</li>
                  <li><b>阅读指数：</b>9.5</li>
                  <li><b>人气指数：</b><span><i class="lever" style="width:40%"></i></span></li>
                  <li><b>小说类别：</b><?php echo $this->_tpl_vars['detail']['cat_name']; ?>
</li>
                  <!--<li>你上次看到了<a href="content.html"><b>第32章</b></a></li>-->
               </ul>
          </div>
          <div class="clerfix"></div>
          <div class="info_list">
          	   <h4><span>共<?php echo $this->_tpl_vars['num_total']; ?>
章</span><?php echo $this->_tpl_vars['detail']['name']; ?>
</h4>
          	   <ul>
			   <?php $_from = $this->_tpl_vars['datalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
               	  <li><a href="./content.php?id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></li>
			   <?php endforeach; endif; unset($_from); ?>
               </ul>
          </div>
     </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>