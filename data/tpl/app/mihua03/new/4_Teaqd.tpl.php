<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '签到活动列表';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css?<?php  echo time()?>">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/framework.js"></script>
<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;background-color:#fff;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
            <div class="teaqd_head">
                <span>签到活动列表</span>
                <a href="<?php  echo $this->createMobileUrl("TeaqdAdd")?>"> <i class=" fa fa-plus-square-o"></i>发起</a>
            </div>

            <div class="w-tab-content tabs-content" style="background-color:#fff;">
                <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                        <div class="weui_panel weui_panel_access" >
                            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/Teaqd_content', TEMPLATE_INCLUDEPATH)) : (include template('../new/Teaqd_content', TEMPLATE_INCLUDEPATH));?>
                        </div>
                </div>
		    </div>
	    </div>
        <div class='end_text' id='end_text'></div>
</div>
<style>
    .weui_media_desc{
        color:#666 !important;
        letter-spacing: 2px;
    }
</style>
<script>
    var pager=1;
    function getTeaLeaveList(){
    if(pager>0){
        $.ajax({
        url:"<?php  echo $this->createMobileUrl('Teaqd',array('ac'=>'ajax'))?>",
        type:'post',
        data:{pager:pager},
        success:function(html){
            if(html && html !='no'){
            $("#tea_msg_send_list").append(html);
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
    getTeaLeaveList();
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                getTeaLeaveList();
            }
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>