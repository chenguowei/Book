<?php
	include_once "../include.php";

	/*
	**添加书籍
	*/
	function addBook(){
		$arr = $_POST;

		//判断必填字段是否为空
		if ($arr['bookName']==null) {
			alertMes("书名不能为空，请重新添加！","book_add.php");
		}
		if ($arr['author']==null) {
			alertMes("作者不能为空，请重新添加！","book_add.php");
		}
		if ($arr['publishing']==null) {
			alertMes("出版社不能为空，请重新添加！","book_add.php");
		}
		if ($arr['ISBN']==null) {
			alertMes("ISBN不能为空，请重新添加！","book_add.php");
		}
		if ($arr['price']==null) {
			alertMes("价格不能为空，请重新添加！","book_add.php");
		}
		if ($arr['page']==null) {
			alertMes("页数不能为空，请重新添加！","book_add.php");
		}
		$name = $arr['bookName'];
		$author = $arr['author'];
		$price = $arr['price'];
		$typeid = $arr['type'];
		$ISBN = $arr['ISBN'];
		$publishing = $arr['publishing'];
		$page = $arr['page'];
		$format = ($arr['format']=="")?"无":$arr['format'];
		$packing = ($arr['packing']=="")?"无":$arr['packing'];
		$titleBrief = ($arr['titleBrief']=="")?"无":$arr['titleBrief'];
		$contentBrief = ($arr['contentBrief']=="")?"无":$arr['contentBrief'];
		$authorBrief = ($arr['authorBrief']=="")?"无":$arr['authorBrief'];
		
		$path="../book_imgs";
		$uploadFiles = uploadFile($path);	
		
		$small_image = $uploadFiles['0']['name'];
		$big_image = $uploadFiles['1']['name'];
		
		$sql="INSERT INTO tb_bookinfo (bookName,author,price,typeId,ISBN,image,imageBig,publishing,page,
			format,packing,titleBrief,contentBrief,authorBrief) VALUES('$name','$author',$price,$typeid,
			'$ISBN','$small_image','$big_image','$publishing',$page,'$format','$packing','$titleBrief',
			'$contentBrief','$authorBrief')";
		// $query=mysql_query($sql);
		$conne = new conmysql();
		$result = $conne->uidRst($sql);
		
		if ($result==null) {
			alertMes("添加书籍失败，请重新添加！","book_add.php");
		}else{
			alertMes("添加书籍成功！","book_list.php");
		}
	}

	/*
	**修改图书
	*/
	function alterBook($id){
		//获取数据
		$arr = $_POST;

		//判断必填字段是否为空
		if ($arr['bookName']==null) {
			alertMes("书名不能为空，请重新添加！","book_add.php");
		}
		if ($arr['author']==null) {
			alertMes("作者不能为空，请重新添加！","book_add.php");
		}
		if ($arr['publishing']==null) {
			alertMes("出版社不能为空，请重新添加！","book_add.php");
		}
		if ($arr['ISBN']==null) {
			alertMes("ISBN不能为空，请重新添加！","book_add.php");
		}
		if ($arr['price']==null) {
			alertMes("价格不能为空，请重新添加！","book_add.php");
		}
		if ($arr['page']==null) {
			alertMes("页数不能为空，请重新添加！","book_add.php");
		}
		$name = $arr['bookName'];
		$author = $arr['author'];
		$price = $arr['price'];
		$typeid = $arr['type'];
		$ISBN = $arr['ISBN'];
		$publishing = $arr['publishing'];
		$page = $arr['page'];
		$format = ($arr['format']=="")?"无":$arr['format'];
		$packing = ($arr['packing']=="")?"无":$arr['packing'];
		$titleBrief = ($arr['titleBrief']=="")?"无":$arr['titleBrief'];
		$contentBrief = ($arr['contentBrief']=="")?"无":$arr['contentBrief'];
		$authorBrief = ($arr['authorBrief']=="")?"无":$arr['authorBrief'];

		$conne = new conmysql();
		$sql_s= "select image ,imageBig from tb_bookinfo where id=$id";
		$row = $conne->getRowsRst($sql_s);
		$old_small_image = $row['image'];
		$old_big_image = $row['imageBig'];

		//上传图片
		$path="../book_imgs";
		$uploadFiles = uploadFile($path);

		//获取上传图片
		$small_image = $uploadFiles['0']['name'];
		$big_image = $uploadFiles['1']['name'];

		//print_r($row);

		$small_image = $uploadFiles['0']['name'];
		$big_image = $uploadFiles['1']['name'];
		if($small_image==""){
			$small_image=$old_small_image;
		}
		if($big_image==""){
			$big_image=$old_big_image;
		}

		// if(file_exists("../book_imgs/".$old_small_image)){
		// 	unlink("../book_imgs/".$old_small_image);
		// }if(file_exists("../book_imgs/".$old_big_image)){
		// 	unlink("../book_imgs/".$old_big_image);
		// }

		//上传图片
		// $path="../book_imgs";
		// $uploadFiles = uploadFile($path);

		//获取上传图片的名字
		// $small_image = $uploadFiles['0']['name'];
		// $big_image = $uploadFiles['1']['name'];

		$sql = "UPDATE tb_bookinfo SET bookName='$name',author='$author',price=$price,typeId=$typeid,
		ISBN='$ISBN',publishing='$publishing',page=$page,format='$format',packing='$packing',
		titleBrief='$titleBrief',contentBrief='$contentBrief',authorBrief='$authorBrief',image='$small_image',
		imageBig='$big_image' WHERE id=$id";//sql语句没有问题
		$conne = new conmysql();
		$result = $conne->uidRst($sql);

		if($result) {						//修改失败，那就删除上传的图片
			alertMes("修改书籍成功！","book_list.php");
		}else if($result==0&&$small_image!=""&&$big_image!=""){
			alertMes("修改书籍成功！","book_list.php");
		}else{
			if(file_exists("$path"."/".$small_image)) {   //删除小的图片
				unlink("$path/".$small_image);
			}if(file_exists("$path"."/".$big_image)) {		//删除大的图片
				unlink("$path/".$big_image);
			}
			alertMes("修改书籍失败，请检查相应的属性是否满足要求！","book_alter.php");		
		}
	}

	/*
	**删除书籍
	*/
	function delBook($id){
		if ($id==null) {
			alertMes("没有选择要删除的图书!","book_list.php");
		}
		$conne = new conmysql();
		$sql_s= "select image ,imageBig from tb_bookinfo where id=$id";
		$row = $conne->getRowsRst($sql_s);
		$image = $row['image'];
		$big_image = $row['imageBig'];

		//删除文件中的图片
		if(file_exists("../book_imgs/".$image)){
			unlink("../book_imgs/".$image);
		}if(file_exists("../book_imgs/".$big_image)){
			unlink("../book_imgs/".$big_image);
		}

		$sql = "DELETE FROM tb_bookinfo where id=$id";
		
		$result = $conne->uidRst($sql);
		
		if ($result==null) {
			alertMes("删除失败!,请重新删除！","book_list.php");
		}else{

			alertMes("删除成功！","book_list.php");
		}
	}

	/*
	**获取所有图书信息
	*/
	function getAllBook(){
		$sql = "select book.*,bt.typeName from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id";
		$conne = new conmysql();
		$rows = $conne->getRowsArray($sql);

		return $rows;
	}

	/*
	**根据ID获取图书的一条记录
	*/
	function getOneBook($id){
		$sql = "select * from tb_bookinfo where id=$id";
		$conne = new conmysql();
		$row = $conne->getRowsRst($sql);

		return $row;
	}
?>