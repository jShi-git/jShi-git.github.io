<?php /* Smarty version 2.6.18, created on 2012-03-07 11:27:09
         compiled from /var/www/samba/magic/cms/template/demo/6.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div data-role="header" data-theme="d"> 
	 <h1>名称:<?php echo $this->_tpl_vars['detail_novel']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者:<?php echo $this->_tpl_vars['detail_novel']['author_name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['detail']['name']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./detail.php?m=contents&id=<?php echo $this->_tpl_vars['detail']['nid']; ?>
">返回目录</a></h1> 
</div> 

<div class="cont_bd">
	
    <div class="ui-body ui-body-d">
	 <ul id="swipeallery">
		 <li id="test1">
		 <?php echo $this->_tpl_vars['detail']['content']; ?>

		 </li>
	 </ul>
     
     <ul>
     	<li class="pages_sy">
        	<dl>
            	<dt>
                	<dd>
					<a href="<?php if ($this->_tpl_vars['detail_prev']['id']): ?>./detail.php?id=<?php echo $this->_tpl_vars['detail_prev']['id']; ?>
<?php else: ?>#<?php endif; ?>" data-role="button" data-icon="arrow-l" data-theme="c" class="ui-btn ui-btn-icon-left ui-corner-top ui-btn-up-c"><span class="ui-btn-inner ui-corner-top"><span class="ui-btn-text"><?php if ($this->_tpl_vars['detail_prev']['name']): ?><?php echo $this->_tpl_vars['detail_prev']['name']; ?>
<?php else: ?>无上一篇<?php endif; ?>
					</span><span class="ui-icon ui-icon-arrow-l ui-icon-shadow"></span></span></a>
					</dd>
                    <dd>
					<a href="<?php if ($this->_tpl_vars['detail_next']['id']): ?>./detail.php?id=<?php echo $this->_tpl_vars['detail_next']['id']; ?>
<?php else: ?>#<?php endif; ?>" data-role="button" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-corner-bottom ui-controlgroup-last ui-btn-up-c"><span class="ui-btn-inner ui-corner-bottom ui-controlgroup-last"><span class="ui-btn-text"><?php if ($this->_tpl_vars['detail_next']['name']): ?><?php echo $this->_tpl_vars['detail_next']['name']; ?>
<?php else: ?>无下一篇<?php endif; ?>
					</span><span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></span></a>
					</dd>
                    <dd><a href="./detail.php?m=contents&id=<?php echo $this->_tpl_vars['detail']['nid']; ?>
">返回小说首页</a> </dd>
                    <dd> <a href="#">回到排行榜</a></dd>
                    <dd><a href="./index.php?cid=<?php echo $this->_tpl_vars['detail']['cat']; ?>
">回到分类首页</a></dd>
                </dt>
            </dl> 
        </li>
     </ul>

     
</div>
    
        
    
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