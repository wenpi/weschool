<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
           <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_left', TEMPLATE_INCLUDEPATH)) : (include template('school/app_left', TEMPLATE_INCLUDEPATH));?>
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $simple_title;?></div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="body padding">
        <div class="w-form">
          <form id="email-form" name="email-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" >
            <div class="separator-button-input"></div>
            <div>
              <label class="label-form" for="full-name-field">姓名</label>
              <input class="w-input input-form" id="full-name-field" type="text" name="full-name" data-name="full-name" value='<?php  echo $my_info['nickname'];?>' required="required">
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="email-field">邮箱</label>
              <input class="w-input input-form" id="email-field" type="email" name="email" data-name="email"  value='<?php  echo $my_info['email'];?>'  required="required">
              <div class="separator-fields"></div>
            </div>
            <div>
              <label class="label-form" for="mobile-field">电话</label>
              <input class="w-input input-form" id="mobile-field" type="mobile" name="mobile"  value='<?php  echo $my_info['mobile'];?>'  data-name="mobile" required="required">
              <div class="separator-fields"></div>
            </div>
          <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>照片</label>
                      <div id='img_list' style='margin-bottom:5px;'  >
                      </div>
                      <div style='clear:both'></div>
                           <div  class='hide' id='img_value'> </div>  
                            <div class="button button-action button-rounded button-small" style='margin-bottom:5px;margin:5px 0 0 35%;' id="chooseImage">选择照片</div>
                            <div id='uploadImg' class="" style='margin-bottom:5px;margin-left:10px;'></div>
          </div>	           
            <div>
              <div class="separator-fields"></div>
            </div>
               <input class="w-button action-button" type="submit" name='submit' value="保存" data-wait="请稍等...">
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

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
 <script>
    $(function(){
         <?php  if($my_info['avatar']) { ?>
            insertImg('<?php  echo $my_info['avatar'];?>','img_list');
            insertValue('<?php  echo $my_info['avatar'];?>','img_value');
        <?php  } ?>
        $("#chooseImage").click(function(){
            chooseImage('img_list','img_value','uploadImg');
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

</body>
</html>