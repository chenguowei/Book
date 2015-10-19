<?php
	//session_start();
	include_once "common.php";
	include_once "connect.php";
	include_once "../include.php";
	
	/*
	**检验管理员是否登录
	*/
	function checkLogined(){
		if (!isset($_SESSION['admin_name'])) {
			alertMes("请先登录您的管理员帐号！","../user/index.php");
		}
	}

	// function getAdminList($page,$PageSize=2,$table){
	// 	$con = new conmysql();
	// 	$sql = "select * from {$table}";
	// 	global $totalRows;
	// 	$totalRows = $con->getRowsNum($sql);
		
	// 	global $totalPage;
	// 	$totalPage = ceil($totalRows/$PageSize);
	// 	if ($page<1||$page==null||!is_numeric($page)) {
	// 		# code...
	// 		$page = 1;
	// 	}
	// 	if ($page>$totalPage) {
	// 		# code...
	// 		$page = $totalPage;
	// 	}
	// 	$offset = ($page-1)*$PageSize;
	// 	$sql = "select * from {$table} limit {$offset},{$PageSize}";
	// 	$rows = $con->getRowsArray($sql);

	// 	return $rows;

	// }

	function getAllAdmin(){

	}

	/*
	**删除管理员
	*/
	function delAdmin($id){
		$sql = "DELETE FROM tb_manager WHERE id={$id}";
		$conne = new conmysql();
		$result = $conne->uidRst($sql);

		if ($result==null) {
			alertMes("删除失败，请重新删除！","admin_list.php");
		}else{
			alertMes("删除成功！","admin_list.php");
		}
	}
	
	/*
	**获取一条管理员记录
	*/
	function getOneAdmin($id){
		$sql = "select * from tb_manager where id={$id}";
		$conne = new conmysql();
  		$row = $conne->getRowsRst($sql);

  		return $row;
	}

	/*
	**添加管理员
	*/
	function addAdmin(){
		$name = $_POST['name'];
		$password = $_POST['password'];
		$modifypassword = $_POST['modifypassword'];

		if ($name==null) {
			alertMes("管理员名字不能为空,请重新添加！","admin_add.php");
		}elseif ($password!=$modifypassword) {
			alertMes("两次输入的密码不一致，请重新输入","admin_add.php");
		}else{
			$sql = "INSERT INTO tb_manager (name,password) VALUES('$name','$password')";
			$conne = new conmysql();
			$result = $conne->uidRst($sql);
			if ($result==null) {
				alertMes("添加失败，请重新添加！","admin_add.php");
			}else{
				alertMes("添加成功！","admin_list.php");
			}
		}
	}

	/*
	**修改管理员信息
	*/
	function alterAdmin($id){
		$name = $_POST['name'];
		$password = $_POST['password'];
		$modifypassword = $_POST['modifypassword'];

		if ($name==null) {
			alertMes("管理员名字不能为空,请重新修改！","admin_alter.php?id=$id");
		}elseif ($password!=$modifypassword) {
			alertMes("两次输入的密码不一致，请重新输入","admin_alter.php?id=$id");
		}else{
			$sql = "UPDATE tb_manager SET name='$name',password='$password' WHERE id=$id";
			$conne = new conmysql();
			$result = $conne->uidRst($sql);
			if ($result==null) {
				alertMes("修改失败，请重新修改！","admin_alter.php?id=$id");
			}else{
				alertMes("修改成功！","admin_list.php");
			}
		}
	}
?>