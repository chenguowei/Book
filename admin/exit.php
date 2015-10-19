<?php
	session_start();//不要忘了初始化SESSION变量

	if(isset($_SESSION['admin_name'])){
		unset($_SESSION['admin_name']);
	}
	if(isset($_SESSION['admin_password'])){
		unset($_SESSION['admin_password']);
	}

	echo "<script language=javascript>alert('注销成功！');window.location='../user/index.php'</script>";
?>