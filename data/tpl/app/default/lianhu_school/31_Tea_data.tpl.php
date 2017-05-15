<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>我的资料-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<style>
	.form-group input {
    display: inline;
    border: 1px solid #ccc;
    width: 67%;
    border-radius: 5px;
    height: 30px;
    padding-left: 1%;
    margin: 0 3% 0 0;
    float: right;
    text-align: left;
}
.col-xs-12 {
     width: 30%;
}
	
	</style>
</head>
<body>
<!--<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>我的资料</div>
        </div>
 </div>  -->
  
<div class="main" style='padding-bottom:100px;'>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class=" panel-default">
			<div class="panel-body">
				<div class="tab-content">	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师姓名</label>
					
						<input type="text" name="teacher_realname" id="teacher_realname"  value='<?php  echo $result['teacher_realname'];?>' />
					
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师电话</label>
				
						<input type="text" name="teacher_telphone" id="teacher_telphone"  value='<?php  echo $result['teacher_telphone'];?>' />
					
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师邮箱</label>
					
						<input type="text" name="teacher_email" id="teacher_email" value='<?php  echo $result['teacher_email'];?>' />
					
				</div>								
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师照片</label>
                    <div id='img_list' style='margin-bottom:5px;'  >
                    </div>
                    <div style='clear:both'></div>
                    <div  class='hide' id='img_value'> </div>  
                           <div class="button button-action button-rounded button-small" style='margin-bottom:5px;margin:5px 0 0 35%;' id="chooseImage">选择照片</div>
                           <div id='uploadImg' class="" style='margin-bottom:5px;margin-left:10px;'></div>
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>微信二维码</label>
               <div id='img_list_qr' style='margin-bottom:5px;'>
                    </div>
                    <div style='clear:both'></div>
                    <div  class='hide' id='img_value_qr'> </div>  
                           <div class="button button-action button-rounded button-small" style='margin-bottom:5px;margin:5px 0 0 35%;' id="chooseImage_qr">选择照片</div>
                                <div id='uploadImg_qr' class="" style='margin-bottom:5px;margin-left:10px;'></div>
				</div>								
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师简介</label>
					
						<textarea name='teacher_introduce' class='form-control' style="width:86%; margin:0 7%;"><?php  echo $result['teacher_introduce'];?></textarea>
					
				</div>
				</div>
			</div>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <input type="hidden" name="submit" value="提交" />
				<button class="button button-raised button-caution" type="submit" style="width:86%; margin:0 7%" ><i class="fa fa-user"></i>&nbsp;&nbsp;提交</button>
		</div>		
	</form>
</div>
<script>
    $(function(){
         <?php  if($result['teacher_img']) { ?>
            insertImg('<?php  echo $this->imgFrom($result['teacher_img']);?>','img_list');
        <?php  } ?>
        insertValue('<?php  echo $result['teacher_img'];?>','img_value');
        <?php  if($result['weixin_code']) { ?>
            insertImg('<?php  echo $this->imgFrom($result['weixin_code']);?>','img_list_qr');
        <?php  } ?>

        $("#chooseImage").click(function(){
            chooseImage('img_list','img_value','uploadImg');
        });
        $("#chooseImage_qr").click(function(){
            chooseImage('img_list_qr','img_value_qr','uploadImg_qr');
        });       
    });
    var images = {
        localId: [],
        serverId: []
    };    
    function chooseImage(img_id_name,value_id_name,up_id_name){
         images.localId='';
            wx.chooseImage({
            count: 1, 
            success: function (res) {
                images.localId = res.localIds;
                $.each(images.localId,function(i,e){
                    insertImg(e,img_id_name);
                });
                uploadImg(value_id_name,up_id_name);
            }
         });       
   }   
 function uploadImg(value_id_name,up_id_name){
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
          insertValue(res.serverId,value_id_name);
          if (i < length) {
             upload();
          }else{
              $("#"+up_id_name+"").html("上传成功");
          }
        },
        fail: function (res) {
           alert(JSON.stringify(res));
        }
      });
    }
    upload();     
  }
    function insertImg(img_src,id_name){
        $('#'+id_name+'').html("<div style='background-size:cover; background-image:url("+img_src+");width:150px;; height:150px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
    }
    function insertValue(value,id_name){
          $('#'+id_name+'').html("<input type='text' name='"+id_name+"' value='"+value+"' >");
    }
</script> 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>
