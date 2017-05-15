<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "班级作业-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link href="<?php echo MODULE_URL;?>/style/new/bottom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<body>
      <div class="body" style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-menu top-buttons">
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
              <div>发布作业</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button" data-w-tab="Tab 2">
              <div>作业记录</div>
            </a>
          </div>
          <div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
            <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
              <form enctype="multipart/form-data" id="new_article" method="post" class="post-form" > 
              <div class="w-clearfix portfolio-gallery home_word_class_list " id='home_word_class_list' >
              <?php  if(is_array($result)) { foreach($result as $item) { ?>
                  <input type='checkbox' style="padding-left:2%;display:none" name='class_list[]' value='<?php  echo $item;?>' id='class_id_<?php  echo $item;?>'>
                  <a class="w-lightbox w-inline-block portfolio-item grid-3-columns" href="javascript:;" data-load="1" data-id='<?php  echo $item;?>' onclick="selectClass(this)" >
                    <div class="group-image">
                      <div><?php  echo $this->classGradeName($item)?></div>
                      <div><?php  echo $this->className($item);?></div>
                      <div class="font_img">  </div>
                    </div>
                  </a>
              <?php  } } ?>
              </div>
              <div class='select_course w-clearfix clear'>
                <div class="select_span">
                  <div class="left_title">课程</div>
                  <div class='right_select'>
                    <select name='course_id'>
                        <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                            <option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
                        <?php  } } ?>
                    </select>
                  </div>
                </div>
              </div>
                  <div class='form-group in_text clear' >
                      <textarea name="content" maxlength="1000" rows="5" placeholder="文字描述"  ></textarea>
                    </div>
                    <div class='form-group' >
                          <div id='img_list' style='margin-bottom:5px;'>
                              <div class='clear'></div>
                          </div>
                          <div  class='hide' id='img_value'>
                          </div>
                          <div  class='hide' id='voice_value'>
                          </div>           
                          <div class='clear'></div>
                      </div>
                      <div class='form-group'>
                          <div class="button button-primary button-rounded button-small" style='margin-bottom:5px;margin-left:10px;border-radius:0px;' id="chooseImage">选择照片</div>
                          <div id='uploadImg' style='margin-bottom:5px;margin-left:10px;display:inline;'></div>
                      </div>
                      <div class='form-group'>
                          <div class="button button-primary button-rounded button-small" style='margin-bottom:5px;margin-left:10px;border-radius:0px;' onclick='chooseVoice()'>开始录音</div>
                          <div id='uploadVoice' style='margin-bottom:5px;margin-left:10px;display:inline;' ></div>
                      </div>         
                      <div class="article_sub" >
                          <input  type="hidden" value="<?php  echo $token;?>"  name='token'>
                          <button type="submit" class="button button-action  button-rounded button-small " style="color:#fff; border:none; line-height:40px;">马上发布</button>
                      </div>
                  </form>

            </div>

            <div class="w-tab-pane tab-pane" data-w-tab="Tab 2">
              <ul class="list list-messages" id='homework_list'> </ul>
              <div class='end_text' id='end_text'></div>
            </div>
          </div>
        </div>
      </div>
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
          }
        },
        fail: function (res) {
           alert(JSON.stringify(res));
        }
      });
    }
    upload();     
  }
function insertImg(img_src){
    $('#img_list').prepend("<div style='background-size:cover; background-image:url("+img_src+");width:23%; height:100px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
}
function insertValue(value){
    $("#img_value").prepend("<input type='hidden' name='img_value[]' value='"+value+"' >");
}
var pager=1;
function getHomeWorkList(){
  if(pager>0){
    $.ajax({
      url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'tea_homework_history'))?>",
      type:'post',
      data:{pager:pager},
      success:function(html){
        if(html && html !='no'){
          $("#homework_list").append(html);
          pager++;
        }else{
          $("#end_text").html("已经全部查看完了");
          pager = 0;
        }
      }
    });
  }
}
$(function(){
  getHomeWorkList();
	$(window).scroll(function(){
		if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
      getHomeWorkList();
		}
	});
});
</script>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/voice', TEMPLATE_INCLUDEPATH)) : (include template('../new/voice', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/modernizr.js"></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/framework.js"></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/scripts.js"></script>

