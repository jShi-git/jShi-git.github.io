<?php /* Smarty version 2.6.18, created on 2012-02-09 12:52:36
         compiled from /var/www/samba/magic/cms/template/demo/1.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cont_bd">
    <ul data-role="listview" data-inset="true"> 
        <li data-role="list-divider">我常看的小说</li>
        <?php if ($_SESSION['member']['username']): ?>
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
		<?php else: ?>
		<li><a href="./user.php?m=update">请完善信息</a></li>
		<?php endif; ?>
    </ul> 



    <ul data-role="listview" data-inset="true"> 
        <li data-role="list-divider">名作家</li> 
		  <?php if ($this->_tpl_vars['authorlist']): ?>
		  <?php $_from = $this->_tpl_vars['authorlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		  <li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> </li> 
		  <?php endforeach; endif; unset($_from); ?>
		  <?php endif; ?>
    </ul> 

    <ul data-role="listview" data-inset="true"> 
        <li data-role="list-divider">热门小说</li> 
		<?php if ($this->_tpl_vars['hotlist']): ?>
		<?php $_from = $this->_tpl_vars['hotlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> </li> 
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

        <li data-role="list-divider" class="custom_ui"> 热门<a href="#">查看更多</a></li>
    </ul> 
    
    <ul data-role="listview" data-inset="true"> 
      <li data-role="list-divider">完本小说</li> 
			<?php if ($this->_tpl_vars['endlist']): ?>
			<?php $_from = $this->_tpl_vars['endlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> </li> 
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<li data-role="list-divider" class="custom_ui">共<?php echo $this->_tpl_vars['endCount']; ?>
本 <a href="./search.php?end=1">查看更多</a></li>
    </ul>
    
    <ul data-role="listview" data-inset="true"> 
      <li data-role="list-divider">连载小说</li> 
			<?php if ($this->_tpl_vars['serilist']): ?>
			<?php $_from = $this->_tpl_vars['serilist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<li data-role="list-divider"><a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> </li> 
			<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
			<li data-role="list-divider" class="custom_ui">共<?php echo $this->_tpl_vars['seriCount']; ?>
本 <a href="./search.php?end=0">查看更多</a></li>
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