<?php
	if($_POST['submit']!=""){
		session_start();//初始化SESSION变量
		$name=$_POST['name'];//接收表单提交的用户名
		$password=$_POST['password'];//接收表单提交的密码

		class check{
			var $name;
			var $password;

			function check($x,$y){
				$this->name=$x;
				$this->password=$y;
			}

			function checkInput(){
				require_once "../include.php";
				$query=mysql_query("select * from tb_manager where name='".$this->name."' and password='".$this->password."'");
				$info=mysql_fetch_array($query);
				if($info==false){
					//登录失败返回上一级页面
					echo "<script language='javascript'>alert('您输入的管理员信息有误，请重新输入！');history.back();</script>";
				}else{
					//登录成功后刷新当前页面
					echo "<script language='javascript'>alert('管理员登录成功！');window.location='../user/index.php'</script>";
					$_SESSION['admin_name']=$info['name'];//将管理员名称存放到$_SESSION[admin_name]变量中
					$_SESSION['admin_password']=$info['password'];//将管理员密码存放到$_SESSION[admin_password]变量中
				}
			}
		}
		$obj=new check(trim($name),trim($password));
		$obj->checkInput();
	}else{
		echo "表单提交失败";
	}
?>