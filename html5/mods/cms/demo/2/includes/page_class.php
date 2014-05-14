<?php

class classPage{
	var $total=0;		//总计数量
	var $perpage=10;	//分页数
	var $nowpage=1;		//显示页
	var $areapage=4;	//区域
	var $classArr=array('PrevPage','NextPage','pagelink','morepage','currentpage',);
	var $pagecount=0;	//分页总数
	var $page_name='page';	//分页的名称
	var $pageHtml='';
	var $url='';

	/*  初始化  */
	function __construct($dataArr=array() ,$styleArr=array()){
		$this->classPage($dataArr ,$styleArr);
	}
	function classPage($dataArr ,$styleArr){
		if(isset($dataArr['total'])){
			$this->total=intval($dataArr['total']);
		}
		if(isset($dataArr['perpage'])){
			$this->perpage=intval($dataArr['perpage']);
		}
		if(isset($dataArr['nowpage'])){
			$this->nowpage=intval($dataArr['nowpage']);
		}elseif(isset($dataArr['page_name'])){
			$this->page_name=trim($dataArr['page_name']);
			$this->nowpage=intval(isset($_REQUEST[$this->page_name])?$_REQUEST[$this->page_name]:1);
		}
		if(isset($dataArr['areapage'])){
			$this->areapage=intval($dataArr['areapage']);
		}
		
		$this->pagecount=intval(($this->total-1)/$this->perpage)+1;
		$this->nowpage=($this->nowpage<1)?1:$this->nowpage;
		$this->nowpage=($this->nowpage>$this->pagecount)?$this->pagecount:$this->nowpage;
		
		//处理url
		if(empty($_SERVER['QUERY_STRING'])){
			$this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
		}else{
			$this->url=$_SERVER['REQUEST_URI'];
			if(strpos($this->url,'?'.$this->page_name.'=')!==false){
				$this->url=preg_replace(
						array("/[\?&]".$this->page_name."=[^&]*([&]?)(.*?)$/is",),
						array('?\\2'),
						$this->url
					);
				if(substr($this->url,-1)=='?'){
					$this->url.=''.$this->page_name.'=';
				}else{
					$this->url.='&'.$this->page_name.'=';
				}
			}else{
				$this->url=preg_replace(
						array("/[\?&]".$this->page_name."=[^&]*([&]?)/is",),
						array('\\1'),
						$this->url
					);
				$this->url.='&'.$this->page_name.'=';
			}
			/*
			$this->url=preg_replace(
					array("/([\?&])".$this->page_name."=[^&]*([&]?)/is",),
					array('\\1\\2'),
					$this->url
				);
			$this->url=str_replace('&&','&',$this->url);
			$this->url=str_replace('?&','?',$this->url);
			$this->url.='&'.$this->page_name.'=';
			*/
		}
	}

	//整理分页
	function getPageHtml(){
		$html='';
		if($this->total==0 or $this->pagecount==0){
			$html='<a class="pagelink currentpage" title="0">0</a> ';
			return $html;
		}
		
		$current='';
		if($this->nowpage-$this->areapage<=2){
			for($i=1;$i<=$this->nowpage;$i++){
				if($i==$this->nowpage){
					$current=' currentpage';
					$html.='<a class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
				}else{
					$html.='<a href="'.$this->url.($i).'" class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
				}
			}
		}else{
			$html.='<a href="'.$this->url.'1" class="pagelink'.$current.'" title="1">1</a> ';
			$html.='<span class="morepage" title="more">...</span> ';
			$i=$this->nowpage-$this->areapage;
			for($i;$i<=$this->nowpage;$i++){
				if($i==$this->nowpage){
					$current=' currentpage';
					$html.='<a class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
				}else{
					$html.='<a href="'.$this->url.($i).'" class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
				}
			}
		}
		
		if($this->nowpage>=$this->pagecount){
			return $html;
		}
		
		$current='';
		if($this->nowpage+$this->areapage>=$this->pagecount-1){
			$i=$this->nowpage+1;
			for($i;$i<=$this->pagecount;$i++){
				$html.='<a href="'.$this->url.($i).'" class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
			}
		}else{
			$i=$this->nowpage+1;
			$i_end=$this->nowpage+$this->areapage;
			for($i;$i<=$i_end;$i++){
				$html.='<a href="'.$this->url.($i).'" class="pagelink'.$current.'" title="'.$i.'">'.$i.'</a> ';
			}
			$html.='<span class="morepage" title="more">...</span> ';
			$html.='<a href="'.$this->url.($this->pagecount).'" class="pagelink'.$current.'" title="'.$this->pagecount.'">'.$this->pagecount.'</a> ';
		}

		return $html;
	}
	
	//显示分页
	function show(){
		$tmp='';
		$tmp=$this->getPageHtml();
		if($this->nowpage>1){
			$tmp='<a href="'.$this->url.($this->nowpage-1).'" class="PrevPage" title="上一页">上一页</a> '.$tmp;
		}
		if($this->nowpage<$this->pagecount){
			$tmp.='<a href="'.$this->url.($this->nowpage+1).'" class="NextPage" title="下一页">下一页</a> ';
		}
		return $tmp;
	}


}

?>