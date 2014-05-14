<?php
class App{

	static function getTpl($pos_id){
		$where=" position=".$pos_id." AND used=1 ";
		$db	= new Dbclass(SYS_ROOT.DB_NAME);
		$data=$db->get_one(TB.'template',$where,'*',1,' id asc');
		if (isset($data['path'])) return SYS_ROOT.'template'.$data['path'];
	}

	static function uaSave($detail){
		$db	= new Dbclass(SYS_ROOT.DB_NAME);
		$ret=$db->add_one(TB."ualogs",$detail);
		return $ret;
	}

	static function getUaToken($id){
		$db	= new Dbclass(SYS_ROOT.DB_NAME);
		$detail=$db->get_one(TB."ualogs",'id='.$id,'token',1,'id');
		$ret =isset($detail['token'])?$detail['token']:'';
		return $ret;
	}

	static function isValidCookie($data){
		if(!isset($data['id'])||(!isset($data['token']))) return;
		$id=$data['id'];
		$token=$data['token'];
		$db	= new Dbclass(SYS_ROOT.DB_NAME);
		$detail=$db->get_one(TB."ualogs","id=".$id." AND token='".$token."'","*");
		$ret =isset($detail['id'])?$detail['id']:false;
		return $ret;
	}

	static function ua_log(){
		$detail=array();
		$detail['phoneNumber']	=Mobile::getPhoneNumber();
		//$detail['httpHeader']	=Mobile::getHttpHeader();
		$detail['ua']			=Mobile::getUA();
		$detail['phoneType']	=Mobile::getPhoneType();
		$detail['isOpera']		=Mobile::isOpera();
		$detail['isM3gate']		=Mobile::isM3gate();
		$detail['httpAccept']	=Mobile::getHttpAccept();
		$detail['ip']			=Mobile::getIP();
		$detail['token']		=Base::simpleRand(16);
		$ret=self::uaSave($detail);
		return $ret;
	}

	static function createUser($uid=NULL){
		$db	= new Dbclass(SYS_ROOT.DB_NAME);
		//判断是否存在
		$detail=$db->get_one(TB."users",'uid='.$uid,'*');
		if (isset($detail['id'])){
			$_SESSION['member']=$detail;
			return $detail['id'];
		}

		$detail['uid']=$uid;
		$sql=self::autoFormatSql(TB."users",$detail);
		$ret='';
		if($db->query($sql)) {
			$ret=$db->insert_id();
		}
		$detail=$db->get_one(TB."users",'id='.$ret,'*');
		$_SESSION['member']=$detail;
		return $ret;
	}

	//建立插入表的sql语句
	static function autoFormatSql($table='', $field_values, $mode='INSERT', $where=''){
        $sql = '';
		if(empty($field_values)){ $field_values=array(); }
		if ($mode == 'INSERT') {
			$fields = $values = array();
			foreach ($field_values as $key => $value){
				$fields[] = $key;
				if (PHP_VERSION >= '4.3') {
					$values[] = "'" . mysql_real_escape_string($value) . "'";
				} else {
					$values[] = "'" . mysql_escape_string($value) . "'";
				}
			}
			if (!empty($fields)) {
				$sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
			}
		}else{
			$sets = array();
			foreach ($field_values as $key => $value){
				if (PHP_VERSION >= '4.3') {
					$sets[] = $key . " = '" . mysql_real_escape_string($value) . "'";
				} else {
					$sets[] = $key . " = '" . mysql_escape_string($value) . "'";
				}
			}
			if (!empty($sets)) {
				$sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
			}
		}
		return $sql;
	}

}
?>