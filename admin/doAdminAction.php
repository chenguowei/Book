 <?php 
	require_once '../include.php';

	$act=$_REQUEST['act'];
	if (isset($_REQUEST['id'])) {
		$id=$_REQUEST['id'];
	}
 	
 	if($act=="addtype"){	//添加分类
 		addType();           			
 	}elseif ($act=="delType") {	//删除分类
 		delType($id);					
 	}elseif ($act=="alterType") {	//修改分类
 		alterType($id);					
 	}elseif ($act=="delAdmin") {	//删除管理员
 		delAdmin($id);					
 	}elseif ($act=="alterAdmin") {	//修改管理员
 		alterAdmin($id);				
 	}elseif ($act=="addAdmin") {	//添加管理员
 		addAdmin();						
 	}elseif ($act=="addBook") {	//添加图书
 		addBook();						
 	}elseif ($act=="delBook") {	//删除图书
 		delBook($id);					
 	}elseif ($act=="alterBook") {	//修改图书
 		alterBook($id);					
 	}else if($act=="addNews"){	//添加新闻
 		addNews();						
 	}else if($act=="alterNews"){	//修改新闻		
 		alterNews($id);					
 	}else if($act=="delNews"){	//删除新闻
 		delNews($id);
 	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>Insert title here</title>
 </head>
 <body>
  <?php 
 // 	if($mes){
 // 		echo $mes;
 // 	}
 ?>
 </body>
 </html>