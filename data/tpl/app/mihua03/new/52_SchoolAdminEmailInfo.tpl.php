<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body> 
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div style="height:45px;padding-top:0" class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $message_info['title'];?></div>
          <a class="w-inline-block navbar-button" href="<?php  echo $this->createMobileUrl('schoolAdminEmail')?>" data-load="1">
            <div class="navbar-button-icon icon ion-ios-arrow-thin-left"></div>
          </a>
        </div>
      </div>
      <div class="body" style="padding-top:45px;">
        <ul class="list list-chats" id='list-chats'>
            
          <li class="list-chat " data-ix="list-item">
                <div class="column-left chat ">
                    <div class="image-message chat">
                        <img src="<?php  echo C('student')->studentImg($message_info['student_id']);?>">
                    </div>
                </div>
                <div class="w-clearfix column-right chat">
                    <div class="arrow-globe"></div>
                    <div class="chat-text"><?php  echo $message_info['message_content'];?></div>
                    <div class="chat-time"><?php  echo date("m-d H:i",$message_info['add_time'])?></div>
                </div>
          </li>
          <?php  if(is_array($handle_list)) { foreach($handle_list as $row) { ?>
          <?php  if($row['type']==2) { ?>
            <li class="list-chat" data-ix="list-item">
              <div class=" column-left chat  ">
                <div class="image-message chat">
                    <img src="<?php  echo C('student')->studentImg($row['student_id']);?>">
                </div>
              </div>
              <div class="w-clearfix column-right chat">
                <div class="arrow-globe"></div>
                <div class="chat-text"><?php  echo $row['content'];?></div>
                <div class="chat-time"><?php  echo date("m-d H:i",$row['add_time'])?></div>
              </div>
            </li>          
          <?php  } ?>
          <?php  if($row['type']==1) { ?>
                    <li class="list-chat right" data-ix="list-item">
                      <div class="w-clearfix column-right chat right">
                        <div class="arrow-globe right"></div>
                        <div class="chat-text right"><?php  echo $row['content'];?>
                        </div>
                        <div class="chat-time right"><?php  echo date("m-d H:i",$row['add_time'])?></div>
                      </div>
                   </li>
          <?php  } ?>
          <?php  } } ?>
        </ul>
      </div>
      <div class="input-chat-block">
        <div class="w-form">
            <input class="w-input input-chat"   id="chat-message" type="text" placeholder="回复内容"  required="required">
            <input class="w-button chat-button" type="submit"     value="发送" data-wait="Please wait..." id="send_message_content">
        </div>
      </div>
    </div>

  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
<script>
  $(function(){
    var message_id = <?php  echo $mid;?>;
    $("#send_message_content").click(function(){
        var content = $("#chat-message").val();
        $.ajax({
          url:"<?php  echo $this->createMobileUrl('schoolAdminEmailInfo')?>",
          type:'post',
          data:{content:content,mid:message_id,ac:'re_message_content'},
          dataType:'json',
          success:function(obj){
            if(obj.errcode == 1){
              alert(obj.msg);
              return false;
            }else{
              $("#chat-message").val('');
              $("#list-chats").append(
                  '<li class="list-chat right" data-ix="list-item" style="opacity: 1; transform: translateX(0px) translateY(0px); transition: opacity 500ms cubic-bezier(0.23, 1, 0.32, 1), transform 500ms cubic-bezier(0.23, 1, 0.32, 1);" >'+
                      '<div class="w-clearfix column-right chat right">'+
                        '<div class="arrow-globe right"></div>'+
                        '<div class="chat-text right">'+content+'</div>'+
                        '<div class="chat-time right">刚刚</div>'+
                      '</div>'+
              '</li>'
              );
            }

          }
      });
    });
  });
</script>
</body>
</html>