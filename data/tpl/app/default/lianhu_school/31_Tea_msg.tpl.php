<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>消息发送-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>消息发送</div>
        </div>
 </div>  
<div class="main">
		<div class="panel-body table-responsive">
		<form action="" method="post" class="form-horizontal form"id="form1" >
         <?php  if($model=='student') { ?>
            <ul class='student_line'>
                    <?php  if(is_array($result)) { foreach($result as $item) { ?>
                            <li class='btn button_new' id='button_<?php  echo $item['student_id'];?>' onclick="checkThis(<?php  echo $item['student_id'];?>)"><?php  echo $this->result_result($item,$model,'name','tea_msg');?>&nbsp;
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
				添加发送内容【模板消息】
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
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>通知内容</label>
					<div class="col-sm-9 col-xs-10">
						<textarea name='content' class='form-control' placeholder="请尽量减少群发消息，以免账号被封！(30字以内)"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>备注消息</label>
					<div class="col-sm-9 col-xs-10">
						<textarea name='remark' class='form-control'></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='url' class='form-control'></textarea>
					</div>
				</div>				
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="submit" name="submit_weixin" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				添加发送内容【客服消息】
			</div>
			<div class="panel-body">
				<div class="tab-content">
  				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-10">
						<textarea name='title_kf' class='form-control' placeholder="发送标题"></textarea>
					</div>
                    <div style='clear:both'></div>
				</div>   
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容说明</label>
					<div class="col-sm-9 col-xs-10">
						<textarea name='content_kf' class='form-control' placeholder="请尽量减少群发消息，以免账号被封！"></textarea>
					</div>
                    <div style='clear:both'></div>
				</div>
                
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
					<div class="col-sm-9 col-xs-10">
						<textarea name='url_kf' class='form-control'></textarea>
					</div>
                    <div style='clear:both'></div>
				</div> 
			</div>
		</div>		
		<div class="form-group col-sm-12">
            <br>
			<input type="submit" name="submit_kf" value="客服消息" class="btn btn-primary"/>
		</div>
	</div><br><br><br>  
        
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>
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
</style>