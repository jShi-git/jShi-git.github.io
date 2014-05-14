<?php /* Smarty version 2.6.18, created on 2012-02-09 12:52:36
         compiled from ./header.html */ ?>
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>小说内容页</title>
<link rel="stylesheet"  href="./style/css/jquery.mobile-1.0rc2.min.css" />  
<link rel="stylesheet" href="./style/css/jqm-docs.css"/> 
<link rel="stylesheet" href="./style/css/add.css"/> 
<script src="./style/js/jquery-1.6.4.min.js"></script> 
<script src="./style/js/jquery.mobile-1.0rc2.min.js"></script> 
</head> 
<body>
<!--Navigation-->
<div data-role="header" data-position="fixed" data-theme="f">
    <div data-theme="a" class="ui-bar ui-grid-c ui-bar-a" style="background:transparent;border:none;padding:.4em 0;">
          <div class="box_fr">
		  <form name="search_form" action="./search.php" method="GET">
               <div class="ui-block-b"><label for="value" style="margin:.3em 0 0 0 ;" class="ui-input-text">搜索：</label> </div>
               <div class="ui-block-c">
   
    <input type="text" data-type="search" name="keyword" id="keyword" value="<?php if ($this->_tpl_vars['keyword']): ?><?php echo $this->_tpl_vars['keyword']; ?>
<?php endif; ?>" class="ui-input-text ui-body-c">
</div>	 
               <div class="ui-block-d"><div style="margin:2px 0 0 10px;"><button type="submit" data-theme="b" class="ui-btn-hidden" aria-disabled="false" onClick="document.search_form.submit();">搜索</button></div></div>

			   <?php if ($_SESSION['member']['username']): ?>
               <div class="ples_info f12">尊敬的: <a href="./user.php"><?php echo $_SESSION['member']['username']; ?>
</a></div>
			   <div class="nav_lgri"><a href="./user.php">我的收藏夹</a>&nbsp;&nbsp;<a href="#">小说排行</a>&nbsp;&nbsp;</div>
			   <?php else: ?>
			    <div class="ples_info"><a href="./user.php?m=update" class="f12 text_n">请完善信息</a></div>
				<div class="nav_lgri"><a href="#">小说排行</a>&nbsp;&nbsp;</div>
			   <?php endif; ?>
	    </form>
        </div>
    </div>		
</div>

<div class="logo clearfix">
	 <a href="./"><img src="./style/images/logo.png" class="fl"></a> <span>Welcome. Browse the jQuery Mobile components and learn how to make rich, accessible, touch-friendly websites and apps.A Touch-Optimized Web Framework for Smartphones & Tablets</span>
</div>