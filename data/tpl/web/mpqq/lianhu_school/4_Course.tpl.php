<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if(!$ac) { ?>  class="active" <?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course')?>">课程列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course', array('ac' => 'edit'))?>">编辑课程</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course', array('ac' => 'new'))?>">新增课程</a>
	</li>

</ul>
<?php  if($ac =='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th style="width:10%;">课程ID</th>
					<th style="width:20%;">课程名</th>
					<th style="width:10%;">是否为基础课程</th>
					<th style="width:20%; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['course_id'];?></td>
					<td><?php  echo $item['course_name'];?></td>
					<td><?php  if($item['course_basic'] ==1) { ?>是<?php  } else { ?>否<?php  } ?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('course', array( 'ac' => 'edit','cid'=>$item['course_id']))?>" class="btn btn-success btn-sm">编辑</a>
						<a href="<?php  echo $this->createWebUrl('course', array('ac' => 'delete','cid'=>$item['course_id']))?>" 
							onclick="return confirm('此操作不可恢复，确认删除？');"
							class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="删除"><i class="fa fa-times"></i>
						</a>
						<?php  if($item['course_basic'] !=1) { ?>
							<a href="<?php  echo $this->createWebUrl('course', array('ac' => 'update','cid'=>$item['course_id']))?>" 
								onclick="return confirm('此操作会把此课程添加到所有班级中去');"
								class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="升级">设为基础课程
							</a>
                         <?php  } else { ?>
							<a href="<?php  echo $this->createWebUrl('course', array('ac' => 'update','delete'=>1,'cid'=>$item['course_id']))?>" 
								class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="降级">降为普通课程
							</a>                         
						<?php  } ?>
                        
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
				<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="course_name" id="course_name" class="form-control" value='<?php  echo $result['course_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="cid"  class="form-control" value='<?php  echo $result['course_id'];?>' />
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