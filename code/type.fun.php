<?php
	include_once "common.php";
	include_once "connect.php";
	include_once "../include.php";

/*
**图书类型添加
*/
function addType(){
		$type = $_POST['type'];
		if ($type==null) {
			alertMes("类型不能为空,请重新添加！","type_add.php");
		}else{
			$sql = "INSERT INTO tb_booktype (id,typeName) VALUES(NULL , '{$type}')";
			$conne = new conmysql();
			$row = $conne->uidRst($sql);

			if ($row==null) {
			# code...
				alertMes("添加失败,请重新添加！","type_add.php");
				
			}else{
				alertMes("添加成功！","type_list.php");
				
			}
		}
		return $mes;
	}


/*
**修改图书类型
*/
function alterType($id){
	$type = $_POST['type'];
	if ($type==null) {
		alertMes("图书类型不能为空，请重新修改！","type_alter.php?id=$id");
	}else{
		$sql = "UPDATE tb_booktype SET typeName = '{$type} ' WHERE id = {$id} ";
		$conne = new conmysql();
		$result = $conne->uidRst($sql); 
		if ($result==null) {
			alertMes("修改失败！请重新修改","type_alter.php?id=$id");
		}else{
			alertMes("修改成功！","type_list.php");
		}
	}
}

function delType($id){
	$sql = "DELETE FROM tb_booktype WHERE id={$id}";
	$conne = new conmysql();
	$result = $conne->uidRst($sql);

	if ($result==null) {
		alertMes("删除失败，请重新删除！","type_list.php");
	}else{
		alertMes("删除成功！","type_list.php");
	}
}

?>