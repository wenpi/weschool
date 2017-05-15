<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('grade')?>">年级列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('grade', array( 'ac' => 'edit'))?>">编辑年级</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('grade', array('ac' => 'new'))?>">新增年级</a>
	</li>	
</ul>
<?php  if($ac=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th style="width:80px;">年级ID</th>
					<th style="width:120px;">年级</th>
					<th style="width:80px;">班级数</th>
					<th style="width:120px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['grade_id'];?></td>
					<td><a href='<?php  echo $this->createWebUrl('class',array('grade_id'=>$item['grade_id']))?>'><?php  echo $item['grade_name'];?></a></td>
					<td><?php  echo $this->grade_class_num($item['grade_id']);?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('grade', array('ac' => 'edit','id'=>$item['grade_id']))?>" class="btn btn-success btn-sm">编辑</a>
						<a href="<?php  echo $this->createWebUrl('grade', array('ac' => 'delete','id'=>$item['grade_id']))?>" 
							onclick="return confirm('此操作不可恢复，确认删除？');"
							class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i>
						</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>	
<?php  } ?>
<?php  if($ac=='new' || $ac=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增年级<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>年级名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="grade_name" id="grade_name" class="form-control" value='<?php  echo $result['grade_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['grade_id'];?>' />
						<?php  } ?>
					</div>
				</div>
				</div>
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>
</div>		
<?php  } ?>
