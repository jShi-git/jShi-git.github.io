<?php /* Smarty version 2.6.18, created on 2012-02-09 12:57:49
         compiled from /var/www/samba/magic/cms/template/demo/3.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cont_bd">

	<ul data-role="listview" data-inset="true"> 
       <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './cat_munu.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </ul>
		
</div>

<div class="hce_adv"><img src="./style/images/adv.jpg"></div>    

<div class="cont_bd">
	<h3>分类小说列表：当前分类 <?php echo $this->_tpl_vars['catname']; ?>
</h3>
    <ul data-role="listview" data-inset="true" class="top_pop"> 
       
        <li class="fl_tab">
        	<div data-role="navbar" data-grid="d"> 
			<ul> 
				<li><a href="<?php echo $this->_tpl_vars['curl']; ?>
&order=1" <?php if ($this->_tpl_vars['order'] == 1): ?>class="ui-btn-active"<?php endif; ?>>更新时间</a></li> 
				<li><a href="<?php echo $this->_tpl_vars['curl']; ?>
&order=2" <?php if ($this->_tpl_vars['order'] == 2): ?>class="ui-btn-active"<?php endif; ?>>阅读数</a></li> 
				<li><a href="<?php echo $this->_tpl_vars['curl']; ?>
&order=3" <?php if ($this->_tpl_vars['order'] == 3): ?>class="ui-btn-active"<?php endif; ?>>评论数</a></li> 
				<li><a href="<?php echo $this->_tpl_vars['curl']; ?>
&order=4" <?php if ($this->_tpl_vars['order'] == 4): ?>class="ui-btn-active"<?php endif; ?>>推荐数</a></li> 
			</ul> 
		</div>
        </li>
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
		<?php endif; ?>
         
        <li class="custom_ui pages_sy ui-bar-d">
		<?php echo $this->_tpl_vars['page_str']; ?>


		</li>
    </ul>
    
    <ul class="custom2_ui">
        <li class="ui-bar-d">查看排行榜</li>
        <li><a href="index.html">周阅读榜</a> <a href="index.html">月阅读榜</a> <a href="index.html">总阅读榜</a></li>
        <li><a href="index.html">周评论榜</a> <a href="index.html">月评论榜</a> <a href="index.html">总评论榜</a></li>
        <li><a href="index.html">周推荐榜</a> <a href="index.html">月推荐榜</a> <a href="index.html">总推荐榜</a></li>
        <li><a href="index.html">周收藏榜</a> <a href="index.html">月收藏榜</a> <a href="index.html">总收藏榜</a></li>
    </ul>

    <ul data-role="listview" data-inset="true" class="mt"> 
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './download.html', 'smarty_include_vars' => array()));
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