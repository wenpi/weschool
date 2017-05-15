<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '请假列表';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css}">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/framework.js"></script>
<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;background-color:#fff;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-menu top-buttons">
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
              <div>请假列表</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button"  data-w-tab="Tab 2">
              <div>处理记录</div>
            </a>
          </div>
            <div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
                <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                <?php  if($ac=='list') { ?>
                    <div class="weui_panel weui_panel_access">
                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                <div class="weui_panel_bd" style="border-bottom: 1px solid #eee;">
                                <a href="<?php  echo $this->createMobileUrl('tea_leave', array('id' => $item['leave_id'],'ac'=>'edit'))?>">
                                    <div class="weui_media_box weui_media_text">
                                        <h4 class="weui_media_title">请假人：<?php  echo $this->studentName($item['student_id']);?></h4>
                                        <p class="weui_media_desc">请假理由：<?php  echo $item['leave_reason'];?></p>
                                        <p class="weui_media_desc">请假时间：<?php  echo date("m-d H:i",$item['time_date_begin'])?> 至 <?php  echo date("m-d H:i",$item['time_date_end'])?></p>
                                    </div>
                                    </a>
                                </div>
                            <?php  } } ?>
                    </div>
                <?php  } ?>
                <?php  if($ac=='edit') { ?>
                    <form action="" method="post" class="form-horizontal form" id="form1" >
                        <div class="weui_panel">
                                <div class="weui_panel_hd" style="color:#333;font-size: 16px">请假详情</div>
                                <div class="weui_panel_bd">
                                    <div class="weui_media_box ">
                                        <p class="">请假人：<?php  echo $this->studentName($result['student_id']);?> </p>
                                        <p class="">请假理由：<?php  echo $result['leave_reason'];?></p>
                                        <p class="">请假时间： <?php  echo date("m-d H:i",$result['time_date_begin'])?> 至 <?php  echo date("m-d H:i",$result['time_date_end'])?> </p>
                                        <?php  if($result['leave_voice']) { ?>
                                          <p class="">语音：</p>
                                            <audio src="<?php  echo $this->imgFrom($result['leave_voice']);?>" controls ></audio>
                                        <?php  } ?>
                                    </div>
                                </div>
                            </div>
                        <div class="weui_cells_title" style="margin-top: 0.3em;color:#333;font-size: 15px;">处理备注</div>
                        <div class="weui_cells weui_cells_form">
                        <div class="weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                <textarea style="font-size: 15px;color:#333" class="weui_textarea" placeholder="内容（必须填写）" rows="5" name="teacher_text" autofocus required ></textarea>
                            </div>
                            <div class="weui_textarea_counter"></div>
                        </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                            <input type="submit" name="submit" value="准许" class="weui_btn weui_btn_plain_primary" style="width: 42.5%;float: left;margin-top:10px;margin-left: 5%;"/>
                            <input type="submit" name="submit" value="不允" class="weui_btn weui_btn_plain_default" style="width: 42.5%;float: left;margin-top:10px;margin-left: 5%;border:1px solid #ff0033;color: #ff0033 " />
                        </div>
                        </form>                    
                <?php  } ?>                   
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
function getTeaLeaveList(){
  if(pager>0){
    $.ajax({
      url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'tea_leave_list'))?>",
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