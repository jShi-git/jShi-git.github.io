<?php /* Smarty version 2.6.18, created on 2012-02-09 12:57:45
         compiled from /var/www/samba/magic/cms/template/demo/9.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './header.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<div class="hce_adv"><img src="./style/images/adv.jpg"></div>     

<div class="cont_bd">
<form name="user_form" action="./user.php&m=update" method="POST">
    <div data-role="header" data-theme="d"> 
	 	 <h1>账号信息</h1> 
	</div> 
    
    <div class="ui-body ui-body-d">
         <div class="lg_box">
         	  <ul>
              	 <li>
                     <div data-role="fieldcontain"> 
                     <label for="name">账号:</label> 
                     <input type="text" name="name" id="name" value=""  /> 
                    </div>
            	</li>
                <li>              
                     <span class="lg_btn2"><button type="submit" onClick="document.user_form.submit();" data-role="button" data-rel="back" data-theme="b">修改</a></span>
            	</li>
                <li>&nbsp;</li>
                <li>你也可以用微博授权登录:<a href="#">[博授权登录]</a></li>
              </ul>	
         </div>
    </div>
    
    <div data-role="header" data-theme="d" class="mt"> 
	 	 <h1>修改信息</h1> 
	</div> 
    
    <div class="ui-body ui-body-d">
         <div class="lg_box">
         	  <ul>
              	 <li>
                     <div data-role="fieldcontain"> 
                     <label for="name">密码:</label> 
                     <input type="password" name="password" id="password" value=""  /> 
                    </div>
            	</li>
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
</form>
</div>
    <!--Footer-->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => './footer.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>