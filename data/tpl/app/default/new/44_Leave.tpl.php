<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '请假申请';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?> 
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-menu top-buttons">
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
              <div>请假申请</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button"  data-w-tab="Tab 2">
              <div>申请记录</div>
            </a>
          </div>
		<div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
    <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
          <form action="" method="post" class="form-horizontal form" id="form1" >
            <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label for="" class="weui_label" style="font-weight: 500;font-size: 0.8em;">开始时间：</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="datetime-local" value=""  name="time_date_begin" style="font-size: 0.6em;" required>
                        </div>
                    </div>
                    <div class="weui_cell">
                        <div class="weui_cell_hd"><label for="" class="weui_label" style="font-weight: 500; font-size: 0.8em;" >结束时间：</label></div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <input class="weui_input" type="datetime-local" value=""  name='time_date_end' style="font-size: 0.6em;" required >
                        </div>
                    </div>
            </div>
            <div class="weui_cells_title">文字说明</div>
            <div class="weui_cells weui_cells_form">
              <div class="weui_cell">
                  <div class="weui_cell_bd weui_cell_primary">
                      <textarea class="weui_textarea" placeholder="详细内容" rows="5" name="leave_reason" required></textarea>
                  </div>
                  <div class="weui_textarea_counter"></div>
              </div>
              </div>

              <div class="form-group col-sm-12">
                <input type="hidden" value="<?php  echo $token;?>"  name='token'>
                <input type="submit" name="submit_weixin" value="提交" class="weui_btn weui_btn_primary" />
              </div>
              </form>
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
      url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'student_leave_list'))?>",
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>