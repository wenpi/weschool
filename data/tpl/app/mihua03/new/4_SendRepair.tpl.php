<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" style="height:45px;padding-top:0" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">提交报修详情</div>
          <a href="<?php  echo $this->createMobileUrl('repairUp')?>">
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
          </a>
        </div>
      </div>
      <div class="body padding" style="padding-top:45px;">
        <div class="w-form">
          <form  method="post" action="<?php  echo $this->createMobileUrl('sendRepair')?>">
            <div class="separator-button-input"></div>
            <div>
              <label class="label-form" for="full-name-field">需维修的地点</label>
              <input class="w-input input-form" id="full-name-field" type="text" name="repair_title" data-name="repair_title" required >
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="full-name-field">维修部门</label>
              <select class="w-input input-form" name="department_id">
                <?php  if(is_array($repair_list)) { foreach($repair_list as $row) { ?>
                  <option value='<?php  echo $row['department_id'];?>'><?php  echo $row['department_name'];?></option>
                <?php  } } ?>
              </select>
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="message">详情</label>
              <textarea class="w-input input-form textarea" id="message" name="repair_content" data-name="repair_content"></textarea>
            </div>
            <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <div class="weui_uploader">
                                <div class="weui_uploader_hd weui_cell">
                                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>
                                    <div class="weui_cell_ft" id='weui_cell_ft_num'><span class='num'>0</span>/<span class='all_num'>0</span></div>
                                </div>
                                <div  class='hide' id='img_value'>
                                </div>
                                <div class="weui_uploader_bd">
                                    <ul class="weui_uploader_files" id='weui_uploader_files'>
                                    </ul>
                                    <div class="weui_uploader_input_wrp">
                                        <span class="weui_uploader_input"  id="chooseImage"  accept="image/*" multiple=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="separator-button-input"></div>
             <input type="hidden" value="<?php  echo $token;?>"  name='token'>
             <input class="w-button action-button" type="submit" value="发送" data-wait="Please wait...">
          </form>
        </div>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
<script>
  var images = {
    localId: [],
    serverId: []
  };
  // 3 智能接口
  var voice = {
    localId: '',
    serverId: ''
  };
  document.querySelector('#chooseImage').onclick = function () {
    images.localId='';
    $('#img_list').html('');
    wx.chooseImage({
      success: function (res) {
        images.localId = res.localIds;
        $.each(images.localId,function(i,e){
            insertImg(e);
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
    $("#weui_cell_ft_num").find('.all_num').html(length);
    images.serverId = [];

    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          i++;
          images.serverId.push(res.serverId);
          insertValue(res.serverId);
          if (i < length) {
             $("#weui_cell_ft_num").find('.num').html(i);
             upload();
          }else{
             $("#weui_cell_ft_num").find('.num').html(length);
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
    $('#weui_uploader_files').prepend(" <li class='weui_uploader_file' style='background-image:url("+img_src+")'></li>");
}
function insertValue(value){
    $("#img_value").prepend("<input type='hidden' name='img_value[]' value='"+value+"' >");
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>