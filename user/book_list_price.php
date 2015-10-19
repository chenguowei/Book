<?php 
  include('conn/connect.php');
  session_start();
  if($_SESSION['sort']==""){
    $_SESSION['sort']=="id_asc";
  }
  $query_type=mysql_query("select * from tb_booktype");
  $types=mysql_fetch_array($query_type);

  //获取相应分类的id并查询该分类下的图书信息
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    switch ($id) {
      //1:9-19 2:19-29 3:29-39 4:39-49 5:49-
      case 1:
        $query=mysql_query("select book.id,book.bookName,book.author,book.price,book.image
          from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.price>=9 and book.price<19");
        break;
      case 2:
        $query=mysql_query("select book.id,book.bookName,book.author,book.price,book.image
          from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.price>=19 and book.price<29");
        break;
      case 3:
        $query=mysql_query("select book.id,book.bookName,book.author,book.price,book.image
          from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.price>=29 and book.price<39");
        break;
      case 4:
        $query=mysql_query("select book.id,book.bookName,book.author,book.price,book.image
          from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.price>=39 and book.price<49");
        break;
      case 5:
        $query=mysql_query("select book.id,book.bookName,book.author,book.price,book.image
          from tb_bookinfo book join tb_booktype bt on book.typeId=bt.id where book.price>=49");
        break;
      }
  }

  //创建一个临时表存放选择相应分类后的图书信息
  $sql=mysql_query("create temporary table tmp_bookinfo(tmp_id int(10) unsigned primary key auto_increment,
    tmp_bookName varchar(70),tmp_author varchar(30),tmp_price float(8,2),tmp_image text)");

  //向临时表中逐条插入数据 
  do{
    $sql=mysql_query("insert into tmp_bookinfo(tmp_id,tmp_bookName,tmp_author,tmp_price,tmp_image) values(
      $books[0],'$books[1]','$books[2]',$books[3],'$books[4]')");
  }while($books=mysql_fetch_array($query));

  //分页
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }else{
    $page=1;
  }
  $page_count=10;//每页显示的图书数量
  $row=mysql_num_rows($query);//总的图书数量
  $page_nums=ceil($row/$page_count);//总的分页的页数
  $last=($page-1)*$page_count;//获取上一页的最后一条记录，从而计算下一页的起始记录

  //获得SESSION值
  if(isset($_GET['price_asc'])){
    $_SESSION['sort']="price_asc";
  }
  if(isset($_GET['price_desc'])){
    $_SESSION['sort']="price_desc";
  }
  if(isset($_GET['id_asc'])){
    $_SESSION['sort']="id_asc";
  }
  if(isset($_GET['id_desc'])){
    $_SESSION['sort']="id_desc";
  }

  //根据SESSION值进行相应的排序
  if($_SESSION['sort']=="price_asc"){
    $query=mysql_query("select * from tmp_bookinfo order by tmp_price asc limit $last,$page_count");
  }
  if($_SESSION['sort']=="price_desc"){
    $query=mysql_query("select * from tmp_bookinfo order by tmp_price desc limit $last,$page_count");
  }
  if($_SESSION['sort']=="id_asc"){
    $query=mysql_query("select * from tmp_bookinfo order by tmp_id asc limit $last,$page_count");
  }
  if($_SESSION['sort']=="id_desc"){
    $query=mysql_query("select * from tmp_bookinfo order by tmp_id desc limit $last,$page_count");
  }
  $books=mysql_fetch_array($query);

  //判断用户输入的页面是否合法
  function isRightPage($page,$page_nums)
  {
    if($page>0&&$page<=$page_nums){
      return true;
    }else{
      echo "<script language='javascript'>alert('您输入的页面不合法，请重新输入！');history.back();</script>";
      return false;
    }
  }

  //读取用户自定义的页面
  if(isset($_POST['page'])&&isRightPage($_POST['page'],$page_nums)){
    $page=$_POST['page'];
    echo "<script language='javascript'>window.open('book_list_price.php?id=$id&page=$page','_self');</script>";
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>图书分类信息</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/book_list.css" rel="stylesheet"></head>
<body onLoad="scrollTo(0,0)">

  <!-- 导航条 -->
  <?php
    include('navigation.php');
  ?>
  <!-- 分类 -->
  <div class="container">
    <!-- 类型 -->
    <div class="row genres">
      <div class="col-md-2 types">
        类型
      </div>

      <div class="col-md-10 type">
        <?php
          do{
        ?>
        <a href="book_list_type.php?id=<?php echo $types['id'];?>"><?php echo $types['typeName'];?></a>
        <?php
          }while($types=mysql_fetch_array($query_type));
        ?>
      </div>
    </div>
    <!-- 类型 -->

    <!-- 出版社 -->
      
    <!-- 出版社 -->

    <!-- 价格 -->
    <div class="row price">
      <div class="col-md-2 types">
        价格
      </div>

      <div class="col-md-10 type">
        <a href="book_list_price.php?id=1">9-19</a>
        <a href="book_list_price.php?id=2">19-29</a>
        <a href="book_list_price.php?id=3">29-39</a>
        <a href="book_list_price.php?id=4">39-49</a>
        <a href="book_list_price.php?id=5">49-</a>
      </div>
    </div>
    <!-- 价格 -->
  </div>
  <!-- container -->

  <div class="container">
    <!-- 排序 -->
    <div class="row text-left">
      <!-- 按钮组 -->
      <div class="col-md-4">
        <div class="btn-group" role="group">
          <a href="book_list_price.php?<?php
            echo "id=".$id."&"."id_desc=1";
          ?>" class="btn btn-default">
            综合
            <span class="glyphicon glyphicon-arrow-down"></span>
          </a>
          <a href="book_list_price.php?<?php
            echo "id=".$id."&"."id_asc=1";
          ?>" class="btn btn-default">
            综合
            <span class="glyphicon glyphicon-arrow-up"></span>
          </a>
          <a href="book_list_price.php?<?php
            echo "id=".$id."&"."price_desc=1";
          ?>" class="btn btn-default">
            价格
            <span class="glyphicon glyphicon-arrow-down"></span>
          </a>
          <a href="book_list_price.php?<?php
            echo "id=".$id."&"."price_asc=1";
          ?>" class="btn btn-default">
            价格
            <span class="glyphicon glyphicon-arrow-up"></span>
          </a>
        </div>
      </div>
      <!-- 按钮组 -->

      <div class="col-md-8">
        <p class="text-right">
          共有
          <span>&nbsp;<?php echo $row;?>&nbsp;</span>
          本书
        </p>
      </div>
    </div>
    <!-- 排序 -->

    <!-- 图书列表 -->
    <div class="books">
      <?php 
        do{
      ?>
      <div class="book">
        <a href="book_detail.php?id=<?php echo $books['tmp_id'];?> ">
          <img src="<?php echo "../book_imgs/".$books['tmp_image'];?>" width="150" height="150" title="<?php echo $books['tmp_bookName'];?>"></a>
        <div class="book_title">
          <a href="book_detail.php?id=<?php echo $books['tmp_id'];?>" title="<?php echo $books['tmp_bookName'];?>"><?php echo $books['tmp_bookName'];?></a>
        </div>
        <small class="text-muted"><?php echo $books['tmp_author'];?></small>
        <br>
        <span style="color:red;">￥<?php echo $books['tmp_price'];?></span>
      </div>
      <?php }while($books=mysql_fetch_array($query));?>
    </div>
  </div>
  <!-- container -->

  <!--分页 -->
  <nav class="text-center">
    <ul class="pagination">
      <li><a href="book_list_price.php?<?php
      echo "id=".$id."&"."page=1";
      ?>">首页</a></li>
      <li>
        <a href="book_list_price.php?<?php
          if($page==1){
            echo "id=".$id."&"."page=1";
          }else{
            echo "id=".$id."&"."page=".($page-1);
          }
        ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;上一页</span>
        </a>
      </li>
      <?php
        $i=1;
        while($i<=$page_nums){
      ?>
      <li>
        <a href="book_list_price.php?<?php
          echo "id=".$id."&"."page=".$i;
        ?>"><?php echo $i;?></a>
      </li>
      <?php
        $i++;}
      ?>
      </li>
      <li>
        <a href="book_list_price.php?<?php 
          if($page<$page_nums){
            echo "id=".$id."&"."page=".($page+1);
          }else{
            echo "id=".$id."&"."page=".$page_nums;
          }
        ?>" aria-label="Next">
          <span aria-hidden="true">下一页&raquo;</span>
        </a>
      </li>
      <li><a href="book_list_price.php?<?php
        echo "id=".$id."&"."page=".$page_nums;
      ?>">尾页</a></li>
      <li>
        <!-- 跳转到某页 -->
        <form name="form1" class="jump_form" role="form" method="post" action="book_list_price.php?id=<?php echo $id;?>">
          <span>共<?php echo $page_nums;?>页,到第</span>
          <input name="page" type="text" style="width:50px;" class="text-center">页&nbsp;&nbsp;
          <input name="submit" type="submit" value="确定" class="btn btn-default btn-sm">
        </form>
      </li>
    </ul>
  </nav>
  <!-- 分页 -->

  <!-- 版权信息 -->
  <div id="footer">
    <ul>
      <li>Copyright © 2015 - 2015 sixunguidiao. All Rights Reserved.</li>
      <li>**公司 版权所有</li>
    </ul>
  </div>
  <!-- 版权信息 -->

  <script src="../js/jquery-1.11.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>