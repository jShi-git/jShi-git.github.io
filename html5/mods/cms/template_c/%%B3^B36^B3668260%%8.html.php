<?php /* Smarty version 2.6.18, created on 2012-03-07 11:30:30
         compiled from /var/www/samba/magic/cms/template/demo/8.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="cont_bd">
    <ul data-role="listview" data-inset="true" class="xs_list2">
	<li data-role="list-divider">我最近看的章节</li> 
	<?php if ($this->_tpl_vars['lastlist']): ?>
	<?php $_from = $this->_tpl_vars['lastlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><span><?php echo $this->_tpl_vars['item']['novel_name']; ?>
 章节 <?php echo $this->_tpl_vars['item']['cms_name']; ?>
<span> </a> </li> 
	<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
	暂无
	<?php endif; ?>
    </ul>
    
    <ul data-role="listview" data-inset="true" class="xs_list2"> 
	<li data-role="list-divider">我最近看的书</li> 

	<?php if ($this->_tpl_vars['novellist']): ?>
	<?php $_from = $this->_tpl_vars['novellist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><span><?php echo $this->_tpl_vars['item']['novel_name']; ?>
 作者 <?php echo $this->_tpl_vars['item']['author_name']; ?>
<span></a> </li> 
	<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
	暂无
	<?php endif; ?>
    </ul>
    
    <ul data-role="listview" data-inset="true" class="xs_list3 xs_list4"> 
        <li>
        	<span>我的积分:0</span>  <span>等级:<?php echo $this->_tpl_vars['detail']['level']; ?>
</span>  <span>头衔:无</span> <span>我的金币:无</span> <span><a href="#">去充值</a></span>
        </li>
    </ul>
    
    <ul data-role="listview" data-inset="true">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './cat_munu.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './ad.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './copr.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</ul>
    
</div>
    <!--Footer-->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>