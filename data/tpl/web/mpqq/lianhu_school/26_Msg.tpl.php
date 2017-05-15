<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op=='list') { ?> class='active'<?php  } ?> >
		<a href="<?php  echo $this->createWebUrl('msg');?>">发送消息</a>
	</li>
	<li <?php  if($op=='record') { ?> class='active'<?php  } ?> >
		<a href="<?php  echo $this->createWebUrl('msg',array("op"=>'record') );?>">消息记录</a>
	</li> 
</ul>
<?php  if($op=='record' ) { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('msg_history_list', TEMPLATE_INCLUDEPATH)) : (include template('msg_history_list', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<div class="main">
	<div class="panel-body table-responsive">
       <div class='title'><?php  if($model=='grade') { ?>年级列表<?php  } else if($model=='class') { ?>班级列表<?php  } else if($model=='student') { ?>学生列表<?php  } ?> </div>
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <ul class='record_list'>
				<?php  if(is_array($result)) { foreach($result as $item) { ?>
                <li class='btn btn-primary' style='background-color:#7DCC4A;border:1px solid #7DCC4A;'>
					<?php  if($model!='student') { ?>
                            <a href="<?php  echo $this->result_result($item,$model,'url','msg');?>" style='color:#fff;font-weight:700'>
                    <?php  } ?>
						    <?php  echo $this->result_result($item,$model,'name','msg');?>
					<?php  if($model!='student') { ?></a><?php  } ?>
						&nbsp;&nbsp;&nbsp;
                        <input type='checkbox' value='<?php  if($model!='student') { ?><?php  echo $item;?><?php  } else { ?><?php  echo $item['student_id'];?><?php  } ?>' name='have[]'>
						<input type='hidden' value='<?php  echo $model;?>' name='model'>
				</li>
				<?php  } } ?>
                 <div class="clear"></div>
         </ul>
				<?php  if($model!='grade') { ?>
					<a href="javascript:;" onclick="window.history.back() "><div class='btn btn-primary'>返回</div></a>
				<?php  } ?>
                <div style='wdith:100%;height:20px;'></div>
		<div class="panel panel-default">
			<div class="panel-heading">
				添加发送内容【微信模板机制】
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<input name='mu_id' class='form-control'type='hidden' value="<?php  echo $this->module['config']['msg']?>">
				
                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题【不填写为默认】</label>
					<div class="col-sm-9 col-xs-8">
                        <input type='text' name='weixin_title' class='form-control'  placeholder="[学生姓名]你好，这是个新的消息" >
					</div>
				</div>
                		
        		<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容说明</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='content' class='form-control' placeholder="请尽量减少群发消息，以免账号被封！(30字以内)"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>备注信息</label>
					<div class="col-sm-9 col-xs-8">
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
            <br>
			<input type="submit" name="submit_weixin" value="提交" class="btn btn-primary col-lg-1" />
		</div>
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
					<div class="col-sm-9 col-xs-8">
						<textarea name='title_kf' class='form-control' placeholder="发送标题"></textarea>
					</div>
                    <div style='clear:both'></div>
				</div>   
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容说明</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='content_kf' class='form-control' placeholder="请尽量减少群发消息，以免账号被封！"></textarea>
					</div>
                    <div style='clear:both'></div>
				</div>
                
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='url_kf' class='form-control'></textarea>
					</div>
                    <div style='clear:both'></div>
				</div> 
			</div>
		</div>		
		<div class="form-group col-sm-12">
            <br>
			<input type="submit" name="submit_kf" value="客服消息" class="btn btn-primary col-lg-1" />
		</div>
	</div><br><br><br>   
    
     <div class="panel panel-default">
			<div class="panel-heading">
				添加发送内容【短信机制】
			</div>
			<div class="panel-body">
				<div class="tab-content">
                    
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>抬头(3～10个字符)</label>
					<div class="col-sm-9 col-xs-8">
						<input name='sms_head' value='<?php  echo $_SESSION['school_name'];?>' class='form-control'>
                    <br>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容说明（控制字数）</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='sms_content' class='form-control' ></textarea>
					</div>
				</div>
                				
			</div>
		</div>		
		<div class="form-group col-sm-12">
            <br>
			<input type="submit" name="submit_sms" value="发送短信" class="btn btn-primary col-lg-1" />
		</div>
	</div>
    
</div>
<?php  } ?>