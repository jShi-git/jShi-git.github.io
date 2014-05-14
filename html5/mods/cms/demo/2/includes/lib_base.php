<?php
if (!defined('MYCMS')){
    die('Hacking attempt');
}

/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value){
    if (empty($value))    {
        return $value;
    }else    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}


function is_utf8($string) {
		// From http://w3.org/International/questions/qa-forms-utf-8.html
		return preg_match('%^(?:
		[\x09\x0A\x0D\x20-\x7E] # ASCII
		| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
		| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
		| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
		| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
		| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
		| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
		| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
		)*$%xs', $string);
}


/**
 * 截取UTF-8编码下字符串的函数
 *
 * @param   string      $str        被截取的字符串
 * @param   int         $length     截取的长度
 * @param   bool        $append     是否附加省略号
 *
 * @return  string
 */
function sub_str($str, $length = 0, $append = true)
{
    $str = trim($str);
    $strlength = strlen($str);

    if ($length == 0 || $length >= $strlength)
    {
        return $str;
    }
    elseif ($length < 0)
    {
        $length = $strlength + $length;
        if ($length < 0)
        {
            $length = $strlength;
        }
    }

    if (function_exists('mb_substr'))
    {
        $newstr = mb_substr($str, 0, $length, 'utf-8');
    }
    elseif (function_exists('iconv_substr'))
    {
        $newstr = iconv_substr($str, 0, $length, 'utf-8');
    }
    else
    {
        //$newstr = trim_right(substr($str, 0, $length));
        $newstr = substr($str, 0, $length);
    }

    if ($append && $str != $newstr)
    {
        $newstr .= '...';
    }

    return $newstr;
}


//check email
function isEmail($email){
	$email=trim($email);
	if(empty($email)){return false;}
	$a=preg_match("/^[a-z0-9][\w\.-]*@[\w-]+\.\w[\w-\.]*[a-z]$/i",$email,$m);
	if($a){
		return true;
	}else{
		return false;
	}
}


//获取随机数字
function simpleRand($num=1){
	if(intval($num)<1){
		$num=1;
	}
	$str='abcdefghijklmnopqrstuvwxyz1234567890';
	$r='';
	for($i=0;$i<$num;$i++){
		$tmp=rand(0,strlen($str)-1);
		$r.=$str{$tmp};
	}
	return $r;
}

/**
 * 获得用户的真实IP地址
 * Startar from ecshop
 * @access  public
 * @return  string
 */
function real_ip()
{
		static $realip = NULL;
		if ($realip !== NULL)
		{
			return $realip;
		}
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				/* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
				foreach ($arr AS $ip)
				{
					$ip = trim($ip);
					if ($ip != 'unknown')
					{
						$realip = $ip;
						break;
					}
				}
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				if (isset($_SERVER['REMOTE_ADDR']))
				{
					$realip = $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$realip = '0.0.0.0';
				}
			}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_CLIENT_IP'))
			{
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
		}
		preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
		$realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
		return $realip;
}


function show_permission_msg($msg,$type) {
		header('Content-Type: text/html; charset=utf-8');
		if ($type ==1) {
			$js_string ="<script type='text/javascript'>alert('".$msg."');window.history.go(-1);</script>";
		} else {
			$js_string ="<script type='text/javascript'>alert('".$msg."');window.history.go(-2);</script>";
		}
		echo $js_string;
		exit;
}


function show_msg($msg,$type,$style=false) {
		if ($type ==1) {
			//startar edit	返回先前一页,修正google浏览器返回后会重复选中(如checkbox)
			if(isset($_SERVER['HTTP_REFERER'])){
				$js_string ="<script type='text/javascript'>location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			}else{
				$js_string ="<script type='text/javascript'>window.history.go(-1);</script>";
			}
		} else {
			$js_string ="<script language='javascript'>window.history.go(-2);</script>";
		}
		if($style==true){
			$js_string ="<script type='text/javascript'>alert('".$msg."');</script>".$js_string;
		}
		echo $js_string;
		exit;
}


/**
 *	自定义抓取网页的html,(可以保存cookie功能)
 *	@param		string	$url	网址
 *	@param		int		$needcookie	1，保存，2，使用
 *	@param		string	$usecookie	文件地址
 *	@return	string
 */
function get_website_html_cook($url=null,$needcookie=false,$usecookie=false){
		if(empty($url)) return '';

		$SET_HTTP_USER_AGENT='Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 (.NET CLR 2.0.50727)';
		$info=array();

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:$SET_HTTP_USER_AGENT);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		if($needcookie==1){
			curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);
		}elseif($needcookie==2){
			curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);
		}

		$info['html']=curl_exec($ch);
		$info['info']=curl_getinfo($ch);
		curl_close($ch);

		if(isset($info['html']) and $info['info']['http_code']=='200'){
			return $info['html'];
		}elseif($needcookie==1 or $needcookie==2){
			return $info['html'];
		}else{
			if(substr($url,0,4)!='http'){
				$url='http://'.$url;
			}
			return @file_get_contents($url);
		}
}


//导出csv文件(utf-8编码)
function fileToCSV($filename,$data) {
		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=" . $filename);
		echo "\xEF\xBB\xBF".$data;exit();
}


?>
