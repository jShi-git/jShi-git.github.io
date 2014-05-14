<?php
/**
*   类名: mobile
*   描述: 手机信息类
*   其他:
*/
class Mobile extends App{
	/**
	* 函数名称: getPhoneNumber
	* 函数功能: 取手机号
	* 输入参数: none
	* 函数返回值: 成功返回号码，失败返回false
	* 其它说明: 说明
	*/
	static function getPhoneNumber(){
	       if (isset($_SERVER['HTTP_X_NETWORK_INFO']))
	       {
	         $str1 = $_SERVER['HTTP_X_NETWORK_INFO'];
	         $getstr1 = preg_replace('/(.*,)(13[\d]{9})(,.*)/i','\\2',$str1);
	         Return $getstr1;
	       }
	       elseif (isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID']))
	       {
	         $getstr2 = $_SERVER['HTTP_X_UP_CALLING_LINE_ID'];
	         Return $getstr2;
	       }
	       elseif (isset($_SERVER['HTTP_X_UP_SUBNO']))
	       {
	         $str3 = $_SERVER['HTTP_X_UP_SUBNO'];
	         $getstr3 = preg_replace('/(.*)(13[\d]{9})(.*)/i','\\2',$str3);
	         Return $getstr3;
	       }
	       elseif (isset($_SERVER['DEVICEID']))
	       {
	         Return $_SERVER['DEVICEID'];
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: getHttpHeader
	* 函数功能: 取头信息
	* 输入参数: none
	* 函数返回值: 成功返回号码，失败返回false
	* 其它说明: 说明
	*/
	static function getHttpHeader(){
	       $str = '';
	       foreach ($_SERVER as $key=>$val)
	       {
	         $gstr = str_replace("&","&amp;",$val);
	         $str.= "$key -> ".$gstr."\r\n";
	       }
	       Return $str;
	}
	
	/**
	* 函数名称: getUA
	* 函数功能: 取UA
	* 输入参数: none
	* 函数返回值: 成功返回号码，失败返回false
	* 其它说明: 说明
	*/
	static function getUA(){
	       if (isset($_SERVER['HTTP_USER_AGENT']))
	       {
	         Return $_SERVER['HTTP_USER_AGENT'];
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: getPhoneType
	* 函数功能: 取得手机类型
	* 输入参数: none
	* 函数返回值: 成功返回string，失败返回false
	* 其它说明: 说明
	*/
	static function getPhoneType(){
	       $ua = Mobile::getUA();
	       if($ua!=false)
	       {
	         $str = explode(' ',$ua);
	         Return $str[0];
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: isOpera
	* 函数功能: 判断是否是opera
	* 输入参数: none
	* 函数返回值: 成功返回string，失败返回false
	* 其它说明: 说明
	*/
	static function isOpera(){
	       $uainfo = Mobile::getUA();
	       if (preg_match('/.*Opera.*/i',$uainfo))
	       {
	         Return true;
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: isM3gate
	* 函数功能: 判断是否是m3gate
	* 输入参数: none
	* 函数返回值: 成功返回string，失败返回false
	* 其它说明: 说明
	*/
	static function isM3gate(){
	       $uainfo = Mobile::getUA();
	       if (preg_match('/M3Gate/i',$uainfo))
	       {
	         Return true;
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: getHttpAccept
	* 函数功能: 取得HA
	* 输入参数: none
	* 函数返回值: 成功返回string，失败返回false
	* 其它说明: 说明
	*/
	static function getHttpAccept(){
	       if (isset($_SERVER['HTTP_ACCEPT']))
	       {
	         Return $_SERVER['HTTP_ACCEPT'];
	       }
	       else
	       {
	         Return false;
	       }
	}
	
	/**
	* 函数名称: getIP
	* 函数功能: 取得手机IP
	* 输入参数: none
	* 函数返回值: 成功返回string
	* 其它说明: 说明
	*/
	static function getIP(){
	       $ip=getenv('REMOTE_ADDR');
	       $ip_ = getenv('HTTP_X_FORWARDED_FOR');
	       if (($ip_ != "") && ($ip_ != "unknown"))
	       {
	         $ip=$ip_;
	       }
	       return $ip;
	}
	
	static function isMobile(){
		// 如果有HTTP_X_WAP_PROFILE则一定是移动设备
		if(isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
			return true;
		}
		  
		//如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
		if(isset($_SERVER['HTTP_VIA'])){
		//找不到为flase,否则为true
			return stristr($_SERVER['HTTP_VIA'],"wap") ? true : false;
		}
		  
		//判断手机发送的客户端标志
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$clientkeywords= array('nokia','sony','ericsson','mot','samsung',
			'htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel',
			'lenovo','iphone','ipod','blackberry','meizu','android','netfront',
			'symbian','ucweb','windowsce','palm','operamini','operamobi',
			'openwave','nexusone','cldc','midp','wap','mobile');
			// 从HTTP_USER_AGENT中查找手机浏览器的关键字
			if(preg_match("/(".implode('|',$clientkeywords).")/i",strtolower($_SERVER['HTTP_USER_AGENT']))){
				return true;
			}
		}
		return false;
	}

}
?> 