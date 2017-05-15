<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('school_admin');?>">学校管理员列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('school_admin', array( 'ac' => 'edit'))?>">编辑学校管理员</a>
	</li> 
	<?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('school_admin', array('ac' => 'new'))?>">新增学校管理员</a>
	</li>
</ul>
<?php  if($ac=='list') { ?>
<div class="main">
	<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>账号</th>
					<th>学校</th>
					<th>状态</th>
					<th style="text-align:center; width:15%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['username'];?></td>
					<td><?php  echo $item['school_name'];?></td>
					<td>
						<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?>
					</td>
					<td style="text-align:center;">
					   <a href="<?php  echo $this->createWebUrl('school_admin', array('admin_id' => $item['admin_id'],'ac'=>'edit'))?>"
                            class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑">
                            <i class="fa fa-pencil"></i>
                            </a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>		
<?php  } ?>
<?php  if($ac=='edit' || $ac=='new') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增学校管理员<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				
        
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>系统账号(_先设置一个名字为“学校组”的用户组)</label>
					<div class="col-sm-9 col-xs-12">
						<?php  if($ac=='edit') { ?>
							<?php  echo $result['username'];?>
						<?php  } else { ?>
							<input name='passport' class='form-control' value=''>
						<?php  } ?>
					</div>	
				</div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>系统密码</label>
					<div class="col-sm-9 col-xs-12">
						<?php  if($ac=='edit') { ?>
							留空不修改
						<?php  } ?>
						<input name='password' class='form-control'value='<?php  echo $result['password'];?>'>
					</div>	
				</div>								
				<?php  if($ac=='edit') { ?>
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
					<select name='status'>
							<option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
							<option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
					</select>
					</div>							
					</div>
				<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-8">
				<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			</div>
			</div>
		</div>		
	</form>
</div>	
<?php  } ?>