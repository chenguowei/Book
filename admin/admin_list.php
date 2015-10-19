<?php
  include_once "../include.php";

  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
  if(isset($_REQUEST['page'])){
    $page=$_REQUEST['page'];
  }else{
    $page = 1;
  }
  $PageSize = 10;
  $table = 'tb_manager';
  $rows = datePage($page,$PageSize,$table);
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>管理员列表</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
  </head>
  <body>
    <div class="panel panel-primary">
      <div class="panel-heading">管理员总览</div>
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>姓名</th>
              <th>密码</th>
              <th>删除</th>
              <th>修改</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rows as $row):?>
            <tr>
              <td><?php echo $row['id']?></td>
              <td><?php echo $row['name']?></td>
              <td><?php echo $row['password']?></td>
              <td><a href="doAdminAction.php?act=delAdmin&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td> 
              <td><a href="admin_alter.php?id=<?php echo $row['id']?>" target="mainFrame"><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>

        <?php if($totalRows > $PageSize):?>
        <nav class="text-center">
          <?php echo showPage($page,$totalPage);?>
        </nav>
        <!-- 分页 --> 
      <?php endif;?>
      </div>
      <!-- panel-body -->
    </div>
    <!-- panel -->

    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>