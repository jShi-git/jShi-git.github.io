<?php

class Dbclass {
	var $conn=NULL;
	var $querynum = 0;
	function __construct($dbhost,$pconnect = 0){
  		$this->connect($dbhost,$pconnect = 0);
  	}
	function connect($dbhost,$pconnect = 0){
		$dbconfig=explode('|',$dbhost);
		$dbhost=$dbconfig[1];
		$dbuser=$dbconfig[2];
		$dbpw=$dbconfig[3];
		$dbname=$dbconfig[4];

		if($pconnect){
			if(!mysql_pconnect($dbhost,$dbuser,$dbpw)){
				$this->halt();
			}
		} else {
			if(!mysql_connect($dbhost,$dbuser,$dbpw)){
				$this->halt();
			}
		}
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db($dbname);
	}
	function select_db($dbname){
		return mysql_select_db($dbname);
	}
	function query($sql,$silence = 0){
		//echo $sql;
		$query = mysql_query($sql);
		if(!$query && !$silence){
			$this->halt();
		}
		$this->querynum++;
		return $query;
	}
	function fetch_array($query,$result_type = MYSQL_ASSOC){
		return mysql_fetch_array($query,$result_type);
	}
	function getlist($table,$wheres = "1=1", $colums = '*',$limits = '20',$orderbys="id DESC"){
		$query = $this->query("select ".$colums." from ".$table." where ".$wheres." ORDER BY  ".$orderbys."  limit ".$limits);
		while($rs = $this->fetch_array($query)){
			$datas[]=Base::magic2word($rs);
		}
		return $datas ;
	}
	function getquery($sqltext){
		$sqlArray=array();
		$sqlArray=explode('|',$sqltext);
		$table=$sqlArray[0];
		if(!$sqlArray[0]){
			return NULL;
		}
		$wheres=$sqlArray[1]?$sqlArray[1]:'1=1';
		$limits=$sqlArray[2]?$sqlArray[2]:'10';
		$orderbys=$sqlArray[3]?$sqlArray[3]:"id DESC";
		$colums=$sqlArray[4]?$sqlArray[4]:"*";
		$query = $this->query("select ".$colums." from ".$table." where ".$wheres." ORDER BY  ".$orderbys."  limit ".$limits);
		return $query;
		}
	function add_one($table,$data ){
		if (is_array($data)){
			foreach ($data as $k=>$v){
				$colums.=Base::safeword($k).',';
				$columsData.="'".Base::safeword($v)."',";
			}

		$sql="INSERT INTO ".$table." (".substr($colums,0,-1).") VALUES(".substr($columsData,0,-1).")";
		$query = $this->query($sql);
		return $this->insert_id();
		}
		return FALSE;
	}
	function delist($table,$idArray,$wheres=""){
		if($wheres==''){
			$ids=implode(',',$idArray);
			$query = $this->query("DELETE FROM ".$table." WHERE id in(".$ids.")");
		}else{
			$query = $this->query("DELETE FROM ".$table." WHERE ".$wheres);
		}
		return $query;
	}
	function updatelist($table,$data,$id,$idArray){
		if (is_array($data)){
			foreach ($data as $k=>$v){
				$updateData.=Base::safeword($k)."='".Base::safeword($v)."',";
			}
			$data=substr($updateData,0,-1);
		}
		$idArray=(array)$idArray;
		$ids=implode(',',$idArray);
		$query = $this->query("UPDATE ".$table." set ".$data."  WHERE ".$id." in(".$ids.")");   
		return $query;
	}

    
	function get_one($table,$wheres = "1=1", $colums = '*',$limits = '1',$orderbys="id DESC"){
		$sql="select ".$colums." from ".$table." where ".$wheres." ORDER BY  ".$orderbys."  limit ".$limits;
		$query = $this->query($sql);
		$rs = Base::magic2word($this->fetch_array($query));
		$this->free_result($query);
		return $rs ;
	} 
	function affected_rows(){
		return mysql_affected_rows();
	}

	function error(){
		return mysql_error();
	}

	function errno(){
		return mysql_errno();
	}

	function result($query,$row){
		$query = mysql_result($query,$row);
		return $query;
	}

	function num_rows($query){
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query){
		return mysql_num_fields($query);
	}

	function free_result($query){
		return mysql_free_result($query);
	}

	function insert_id(){
		$id = mysql_insert_id();
		return $id;
	}

	function fetch_row($query){
		$query = mysql_fetch_row($query);
		return $query;
	}

	function halt(){
		echo $this->error();
	}
	function close(){
		mysql_close();
	}
}
?>