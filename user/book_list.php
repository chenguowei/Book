<?php 
  //include('conn/connect.php');
  include_once "../code/connect.php";
  header("Content-type:text/html;charset=utf-8");
  error_reporting (E_ALL & ~E_NOTICE);
  @session_start();

  //获取图书的全部类型
  $type_sql = "select * from tb_booktype ";
  $result = mysql_query($type_sql);

  $conditions = array('type','price','sort');//要进行筛选的字段放在这里
  $type = $press = $sort = '';//先给需要筛选的字段赋空值，这些值将输出到页面的hidden fileds 中
//以下循环给已经进行的筛选赋值，以便能够在下一次筛选中保留
foreach($conditions as $value){
    if(isset($_GET[$value])){
        $$value = $_GET[$value];
    }
}
//初始选择条件
$priceConditation = 1;
$typeConditation = 1;
$sortConditation = "ORDER BY id";//默认按id从低到高进行排序
//判断图书类型
if (isset($_GET['type'])) {
    $type= $_GET['type'];
    if($type!='全部'){
        $typeConditation = "typeId=".$type;
    }else{
         $where1 = 1;
    }
}

// //根据ID来排序
// if (isset($_GET['book_id'])) {
//     $book_id= $_GET['book_id'];
//     if($book_id =='desc'){
//         $IdConditation = "id desc";
//     }
// }


// //判断价格的升或降
// if (isset($_GET['sort'])) {
//     $sort= $_GET['sort'];
//     if($sort =='down'){
//         $sortConditation= "ORDER BY price DESC";
//     }
// }

//根据不同的排序条件进行排序
if(isset($_GET['sort'])){
  $sort=$_GET['sort'];
  switch ($sort) {
    case 'click_asc':
      $sortConditation='ORDER BY click';
      break;

    case 'click_desc':
      $sortConditation='ORDER BY click desc';
      break;

    case 'price_asc':
      $sortConditation='ORDER BY price';
      break;

    case 'price_desc':
      $sortConditation='ORDER BY price desc';
      break;
  }
}

//判断图书价格
if (isset($_GET['price'])) {
    $price= $_GET['price'];
    if($price!='全部'){
      switch ($price) {
        case 1:
          $priceConditation = "price<=19";
          break;
        case 2:
          $priceConditation = "price>19 and price<=29";
          break;
        case 3:
          $priceConditation = "price>29 and price<=39";
          break;
        case 4:
         $priceConditation = "price>39 and price<=49";
          break;;
        default:
          $priceConditation = "price>49";
          break;
      }
    }else{
         $priceConditation = 1;
    }
}

  //分页
  if(isset($_GET['page'])){
    $page=$_GET['page'];
  }else{
    $page=1;
  }

  $sql = "select * from tb_bookinfo where $typeConditation and $priceConditation  $sortConditation";
 
  //搜索按钮功能的实现
  if(isset($_POST['search'])){
    $key=$_POST['search'];
    if($key==""){
      echo "<script language='javascript'>alert('您还未输入任何关键字！');history.back();</script>";
    }else{
      $sql = "select id,bookName,author,price,image from tb_bookinfo where bookName like '%$key%' or author like '%$key%'";
      $query_results=mysql_query($sql);
      $results_nums=mysql_fetch_row($query_results);
      if($results_nums==0){
        echo "<script language='javascript'>alert('未找到相关图书= =');history.back();</script>";
      }else{
         $sql = "select id,bookName,author,price,image from tb_bookinfo where bookName like '%$key%' or author like '%$key%'";
         $row = $conne->getRowsNum($sql);//总的图书数量
         $page_count=10;//每页显示的图书数量
        $page_nums=ceil($row/$page_count);//总的分页的页数
        $last=($page-1)*$page_count;//获取上一页的最后一条记录，从而计算下一页的起始记录
        $sql = "select id,bookName,author,price,image from tb_bookinfo where bookName like '%$key%' or author like '%$key%' limit $last,$page_count";
        $resultBook = $conne->getRowsArray($sql);
      }
    }
  }else{  //如果不用搜索按钮
        $row = $conne->getRowsNum($sql);//总的图书数量
        $page_count=10;//每页显示的图书数量
        $page_nums=ceil($row/$page_count);//总的分页的页数
        $last=($page-1)*$page_count;//获取上一页的最后一条记录，从而计算下一页的起始记录
        $sql = "select * from tb_bookinfo where $typeConditation and $priceConditation $sortConditation limit $last,$page_count";
        $resultBook = $conne->getRowsArray($sql);
  }
  
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

  //跳转页面之后的GET的值要保持不变
  if ($_GET['type']==null) {
    $type='全部';
  }else{
    $type=$_GET['type'];
  }

  if ($_GET['price']==null) {
    $price = '全部';
  }else{
    $price = $_GET['price'];
  }
  $where = "&type=".$type."&price=".$price;

  //读取用户自定义的页面
  if(isset($_POST['page'])&&isRightPage($_POST['page'],$page_nums)){
    $page=$_POST['page'];
    echo "<script language='javascript'>window.open('book_list.php?page=$page{$where}','_self');</script>";
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
  <link href="../css/book_list.css" rel="stylesheet">
  <script type="text/javascript">
    function Filter(a,b){
        var $ = function(e){return document.getElementById(e);}
        var ipts = $('filterForm').getElementsByTagName('input'),result=[];
        for(var i=0,l=ipts.length;i<l;i++){
            if(ipts[i].getAttribute('to')=='filter'){
                result.push(ipts[i]);
            }
        }
        if($(a)){
            $(a).value = b;
            for(var j=0,len=result.length;j<len;j++){
                if(result[j].value==''){
                    result[j].parentNode.removeChild(result[j]);
                }
            }
            document.forms['filterForm'].submit();
        }
        return false;
    }
</script>
</head>
<body onLoad="scrollTo(0,0)">
  <!-- 隐藏表单 -->
<form id="filterForm" action="book_list.php" method="GET">
<!--
form的id 要和程序里统一
为避免与其他使用的隐藏域冲突，添加了to属性
以下是筛选字段隐藏域
需要筛选的隐藏域需要加 to 属性
-->
<input to="filter" type="hidden" id="type" name="type" value="<?=$type?>" />
<input to="filter" type="hidden" id="price" name="price" value="<?=$price?>" />
<input to="filter" type="hidden" id="sort" name="sort" value="<?=$sort?>" />

</form>

  <!-- 导航条 -->
  <?php
    include('navigation.php');
  ?>
  <!-- 分类 -->
  <div class="container">
    <!-- 类型 -->
    <div class="row">
      <div class="col-md-2 types">
        <!-- <a href="javascript:Filter('type','全部')">类型</a> -->
        <span>类型</span>
      </div>

      <div class="col-md-10 type">
        <ul class="nav nav-pills">
          <?php
            if($_GET['type']=='全部'){
          ?>
            <li role="presentation" class="active"><a href="javascript:Filter('type','全部')">全部</a></li>
          <?php
            }else{
          ?>
            <li role="presentation"><a href="javascript:Filter('type','全部')">全部</a></li>
          <?php
            }
            while($type= mysql_fetch_assoc($result)){
              if($_GET['type']==$type['id']){
          ?>
            <li role="presentation" class="active"><a href="javascript:Filter('type','<?php echo $type['id']?>')"><?php echo $type['typeName']?></a></li>
          <?php
            }else{
          ?>
            <li role="presentation"><a href="javascript:Filter('type','<?php echo $type['id']?>')"><?php echo $type['typeName']?></a></li>
          <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
    <!-- 类型 -->

    <!-- 出版社 -->
      
    <!-- 出版社 -->

    <!-- 价格 -->
    <div class="row price">
      <div class="col-md-2 types">
        <!-- <a href="javascript:Filter('price','全部')">价格</a> -->
        <span>价格</span>
      </div>

      <div class="col-md-10 type">
        <ul class="nav nav-pills">
          <?php if($_GET['price']=='全部'){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','全部')">全部</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','全部')">全部</a></li>
          <?php }?>

          <?php if($_GET['price']==1){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','1')">0-19</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','1')">0-19</a></li>
          <?php }?>

          <?php if($_GET['price']==2){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','2')">19-29</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','2')">19-29</a></li>
          <?php }?>

          <?php if($_GET['price']==3){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','3')">29-39</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','3')">29-39</a></li>
          <?php }?>

          <?php if($_GET['price']==4){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','4')">39-49</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','4')">39-49</a></li>
          <?php }?>

          <?php if($_GET['price']==5){?>
            <li role="presentation" class="active"><a href="javascript:Filter('price','5')">49-</a></li>
          <?php }else{?>
            <li role="presentation"><a href="javascript:Filter('price','5')">49-</a></li>
          <?php }?>
        </ul>
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
          <a href="javascript:Filter('sort','click_desc')" class="btn btn-default" onclick="changeIdIcon()">
            人气
            <span id="idIcon" class="glyphicon glyphicon-arrow-down"></span>
          </a>
          <a href="javascript:Filter('sort','click_asc')" class="btn btn-default" onclick="changeIdIcon()">
            人气
            <span id="idIcon" class="glyphicon glyphicon-arrow-up"></span>
          </a>
          <a id="price_sort" href="javascript:Filter('sort','price_desc')" class="btn btn-default" onclick="changePriceIcon()">
            价格
            <span id="priceIcon" class="glyphicon glyphicon-arrow-down"></span>
          </a>
          <a id="price_sort" href="javascript:Filter('sort','price_asc')" class="btn btn-default" onclick="changePriceIcon()">
            价格
            <span id="priceIcon" class="glyphicon glyphicon-arrow-up"></span>
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
      <?php  foreach($resultBook as $books):?>
      <div class="book">   
        <a href="book_detail.php?id=<?php echo $books['id'];?> ">
          <img src="<?php echo "../book_imgs/".$books['image'];?>" width="150" height="150" title="<?php echo $books['bookName'];?>"></a>
        <div class="book_title">
          <a href="book_detail.php?id=<?php echo $books['id'];?>" title="<?php echo $books['bookName'];?>"><?php echo $books['bookName'];?></a>
        </div>
        <div class="book_author">
          <small class="text-muted"><?php echo $books['author'];?></small>
        </div>
        <br>
        <span style="color:red;">￥<?php echo $books['price'];?></span>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <!-- container -->

  <!--分页 -->
  <?php 
    if(!isset($_POST['search'])){
  ?>
  <nav class="text-center">
    <ul class="pagination">
      <li><a href="book_list.php?page=1<?php echo $where?>">首页</a></li>
      <li>
        <a href="book_list.php?page=<?php 
          if($page==1){
            echo "1";
          }else{
            echo $page-1;
          }
        ?><?php echo $where?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;上一页</span>
        </a>
      </li>
      <?php
        $i=1;
        while($i<=$page_nums){
      ?>
      <li>
        <a href="book_list.php?page=<?php echo $i;?><?php echo $where?>"><?php echo $i;?></a>
      </li>
      <?php
        $i++;}
      ?>
      </li>
      <li>
        <a href="book_list.php?page=<?php 
          if($page<$page_nums){
            echo $page+1;
          }else{
            echo $page_nums;
          }
        ?><?php echo $where?>" aria-label="Next">
          <span aria-hidden="true">下一页&raquo;</span>
        </a>
      </li>
      <li><a href="book_list.php?page=<?php echo $page_nums;?><?php echo $where?>">尾页</a></li>
      <li>
        <!-- 跳转到某页 -->
        <form name="form1" class="jump_form" role="form" method="post" action="book_list.php?<?php echo $where?>">
          <span>共<?php echo $page_nums;?>页,到第</span>
          <input name="page" type="text" style="width:50px;" class="text-center">页&nbsp;&nbsp;
          <input name="submit" type="submit" value="确定" class="btn btn-default btn-sm">
        </form>
      </li>
    </ul>
  </nav>
  <?php }?>
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
  <script type="text/javascript">
    //对当前点击的导航项设置active类样式
    // $(document).ready(function(){
    //   $(".type ul li").click(function(){
    //     $(this).addClass("active").siblings().removeClass("active")
    //   });
    // });
  </script>
</body>
</html>