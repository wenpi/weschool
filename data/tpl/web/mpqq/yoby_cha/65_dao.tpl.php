<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<div class='container' style='padding:0 5px 10px;margin:0;width:100%'>

<ul class="nav nav-tabs">

</ul>
<?php  if($op =='display') { ?>
<div class="main">
<div style="padding:15px;">
		<form id="form4" enctype="multipart/form-data" class="form-horizontal" method="post" action="index.php?c=site&a=entry&m=yoby_cha&do=dao&op=exe&cid=<?php  echo $cid;?>&projectid=<?php  echo $projectid;?>">

<div class="panel-body">
	<div class="form-group">
				<label  class="col-sm-2 control-label"></label>
				<div class="col-sm-8">
					<input type="file" id="exampleInputFile" name="teacherx" >
					<span class="help-block"></span>
				</div>
			</div>

  <div class="form-group">
	<label class=" col-sm-2  control-label"></label>
<div class="col-sm-4">
  <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
  <input type="hidden" name="projectid" value="<?php  echo $projectid;?>" />
 <button name="submit" value='submit'class="btn btn-primary span3 btn-sm">导入Excel数据</button>

  </div>
 </div>
  <div class="form-group">
	<label class=" col-sm-2  control-label"></label>
<div class="col-sm-4">
  <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />

<a class="btn  btn-primary btn-sm" href="<?php echo $_W['siteroot']."web/index.php?c=site&a=entry&m=yoby_cha&do=daochu&cid=$cid&projectid=$projectid"?>">下载Excel模板</a>
  </div>
 </div>

  </div>
			</form>
	</div>
	</div>
<?php  } ?>		
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>