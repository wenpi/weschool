<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="../addons/lianhu_school/images/style.css?<?php echo TIMESTAMP;?>">
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<div class="head">
	<span class="title">绑定教师账号</span>
</div>
<form class="form-horizontal" method="post" action="<?php  echo $this->createMobileUrl('teacher')?>">
	<div class="order-main">
		<div class="add-address img-rounded" id="" >
			<div class="add-address-hd">通过系统账号绑定</div>
			<div class="add-address-main">
				<div class="form-group">
					<label class="col-sm-3 control-label">系统账号：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='passport' id='passport'>
						<input type="hidden" class="form-control" name='submit' value='1'>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">系统密码：</label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name='password' id='password'>
					</div>
				</div>				
				<div class="form-group">
					<div class="col-sm-12">
						
						 <button class="button button-raised button-caution" type="submit" ><i class="fa fa-user"></i>&nbsp;&nbsp;保存</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

