<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/style.css">
<link href="<?php echo MODULE_URL;?>style/css/dropload.css" rel="stylesheet" type="text/css" />
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js?<?php  echo  time();?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css?<?php  echo  time();?>">
  <style>
  .bg-gradient{
    background-color: rgba(51,203,213,0.8);
    background-image: none;
  }
  </style>
<body> 
  <section class="w-section mobile-wrapper">
    <div class="page-content " id="main-stack"  style="background-color:#fff">
      <div id='line_banner' style="height:45px;padding-top:0" class="w-nav navbar bg-gradient " data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $head_title;?> </div>
            <a class="w-inline-block navbar-button" href="<?php  if($in_type['type']=='student' ) { ?> <?php  echo $this->createMobileUrl('personer_list')?> <?php  } else { ?> <?php  echo $this->createMobileUrl('teaChat')?> <?php  } ?>" data-load="1">
            <div class="navbar-button-icon icon ion-ios-arrow-thin-left"></div>
            <a class="w-inline-block navbar-button right" href="javascript:;" onclick="loadHis()" data-load="1" data-ix="search-box">
              <div class="navbar-button-icon smaller icon ion-load-a"></div>
          </a>
          </a>
        </div>
      </div>
      <div class="body inner " style="padding-top:45px;">
        <ul class="list list-chats " id='list-chats'>
            <div style="width:100%;height: 45px;"></div>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/ChatMessage_content', TEMPLATE_INCLUDEPATH)) : (include template('../new/ChatMessage_content', TEMPLATE_INCLUDEPATH));?>
        </ul>
        <div id='end_bottom' name="zhidao" style="width:100%;height:1px;background-color:#fff"></div>
      </div>
      <div class="input-chat-block">
        <div class="w-form">
            <div class="message_plus"> <i class=" icon ion-ios-plus"></i></div>
            <input class="w-input input-chat"  style="width: 70%;border-bottom: 0px;"  id="chat-message" type="text" placeholder="回复内容"  required="required">
            <input class="w-button chat-button" type="submit"     value="发送" data-wait="Please wait..." id="send_message_content">
        </div>
      </div>
      <div class="other_type_msg">
        <div class="close_msg"><i class=" icon ion-ios-close"></i></div>
        <ul>
          <li id="plus_img">  <i class="ion-image"></i> </li><span>拍摄</span>
          <input type="hidden" id="value_id_name">
          <li id="plus_voice"> <i class="ion-mic-a"></i> </li><span>语音</span>
          <div class="clear"></div>
        </ul>
      </div>
    </div>
  </section>
<script>
  var page    = 1;
  var done    = false;
  var to_done = true;
  function scrollToEnd(){
    var h = $(document).height()-$(window).height();
    $(document).scrollTop(h); 
  }
  function sendMsg(content,type){
      var text_content        = '';
      var img_value_content   = '';
      var voice_value_content = '';
      if(type == 'text'){
        text_content = content;
      }else if(type == 'img_value'){
        img_value_content = content;
      }else if(type == 'voice_value'){
        voice_value_content = content;
      }
      if(content){
          $.ajax({
            url:'<?php  $this->createMobileUrl('chatMessage') ?>',
            data:{type:'<?php  echo $_GPC['type'];?>',t_id:'<?php  echo $_GPC['t_id'];?>',s_id:'<?php  echo $_GPC['s_id'];?>',o_id:'<?php  echo $_GPC['o_id'];?>',text:text_content,img_value:img_value_content,voice_value:voice_value_content,ajax:'add'},
            dataType:"json",
            type:'post',
            success:function(obj){
              getNewList();
            }
          });
      }
    }

  $(function(){
    scrollToEnd();
    $(".message_plus").click(function(){
      $(".other_type_msg").show();
    });
    $(".close_msg").click(function(){
      $(".other_type_msg").hide();
    });
    //发送消息
    $("#send_message_content").click(function(){
        content = $('#chat-message').val();
        sendMsg(content,'text');
        $('#chat-message').val('');
        to_done = true;
    });
    setInterval("getNewList()",2000);
});
function loadHis(){
  page++;
  $.ajax({
    url:'<?php  $this->createMobileUrl('chatMessage') ?>',
    data:{type:'<?php  echo $_GPC['type'];?>',t_id:'<?php  echo $_GPC['t_id'];?>',s_id:'<?php  echo $_GPC['s_id'];?>',ajax:'list',pager:page},
    success: function(data){
      if(data=='done'){
        done=true;
      }else{
        $("#list-chats").prepend(data);
      }
    }
  }); 
}
function getNewList(){
  $.ajax({
    url:'<?php  $this->createMobileUrl('chatMessage') ?>',
    data:{type:'<?php  echo $_GPC['type'];?>',t_id:'<?php  echo $_GPC['t_id'];?>',s_id:'<?php  echo $_GPC['s_id'];?>',ajax:'new_list'},
    success: function(data){
      if(data!='done'){
          $("#list-chats").append(data);
          if(to_done){
            var h = $(document).height()-$(window).height();
            $(document).scrollTop(h);
            console.log(1);
          }
      }
    }
    });
}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/ChatMesageImage', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/ChatMesageImage', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/ChatMesageVoice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/ChatMesageVoice', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>