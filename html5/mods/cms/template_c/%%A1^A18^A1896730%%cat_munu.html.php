<?php /* Smarty version 2.6.18, created on 2012-02-09 12:52:36
         compiled from ./cat_munu.html */ ?>
			<li> 
				<h3>小说分类</h3> 
				<p><span class="sub_n">
          <b>按内容分类：</b>
		  <?php if ($this->_tpl_vars['catlist']): ?>
		  <?php $_from = $this->_tpl_vars['catlist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		  <a href="<?php echo $this->_tpl_vars['item']['url']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a> 
		  <?php endforeach; endif; unset($_from); ?>
		  <?php endif; ?>
		  &nbsp;&nbsp;&nbsp;&nbsp;
          <b>写作状态分类：</b><a href="#">完本</a> <a href="#">连载</a></span></p> 
			</li>