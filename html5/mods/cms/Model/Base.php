<?php
class Base{
	static function cutStr($string, $sublen=10, $start = 0, $code = 'UTF-8'){
		$string=strip_tags($string);
		if($code == 'UTF-8')
		{
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all($pa, $string, $t_string);

			//if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
			return join('', array_slice($t_string[0], $start, $sublen));
		}
		else
		{
			$start = $start*2;
			$sublen = $sublen*2;
			$strlen = strlen($string);
			$tmpstr = '';
			for($i=0; $i<$strlen; $i++)
			{
				if($i>=$start && $i<($start+$sublen))
				{
					if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);
					else $tmpstr.= substr($string, $i, 1);
				}
				if(ord(substr($string, $i, 1))>129) $i++;
			}
			//if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
			return $tmpstr;
		}
	}

	//清空session
	static function clearseesion(){
		session_unset();
		session_destroy();
	}
	//提示信息
	static function showmessage($msg, $url = '-1',$auto='',$ajax=false) {
		if ($auto){
			echo '<meta http-equiv="refresh" content="'.$auto.';url='.$url.'">';
			die($msg);
		}else{
			if ($url){
				if($url=="-1"){
					$omsg=$ajax?json_encode(array('msg'=>$msg,'no'=>-1)):"history.go(-1);";
				}elseif($url=="0"){
					$omsg=$ajax?json_encode(array('msg'=>$msg,'no'=>0)):"window.close();";
				}else{
					$omsg=$ajax?json_encode(array('msg'=>$msg,'no'=>1)):"location.href='$url';";
				}
			}
			die($ajax?$omsg:"<script language='JavaScript' type='text/JavaScript'>".(($msg<>'')?"alert('{$msg}');":"")."{$omsg}</script>");
		}
	}
	//操作状态提示
	static function execmsg($ctrl,$url,$status=TRUE){
		$msg=$ctrl."执行".($status?"成功":"失败");
		self::showmessage($msg, $url);
	}

	static function checkadmin(){
		if(isset($_SESSION[TB.'admin']['id'])){
			return true;
		}else{
			return false;
		}
	}

	static function catauth($action){
		if(isset($_SESSION[TB.'admin_level'])&&($_SESSION[TB.'admin_level']=='admincat')){
			return in_array($action, array('cms','frame','user','admin'))?true:false;
		}
		return true;
	}

	static function magic2word($text){
		if (is_array($text)) {
			foreach($text as $k=>$v){
			$text[$k]=self::magic2word($v);
			}
		}else{
			$text=stripslashes($text);
		}
		return $text;
	}

	static function safeword($text,$level=8){
		switch ($level)
		{
			case 0:
				if (get_magic_quotes_gpc()) {// 检查magic_quotes_gpc是否打开,如果没有打开，用addslashes进行转义
					$safeword = stripcslashes($text);
				}else{
					$safeword=$text;
				}
				break;
			case 1:
				$safeword=intval($text);
				break;
			case 3:
				$safeword=strip_tags($text);
				break;
			case 5:
				$safeword=nl2br(htmlspecialchars($safeword));
			case 6:
				$safeword=str_replace("'","",addslashes($text));
				$safeword=str_replace("select","",$safeword);
				$safeword=str_replace("union","",$safeword);
				$safeword=str_replace("=","",$safeword);
				break;
			default:
				$safeword=Base::_addslashs($text);
				break;

		}
		return $safeword;
	}

	static function _addslashs($text){
		if (!get_magic_quotes_gpc()) {// 检查magic_quotes_gpc是否打开,如果没有打开，用addslashes进行转义
			$text = addslashes($text);
		}
		return $text;
		
	}

	static function creaturl($data='',$flag=1){
		if($flag==1){
			$configurl=str_replace('{slug}',$data['slug'],Base::magic2word(ATLURL));
			$configurl=str_replace('{id}',$data['id'],$configurl);
			$configurl=str_replace('{Y}',date('Y',$data['times']),$configurl);
			$configurl=str_replace('{m}',date('m',$data['times']),$configurl);
			$configurl=str_replace('{d}',date('d',$data['times']),$configurl);
		}else{
			$configurl=str_replace('{nickname}',urlencode($data['nickname']),Base::magic2word(CATURL));
			$configurl=str_replace('{id}',$data['id'],$configurl);
		}
		return $configurl;
	}

	static function sendheader($status){
		switch ( $status){
			case 404:
				header("HTTP/1.1 404 Not Found");
				header("Status: 404 Not Found");
				exit;
				break;
			default:
				break;
		}
	}

	static function is_utf8($word) {
		if (preg_match ( "/^([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}$/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){2,}/", $word ) == true) {
			return true;
		} else {
			return false;
		}
	}

	static function getCookie() {
		if(isset($_COOKIE["CMS_UID"])) {
			$value=$_COOKIE["CMS_UID"];
			$value=json_decode(base64_decode($value),true);
			if(isset($value['id'])&&(isset($value['token'])) ){
				$uid=App::isValidCookie($value);
			}
		}
		if (!isset($uid)){
			$id=App::ua_log();
			$uaToken=App::getUaToken($id);
			$value['id']=$id;
			$value['token']=$uaToken;
			setcookie("CMS_UID", base64_encode(json_encode($value)), time()+COOKIE_EXPIRE); 
			$uid=App::isValidCookie($value);

		}
		return $uid;
	}

	static function getSession() {
		if (isset($_SESSION['member']['id'])){
			$ret=$_SESSION['member']['id'];
		}else{
			$uid=self::getCookie();
			$ret=App::createUser($uid);
		}
		return $ret;
	}

	//获取随机数字
	static function simpleRand($num = 1) {
		if (intval ( $num ) < 1) {
			$num = 1;
		}
		$str = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$r = '';
		for($i = 0; $i < $num; $i ++) {
			$tmp = rand ( 0, strlen ( $str ) - 1 );
			$r .= $str {$tmp};
		}
		return $r;
	}


}

?>