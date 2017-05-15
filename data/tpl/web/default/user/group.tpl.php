<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li><a href="<?php  echo url('user/group');?>">用户组</a></li>
	<li class="active"><?php  if($do == 'display') { ?>用户组列表<?php  } else if($do == 'post') { ?><?php  if($id) { ?>编辑<?php  } else { ?>添加<?php  } ?>用户组<?php  } ?></li>
</ol>
<ul class="nav nav-tabs">
	<li <?php  if($do == 'display') { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/group/display');?>">用户组列表</a></li>
	<li <?php  if($do == 'post' && empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/group/post');?>">添加用户组</a></li>
	<?php  if(!empty($id)) { ?>
	<li <?php  if($do == 'post' && !empty($id)) { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/group/post', array('id' => $id));?>">编辑用户组</a></li>
	<?php  } ?>
</ul>
<?php  if($do == 'post') { ?>
<div class="clearfix">
	<form action="" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
		<h5 class="page-header">用户组管理</h5>
		<input type="hidden" name="id" value="<?php  echo $id;?>" />
		<input type="hidden" name="templateid" value="<?php  echo $template['id'];?>">
		<div class="panel panel-default">
			<div class="panel-heading">基本信息</div>
			<div class="panel-body table-responsive">
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">名称</label>
					<div class="col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="name" id="name" value="<?php  echo $group['name'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">公众号数量</label>
					<div class="col-sm-10 col-xs-12">
						<input type="text" class="form-control" name="maxaccount" value="<?php  echo $group['maxaccount'];?>" />
						<span class="help-block">限制公众号的数量，为0则不允许添加。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">有效期限</label>
					<div class="col-sm-10 col-xs-12">
						<div class="input-group">
							<input type="text" class="form-control" name="timelimit" value="<?php  echo $group['timelimit'];?>"  >
							<span class="input-group-addon">天</span>
						</div>
						<span class="help-block">设置用户组的有效期限。0为不限制期限。到期后，该用户下的所有公众号只能使用 "基础服务"</span>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">可使用的公众服务套餐</div>
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="width:50px;" class="row-first">选择</th>
							<th style="width:120px;">公众服务套餐</th>
							<th style="width:400px;">模块权限</th>
							<th style="width:400px;">模板权限</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($packages)) { foreach($packages as $item) { ?>
						<tr>
							<td class="row-first"><input class="modules" type="checkbox" value="<?php  echo $item['id'];?>" name="package[]" <?php  if(!empty($group['package']) && in_array($item['id'], $group['package'])) { ?>checked<?php  } ?> /></td>
							<td><?php  echo $item['name'];?></td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-success">系统模块</span>
								<?php  if(is_array($item['modules'])) { foreach($item['modules'] as $module) { ?>
								<span class="label label-info"><?php  echo $module['title'];?></span>
								<?php  } } ?>
							</td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-success">微站默认模板</span>
								<?php  if(is_array($item['templates'])) { foreach($item['templates'] as $template) { ?>
								<span class="label label-info"><?php  echo $template['title'];?></span>
								<?php  } } ?>
							</td>
						</tr>
						<?php  } } ?>
						<tr>
							<td class="row-first"><input class="modules" type="checkbox" value="-1" name="package[]" <?php  if(!empty($group['package']) && in_array(-1, $group['package'])) { ?>checked<?php  } ?> /></td>
							<td>所有服务</td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-danger">系统所有模块</span>
							</td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-danger">系统所有模板</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class=" col-xs-12 col-sm-10 col-md-10 col-lg-11">
				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				<input type="submit" class="btn btn-primary col-lg-1" name="submit" value="提交" />
			</div>
		</div>
	</form>
</div>
<script>
	$(function(){
		$('#form1').submit(function(){
			if(!$.trim($('#form1 :text[name="name"]').val())) {
				util.message('请填写用户组名称');
				return false;
			}
/*
			if(!$('#form1 :checkbox[name="package[]"]:checked').size()) {
				util.message('请使用该会员组可使用的公众服务套餐');
				return false;
			}
*/
			return true;
		});
	});
</script>
<?php  } else if($do == 'display') { ?>
<form action="" method="post">
<div class="panel panel-default">
	<div class="panel-body table-responsive">
	<table class="table table-hover">
		<thead class="navbar-inner">
			<tr>
				<th style="width:30px;">删？</th>
				<th style="width:150px;">名称</th>
				<th>公众号数量</th>
				<th>有效期限</th>
				<th style="min-width:60px;">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php  if(is_array($list)) { foreach($list as $item) { ?>
			<tr>
				<td><input type="checkbox" name="delete[]" value="<?php  echo $item['id'];?>" /></td>
				<td><?php  echo $item['name'];?></td>
				<td><?php  if(empty($item['maxaccount'])) { ?>无权限<?php  } else { ?><?php  echo $item['maxaccount'];?><?php  } ?></td>
				<td><?php  if(!$item['timelimit']) { ?>永久有效<?php  } else { ?><?php  echo $item['timelimit'];?>天<?php  } ?></td>
				<td><span><a href="<?php  echo url('user/group/post', array('id' => $item['id']))?>">编辑</a></span></td>
			</tr>
			<?php  } } ?>
		</tbody>
		<tr>
			<th></th>
			<td>
				<input name="token" type="hidden" value="<?php  echo $_W['token'];?>" />
				<input type="submit" class="btn btn-primary span3" name="submit" value="提交" />
			</td>
		</tr>
	</table>
	</div>
</div>
</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>