<?php 
  include_once "../include.php";

  session_start();
  checkLogined();
  if(isset($_REQUEST['page'])){
    $page=$_REQUEST['page'];
  }else{
    $page = 1;
  }
  $PageSize=10;
  $table = 'tb_bookinfo';
  $rows = datePage($page,$PageSize=10,$table);
  if ($rows==null) {
    alertMes("没有可显示的图书，请添加图书！","book_add.php");
  }
?>

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>图书列表</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
  </head>
  <body>
    <div class="panel panel-primary">
      <div class="panel-heading">图书总览</div>
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>书名</th>
              <th>作者</th>
              <th>类型</th>
              <th>出版社</th>
              <th>点击量</th>
              <th>详细信息</th>
              <th>删除</th>
              <th>修改</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($rows as $row):?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['bookName']?></td>
              <td><?php echo $row['author']?></td>
              <td><?php echo $row['typeName']?></td>
              <td><?php echo $row['publishing'];?></td>
              <td><?php echo $row['click']?></td>
              <td><a href="detail.php?id=<?php echo $row['id']?>">查看</a></td>
              <td><a href="doAdminAction.php?act=delBook&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-remove"></span></a></td>
              <td><a href="book_alter.php?id=<?php echo $row['id']?>" target="mainFrame" ><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>

        <?php if($totalRows > $PageSize):?>
        <nav class="text-center">
          <ul class="pagination">
            <?php echo showPage($page,$totalPage);?>
          </ul>
        </nav>
      <?php endif;?>
        <!-- 分页 -->
      </div>
      <!-- panel-body -->
    </div>
    <!-- panel -->

    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>