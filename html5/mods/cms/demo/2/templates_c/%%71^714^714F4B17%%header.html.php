<?php /* Smarty version 2.6.18, created on 2011-12-12 19:05:07
         compiled from header.html */ ?>
<div data-role="header" data-position="fixed" class="ui-header ui-header-fixed fade ui-fixed-overlay">
	 <div data-role="navbar"> 
          <ul> 
             <li><a href="./" data-icon="grid"<?php if (( ! isset ( $this->_tpl_vars['cat_id'] ) )): ?> class="ui-btn-active"<?php endif; ?>>首页</a></li> 
             <li><a href="./cat.php?id=1" data-icon="grid"<?php if (( isset ( $this->_tpl_vars['cat_id'] ) && ( $this->_tpl_vars['cat_id'] == 1 ) )): ?> class="ui-btn-active"<?php endif; ?>>武侠</a></li> 
             <li><a href="./cat.php?id=2" data-icon="star"<?php if (( isset ( $this->_tpl_vars['cat_id'] ) && ( $this->_tpl_vars['cat_id'] == 2 ) )): ?> class="ui-btn-active"<?php endif; ?>>言情</a></li> 
             <li><a href="./cat.php?id=3" data-icon="gear"<?php if (( isset ( $this->_tpl_vars['cat_id'] ) && ( $this->_tpl_vars['cat_id'] == 3 ) )): ?> class="ui-btn-active"<?php endif; ?>>科幻</a></li> 
             <li><a href="./cat.php?id=4" data-icon="plus"<?php if (( isset ( $this->_tpl_vars['cat_id'] ) && ( $this->_tpl_vars['cat_id'] == 4 ) )): ?> class="ui-btn-active"<?php endif; ?>>文学</a></li> 
         </ul> 
	 </div>		
</div>