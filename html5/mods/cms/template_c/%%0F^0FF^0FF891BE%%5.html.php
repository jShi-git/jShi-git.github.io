<?php /* Smarty version 2.6.18, created on 2012-02-09 12:58:33
         compiled from /var/www/samba/magic/cms/template/demo/5.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/samba/magic/cms/template/demo/5.html', 11, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cont_bd">
	<h3 class="t_c">标题：<?php echo $this->_tpl_vars['detail_novel']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：<?php echo $this->_tpl_vars['detail_novel']['author_name']; ?>
</h3>
    <ul data-role="listview" data-inset="true" class="xs_list"> 
        <li data-role="list-divider">目录</li> 
        <?php if ($this->_tpl_vars['datalist']): ?>
		<?php $_from = $this->_tpl_vars['datalist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['record'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['record']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['record']['iteration']++;
?>
        <li class="fl_tab_list">
        	<a href="./detail.php?id=<?php echo $this->_tpl_vars['item']['id']; ?>
">
            <span><?php echo $this->_tpl_vars['item']['name']; ?>
</span>
            <span class="time_span">更新时间：<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['times'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y-%m-%d %H:%M:%S")); ?>
</span>
            <span class="top_span">排名：<?php echo ($this->_foreach['record']['iteration']-1)+1; ?>
</span></a>
        </li>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>

		<li class="custom_ui pages_sy ui-bar-d">
		<?php echo $this->_tpl_vars['page_str']; ?>

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
    <div data-role="footer" class="footer-docs ui-footer ui-bar-a ui-footer-fixed fade ui-fixed-overlay" data-theme="a" data-position="fixed" role="contentinfo">
        <h1 class="ui-title" tabindex="0" role="heading" aria-level="1"><font><font>Copyright©2011-2014 手机版 版权所有</font></font></h1>
    </div>
</body>
</html>