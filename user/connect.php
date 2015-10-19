<?php
	include('config.php');//Attention:It would be better to use absolute path here
	//Connect database
	if(!($con = mysql_connect(HOST, USERNAME, PASSWORD))){
		echo mysql_error();
	}
	//Select database
	if(!mysql_select_db('book')){
		echo mysql_error();
	}
	//Set names
	if(!mysql_query('set names utf8')){
		echo mysql_error();
	}
?>