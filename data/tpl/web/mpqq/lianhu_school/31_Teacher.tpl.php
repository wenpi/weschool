<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('teacher');?>">老师列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('teacher', array( 'ac' => 'edit'))?>">编辑老师</a>
	</li> 
	<?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('teacher', array('ac' => 'new'))?>">新增老师</a>
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
			<input type="hidden" name="do" value="teacher" />
			<input type="hidden" name="ac" value="list" />
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">姓名</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<input name='teacher_realname' id='teacher_realname' value="<?php  echo $_GPC['teacher_realname'];?>">
				</div>
			</div>						
			<div class="form-group">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
				<div class="col-xs-12 col-sm-8 col-lg-9">
					<select name="status" class='form-control'>
						<option value='0'>全部</option>
						<option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
						<option value="2" <?php  if($_GPC['status'] == '2') { ?> selected<?php  } ?>>关闭</option>
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
					<th style="width:5%;">教师姓名</th>
					<th style="width:8%;">教师电话</th>
					<th style="width:10%;">教师账号</th>
					<th style="width:5%;">课程</th>
					<th style="width:8%;">关联的微信账号</th>
					<th style="width:5%;">状态</th>
					<th style="width:5%;">班主任</th>
					<th style="width:8%;">添加时间</th>
					<th style="text-align:center; width:15%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['teacher_realname'];?></td>
					<td><?php  echo $item['teacher_telphone'];?></td>
					<td><?php  echo $item['username'];?></td>
					<td><?php  echo $this->teacherCourse($item['teacher_id'],'echo');?>
                    </td>
					<td><?php  echo $item['nickname'];?></td>
					<td>
						<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?>
					</td>
                    <td><?php  if($result=$this->classHead($item['teacher_id'])) { ?>
                        <a class='a_use_title' href='' title="<?php  echo $this->echoArrOne($result,'class_name');?>">班主任</a>
                        <?php  } else { ?>否
                        <?php  } ?>
                        </td>
					<td><?php  echo date("Y-m-d",$item['addtime']);?></td>
					<td style="text-align:center;">
					<a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'edit'))?>"
                            class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑">
                            <i class="fa fa-pencil"></i></a>
						<a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'delete'))?>" 
                            onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除">
                            <i class="fa fa-times"></i></a>
						<?php  if($item['uid']) { ?>
                            <a href="<?php  echo $this->createWebUrl('teacher', array('id' => $item['teacher_id'],'ac'=>'unbundling'))?>" title='解绑微信号' class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" ><i class="fa fa-trash-o"></i></a>
                        <?php  } else { ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php  } ?>
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
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增老师<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择其授课的班级</label>
					<div class="col-sm-9 col-xs-8">
                        <?php  $grade_id=0;?>
						<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
						  <?php  $i++;?>
                          <?php  if($grade_id !=$row['grade_id'] ) { ?> <?php  $grade_id=$row['grade_id'];?> <?php  if($i!=1 ) { ?><br><?php  } ?> 【<?php  echo $this->gradeName($grade_id);?>】<?php  } ?>
						  <input type='checkbox'
                            onchange='teacher_class_change()'
                            value='<?php  echo $row['class_id'];?>' 
                            class='class_s'
                            name='class_s[<?php  echo $i;?>]' 
                            <?php  if(@in_array($row['class_id'],$result['class_s'])) echo 'checked' ;?>>
                          &nbsp;
                          <span onclick='change_check_status("class_s[<?php  echo $i;?>]")' class='hover_point' ><?php  echo $row['class_name'];?></span>
						  &nbsp;&nbsp;&nbsp;&nbsp;
						<?php  } } ?>
					</div>	 
				</div>	
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择其负责的课程</label>
					<div class="col-sm-9 col-xs-8" id="course_list">
						<?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
						<input type='checkbox' class='box_type'  value='<?php  echo $row['course_id'];?>' name='course_id[]' <?php  if(in_array($row['course_id'],$result['course_ids']) ) { ?> checked <?php  } ?>>&nbsp;<?php  echo $row['course_name'];?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php  } } ?>
					<div class='btn  btn-primary  ' onclick="allSelect('box_type')">全选</div>
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师姓名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="teacher_realname" id="teacher_realname" class="form-control" value='<?php  echo $result['teacher_realname'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"   value='<?php  echo $result['teacher_id'];?>' />
						<input type="hidden" name="uid"   value='<?php  echo $result['uid'];?>' />
						<?php  } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师电话</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="teacher_telphone" id="teacher_telphone" class="form-control" value='<?php  echo $result['teacher_telphone'];?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师邮箱</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="teacher_email" id="teacher_email" class="form-control" value='<?php  echo $result['teacher_email'];?>' />
					</div>
				</div>								
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师照片</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_image('teacher_img',$result['teacher_img']);?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师微信二维码</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_image('weixin_code',$result['weixin_code']);?>
					</div>
				</div>					
							
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师简介</label>
					<div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_ueditor('teacher_introduce',$result['teacher_introduce']);?>
					</div>	
				</div>
				
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>系统账号(_先设置一个名字为“教师组”的用户组)</label>
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