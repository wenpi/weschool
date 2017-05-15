<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "消息发送-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css?<?php  echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
 <body>
 <div class="body" style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-menu top-buttons">
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
              <div>消息发送</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button" data-w-tab="Tab 2">
              <div>发送记录</div>
            </a>
          </div>
		<div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
      <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
				<form action="" method="post" class="form-horizontal form" id="form1" >
				<?php  if($model=='student') { ?>
					<ul class='student_line'>
							<?php  if(is_array($result)) { foreach($result as $item) { ?>
									<li class='btn button_new' id='button_<?php  echo $item['student_id'];?>' onclick="checkThis(<?php  echo $item['student_id'];?>)" style="color:#fff;padding:0px;border-radius:0px;"><?php  echo $this->result_result($item,$model,'name','tea_msg');?>&nbsp;
										<input  id='check_box_<?php  echo $item['student_id'];?>' type='checkbox' value='<?php  echo $item['student_id'];?>' name='have[]' style='width:15px;display:none' > 
									</li>
							<?php  } } ?>
						</ul>
				<?php  } ?>        
				<table class="table table-hover">
					<tbody>
						<?php  if($model!='student') { ?>
						<?php  if(is_array($result)) { foreach($result as $item) { ?>
						<tr>
							<td><?php  if($model!='student') { ?>
								<a href="<?php  echo $this->result_result($item,$model,'url','tea_msg');?>" ><?php  } ?>
								<?php  echo $this->classGradeName($item)?>-<?php  echo $this->className($item);?>
								<?php  if($model!='student') { ?> >></a><?php  } ?>
								&nbsp;&nbsp;&nbsp;
								<input type='checkbox' value='<?php  if($model!='student') { ?><?php  echo $item;?><?php  } else { ?><?php  echo $item['student_id'];?><?php  } ?>' name='have[]' style='width:22px; height:22px'>
							</td>
						</tr>
						<?php  } } ?>
						<?php  } ?>
					</tbody>
				</table>
				<input type='hidden' value='<?php  echo $model;?>' name='model'>
				<div class="panel panel-default">
					<div class="panel-heading">
						微信模板消息发送
					</div>
					<div class="panel-body">
						<div class="tab-content">
						<div class="form-group">
						<input name='mu_id' class='form-control' value="<?php  echo $this->module['config']['msg']?>" type='hidden'>
						</div>	
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>通知标题【不填写为默认】</label>
							<div class="col-sm-9 col-xs-10">
								<textarea name='title' class='form-control'  placeholder="[学生姓名]你好，这是个新的消息" ></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>简要内容</label>
							<div class="col-sm-9 col-xs-10">
								<textarea name='intro' class='form-control' placeholder="内容简短，30字内！" required maxlength="30"></textarea>
							</div>
						</div>
						<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_reply', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_reply', TEMPLATE_INCLUDEPATH));?>
					</div>
				 </div>		
           		 </div>
				<div class="form-group col-sm-12">
					<input type="hidden" value="<?php  echo $token;?>"  name='token'>
					<input type="submit" name="submit_weixin" value="提交" class="btn btn-primary col-lg-1" />
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
function getMsgSendList(){
  if(pager>0){
    $.ajax({
      url:"<?php  echo $this->createMobileUrl('ajax',array('ac'=>'tea_msg_send_list'))?>",
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
  getMsgSendList();
	$(window).scroll(function(){
		if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
      		getMsgSendList();
		}
	});
});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
<style>
    .student_line li{
        width:30%;
        float: left;
        margin-bottom: 5px;
        text-align: center;
        font-size: 1.1em;
		line-height:30px;
		font-weight:700;
    }
	.button_new{
		padding:0px 0px !important;
		background-color:#bbb;
	}	
	.button_list button{
		float: left;
		margin-left: 10px;
		width: 80px;
		font-size: 0.8em;
		padding: 5px;
	}
</style>