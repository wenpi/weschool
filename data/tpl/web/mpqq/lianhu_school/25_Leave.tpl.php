<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	    <a href="<?php  echo $this->createWebUrl('leave')?>">请假申请列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	    <a href="#">编辑请假申请</a>
	</li> 
    <?php  } ?>
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
			<input type="hidden" name="do" value="leave" />
			<input type="hidden" name="ac" value="list" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">班级</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<select name='class_id'>
						<option value='0'>全部</option>
						<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
							<option value='<?php  echo $row['class_id'];?>' <?php  if($_GPC['class_id'] ==$row['class_id']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
						<?php  } } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">姓名</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<input name='student_name' id='student_name' value="<?php  echo $_GPC['student_name'];?>">
				</div>
			</div>						
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<select name="status" class='form-control'>
						<option value='0'>全部</option>
						<option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>申请中</option>
						<option value="2" <?php  if($_GPC['status'] == '2') { ?> selected<?php  } ?>>允许</option>
						<option value="2" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>拒绝</option>
					</select>
				</div>
			</div>
			<div class="form-group">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
			</div>
						
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th >ID</th>
					<th >学生姓名</th>
					<th >家长</th>
					<th >班级</th>
					<th >请假开始时间</th>
					<th >请假结束时间</th>
					<th >班主任</th>
					<th >理由</th>
					<th >状态</th>
					<th >时间</th>
					<th style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['leave_id'];?></td>
					<td><?php  echo $this->studentName($item['student_id']);?></td>
					<td><?php  echo $this->memberNickName($item['member_uid'])?></td>
					<td><?php  echo $this->className($item['class_id'])?></td>
                    <td><?php  echo date("Y-m-d",$item['time_date_begin'])?></td>
					<td><?php  echo date("Y-m-d",$item['time_date_end'])?></td>
					<td><?php  echo $this->teacherName($item['teacher_id'])?></td>
					<td><?php  echo $item['leave_reason'];?></td>
					<td>
						<?php  if($item['leave_status'] ==1) { ?>申请中<?php  } else if($item['leave_status'] ==2) { ?><span class='red'>允许</span><?php  } else { ?> 不允许<?php  } ?>
					</td>
					<td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('leave', array('id' => $item['leave_id'],'ac'=>'edit'))?>"class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
    <?php  echo $pager;?>
	</div>
	</div>
</div>
<?php  } ?>
<?php  if($ac=='edit') { ?>
 	<div class="main">
	<form action="" method="post" class="form-horizontal form" >
		<div class="panel panel-default">
			<div class="panel-heading">
				处理请假申请
			</div>
			<div class="panel-body">
				<div class="tab-content">
                    <div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 请假人：</label>
                             <?php  echo $this->studentName($result['student_id']);?> </div><div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label><?php  echo date("Y-m-d",$result['time_date_begin'])?>--<?php  echo date("Y-m-d",$result['time_date_end'])?> 
                            </div><div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">理由：</label><?php  echo $result['leave_reason'];?>
                     </div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>处理备注</label>
					<div class="col-sm-9 col-xs-12">
                        <textarea name='teacher_text' rows=4 class='form-control'><?php  echo $result['teacher_text'];?></textarea>
					</div>	
				</div>								

				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-8">
				<input type="submit" name="submit" value="准许" class="btn btn-primary col-lg-1" />
				<input type="submit" name="submit" value="不允" class="btn  col-lg-1" style='margin-left:10px;'/>
			</div>
			</div>
		</div>		
	</form>
</div>	   
<?php  } ?>