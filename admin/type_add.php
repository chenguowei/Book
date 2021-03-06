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
  <title>图书浏览</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/admin.css" rel="stylesheet">
  <link href="../css/add.css" rel="stylesheet">
</head>

<body>
  <div class="wrap">
    <form class="form-horizontal" action="doAdminAction.php?act=addtype" method="post">
      <div class="form-group">
        <label for="inputEmail3" class="col-md-2 control-label">类型名称</label>
        <div class="col-md-9">
          <input type="text" class="form-control" id="inputEmail3" placeholder="类型" name="type">
        </div>
        <div class="col-md-1">
          <span class="warning">*</span>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-2"></div>
        <div class="col-md-9 text-right">
          <input type="submit" class="btn btn-primary" value="添加"/>
        </div>
      </div>
    </form>
  </div>

  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>