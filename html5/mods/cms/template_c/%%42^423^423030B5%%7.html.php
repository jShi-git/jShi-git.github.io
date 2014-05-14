<?php /* Smarty version 2.6.18, created on 2012-02-09 12:58:09
         compiled from /var/www/samba/magic/cms/template/demo/7.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cont_bd">
    <ul data-role="listview" data-inset="true" class="xs_list3"> 
        <li data-role="list-divider">搜索结果</li>


        <?php if ($this->_tpl_vars['datalist']): ?>
		<?php $_from = $this->_tpl_vars['datalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['record'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['record']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['record']['iteration']++;
?>
        <li class="fl_tab_list">
        	<a href="./detail.php?m=cover&id=<?php echo $this->_tpl_vars['item']['id']; ?>
">
            <span><?php echo $this->_tpl_vars['item']['name']; ?>
</span>
            <span>作者：<?php echo $this->_tpl_vars['item']['author_name']; ?>
</span>
            <span>排名：<?php echo ($this->_foreach['record']['iteration']-1)+1; ?>
</span></a>
        </li>

		<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<li>暂无数据</li> 
		<?php endif; ?>
         

        <li class="custom_ui pages_sy ui-bar-d">
		<?php echo $this->_tpl_vars['page_str']; ?>

		</li>


    </ul>
    <!--
	<ul data-role="listview" data-inset="true" class="xs_list2"> 
        <li data-role="list-divider">搜索结果</li> 
		<li><a href="index.html"><span>伈伈睍睍</span> <span>大大滴答</span></a></li> 
    </ul>
	-->
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