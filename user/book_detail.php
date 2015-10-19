<?php
  include('conn/connect.php');
  $id=$_GET['id'];
  //获取图书的详细信息
  $query=mysql_query("select book.id,book.bookName,book.author,
    book.typeId,bt.typeName,book.publishing,book.ISBN,book.price,
    book.page,book.format,book.packing,book.image,book.imageBig,
    book.titleBrief,book.contentBrief,book.authorBrief from tb_bookinfo book join 
    tb_booktype bt on book.typeId=bt.id where book.id=$id");
  $book=mysql_fetch_array($query);

  //获取同类图书的信息
  $query_others=mysql_query("select id,bookName,author,image from tb_bookinfo where 
    typeId=$book[typeId] and id<>$id limit 4");
  $books=mysql_fetch_array($query_others);

  $query_click=mysql_query("update tb_bookinfo set click=click+1 where id=$id");
  // if($query==true){
  //   echo "点击量添加成功";
  // }else{
  //   echo "点击量添加失败";
  // }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <title>图书详细信息</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/book_detail.css" rel="stylesheet"></head>
<body onLoad="scrollTo(0,0)">

  <!-- 导航条 -->
  <?php
      include('navigation.php');
  ?>

  <div class="container">
    <!-- 主体内容 -->
    <div class="col-md-10">
      <!-- 基本信息 -->
      <div class="row">
        <!-- 图片 -->
        <div class="col-md-5 col-md-pull-1">
          <img src="<?php echo "../book_imgs/".$book['imageBig'];?>" width="350" height="350" title="<?php echo $book['bookName'];?>" class="image_big">
        </div>
        <!-- 文本 -->
        <div class="col-md-7 basic_info">
          <h3><strong><?php echo $book['bookName'];?></strong></h3>
          <h4 class="text-muted"><strong><?php echo $book['titleBrief'];?></strong></h4>
          <hr>
          <div class="col-md-2">
            <h5>编号</h5>
            <h5>作者</h5>
            <h5>类型</h5>
            <h5>出版社</h5>
            <h5>ISBN</h5>
            <h5>价格</h5>
            <h5>页码</h5>
            <h5>开本</h5>
            <h5>包装</h5>
          </div>
          <div class="col-md-10">
            <h5><?php echo $book['id'];?></h5>
            <h5><?php echo $book['author'];?></h5>
            <h5><?php echo $book['typeName'];?></h5>
            <h5><?php echo $book['publishing'];?></h5>
            <h5><?php echo $book['ISBN'];?></h5>
            <h5><?php echo $book['price'];?></h5>
            <h5><?php echo $book['page'];?></h5>
            <h5><?php echo $book['format'];?></h5>
            <h5><?php echo $book['packing'];?></h5>
          </div>
        </div>
        <!-- 文本 -->
      </div>
      <!-- 基本信息 -->

      <!-- 详细信息 -->
      <div class="row detail_info">
        <!-- 内容简介 -->
        <div class="row">
          <div class="content">
            <h3>内容简介</h3>
            <hr>
            <p><?php echo $book['contentBrief'];?></p>
          </div>
        </div>
        <!-- 内容简介 -->

        <!-- 作者简介 -->
        <div class="row">
          <div class="content">
            <h3>作者简介</h3>
            <hr>
            <p>
              <?php echo $book['authorBrief'];?></p>
          </div>
        </div>
        <!-- 作者简介 -->
      </div>
      <!-- 详细信息 -->
    </div>
    <!-- 主体内容 -->

    <!-- 同类图书 -->
    <div class="col-md-2 col-md-push-1 sidebar">
      <!-- 推荐4本 -->
      <h3>同类图书推荐</h3>
      <hr>
      <?php
        do{
      ?>
      <div class="recommend_book">
        <a href="book_detail.php?id=<?php echo $books['id'];?>" title="<?php echo $books['bookName'];?>">
          <img src="<?php echo "../book_imgs/".$books['image'];?>" width="150" height="150"></a>
        <a href="book_detail.php?id=<?php echo $books['id'];?>" title="<?php echo $books['bookName'];?>"><?php echo $books['bookName'];?></a>
        <br>
        <small class="text-muted"><?php echo $books['author'];?></small>
      </div>
      <?php }while($books=mysql_fetch_array($query_others));?>

    </div>
    <!-- 同类图书 -->
  </div>
  <!-- container -->

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