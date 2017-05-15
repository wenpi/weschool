<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('class')?>">班级列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('class', array('ac' => 'edit'))?>">编辑班级</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('class', array('ac' => 'new'))?>">新增班级</a>
	</li>
</ul>
<?php  if($ac=='list') { ?>
<div class="main">
	<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="lianhu_school" />
			<input type="hidden" name="do" value="class" />
			<input type="hidden" name="ac" value="list" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">年级</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<select name='grade_id'>
						<option value='0'>全部</option>
						<?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
							<option value='<?php  echo $row['grade_id'];?>' <?php  if($_GPC['grade_id'] ==$row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<select name="status" class='form-control'>
						<option value='0'>全部</option>
						<option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
						<option value="3" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>关闭</option>
					</select>
				</div>
			</div>
			<div class="form-group">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					<button class="btn btn-default" type="button">总记录数：<?php  echo $num;?></button>				
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>班级</th>
					<th>班主任</th>
					<th >学生数</th>
					<th >年级</th>
					<th >状态</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['grade_name'];?>&nbsp;➡&nbsp;<?php  echo $item['class_name'];?></td>
					<td><?php  echo $item['teacher_realname'];?></td>
                    <td><?php  echo $this->classStudentNum($item['class_id']);?></td>
					<td><a href="<?php  echo $this->createWebUrl('class',array('grade_id'=>$item['grade_id']))?>"><?php  echo $item['grade_name'];?></a></td>
					<td>
						<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?>
					</td>
					<td >
						<a href="<?php  echo $this->createWebUrl('class', array('id' => $item['class_id'],'ac'=>'edit'))?>"
                            class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
						<a href="<?php  echo $this->createWebUrl('class', array('id' => $item['class_id'],'ac'=>'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<?php  } ?>
<?php  if($ac=='new' || $ac=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增班级<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>班级名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="class_name" id="class_name" class="form-control" value='<?php  echo $result['class_name'];?>' placeholder="请添加上班级名"/>
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['class_id'];?>' />
						<?php  } ?>
					</div>
				</div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>其绑定的课程</label>
					<div class="col-sm-9 col-xs-8">
                        <?php  if($ac=='edit') { ?>
						  <?php  $result['course_arr']=unserialize($result['course_ids']);?>
                        <?php  } else { ?>
						  <?php  $result['course_arr']=$course_ids;?>
                        <?php  } ?>
						<?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
						<?php  $i++;?>
						<input type='checkbox' value='<?php  echo $row['course_id'];?>' name='course_s[<?php  echo $i;?>]' <?php  if(@in_array($row['course_id'],$result['course_arr'])) echo 'checked' ;?>>&nbsp;<?php  echo $row['course_name'];?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php  } } ?>
					</div>	
				</div>	
				
                <div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>其可以查看的监控视频</label>
					<div class="col-sm-9 col-xs-8">
                        <?php  if($ac=='edit') { ?>
						  <?php  $result['video_arr']=unserialize($result['video_ids']);?>
                        <?php  } ?>
						<?php  if(is_array($video_list)) { foreach($video_list as $row) { ?>
						<?php  $i++;?>
						<input type='checkbox' value='<?php  echo $row['video_id'];?>' name='video_s[<?php  echo $i;?>]' <?php  if(@in_array($row['video_id'],$result['video_arr'])) echo 'checked' ;?>>&nbsp;<?php  echo $row['video_name'];?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php  } } ?>
					</div>	
				</div>
                
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
					<div class="col-sm-9 col-xs-8">
					<select name='grade_id'>
						<?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
							<option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id'] ==$result['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
						<?php  } } ?>
					</select>
					</div>	
				</div>
				<?php  if($ac=='edit') { ?>
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>班主任</label>
					<div class="col-sm-9 col-xs-8">
					<select name='teacher_id'>
						<?php  if(is_array($list_teacher)) { foreach($list_teacher as $row) { ?>
							<option value='<?php  echo $row['teacher_id'];?>' <?php  if($row['teacher_id']==$result['teacher_id']) { ?> selected <?php  } ?>><?php  echo $row['teacher_realname'];?></option>
						<?php  } } ?>
					</select>
					</div>							
					</div>

					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
					<select name='status'>
							<option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
							<option value='3' <?php  if(3 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
					</select>
					</div>							
					</div>
				<?php  } ?>
				</div>
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>
</div>		
<?php  } ?>
