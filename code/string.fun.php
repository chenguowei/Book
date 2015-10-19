<?php
	/**
	*获取唯一的字符串
	*/
	function getUniName(){
		return md5(uniqid(microtime(true),true));
	}


	/**
	*获得文件的扩展名
	*/
	function getExt($filename){
		$string = explode(".", $filename);
		return strtolower(end($string));
	}

?>