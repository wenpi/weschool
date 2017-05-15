<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = $title."-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css?<?php  echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<body>
    <div class="weui_panel weui_panel_access">
        <div class="weui_panel_bd">
            <a href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_bd">
                    <h4 class="weui_media_title" style="line-height: 25px;"><?php  echo $record_re['record_intro'];?></h4>
                    <p class="weui_media_desc"><?php  echo $record_re['record_content'];?></p>
                </div>
            </a>
        </div>
    </div>
<div class="weui_panel">
        <div class="weui_panel_hd">详情列表</div>
        <div class="weui_panel_bd">
            <div class="weui_media_box weui_media_small_appmsg">
                <div class="weui_cells weui_cells_access">
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <a class="weui_cell" href="javascript:;">
                            <div class="weui_cell_hd"><img src="<?php  echo $this->imgFrom($row['student_img']);?>" alt="" style="width:20px;margin-right:5px;display:block"></div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p><?php  echo $row['student_name'];?></p>
                            </div>
                            <?php  if($look == 1) { ?>
                                <?php  if($row['look_content']) { ?>
                                <span onclick="findLookInfo(<?php  echo $row['look_id'];?>)">
                                <i class="weui_icon_info_circle"></i>
                                详情
                               </span>
                               <?php  } else { ?>
                                 <span>
                                <i class="weui_icon_info_circle"></i>
                                无回复
                               </span>                              
                               <?php  } ?>
                            <?php  } else { ?>
                                <span onclick="reSend(<?php  echo $rid;?>,<?php  echo $row['student_id'];?>,this)">
                                <i class="weui_icon_download"></i>
                                重发
                                </span>
                            <?php  } ?>
                        </a>
                    <?php  } } ?>
                </div>
            </div>
        </div>
</div>
<div class="weui_dialog_alert" style="display:none" id="weui_dialog_alert" >
    <div class="weui_mask" ></div>
    <div class="weui_dialog" >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">提示消息</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access" id="weui_content">
                    
                </div>
        </div>
            <div class="weui_dialog_ft">
            <br>
        </div>        
    </div>
</div>
<div class="weui_dialog_alert" style="display:none" id="weui_dialog_alert_content" >
    <div class="weui_mask" ></div>
    <div class="weui_dialog" style="top: 5%;overflow-y: auto;bottom: 20%;height: 80%;" >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">回复详情</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access" id="msg_replay">
                    <p class="images"></p>
                    <p class="voice"></p>
                    <p class="text"></p>
                </div>
        </div>
            <div class="weui_dialog_ft">
            <br>
        </div>        
    </div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
<script>
    $(function(){
        $("#weui_dialog_alert").click(function(){
            $(this).hide();
        });
        $("#weui_dialog_alert_content").click(function(){
            $(this).hide();
        });        
    });
    function reSend(rid,student_id,obj){
        $.ajax({
        url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'tea_re_send'))?>",
        type:'post',
        data:{rid:rid,student_id:student_id},
        dataType:'json',
        success:function(json){
            if(json.errcode==1){
                $("#weui_dialog_alert").show();
                $("#weui_content").html(json.text);
            }else{
                $(obj).html('<i class="weui_icon_success"></i>');
            }
        }
        });       
    }
    function findLookInfo(look_id){
        $.ajax({
            url:'<?php  echo $this->createMobileUrl('ajax')?>',
            type:'post',
            data:{ac:'look_info',look_id:look_id},
            dataType:'json',
            success:function(obj){
                if(obj.errcode==0){
                    $("#weui_dialog_alert_content").show();
                    $("#msg_replay").find('.text').html(obj.text);
                    $("#msg_replay").find('.voice').html(obj.voice);
                    $("#msg_replay").find('.images').html(obj.imgs);
                }
            }    
        });        
    }
</script>