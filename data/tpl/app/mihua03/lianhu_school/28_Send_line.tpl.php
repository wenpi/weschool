<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="telephone=no">
    <title>发布消息-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/app.min.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/line_css.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
     <script src="<?php echo MODULE_URL;?>style/js/modernizr.js"></script>
     <script src="<?php echo MODULE_URL;?>style/js/jquery.lazyload.js?v=1.9.1"></script>
     <script src="<?php echo MODULE_URL;?>style/js/main.js"></script>
     </head>
     <body>
<div class="top-wrap2">

 </div>
    <form enctype="multipart/form-data" id="new_article" method="post" class="post-form" > 
        <div class='form-group'>
        <textarea id="addtext" name="content" maxlength="1000" rows="5" placeholder="分享一件新鲜事..." required=""></textarea>
        </div>
        <div class='form-group'>
            <div id='img_list'>
                <div class='clear'></div>
            </div>
            <div  class='hide' id='img_value'>
                
            </div>
            <div class='clear'></div>
         </div>
        <div class='form-group'>
             <div class="button button-primary button-rounded button-small" style='margin-left:10px;' id="chooseImage">
			选择图片
			 </div>
             <div id='uploadImg' class="button button-highlight button-rounded button-small" style='margin-left:10px;'onclick="uploadImg()">
			 上传
			 </div>
         </div>
        <div class="article_sub">
              <input name='submit' type="submit" class="add-article" value='发送'>
        </div>
    </form>
</body>
<script>
    $(function(){
       $(".help-block").hide();
       $('input[name="image"]').css('width',"80%"); 
       $('input[name="image"]').css('display','inline-block');
       $('input[name="image"]').css('margin-left','5%');
       $('input[name="image"]').css('margin-right','5%');
       $("button[type='button']").css('display','inline-block');
       $("button[type='button']").css('margin-right','5%');
    });
</script>
<script>
 var images = {
    localId: [],
    serverId: []
  };
  document.querySelector('#chooseImage').onclick = function () {
    images.localId='';
    $('#img_list').html('');
    wx.chooseImage({
      success: function (res) {
        images.localId = res.localIds;
        $.each(images.localId,function(i,e){
            img_data = realImgDis(e);
            if(!img_data){
                wx.getLocalImgData({
                        localId: e, 
                        success: function (res) {
                            var localData = res.localData; 
                            img_value = localData;
                            insertImg(img_value);
                        }
                 });             
            }else{
                insertImg(img_data);
            }
        });
          $("#uploadImg").html("上传");
          uploadImg();
      }
    });
  };
function insertImg(img_src){
    $('#img_list').prepend("<div style='background-size:cover; background-image:url("+img_src+");width:23%; height:100px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
}
function insertValue(value){
    $("#img_value").prepend("<input type='hidden' name='img_value[]' value='"+value+"' >");
}
function uploadImg(){
      $("#img_value").html('');
     if (images.localId.length == 0) {
        alert('请先选择图片');
        return;
    }
    var i = 0, length = images.localId.length;
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          i++;
          images.serverId.push(res.serverId);
          insertValue(res.serverId);
          if (i < length) {
             upload();
          }else{
              $("#uploadImg").html("上传成功");
            //   alert("上传成功!");
          }
        },
        fail: function (res) {
           alert(JSON.stringify(res));
        }
      });
    }
    upload();     
  }
  function downLoadImg(){
      if (images.serverId.length === 0) {
      alert('请先使用 uploadImage 上传图片');
      return;
    }
    var i = 0, length = images.serverId.length;
    images.localId = [];
    function download() {
      wx.downloadImage({
        serverId: images.serverId[i],
        success: function (res) {
          i++;
          alert('已下载：' + i + '/' + length);
          images.localId.push(res.localId);
          console.log(res);
          if (i < length) {
            download();
          }
        }
      });
    }
    download();    
  }
</script>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php  if($_SESSION['teacher_mobile']) { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</html>