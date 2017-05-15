<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" style="height:45px;padding-top:0"   data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">给<?php  echo $student_info['student_name'];?>添加记录</div>
          <a href="<?php  echo $this->createMobileUrl('SchoolAdminStudentRecordInfo',array("id"=>$student_id))?>">
            <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
                <div class="navbar-button-icon smaller icon ion-reply"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="body padding"  style="padding-top:45px;">
        <div class="w-form">
          <form  method="post" action="<?php  echo $this->createMobileUrl('SchoolAdminStudentRecordInfoAdd',array('id'=>$student_id))?>">
            <div class="separator-button-input"></div>
            <div>
              <label class="label-form" for="full-name-field">记录类型</label>
                <select name='jilv_class' class="w-input input-form" >
                  <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                    <option value='<?php  echo $row['class_id'];?>'><?php  echo $row['class_name'];?></option>
                  <?php  } } ?>
                </select>
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="full-name-field">标题</label>
                <input class="w-input input-form" id="full-name-field" type="text" name="word" data-name="word" required>
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="message">内容</label>
              <textarea class="w-input input-form textarea" id="content" name="content" data-name="content"></textarea>
            </div>
              <div >
                 <label class="label-form" for="message">点评照片</label>
                          <div id='img_list' style='margin：10px 0px;'></div>
                          <div style='clear:both'></div>
                          <div  class='hide' id='img_value'> </div>  
                          <div class="button button-action button-rounded button-small up_button" style='margin:5px 0px 5px 10px;' id="chooseImage">选择照片</div>
                          <div id='uploadImg' style='margin-bottom:5px;margin-left:10px;display:inline;'></div>
              </div>	
              <div>
                	<div  class='hide' id='voice_value'></div>     
                    <div class="button button-primary button-rounded button-small up_button" style='margin:5px 0px 5px 10px;' onclick='chooseVoice()'>开始录音</div>
                    <div id='uploadVoice' style='margin-bottom:5px;margin-left:10px;display:inline;' ></div>
              </div>             
            <div class="separator-button-input"></div>
             <input type="hidden" value="<?php  echo $token;?>"  name='token'>
             <input class="w-button action-button" type="submit" name="submit" value="提交" data-wait="Please wait...">
          </form>
        </div>
      </div>
    </div>

  </section>
  <script>
    $(function(){
          $("#chooseImage").click(function(){
              chooseImage('img_list','img_value','uploadImg');
          });
      });
      var images = {
          localId: [],
          serverId: []
      }; 
    // 3 智能接口
    var voice = {
      localId: '',
      serverId: ''
      };       
      function chooseImage(img_id_name,value_id_name,up_id_name){
          images.localId='';
              wx.chooseImage({
              count: 1, 
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
          $('#'+id_name+'').html("<div style='background-size:cover; height:150px; width:180px;background-image:url("+img_src+");float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
      }
      function insertValue(value,id_name){
            $('#'+id_name+'').html("<input type='text' name='"+id_name+"' value='"+value+"' >");
      }    
  </script>
  <style>
    #voice_stop{
      margin-top:50px;
    }
  </style>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/voice', TEMPLATE_INCLUDEPATH)) : (include template('../new/voice', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>