<?php
	include_once "common.php";
	include_once "connect.php";
	include_once "../include.php";

/*
**图书类型添加
*/
function addNews(){
	$new = $_POST['new'];
	if ($new==null) {
		alertMes("新闻不能为空！","news_add.php");
	}else{
		$sql = "INSERT INTO tb_news (id,content)VALUES (NULL , '{$new}')";
		$conne = new conmysql();
		$row = $conne->uidRst($sql);

		if ($row==null) {
			alertMes("添加失败,请重新添加！","news_add.php");
			
		}else{
			alertMes("添加成功！","news_list.php");
			
		}
	}
	//return $mes;
}

/*
**修改图书类型
*/
function alterNews($id){
	$news = $_POST['news'];
	if ($news==null) {
		alertMes("新闻不能为空，请重新修改！","news_alter.php?id=$id");
	}else{
		$sql = "UPDATE tb_news SET content = '{$news}' WHERE id = {$id}";
		$conne = new conmysql();
		$result = $conne->uidRst($sql); 
		if ($result==null) {
			alertMes("修改失败！请重新修改","news_alter.php?id=$id");
		}else{
			alertMes("修改成功！","news_list.php");
		}
	}
}

function delNews($id){
	$sql = "DELETE FROM tb_news WHERE id={$id}";
	$conne = new conmysql();
	$result = $conne->uidRst($sql);

	if ($result==null) {
		alertMes("删除失败，请重新删除！","news_list.php");
	}else{
		alertMes("删除成功！","news_list.php");
	}
}
?>