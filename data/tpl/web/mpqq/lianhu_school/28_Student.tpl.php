<?php defined('IN_IA') or exit('Access Denied');?><?php  if($_GPC['print_code']==1) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('print_code', TEMPLATE_INCLUDEPATH)) : (include template('print_code', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('student')?>">学生列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('student', array( 'ac' => 'edit'))?>">编辑学生</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('student', array('ac' => 'new'))?>">新增学生</a>
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
			<input type="hidden" name="do" value="student" />
			<input type="hidden" name="ac" value="list" />
            <?php  if($admin !='teacher') { ?>
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
            <?php  } ?>
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
					<button class="btn btn-default" name='print_code' value='1' >统一打印二维码</button>				
			</div>
		</form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:5%;">ID</th>
					<th style="width:5%;">学生姓名</th>
					<th style="width:10%;">系统编号</th>
					<th style="width:5%;">学号</th>
					<th style="width:5%;">家长姓名</th>
					<th style="width:5%;">家长电话</th>
					<th style="width:15%;">班级</th>
					<th style="width:5%;">状态</th>
					<th style="width:8%;">入学时间</th>
					<th style="text-align:right; width:10%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<?php  $have_parent  =$this->returnEfficeOpenid($item);?>
					<td><?php  echo $item['student_id'];?></td>
					<td><?php  if(!$have_parent['f_openid']  && !$have_parent['s_openid'] && !$have_parent['t_openid']) { ?>
						<span class='red'>
							<?php  echo $item['student_name'];?>
						</span>
						<?php  } else { ?>
						<?php  echo $item['student_name'];?>
						<?php  } ?></td>
					<td><?php  echo $item['student_passport'];?></td>
					<td><?php  echo $item['xuehao'];?></td>
					<td><?php  echo $item['parent_name'];?></td>
					<td><?php  echo $item['parent_phone'];?></td>
					<td><?php  echo $item['class_name'];?></td>
					<td>
						<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?>
					</td>
					<td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('student', array('id' => $item['student_id'], 'op' => 'student','ac'=>'edit'))?>"class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
<a href="<?php  echo $this->createWebUrl('student', array('id' => $item['student_id'], 'op' => 'student','ac'=>'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a>
<a href="<?php  echo $this->createWebUrl('qrcode', array('id' => $item['student_id'], 'op' => 'student_live_student' ))?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" target="_blank" title="打印二维码"><i class="fa fa-barcode"></i>
</a>
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
<?php  if($ac=='edit' || $ac=='new') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增学生<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择班级</label>
                    <div class="col-sm-9 col-xs-8">
                    <?php  if($admin=='teacher') { ?>
                        <select id="class_id" class="col-xs-12 col-sm-9 col-lg-3" style="height:30px" name="class_id">
                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                <option value='<?php  echo $row['class_id'];?>'><?php  echo $row['class_name'];?></option>
                            <?php  } } ?>
                        </select>
                    <?php  } else { ?>
    					<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('grade_class', TEMPLATE_INCLUDEPATH)) : (include template('grade_class', TEMPLATE_INCLUDEPATH));?>
                    <?php  } ?>
                    </div>
				</div>					
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>学生姓名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="student_name" id="student_name" class="form-control" value='<?php  echo $result['student_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['student_id'];?>' />
						<?php  } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>学号</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="xuehao" id="xuehao" class="form-control" value='<?php  echo $result['xuehao'];?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>家庭住址</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="address" id="address" class="form-control" value='<?php  echo $result['address'];?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>学生联系方式</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="student_link" id="student_link" class="form-control" value='<?php  echo $result['student_link'];?>' />
					</div>
				</div>												
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>学生头像</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_image('student_img',$result['student_img']);?>
					</div>
				</div>				
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>家长信息</label>
					<div class="col-sm-9 col-xs-12">
						姓名：<input type='text' name='parent_name' value="<?php  echo $result['parent_name'];?>" class="form-control">
						联系电话：<input type='text' name='parent_phone' value="<?php  echo $result['parent_phone'];?>" class="form-control">
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
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>绑定的微信账号：</label>
					<div class="col-sm-9 col-xs-12">
						<?php  if($result['fanid']) { ?>
							<input name='fanid' type='checkbox' value='<?php  echo $result['fanid'];?>' checked><?php  echo $this->find_user($result['fanid']);?>&nbsp;	&nbsp;	&nbsp;						
						<?php  } ?>
                        <?php  if($result['fanid1']) { ?>
							<input name='fanid1' type='checkbox' value='<?php  echo $result['fanid1'];?>' checked><?php  echo $this->find_user($result['fanid1']);?>	&nbsp;	&nbsp;	&nbsp;	
						<?php  } ?>
						<?php  if($result['fanid2']) { ?>
							<input name='fanid2' type='checkbox' value='<?php  echo $result['fanid2'];?>' checked><?php  echo $this->find_user($result['fanid2']);?>	&nbsp;	&nbsp;	&nbsp;	
						<?php  } ?>												
					</div>	
				</div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> ID卡：</label>
					<div class="col-sm-9 col-xs-12">
							卡一：<input type='text' name='rfid'  class='span2' value='<?php  echo $result['rfid'];?>'>		<br><br>					
							卡二：<input type='text' name='rfid1'  class='span2' value='<?php  echo $result['rfid1'];?>'>	<br><br>					
							卡三：<input type='text' name='rfid2'  class='span2' value='<?php  echo $result['rfid2'];?>'>						
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
<?php  } ?>