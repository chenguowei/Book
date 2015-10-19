<?php
	include('conn/connect.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<title>图书管理系统</title>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/index.css" rel="stylesheet"></head>
	<style type="text/css"></style>
	<script src="../js/myfocus-2.0.1.min.js" type="text/javascript"></script>
	<script src="../js/mf-pattern/mF_YSlider.js" type="text/javascript"></script>
	<script language="">
     myFocus.set({
      id:'picBox'
     })
  </script>
<body>
	<!-- 导航条 -->
	<?php
	  include('navigation.php');
	?>

	<div class="wrap">
		<!-- 图片轮播 -->
		<!-- <div class="ad" id="picBox">
			<div class="loading">
				<img src="../images/jiazai.jpg.gif" alt="图片加载中"/>
			</div>
			<div class="pic">
				<ul>
					<li>
						<img src="../images/1.png"/>
					</li>
					<li>
						<img src="../images/2.png"/>
					</li>
					<li>
						<img src="../images/3.png"/>
					</li>
				</ul>
			</div>
		</div> -->

		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="../images/1.png" alt="...">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		    <div class="item">
		      <img src="../images/2.png" alt="...">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		    <div class="item">
		      <img src="../images/3.png" alt="...">
		      <div class="carousel-caption">
		        
		      </div>
		    </div>
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">上一张</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">下一张</span>
		  </a>
		</div>
		<!-- 图片轮播 -->

		<!-- 新闻公告与最新动态 -->
		<div class="row">
			<!-- 新闻公告 -->
			<div class="col-md-8 notice">
				<h3>新闻公告</h3>
				<hr>
				<div class="notice_info">
					<ul>
						<?php
							$query=mysql_query("select content from tb_news");
							$news=mysql_fetch_array($query);
							do{
						?>
						<li><?php echo $news['content'];?></li><br>
						<?php
							}while($news=mysql_fetch_array($query));
						?>
					</ul>
				</div>

				
			</div>
			<!-- 新闻公告 -->

			<!-- 最新动态 -->
			<div class="col-md-4 news">
				<h3>最新动态</h3>
				<hr>
				<div class="news_info">
					<ul>
						<li>
							<span class="glyphicon glyphicon-chevron-right">&nbsp;</span>
							<a href="#">白岩松新书《白说》，与读者坦诚相见</a>
						</li>
						<br>
						<li>
							<span class="glyphicon glyphicon-chevron-right">&nbsp;</span>
							<a href="#">阅享频道：一般是海水，一般是大陆</a>
						</li>
						<br>
						<li>
							<span class="glyphicon glyphicon-chevron-right">&nbsp;</span>
							<a href="#">习大大访美推荐书目：基辛格的秩序</a>
						</li>
						<br></ul>
				</div>
			</div>
			<!-- 最新动态 -->
		</div>
		<!-- 新闻公告与最新动态 -->

		<!-- 新书上架与畅销榜 -->
		<div class="row">
			<!-- 新书推荐 -->
			<div class="col-md-8">
				<h3>新书推荐</h3>
				<hr>
				<div class="new_books">
				<?php
					$query=mysql_query("select id,bookName,author,price,image from tb_bookinfo order by id desc limit 8");
					$new_books=mysql_fetch_array($query);
					do{
				?>
					<div class="new_book">
						<a href="book_detail.php?id=<?php echo $new_books['id'];?>">
							<img src="<?php echo "../book_imgs/".$new_books['image'];?>" width="150" height="150" title="<?php echo $new_books['bookName'];?>"></a>
						<div class="book_title">
							<a title="我的晃荡的青春" href="book_detail.php?id=<?php echo $new_books['id'];?>"><?php echo $new_books['bookName'];?></a>
						</div>
						<div class="book_author">
							<small class="text-muted"><?php echo $new_books['author'];?></small>
						</div>
						<span style="color:red;">￥<?php echo $new_books['price'];?></span>
					</div>
				<?php
					}while($new_books=mysql_fetch_array($query));
				?>
				</div>
			</div>
			<!-- 新书推荐 -->

			<!-- 热卖榜 -->
			<div class="col-md-4 hot">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#total" aria-controls="home" role="tab" data-toggle="tab">总榜</a>
					</li>
					<li role="presentation">
						<a href="#week" aria-controls="profile" role="tab" data-toggle="tab">周榜</a>
					</li>
					<li role="presentation">
						<a href="#month" aria-controls="profile" role="tab" data-toggle="tab">月榜</a>
					</li>
				</ul>

				<div class="tab-content">
					<!-- 总榜 -->
					<div role="tabpanel" class="tab-pane active" id="total">
						<div class="top_books">
							<?php
								$query=mysql_query("select id,bookName,author,price,image from tb_bookinfo order by click desc limit 10");
								$hot_books=mysql_fetch_array($query);
								$i=1;
								do{
							?>
							<div class="top_book">
								<?php
									if($i<=3){
								?>
								<span class="label_top"><?php echo $i++;?></span>
								<?php
									}else{
								?>
								<span class="label_other"><?php echo $i++;?></span>
								<?php }?>
								<span class="book_name">
									<a href="book_detail.php?id=<?php echo $hot_books['id'];?>"><?php echo $hot_books['bookName'];?></a>
								</span>
							</div>
							<?php
								}while($hot_books=mysql_fetch_array($query));
							?>
						</div>
					</div>
					<!-- 总榜 -->

					<!-- 周榜 -->
					<div role="tabpanel" class="tab-pane" id="week">
						<div class="top_books">
							<?php
								$query=mysql_query("select id,bookName,author,price,image from tb_bookinfo order by id limit 10");
								$hot_books=mysql_fetch_array($query);
								$i=1;
								do{
							?>
							<div class="top_book">
								<?php
									if($i<=3){
								?>
								<span class="label_top"><?php echo $i++;?></span>
								<?php
									}else{
								?>
								<span class="label_other"><?php echo $i++;?></span>
								<?php }?>
								<span class="book_name">
									<a href="book_detail.php?id=<?php echo $hot_books['id'];?>"><?php echo $hot_books['bookName'];?></a>
								</span>
							</div>
							<?php
								}while($hot_books=mysql_fetch_array($query));
							?>
						</div>
					</div>
					<!-- 周榜 -->

					<!-- 月榜 -->
					<div role="tabpanel" class="tab-pane" id="month">
						<div class="top_books">
							<?php
								$query=mysql_query("select id,bookName,author,price,image from tb_bookinfo order by id desc limit 10");
								$hot_books=mysql_fetch_array($query);
								$i=1;
								do{
							?>
							<div class="top_book">
								<?php
									if($i<=3){
								?>
								<span class="label_top"><?php echo $i++;?></span>
								<?php
									}else{
								?>
								<span class="label_other"><?php echo $i++;?></span>
								<?php }?>
								<span class="book_name">
									<a href="book_detail.php?id=<?php echo $hot_books['id'];?>"><?php echo $hot_books['bookName'];?></a>
								</span>
							</div>
							<?php
								}while($hot_books=mysql_fetch_array($query));
							?>
						</div>
					</div>
					<!-- 月榜 -->
				</div>
				<!-- tab-content -->
			</div>
			<!-- 热卖榜 -->
		</div>
		<!-- 新书上架与畅销榜 -->

		<!-- 热书推荐 -->
		<div class="row">
			<h3>热书推荐</h3>
			<hr>
			<div class="recommend_books">
				<?php
					$query=mysql_query("select id,bookName,author,price,image from tb_bookinfo order by click desc limit 10");
					$hot_books=mysql_fetch_array($query);
					do{
				?>
				<div class="recommend_book">
					<a href="book_detail.php?id=<?php echo $hot_books['id'];?>">
						<img src="<?php echo "../book_imgs/".$hot_books['image'];?>" width="150" height="150" title="<?php echo $hot_books['bookName'];?>">
					</a>
					<div class="book_title">
						<a title="<?php echo $hot_books['bookName'];?>" href="book_detail.php?id=<?php echo $hot_books['id'];?>"><?php echo $hot_books['bookName'];?></a>
					</div>
					<div class="book_author">
						<small class="text-muted"><?php echo $hot_books['author'];?></small>
					</div>
					<span style="color:red;">￥<?php echo $hot_books['price'];?></span>
				</div>
				<?php
					}while($hot_books=mysql_fetch_array($query));
				?>
			</div>
		</div>
		<!-- 热书推荐 -->
	</div>
	<!-- wrap -->

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