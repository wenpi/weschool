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
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">版本</label>
					<div class="col-sm-9 col-xs-12">
						<input type='radio' value='6' name='version' <?php  if($settings['version']==6) { ?> checked <?php  } ?>> 0.6版&nbsp;&nbsp;
						<input type='radio' value='7' name='version' <?php  if($settings['version']==7) { ?> checked <?php  } ?>> 0.7版
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校微官网地址</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="school_url" class="form-control" value="<?php  echo $settings['school_url'][$_SESSION['school_id']];?>" />
					</div>
				</div>

                <div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信接口配置</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="sms_set" class="form-control" value="<?php  if($settings['sms_set'][$_SESSION['school_id']] ) { ?><?php  echo $settings['sms_set'][$_SESSION['school_id']];?>
                        <?php  } else { ?>http://api.smsbao.com/sms?u=USERNAME&p=PASSWORD&m=PHONE&c=CONTENT<?php  } ?>"  />
                        配置时，只需把相应的帐密填写上，PHONE和CONTENT，不需要动，其他类似接口也请在相应值上设置为这两个关键字<br>
					    <a href='http://www.cocsms.com/openapi/' target='_blank'>使用说明</a>
                    </div>
				</div>
                
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">学校基本设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">在校时间（学校配置用）</label>
					<div class="col-sm-9 col-xs-12">
                        
						<input type='text' value='<?php  echo $settings['on_school'][$_SESSION['school_id']];?>' name='on_school' placeholder="5"> 天制&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">周几课程开始（给培训学校用：周一开始上课的学校可以不填写。）</label>
					<div class="col-sm-9 col-xs-12">
						周<input type='text' value='<?php  echo $settings['begin_course'][$_SESSION['school_id']];?>' name='begin_course' placeholder="6"> 开始上课&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">上下午课时配置（上几节课，配置后请勿随便修改）</label>
					<div class="col-sm-9 col-xs-12">
						上午：<input type="text" name="am_much" class="form-control" value="<?php  echo $settings['am_much'][$_SESSION['school_id']];?>" />
						下午：<input type="text" name="pm_much" class="form-control" value="<?php  echo $settings['pm_much'][$_SESSION['school_id']];?>" />
						晚上：<input type="text" name="ye_much" class="form-control" value="<?php  echo $settings['ye_much'][$_SESSION['school_id']];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈类别</label>
					<div class="col-sm-9 col-xs-12">
						每个不同的类别以||分开
						<textarea name='line_type' class='form-control'><?php  if($settings['line_type'][$_SESSION['school_id']]) { ?><?php  echo $settings['line_type'][$_SESSION['school_id']];?><?php  } else { ?>班级活动||班级公告||日常点滴||重要事务<?php  } ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">预约类别</label>
					<div class="col-sm-9 col-xs-12">
						每个不同的类别以||分开
						<textarea name='appointment' class='form-control'><?php  if($settings['appointment'][$_SESSION['school_id']]) { ?><?php  echo $settings['appointment'][$_SESSION['school_id']];?><?php  } else { ?>课程预约||兴趣小组||集体活动<?php  } ?></textarea>
					</div>
				</div>
 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">家长绑定配置</label>
					<div class="col-sm-9 col-xs-12">
						<input type="radio" name="family_set"  value="much_school" <?php  if($settings['family_set'] !='alone_school' ) { ?>  checked <?php  } ?> />系统编号模式（多校平台建议）&nbsp;&nbsp;
						<input type="radio" name="family_set"  value="alone_school"  <?php  if($settings['family_set'] =='alone_school' ) { ?>  checked <?php  } ?>  />学生学号模式
					</div>
				</div>
			</div>
		</div>
    <div class="panel panel-default">
                <div class="panel-heading">七牛云（非多校）必须配置</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">域名前缀(要以/结尾)：</label>
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
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">空间名:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['qiniu_bucket'];?>' name='qiniu_bucket'  class='form-control'> 					
                        </div>
                </div>
                <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">多媒体处理:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['qiniu_pipeline'];?>' name='qiniu_pipeline'  class='form-control'> 					
                        </div>
                </div>            
                    <a href="https://portal.qiniu.com/signup?code=3looaumbp7z2q">去注册七牛</a>           
                </div>
    </div>   
    <div class="panel panel-default">
                <div class="panel-heading">家校通云配置（非多校）</div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">Passport:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='text' value='<?php  echo $settings['jia_passport'];?>' name='jia_passport'  class='form-control'> 					
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">Password:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='password' value='<?php  echo $settings['jia_password'];?>' name='jia_password'  class='form-control'> 					
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label">超级管理员OPENID:</label>
                        <div class="col-sm-9 col-xs-12">
                            <input type='password' value='<?php  echo $settings['admin_openid'];?>' name='admin_openid'  class='form-control'> 					
                        </div>
                    </div> 
    </div> 
    <div class="panel panel-default">
                <div class="panel-heading">支付配置（非多校）</div>
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