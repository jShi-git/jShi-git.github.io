<?php /* Smarty version 2.6.18, created on 2012-02-09 12:58:30
         compiled from /var/www/samba/magic/cms/template/demo/4.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '/var/www/samba/magic/cms/template/demo/4.html', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="cont_bd">
	
    <div data-role="header" data-theme="d"> 
	 <h1>小说书名</h1> 
	</div> 
    
    <div class="ui-body ui-body-d">
        <div class="introd">
              <div class="pic"><img src="./style/images/no_img.png"></div>
              <ul>
                <li>标题：<em><?php echo $this->_tpl_vars['detail_novel']['name']; ?>
</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者：<?php echo $this->_tpl_vars['detail_novel']['author_name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>最新章节：<?php if ($this->_tpl_vars['cmslist']['0']['id']): ?>【<?php echo $this->_tpl_vars['cmslist']['0']['name']; ?>
】<?php else: ?>暂无<?php endif; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;更新时间：<?php if ($this->_tpl_vars['cmslist']['0']['id']): ?>【<?php echo ((is_array($_tmp=$this->_tpl_vars['cmslist']['0']['times'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%y-%m-%d %H:%M:%S")); ?>
】<?php else: ?>暂无<?php endif; ?></li>
                <li><em>小说简介：</em>
				<?php echo $this->_tpl_vars['detail_novel']['detail']; ?>

				</li>
                <li><a href="#" data-role="button" data-inline="true">查看作者</a>
                <a href="./detail.php?m=contents&id=<?php echo $this->_tpl_vars['detail_novel']['id']; ?>
" data-role="button" data-inline="true">查看目录</a><a href="#" data-role="button" data-inline="true">分享到微博</a><a href="#" data-role="button" data-inline="true">下载小说</a><a href="./detail.php?m=contents&id=<?php echo $this->_tpl_vars['detail_novel']['id']; ?>
" data-role="button" data-inline="true">>>在线看小说 </a></li>
                <li class="pages_sy">
				<p /><p />
                </li>
                <li><a href="javascript:history.go(-1);">回到上一页</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">回到排行榜</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./index.php?cid=<?php echo $this->_tpl_vars['detail_novel']['cat']; ?>
">回到分类首页</a></li>
             </ul>
        </div>
    </div>
    
    <ul data-role="listview" data-inset="true" class="mt"> 
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