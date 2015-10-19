<?php
	header("Content-type:text/html;charset=utf-8");
	include_once "page.fun.php";
	$page= $_REQUEST['page']?(int)$_REQUEST['page']:1;
	echo showPage($page,5);

?>