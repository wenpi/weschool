<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('extension/service-tabs', TEMPLATE_INCLUDEPATH)) : (include template('extension/service-tabs', TEMPLATE_INCLUDEPATH));?>
<div class="clearfix">	
	<div class="panel panel-info">
		<div class="panel-heading">筛选</div>
		<div class="panel-body">
			<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="extension" />
			<input type="hidden" name="a" value="service" />
			<input type="hidden" name="do" value="display" />
			<input type="hidden" name="status" value="<?php  echo $_GPC['status'];?>" />
				<div class="form-group">
						<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
						<div class="col-sm-8 col-lg-10 col-xs-12">
						<div class="btn-group">
							<a href="<?php  echo filter_url('status:1');?>"  class="btn <?php  if($_GPC['status'] == '1' || $_GPC['status'] == '') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">启用</a>
							<a href="<?php  echo filter_url('status:0');?>"  class="btn <?php  if($_GPC['status']== '0') { ?>btn-primary<?php  } else { ?>btn-default<?php  } ?>">禁用</a>
						</div>
						</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
					<div class="col-sm-8 col-lg-10 col-xs-12">
						<input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
					</div>
					<div class="pull-right col-xs-12 col-sm-2 col-lg-1">
						<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					</div>
				</div>
				<div class="form-group">
				</div>
			</form>
		</div>
	</div>
	<div>
		<?php  if($import) { ?>
		<div class="alert alert-info">
			<a href="<?php  echo url('extension/service/import')?>">存在可用的服务, 点击这里快速导入</a>
		</div>
		<?php  } ?>
		<?php  if(is_array($ds)) { foreach($ds as $row) { ?>
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="pull-left">
					<?php  echo $row['name'];?>
				</div>
				<div class="btn-group pull-right">
					<a class="btn btn-default btn-xs" href="<?php  echo url('extension/service/post', array('rid' => $row['id'],'m'=>$row['module']))?>"><i class="fa fa-edit"></i> 编辑</a>
					<a class="btn btn-default btn-xs" onclick="return confirm('删除规则将同时删除关键字与回复，确认吗？');return false;" href="<?php  echo url('extension/service/delete', array('rid' => $row['id']))?>"><i class="fa fa-times"></i> 删除</a>
				</div>
			</div>
			<div class="panel-body">
				<?php  echo $row['description'];?>
			</div>
		</div>
		<?php  } } ?>
	</div>
	<?php  echo $pager;?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>
