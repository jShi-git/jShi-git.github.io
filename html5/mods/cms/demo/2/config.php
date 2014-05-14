<?php

//数据库配置定义
define('DB_HOST','localhost');	//如,'localhost'
define('DB_USER','root');
define('DB_PASS','');
define('DB_DATABASE','cms');
define('DB_PREFIX','cms_');
define('DB_ENCODING','utf8');


//其他定义
define('SET_ERROR_REPORT','1');				//是否报错【0：屏蔽网站错误，1：显示网站错误】
define('SET_TIMEZONE','PRC');				//时区设置【可以空，或者: PRC etc】
define('SET_SCRIPT_DIR','');				//网站脚本路径【可以空】
define('SET_MAX_LOGOUT',3600);				//超时时间【秒】
define('SET_PHP_MEMORY_LIMIT','64M');
define('SET_HTTP_USER_AGENT','Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 (.NET CLR 2.0.50727)');




?>
