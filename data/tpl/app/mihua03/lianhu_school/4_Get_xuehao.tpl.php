<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<link type="text/css" rel="stylesheet" href="../addons/lianhu_school/images/style.css">
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<div class="head">
	<span class="title">查询信息</span>
</div>
<form class="form-horizontal" method="post" role="form" >
	<div class="order-main">
		<div class="add-address img-rounded" id="" >
			<div class="add-address-hd">请仔细填写相应资料：</div>
			<div class="add-address-main">
				<div class="form-group">
					<label class="col-sm-3 control-label">班级(选填)：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='class_name' >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">学生姓名：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='student_name' id='student_name'>
					</div>
				</div>                			

				<div class="form-group">
					<div class="col-sm-12">
							 <button class="button button-raised button-caution" type="submit" ><i class="fa fa-user"></i>&nbsp;&nbsp;查询</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

