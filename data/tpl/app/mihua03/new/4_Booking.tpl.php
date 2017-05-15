<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '校外报名活动列表';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?> 
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet"        href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css"  type="text/css" />
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>

  <body>
    <div class="body" style="padding-top:0px;padding-bottom:60px;">
            <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
            <div class="w-tab-menu top-buttons">
                <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
                <div>活动列表</div>
                </a>
                <a class="w-tab-link  w-inline-block toolbar-top-button"  data-w-tab="Tab 2">
                <div>报名列表</div>
                </a>
            </div>
            <div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
            <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                <div class="weui_panel weui_panel_access">
                    <div class="weui_panel_hd">可报名的活动列表</div>
                        <div class="weui_panel_bd">
                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                <a href="<?php  echo $this->createMobileUrl('booking_list',array('id'=>$row['booking_id'],'school_id'=>$_GPC['school_id']));?>" class="weui_media_box weui_media_appmsg">
                                    <div class="weui_media_hd">
                                        <img class="weui_media_appmsg_thumb"  width="120" src="<?php  echo $_W['attachurl'];?><?php  echo $row['booking_img'];?>"  alt="">
                                    </div>
                                    <div class="weui_media_bd">
                                    <h4 class="weui_media_title"><?php  echo $row['booking_title'];?></h4>
                                    <p class="weui_media_desc"><?php  echo date("Y-m-d H:i",$row['begin_time'])?>--<?php  echo date("Y-m-d H:i",$row['end_time'])?> </p>
                                    <p class="weui_media_desc"><?php  echo $row['booking_intro'];?></p>
                                    </div>
                                </a>
                            <?php  } } ?>
                        </div>
                </div>
            </div>
            <div class="w-tab-pane tab-pane" data-w-tab="Tab 2">
                <div class="weui_panel_bd" id='tea_msg_send_list' >

                </div>
                <div class='end_text' id='end_text'></div>
            </div>			
            </div>
        </div>
    </div>
    <script>
        var pager=1;
        function getLeaveList(){
        if(pager>0){
            $.ajax({
            url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'booking_list_history'))?>",
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
            getLeaveList();
        });
    </script>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>