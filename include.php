<?php
	header("Content-Type:text/html;charset=utf-8");
	error_reporting(0);
	
	date_default_timezone_set("PRC");
	session_start();
	define('ROOT', dirname(__FILE__));
	set_include_path(".".PATH_SEPARATOR.ROOT."/code");
	include_once "admin.fun.php";
	include_once "common.php";
	include_once "connect.php";
	include_once "page.fun.php";
	include_once "string.fun.php";
	include_once "type.fun.php";
	include_once "book.fun.php";
	include_once "upload.php";
	include_once "news.fun.php";
?>