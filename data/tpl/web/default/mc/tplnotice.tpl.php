<?php defined('IN_IA') or exit('Access Denied');?><?php  $newUI = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li<?php  if($do == 'set') { ?> class="active"<?php  } ?>><a href="<?php  echo url('mc/tplnotice')?>"><i class="icon-group"></i> 设置通知模板</a></li>
</ul>
<?php  if($_W['account']['level'] < ACCOUNT_SUBSCRIPTION_VERIFY) { ?>
<div class="alert alert-danger">
	<i class="fa fa-info-circle"></i> 由于您的公众号属于非认证帐号，无使用该功能的权限，请在微信公众平台进行“微信认证”
</div>
<?php  } else { ?>
<?php  if($_W['account']['level'] == ACCOUNT_SUBSCRIPTION_VERIFY) { ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> 系统将通过“客服消息”接口给会员发送信息.使用客服消息发送通知，要求：粉丝过去的“48小时内”必须有过交互，否则将不能发送通知<br>
	</div>
<?php  } else { ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> 您可以为通知设置个性化通知模板<br>
	</div>
<?php  } ?>
<div class="clearfix">
	<form action="<?php  echo url('mc/tplnotice');?>" method="post" class="form-horizontal">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置通知模板
			</div>
			<div class="panel-body">
				<?php  if(is_array($tpls)) { foreach($tpls as $key => $tpl) { ?>
					<?php  if($_W['account']['level'] == ACCOUNT_SERVICE_VERIFY) { ?>
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><?php  echo $tpl['name'];?>模板</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" name="<?php  echo $key;?>[tpl]" value="<?php  echo $set[$key]['tpl'];?>"/>
							<span class="help-block"><?php  echo $tpl['help'];?></span>
						</div>
					<?php  } ?>
				<?php  } } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-9 col-xs-12">
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
				<input type="submit" name="submit" value="提交" class="btn btn-primary"/>
			</div>
		</div>
	</form>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
