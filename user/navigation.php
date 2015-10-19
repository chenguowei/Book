<?php
  session_start();//初始化SESSION变量
?>
<!-- 导航条 -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">图书管理系统</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php" target="_self">首页 <span class="sr-only">(current)</span></a></li>
        <li><a href="book_list.php?type=全部&price=全部" target="_self">分类</a></li>
        <?php if(isset($_SESSION['admin_name'])){ ?><li><a href="../admin/admin.php">管理</a></li><?php }?>
        <li><a data-toggle="modal" href="#briefModal">简介</a></li>
        <li><a data-toggle="modal" href="#contactModal">联系我们</a></li>
      </ul>

      <form name="form2" method="post" action="book_list.php" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input name="search" type="text" class="form-control" placeholder="你想找什么书...">
          <input name="submit" type="submit" value="搜索" class="btn btn-default">
        </div>
      </form>
      
      <div class="nav navbar-nav navbar-right" style="">
      <?php if(isset($_SESSION['admin_name'])){?><div style="margin-top:15px;margin-right:20px;"><span style="color:#fff;">欢迎您,<?php echo $_SESSION['admin_name'];?>!&nbsp;&nbsp;</span><a href="../admin/exit.php" style="color:#fff;">注销</a></div><?php }else{?>
        <form class="navbar-form navbar-right" role="admin-login">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal" style="margin-right:20px;">管理员登录</button>
        </form><?php }?>
      </div>
    </div>
  </div>
</nav>
<!-- 导航条 -->

<!-- 简介 -->
<div class="modal fade" id="briefModal" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">简介</h3>
      </div>
      <!-- header -->

      <div class="modal-body">
        <p>
          这段文字是我自己瞎编的，至于内容是什么你就不要看了，如果你真的执意非要看下去的话我也没有办法，不过我还是要提醒你，无论你再怎么看，这段文字依然是没有任何意义的，好吧，简介就到这了。
        </p>
      </div>
      <!-- body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
      <!-- footer -->
    </div>
    <!-- content -->
  </div>
  <!-- dialog -->
</div>
<!-- 简介 -->

<!-- 联系我们 -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">联系我们</h3>
      </div>
      <!-- header -->

      <div class="modal-body">
        <p>
           我才不会告诉你组长的电话号码是18986194487呢。
        </p>
      </div>
      <!-- body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
      <!-- footer -->
    </div>
    <!-- content -->
  </div>
  <!-- dialog -->
</div>
<!-- 联系我们 -->

<!-- 管理员登录 -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">管理员登录</h3>
      </div>
      <!-- header -->

      <form name="form1" method="post" action="../admin/login_handle.php">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label">管理员姓名</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="管理员姓名" required autofocus/>
            <span class="label label-warning" id="username_msg"></span>
          </div>
          <div class="form-group">
            <label class="control-label">密码</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="密码"/>
            <span class="label label-warning" id="password_msg"></span>
          </div>
        </div>
        <!-- body -->

        <div class="modal-footer">
          <input type="submit" name="submit" class="btn btn-primary" value="登录">
          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
        <!-- footer -->
      </form>
    </div>
    <!-- content -->
  </div>
  <!-- dialog -->
</div>
<!-- 管理员登录 -->