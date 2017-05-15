<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/dropload.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body> 
  <section class="w-section mobile-wrapper">
    <div class="page-content " id="main-stack"  style="background-color:#fff">
      <div id='line_banner' style="height:45px;padding-top:0" class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $head_title;?></div>
          <a class="w-inline-block navbar-button" href="<?php  if($in_type['type']=='student' ) { ?> <?php  echo $this->createMobileUrl('personer_list')?> <?php  } else { ?> <?php  echo $this->createMobileUrl('teaChat')?> <?php  } ?>" data-load="1">
            <div class="navbar-button-icon icon ion-ios-arrow-thin-left"></div>
          </a>
        </div>
      </div>
      <div class="body inner " style="padding-top:45px;">
        <ul class="list list-chats " id='list-chats'>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/ChatMessage_content', TEMPLATE_INCLUDEPATH)) : (include template('../new/ChatMessage_content', TEMPLATE_INCLUDEPATH));?>
        </ul>
        <div id='end_bottom' style="width:100%;height:1px;background-color:#fff"></div>
      </div>
      <div class="input-chat-block">
        <div class="w-form">
            <input class="w-input input-chat"   id="chat-message" type="text" placeholder="回复内容"  required="required">
            <input class="w-button chat-button" type="submit"     value="发送" data-wait="Please wait..." id="send_message_content">
        </div>
      </div>
    </div>
  </section>
<script src="<?php echo MODULE_URL;?>style/js/dropload.js"></script>
<script>
  var page    = 1;
  var done    = false;
  var to_done = true;

  $(function(){
    //发送消息
    $("#send_message_content").click(function(){
      content = $('#chat-message').val();
      if(content){
        $.ajax({
          url:'<?php  $this->createMobileUrl('chatMessage') ?>',
          data:{type:'<?php  echo $_GPC['type'];?>',t_id:'<?php  echo $_GPC['t_id'];?>',s_id:'<?php  echo $_GPC['s_id'];?>',text:content,ajax:'add'},
          dataType:"json",
          type:'post',
          success:function(obj){

          }
        });
      }
      $('#chat-message').val('');
      to_done = true;
    });
    //2s一个遍历获取最新消息
    setInterval("getNewList()",2000);
    // 按钮操作
    $('#line_banner ').on('click',function(){
        var $this = $(this);
        if(!!$this.hasClass('lock')){
            $this.attr('class','btn unlock');
            $this.text('解锁');
            // 锁定
            dropload.lock();
            $('.dropload-down').hide();
        }else{
            $this.attr('class','btn lock');
            $this.text('锁定');
            // 解锁
            dropload.unlock();
            $('.dropload-down').show();
        }
    });

    // dropload
    var dropload = $('.inner').dropload({
        domUp : {
            domClass   : 'dropload-up',
            domRefresh : '<div class="dropload-refresh">↓下拉刷新</div>',
            domUpdate  : '<div class="dropload-update">↑释放更新</div>',
            domLoad    : '<div class="dropload-load"><span class="loading"></span>加载中...</div>'
        },
        loadUpFn : function(me){
            to_done = false;
            if(!done){
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
                     dropload.resetload();
                  },
                  error: function(xhr, type){
                      // 即使加载出错，也得重置
                      dropload.resetload();
                  }
              });
            }else{
                    dropload.resetload();
                    dropload.lock();
                    $('.dropload-down').hide();
             }
        },
    });
});
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>