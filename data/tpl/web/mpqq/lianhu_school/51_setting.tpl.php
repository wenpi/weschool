<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
.red {float:left;color:red}
.white{float:left;color:#fff}
.tooltipbox {
	background:#fef8dd;border:1px solid #c40808; position:absolute; left:0;top:0; text-align:center;height:20px;
	color:#c40808;padding:2px 5px 1px 5px; border-radius:3px;z-index:1000;
}
.red { float:left;color:red}
</style>
<div class="main">
    <h1>请移步至独立后台=》系统维护=》系统参数里编辑</h1>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">模板消息配置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校通知【只需填写一个】</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="msg" class="form-control" value="<?php  echo $settings['msg'];?>" />
						行业：教育 - 院校；名称：学校通知；编号OPENTM204845041
					</div>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="msg01" class="form-control" value="<?php  echo $settings['msg01'];?>" />
						行业：IT科技 - 互联网|电子商务；名称：重要通知；编号OPENTM400751454
					</div>					
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级通知【只需填写一个】</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="msg1" class="form-control" value="<?php  echo $settings['msg1'];?>" />
						模板编号：OPENTM204533457；行业：教育 ；名称： 班级通知
					</div>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="msg11" class="form-control" value="<?php  echo $settings['msg11'];?>" />
						行业：IT科技 - 互联网|电子商务；名称：重要通知；编号OPENTM400751454
					</div>					
				</div>
 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">刷卡通知</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="msg_card" class="form-control" value="<?php  echo $settings['msg_card'];?>" />
						模板编号：OPENTM207940152；行业：IT科技 ；名称： 幼儿园刷卡通知
					</div>
				</div>

                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信接口配置</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="sms_set"  class="form-control" value="<?php  if($settings['sms_set']) { ?><?php  echo $settings['sms_set'];?>
                        <?php  } else { ?>http://api.smsbao.com/sms?u=USERNAME&p=PASSWORD&m=PHONE&c=CONTENT<?php  } ?>"  />
                        配置时，只需把相应的帐密填写上，PHONE和CONTENT，不需要动，其他类似接口也请在相应值上设置为这两个关键字<br>
					    <a href='http://www.cocsms.com/openapi/' target='_blank'>使用说明</a>
                    </div>
				</div>
                
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">基本设置</div>
			<div class="panel-body">

 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">家长绑定配置</label>
					<div class="col-sm-9 col-xs-12">
						<input type="radio" name="family_set"  value="much_school" <?php  if($settings['family_set'] !='alone_school' ) { ?>  checked <?php  } ?> />系统编号模式（多校平台建议）&nbsp;&nbsp;
						<input type="radio" name="family_set"  value="alone_school"  <?php  if($settings['family_set'] =='alone_school' ) { ?>  checked <?php  } ?>  />学生学号模式
					</div>
				</div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">超级管理员OPENID:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='password' value='<?php  echo $settings['admin_openid'];?>' name='admin_openid'  class='form-control'> 					
                        </div>
                    </div> 				
			</div>
		</div>
    <div class="panel panel-default">
                <div class="panel-heading">七牛云（多校共用）必须配置</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">域名(要以/结尾)：</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='radio' value='1' name='qiniu' checked style="display:none">  
                            <input type='text' value='<?php  echo $settings['qiniu_url'];?>' name='qiniu_url'  class='form-control' > 					
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">AccessKey:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['qiniu_AccessKey'];?>' name='qiniu_AccessKey'  class='form-control'> 					
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">SecretKey:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='password' value='<?php  echo $settings['qiniu_SecretKey'];?>' name='qiniu_SecretKey'  class='form-control'> 					
                        </div>
                    </div>                              
                <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">储存空间名:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['qiniu_bucket'];?>' name='qiniu_bucket'  class='form-control'> 					
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">多媒体处理空间名:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['qiniu_pipeline'];?>' name='qiniu_pipeline'  class='form-control'> 					
                        </div>
                </div>            
                    <a href="https://portal.qiniu.com/signup?code=3looaumbp7z2q">去注册七牛</a>           
                </div>
    </div>   
    <div class="panel panel-default">
                <div class="panel-heading">支付配置（多校共用）</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否开启其他账号支付</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='radio' value='0' name='pay_do' <?php  if($settings['pay_do']==0) { ?> checked <?php  } ?>> 不开启&nbsp;&nbsp;
                            <input type='radio' value='1' name='pay_do' <?php  if($settings['pay_do']==1) { ?> checked <?php  } ?>> 开启
                        </div>
                    </div>
                                
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择公众号</label>
                        <div class="col-sm-9 col-xs-12">
                        <select name='pay_uniacid'>
                            <?php  if(is_array($uniacid_list)) { foreach($uniacid_list as $row) { ?>
                                <option value="<?php  echo $row['uniacid'];?>" <?php  if($settings['pay_uniacid']==$row['uniacid']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                        </div>
                    </div>
                </div>
    </div>         
	<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
 
 </form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>