<?php
  include_once "../include.php";

  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
  $id = $_GET['id'];
  $sql = "select *from tb_news where id={$id}";
  $row = $conne->getRowsRst("$sql");
  if ($row==null) {
    alertMes("没有找到改数据!","news_list.php");
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>新闻修改</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="../css/add.css" rel="stylesheet">
  </head>
  <body>
<!--列表 -->
      <h2>新闻修改：</h2>
      <form class="form-horizontal" action="doAdminAction.php?act=alterNews&id=<?php echo $row['id']?>" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"></label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="inputEmail3" name="news" value="<?php echo $row['content']?>">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <input type="submit" class="btn btn-default" value="修改"/>
      <!-- <button type="submit" class="btn btn-default">添加</button> -->
    </div>
  </div>
</form>

    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>