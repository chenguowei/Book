<?php
	class conmysql{
		private $host = 'localhost';      		//服务器地址
		private $name = 'root';			  		//账号
		private $pwd = '';				 		//密码
		private $dBase = '';					//连接的数据库名称
		private $conn = '';						//数据库连接资源
		private $result = '';					//结果集
		private $msg = '';					//返回结果
		private $fields; 						//返回字段
		private $fieldsNum = 0;					//返回字段数
		private $rowsNum = 0;					//返回结果数
		private $rowsRst = '';					//返回单条记录的字段数组
		private $filesArray = array();			//返回字段数组
		private $rowsArray = array();			//返回结果数组

		/*
			构造函数
		*/
		function __construct($host='', $name='', $pwd='', $dBase=''){
			if ($host != '') {
				$this->host = $host;
			}
			if ($name != '') {
				$this->name = $name;
			}
			if ($pwd != '') {
				$this->pwd = $pwd;
			}
			if ($dBase != '') {
				$this->dBase = $dBase;
			}
			$this->init_conn();
		}

		/*
		**连接数据库
		*/
		// $host = "localhost";
		// $name = "root";
		// $pwd = "";
		// $re = mysql_connect($host,$name,$pwd);
		// if ($re !='') {
		// 	# code...
		// 	echo "数据库连接成功！";
		// }else{
		// 	echo mysql_error();
		// }
		function init_conn(){
			$this->conn = mysql_connect($this->host, $this->name, $this->pwd);			
			mysql_select_db('book');
			mysql_query("set names utf8");
			
		}

		/*
		**返回查询结果集
		*/
		function mysql_query_rst($sql){
			if ($this->conn == '') {
				$this->init_conn();
			}
			$this->result = mysql_query($sql, $this->conn);
		}

		/*
		**返回查询记录数
		*/
		function getRowsNum($sql){
			$this->mysql_query_rst($sql);
			if(mysql_errno() == 0){
				return mysql_num_rows($this->result);
			}else{
				return '';
			}
		}

		/*
		**返回结果集的关联数组
		*/
		function getRowsRst($sql){
			$this->mysql_query_rst($sql);
			if (mysql_errno() == 0) {
				$this->rowsRst = mysql_fetch_array($this->result, MYSQL_ASSOC);
				return $this->rowsRst;
			}else{
				return '';
			}
		}

		/*
		**返回有多条记录的二维数组
		*/
		function getRowsArray($sql){
			$this->mysql_query_rst($sql);
			if(mysql_errno() == 0){
				while ($row = mysql_fetch_array($this->result,MYSQL_ASSOC)) {
					$this->rowsArray[] = $row;
				}
				return $this->rowsArray;
			}else{
				return '';
			}
		}

		/*
		**返回更新，删除，添加的记录数
		*/
		function uidRst($sql){
			if ($this->conn == '') {
				$this->init_conn();
			}
			$query=mysql_query($sql);

			if($query==true){
				echo "success";
			}else{
				echo "fail";
			}
			
			$this->rowsNum = mysql_affected_rows();
			if (mysql_errno() == 0) {
				return $this->rowsNum;
			}else{
				return '';
			}
		}

		function updateDate($sql){
			$result = mysql_query($sql);

			if ($result) {
				return mysql_affected_rows();
			}else{
				return false;
			}
		}

		/*
		**释放结果集
		*/
		function close_rst(){
			mysql_free_result($this->result);
			$this->msg = '';
			$this->fieldsNum = 0;
			$this->rowsNum = 0;
			$this->filesArray = '';
			$this->rowsArray = '';
		}

		/*
		**关闭数据库
		*/
		function close_conn(){
			$this->close_rst();
			mysql_close($this->conn);
			$this->conn = '';
		}

	 }

	 $conne = new conmysql();
?>