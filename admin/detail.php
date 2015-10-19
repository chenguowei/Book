<?php
	include_once "../include.php";

  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
	$id = $_REQUEST['id'];
	$sql = "select book.*,bt.typeName from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.id=$id";
	$row = $conne->getRowsRst($sql);

	if ($row==null) {
		alertMes("查看失败1","book_list.php");
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>图书浏览</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="../css/detail.css" rel="stylesheet">
  </head>
<body>
	<!-- <div class="row back">
		<img src="../images/back.png" width="50" height="50" style="cursor:pointer;" onclick="history.back();">
	</div> -->

  <div class="wrap">
    <div class="row list">
      <!-- 键 -->
      <div class="col-md-4 list_left">
        <ul class="list-group">
        	<li class="list-group-item">编号</li>
          <li class="list-group-item">书名</li>
          <li class="list-group-item">作者</li>
          <li class="list-group-item">类型</li>
          <li class="list-group-item">出版社</li>
          <li class="list-group-item">ISBN</li>
          <li class="list-group-item">点击量</li>
          <li class="list-group-item">价格</li>
          <li class="list-group-item">页码</li>
          <li class="list-group-item">开本</li>
          <li class="list-group-item">包装</li>
        </ul>
      </div>
      <!-- 键 -->

      <!-- 值 -->
      <div class="col-md-8 list_right">
        <ul class="list-group">
          <li class="list-group-item"><?php echo $row['id'];?></li>
          <li class="list-group-item"><?php echo $row['bookName'];?></li>
          <li class="list-group-item"><?php echo $row['author'];?></li>
          <li class="list-group-item"><?php echo $row['typeName'];?></li>
          <li class="list-group-item"><?php echo $row['publishing'];?></li>
          <li class="list-group-item"><?php echo $row['ISBN'];?></li>
          <li class="list-group-item"><?php echo $row['click'];?></li>
          <li class="list-group-item"><?php echo $row['price'];?></li>
          <li class="list-group-item"><?php echo $row['page'];?></li>
          <li class="list-group-item"><?php echo $row['format'];?></li>
          <li class="list-group-item"><?php echo $row['packing'];?></li>
        </ul>
      </div>
      <!-- 值 -->
    </div>
    <!-- row -->

    <!-- 内容简介和作者简介 -->
    <div class="row text">
      <ul class="list-group">
      	<li class="list-group-item">标题简介</li>
          <li class="list-group-item">
            <?php echo $row['titleBrief'];?>
          </li>
        <li class="list-group-item">内容简介</li>
          <li class="list-group-item">
            <?php echo $row['contentBrief'];?>
          </li>
          <li class="list-group-item">作者简介</li>
          <li class="list-group-item">
            <?php echo $row['authorBrief'];?>
          </li>
        </ul>
    </div>
    <!-- row -->
	</div>
	<!-- wrap -->

	<script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>