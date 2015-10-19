<?php
  require_once "../include.php";
  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>管理图书信息</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
    <script>
      //对当前点击的导航项设置active类样式
      $(document).ready(function(){
        $("ul li").click(function(){
          $(this).addClass("active").siblings().removeClass("active")
        });
      });
    </script>
  </head>

  <body style="overflow-y: hidden" onLoad="scrollTo(0,0)"><!-- 隐藏垂直滚动条并且始终让滚动条处在最上方 -->
    <!-- 导航条 -->
    <?php include 'navigation.php';?>
    
    <!-- container -->
    <div class="container-fluid">
      <!-- 左侧边栏 -->
      <div class="row">
        <div class="col-md-2 sidebar">
          <ul class="nav nav-pills nav-stacked">
            <li id="add_item" role="presentation" class="active"><a href="book_list.php" target="mainFrame" >图书列表</a></li>
            <li id="add_item" role="presentation"><a href="book_add.php" target="mainFrame" >添加图书</a></li>
            <li id="add_item" role="presentation"><a href="admin_list.php" target="mainFrame" >管理员列表</a></li>
            <li id="add_item" role="presentation"><a href="admin_add.php" target="mainFrame" >添加管理员</a></li>
            <li id="add_item" role="presentation"><a href="type_list.php" target="mainFrame" >分类列表</a></li>
            <li id="add_item" role="presentation"><a href="type_add.php" target="mainFrame" >添加分类</a></li>
            <li id="add_item" role="presentation"><a href="news_list.php" target="mainFrame" >新闻总览</a></li>
            <li id="add_item" role="presentation"><a href="news_add.php" target="mainFrame" >添加新闻</a></li>
          </ul>
        </div>
        <!-- 左侧边栏 -->
        
        <div class="col-md-10 main">
          <iframe src="book_list.php" frameborder="0" name="mainFrame" width="100%" height="600"></iframe>
        <div>
      </div>
      <!-- row -->
    </div>
    <!-- conainer -->

    <!--<script src="js/jquery-1.11.1.min.js"></script>-->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>