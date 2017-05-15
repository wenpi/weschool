<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<style>
    .margin-5{
        display: inline-block;
        margin-bottom: 5px;
    }
</style>

<ul class="nav nav-tabs">
	<li class="active">
	<a href="<?php  echo $this->createWebUrl('cookbook')?>">食谱列表</a>
	</li>
</ul>

	<div class="main">
	<form  method="post" class="form-horizontal form" >
		<div class="panel panel-default">
		<div class="panel-heading">
			 一周校园食堂
		</div>
		</div>
		<div class="form-group col-sm-12">
				<?php  echo tpl_ueditor("cookBook",$result['cookbooK_breakfast'])?>
		</div>
			<div class="form-group col-sm-12">
				<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		 </div>				
	</form>
	</div>