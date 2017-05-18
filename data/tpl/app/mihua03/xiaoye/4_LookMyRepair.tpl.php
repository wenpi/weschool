<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css">
<body> 
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="body" style="padding-top: 0px;">
        <ul class="list list-chats" id='list-chats'>
          <li class="list-chat right" data-ix="list-item">
            <div class="w-clearfix column-right chat right">
              <div class="arrow-globe right"></div>
              <div class="chat-text right"><?php  echo $result['repair_title'];?><br><?php  echo $result['repair_content'];?></div>
              <?php  if($result['repair_img']) { ?>
               <div style="clear:both"></div>
                <?php  $img=json_decode($result['repair_img'],1);?>
                <div class="chat-imgs right" onclick='displayImage(this)' >
                    <?php  if(is_array($img)) { foreach($img as $row) { ?>
                        <img src='<?php  echo  $this->imgFrom($row)?>' height="100">
                    <?php  } } ?>
                    <div style="clear:both"></div>
                </div>
              <?php  } ?>
              <div class="chat-time right"><?php  echo date("m-d H:i",$result['add_time'])?></div>
            </div>
          </li>
          <?php  if(is_array($reply_list)) { foreach($reply_list as $row) { ?>
            <li class="list-chat" data-ix="list-item">
              <div class="w-clearfix column-right chat" style="margin-left:10px;">
                <div class="arrow-globe"></div>
                <div class="chat-text"><?php  echo $row['reply_content'];?><br><b style="color:#ff0033">【状态：<?php  echo $class_repair->reply_status[$row['status']];?>】</b><br><b style="color:#ff0033">【人员：<?php  echo $row['department_name'];?>--<?php  echo $row['admin_name'];?>】</b></div>
                <?php  if($row['reply_img']) { ?>
                <div style="clear:both"></div>
                    <?php  $img=json_decode($row['reply_img'],1);?>
                    <div class="chat-imgs left" onclick='displayImage(this)' >
                        <?php  if(is_array($img)) { foreach($img as $li) { ?>
                            <img src='<?php  echo $this->imgFrom($li)?>' height="100">
                        <?php  } } ?>
                        <div style="clear:both"></div>
                    </div>
                <?php  } ?>
                <div class="chat-time"><?php  echo date("m-d H:i",$row['reply_time'])?></div>
              </div>
            </li>          
          <?php  } } ?>
        </ul>
      </div>
    </div>

  </section>
  <style>
      .chat-imgs{
          margin-top:10px;
      }
      .chat-imgs img{
          width:30%;
          float:right;
          margin-left:2%;
          margin-top:5px;
      }
      .left img{
          float:left;
      }
  </style>
  <script>
  function displayImage(obj){
      var img_urls   =[];
      var img_current='';
        if($(obj).find('img').length>0){
            img_current=$(obj).find('img').eq(0).attr('src');
            $.each($(obj).find('img'),function(){
              get_v = $(this).attr('src');
              img_urls.push(get_v);
            });
        }
        wx.previewImage({
            current: img_current,
            urls: img_urls
        });
  }
  </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
