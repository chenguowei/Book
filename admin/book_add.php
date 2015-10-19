<?php
  include_once "../include.php";

  session_start();//初始化SESSION变量
  checkLogined();//检查管理员是否已经登录
  $sql = "select * from tb_booktype";
  $rows = $conne->getRowsArray($sql);
  if ($rows==null) {
    alertMes("还没有图书分类，请添加分类！","type_add.php");
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>添加图书</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link href="../css/add.css" rel="stylesheet">
    <link href="../css/global.css"  rel="stylesheet"  type="text/css" media="all">
    <script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
    <script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
    <script type="text/javascript" src="../scripts/jquery-1.6.4.js"></script>
    <script>
            KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
            $(document).ready(function(){
             $("#selectFileBtn").click(function(){
            $fileField = $('<input type="file" name="thumbs[]"/>');
            $fileField.hide();
            $("#attachList").append($fileField);
            $fileField.trigger("click");
            $fileField.change(function(){
            $path = $(this).val();
            $filename = $path.substring($path.lastIndexOf("\\")+1);
            $attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
            $attachItem.find(".left").html($filename);
            $("#attachList").append($attachItem);   
            });
          });
          $("#attachList>.attachItem").find('a').live('click',function(obj,i){
            $(this).parents('.attachItem').prev('input').remove();
            $(this).parents('.attachItem').remove();
          });
        });
    </script>
  </head>

  <body>
    <div class="wrap">
      <div class="row">
        <form class="form-horizontal add_form" role="form" action="doAdminAction.php?act=addBook" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name" class="col-md-2 control-label">书名</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="name" name="bookName"
                  placeholder="书名">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="author" class="col-md-2 control-label">作者</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="author" name="author"
                  placeholder="作者">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="type" class="col-md-2 control-label">类型</label>
            <div class="col-md-9">
               <select class="form-control" name="type" >
                <?php foreach($rows as $row):?>
                 <option value="<?php echo $row['id']?>"><?php echo $row['typeName']?></option>
               <?php endforeach;?>
               </select>
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="press" class="col-md-2 control-label">出版社</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="publishing" name="publishing"
                  placeholder="出版社">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="isbn" class="col-md-2 control-label">ISBN</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="isbn" name="ISBN"
                  placeholder="ISBN">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="price" class="col-md-2 control-label">价格</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="price" name="price"
                  placeholder="价格">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="isbn" class="col-md-2 control-label">页数</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="page" name="page"
                  placeholder="页数">
            </div>
            <div class="col-md-1">
              <span class="warning">*</span>
            </div>
          </div>

          <div class="form-group">
            <label for="format" class="col-md-2 control-label">开本</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="format" name="format"
                  placeholder="开本">
            </div>
          </div>

          <div class="form-group">
            <label for="packing" class="col-md-2 control-label">包装</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="packing" name="packing"
                  placeholder="包装">
            </div>
          </div>

          <div class="form-group">
            <label for="image" class="col-md-2 control-label">图片</label>
            <div class="col-md-9">
               <a href="javascript:void(0)" id="selectFileBtn">添加图片</a>
               <div id="attachList" class="clear"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2"></div>
            <div class="col-md-9">
               <span>第一张为小图，第二张为大图</span>
            </div>
          </div>
          
          <div class="form-group">
            <label for="content_brief" class="col-md-2 control-label">作者简介</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="5" name="authorBrief"></textarea>
            </div>
          </div>

         <div class="form-group">
            <label for="content_brief" class="col-md-2 control-label">标题简介</label>
            <div class="col-md-9">
              <textarea class="form-control" rows="5" name="titleBrief"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="content_brief" class="col-md-2 control-label">内容简介</label>
            <div class="col-md-9">
              <!-- id="editor_id" -->
              <textarea class="form-control" rows="5" name="contentBrief"></textarea>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-md-2"></div>
            <div class="col-md-9 text-right">
              <input type="submit" class="btn btn-primary" value="确定">
            </div>
          </div>
        </form>
        <!-- 表单 -->
      </div>
      <!-- row -->
    </div>
    <!-- wrap-->

    <!-- <script src="js/jquery-1.11.1.min.js"></script> -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>