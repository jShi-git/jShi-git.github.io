<?php /* Smarty version 2.6.18, created on 2011-12-13 00:41:35
         compiled from index.html */ ?>
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>首页</title>
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
	<div class="hce_adv"><img src="./style/images/adv.jpg"></div>
    

			<div class="df">	
                <ol data-role="listview">
					<?php $_from = $this->_tpl_vars['datalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <li><a href="./mod.php?id=<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></li> 
					<?php endforeach; endif; unset($_from); ?>
                </ol> 
			</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>