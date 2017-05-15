<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('data_out')?>">年级，班级，学生数据</a>
	</li>
	<li <?php  if($ac == 'sroce') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('data_out', array('ac' => 'sroce'))?>">考试数据</a>
	</li>	
	
	<li <?php  if($ac == 'on_school') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('data_out', array('ac' => 'on_school'))?>">到校数据</a>
	</li>		
	
	<li <?php  if($ac == 'leave_school') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('data_out', array('ac' => 'leave_school'))?>">离校数据</a>
	</li>	
							
</ul>
<?php  if($ac=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<div class="panel-heading red">
				<?php  if($op=='list') { ?>年级列表<?php  } else if($op=='class') { ?>【<?php  echo $grade_name;?>】下班级列表<?php  } else if($op=='student') { ?>【<?php  echo $class_name;?>】下的学生列表<?php  } ?>
			</div>
			<table class="table table-hover">
				<?php  if($op=='list') { ?>
					<thead class="navbar-inner">
					<tr>
						<th style="width:80px;">年级ID</th>
						<th style="width:120px;">年级</th>
						<th style="width:80px;">班级数</th>
						<th style="width:80px;">学生数</th>
						<th style="width:80px;">老师数</th>
						<th style="width:80px;">状态</th>
					</tr>
					</thead>
				<?php  } else if($op=='class') { ?>
					<thead class="navbar-inner">
					<tr>
						<th style="width:80px;">班级ID</th>
						<th style="width:120px;">班级级</th>
						<th style="width:80px;">学生数</th>
						<th style="width:80px;">老师数</th>
						<th style="width:80px;">状态</th>
					</tr>
					</thead>	
				<?php  } else if($op=='student') { ?>		
					<thead class="navbar-inner">
					<tr>
						<th style="width:80px;">学生ID</th>
						<th style="width:120px;">学生姓名</th>
						<th style="width:80px;">学生学号</th>
						<th style="width:80px;">系统编号</th>
						<th style="width:80px;">状态</th>
					</tr>
					</thead>					
				<?php  } ?>
				<tbody>
					<?php  if($op=='list') { ?>
						<?php  if(is_array($grade)) { foreach($grade as $item) { ?>
						<tr>
							<td><?php  echo $item['grade_id'];?></td>
							<td><a href="<?php  echo $this->createWebUrl('data_out',array('ac'=>'list','gid'=>$item['grade_id'],'op'=>'class'));?>"><?php  echo $item['grade_name'];?></a></td>
							<td><?php  $class_num=$this->grade_class_num($item['grade_id'])?><?php  echo $class_num;?><?php  $class_all_num+=$class_num?></td>
							<td><?php  $grade_num=$this->grade_student_num($item['grade_id'])?><?php  echo $grade_num;?><?php  $grade_all_num+=$grade_num?></td>
							<td><?php  $teacher_num=$this->grade_teacher_num($item['grade_id'])?><?php  echo $teacher_num;?><?php  $teacher_all_num+=$teacher_num?></td>
							<td><?php  if($item['status']==1) { ?> 正常<?php  } else { ?> 关闭<?php  } ?></td>
						</tr>
						<?php  } } ?>
						<tr>
							<td>总计：</td>
							<td></td>
							<td><?php  echo $class_all_num;?></td>
							<td><?php  echo $grade_all_num;?></td>
							<td><?php  echo $teacher_all_num;?></td>
							<td></td>
						</tr>
					<?php  } else if($op=='class') { ?>
						<?php  if(is_array($class)) { foreach($class as $item) { ?>
						<tr>
							<td><?php  echo $item['class_id'];?></td>
							<td><a href="<?php  echo $this->createWebUrl('data_out',array('ac'=>'list','op'=>'student','cid'=>$item['class_id']));?>"><?php  echo $item['class_name'];?></a></td>
							<td><?php  echo $this->class_student_num($item['class_id'])?></td>
							<td><?php  echo $this->class_teacher_num($item['class_id'])?></td>
							<td><?php  if($item['status']==1) { ?> 正常<?php  } else { ?> 关闭<?php  } ?></td>
						</tr>
						<?php  } } ?>		
					<?php  } else if($op=='student') { ?>	
						<?php  if(is_array($student)) { foreach($student as $item) { ?>
						<tr>
							<td><?php  echo $item['student_id'];?></td>
							<td><?php  echo $item['student_name'];?></a></td>
							<td><?php  echo $item['xuehao'];?></td>
							<td><?php  echo $item['class_id'];?><?php  echo $item['student_id'];?></td>
							<td><?php  if($item['status']==1) { ?> 正常<?php  } else { ?> 关闭<?php  } ?></td>
						</tr>
						<?php  } } ?>												
					<?php  } ?>
				</tbody>
			</table>
		</div>
	</div>	
<?php  } ?>
<?php  if($ac=='sroce') { ?>
	<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="lianhu_school" />
			<input type="hidden" name="do" value="data_out" />
			<input type="hidden" name="ac" value="sroce" />
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
					<div class="col-sm-9 col-xs-8">
						<select name='gid' id="grade_id" class='form-control'>
							<?php  if(is_array($grade)) { foreach($grade as $row) { ?>
									<option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id']==$gid ) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>			
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择班级</label>
					<div class="col-sm-9 col-xs-8">
						<select name='class_id' id="class_id" class='form-control'>
							<option value='0'>不选择</option>
							<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
									<option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id']==$_GPC['class_id'] ) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择考试</label>
					<div class="col-sm-9 col-xs-8">
						<select name='jilv_id'id="jilv_id" class='form-control'>
							<?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
									<option value='<?php  echo $row['scorejilv_id'];?>'  <?php  if($row['scorejilv_id']==$_GPC['jilv_id'] ) { ?> selected <?php  } ?>><?php  echo $row['scorejilv_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>					
			<div class="form-group">
				<div class="col-sm-5 col-xs-5"></div>
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					<button class="btn btn-default" type="button">总记录数：<?php  echo $total;?></button>
					<input type='submit'name='excel' class="btn btn-default" type="button" value='导出'>
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:50px;">学生</th>
					<th style="width:60px">班级</th>
					<?php  if(is_array($out_course_arr)) { foreach($out_course_arr as $row) { ?>
					<th style="width:50px;"><?php  echo $row['course_name'];?></th>
					<?php  } } ?>
					<th style="width:50px;">总分</th>
					<th style="width:50px;">排名</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($out_list)) { foreach($out_list as $key => $item) { ?>
				<tr>
					<td><?php  echo $item['student_name'];?></td>
					<td><?php  echo $item['class_name'];?></td>
					<?php  if(is_array($out_course_arr)) { foreach($out_course_arr as $row) { ?>
						<td><?php  if($item['course_ids'][$row['course_id']]>0 ) { ?> <?php  echo $item['course_ids'][$row['course_id']];?> <?php  } else { ?>0<?php  } ?></td>
					<?php  } } ?>
					<td><?php  echo $item['all_score'];?></td>
					<td><?php  echo $key+1?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
<?php  echo $pager;?>
<script>
		var html="<option value='0'>不选择</option>";
		$(function(){
            <?php  if($_GPC['class_id'] && $_GPC['jilv_id']) { ?>
		      	ajax_up(<?php  echo $_GPC['class_id'];?>,<?php  echo $_GPC['jilv_id'];?>);
            <?php  } ?>
             <?php  if($_GPC['class_id'] && !$_GPC['jilv_id']) { ?>
		      	ajax_up(<?php  echo $_GPC['class_id'];?>,0);
            <?php  } ?> 
             <?php  if(!$_GPC['class_id'] && !$_GPC['jilv_id']) { ?>
		      	ajax_up(0,0);
            <?php  } ?>                       
			$('#grade_id').change(function(){
				ajax_up(0,0);
			});
		});
		function ajax_up(first_class_id,first_jilv_id){
				var gid=$('#grade_id').val();
				$.ajax({
					type:'post',
					url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'class_list'))?>',
					data:{gid:gid},
					dataType:'json',
					success:function(obj){
						$('#class_id').html(" ");
						$('#class_id').html(html);
						if(obj.success){
							$.each(obj.list,function(i,e){
                                if(first_class_id>0 && first_class_id==e.class_id){
    								$('#class_id').append("<option value='"+e.class_id+"' selected >"+e.class_name+"</option>");
                                }else{
	       							$('#class_id').append("<option value='"+e.class_id+"'>"+e.class_name+"</option>");
                                }
							});
						}
					}
				});	
				$.ajax({
					type:'post',
					url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'jilv_list'))?>',
					data:{gid:gid},
					dataType:'json',
					success:function(obj){
						$('#jilv_id').html(" ");
						$('#jilv_id').html(html);
						if(obj.success){
							$.each(obj.list,function(i,e){
                                 if(first_jilv_id>0 && first_jilv_id==e.scorejilv_id){
    								$('#jilv_id').append("<option value='"+e.scorejilv_id+"' selected >"+e.scorejilv_name+"</option>");
                                }else{
	       							$('#jilv_id').append("<option value='"+e.scorejilv_id+"'>"+e.scorejilv_name+"</option>");
                                }                               
							});
						}
					}
				});							
		}
</script>
<?php  } ?>
<?php  if($ac == 'on_school' || $ac=='leave_school') { ?>
<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="lianhu_school" />
			<input type="hidden" name="do" value="data_out" />
			<input type="hidden" name="ac" value="<?php  echo $ac;?>" />
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
					<div class="col-sm-9 col-xs-8">
						<select name='gid' id="grade_id" class='form-control'>
							<?php  if(is_array($grade)) { foreach($grade as $row) { ?>
									<option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id']==$gid ) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>			
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择班级</label>
					<div class="col-sm-9 col-xs-8">
						<select name='class_id' id="class_id" class='form-control'>
							<option value='0'>不选择</option>
							<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
									<option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id']==$_GPC['class_id'] ) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>	
			<div class="form-group">
				<div class="col-sm-5 col-xs-5"></div>
					<button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
					<button class="btn btn-default" type="button">总学生数：<?php  $grade_num=$this->grade_student_num($gid)?><?php  echo $grade_num;?></button>
					<button class="btn btn-default" type="button"><?php  if($ac=='on_school' ) { ?>到校学生数<?php  } else { ?>离校人数<?php  } ?>：<?php  echo $do_count;?></button>
			</div>
			
		</form>
	</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:50px;">学生</th>
					<th style="width:60px">班级</th>
					<th style="width:50px;">时间点</th>
					<th style="width:50px;">操作教师</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $key => $item) { ?>
				<tr>
					<td><?php  echo $this->studentName($item['student_id']) ?></td>
					<td><?php  echo $this->className($item['class_id']) ?></td>
					<td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
					<td><?php  echo $this->teacherName($item['teacher_id']) ?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	 </div>
	</div>	
</div>
<?php  } ?>