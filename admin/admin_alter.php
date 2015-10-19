<?php
  include_once "../include.php";

  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
  $id = $_GET['id'];
  //$sql = "select *from book_type where id={$id}";
  $row = getOneAdmin($id);
  if ($row==null) {
    alertMes("没有找到改数据!","admin_list.php");
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>管理员浏览</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/admin.css" rel="stylesheet">
  <link href="../css/add.css" rel="stylesheet"></head>
<body>
  <div class="wrap">
    <form class="form-horizontal" action="doAdminAction.php?act=alterAdmin&id=<?php echo $row['id']?>
      " method="post">
      <!-- 管理员名字 -->
      <div class="form-group">
        <label for="inputEmail3" class="col-md-3 control-label">姓名</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="inputEmail3" name="name" value="<?php echo $row['name']?>">
        </div>
      </div>

      <!-- 输入密码 -->
      <div class="form-group">
        <label for="inputEmail3" class="col-md-3 control-label">密码</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="inputEmail3" name="password" value="<?php echo $row['password']?>">
        </div>
      </div>

      <!-- 再次确认密码框 -->
      <div class="form-group">
        <label for="inputEmail3" class="col-md-3 control-label">再次输入密码</label>
        <div class="col-md-8">
          <input type="text" class="form-control" id="inputEmail3" name="modifypassword" value="<?php echo $row['password']?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-3"></div>
        <div class="col-md-8 text-right">
          <input type="submit" class="btn btn-default" value="确定"/>
        </div>
      </div>
    </form>
  </div>

  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>