<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac =='list' ) { ?>  class="active" <?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan')?>">设计课程</a>
	</li>
	<li <?php  if($ac == 'student') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan', array('ac' => 'edit'))?>">编辑学生</a>
	</li> 
	<li <?php  if($ac == 'data' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan', array('ac' => 'new'))?>">数据查看  </a>
	</li>
</ul>
<?php  if($ac=='list') { ?>
<div class="panel panel-default">
 <ul class="nav nav-tabs">
	<li <?php  if($op =='list' ) { ?>  class="active" <?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan',array('ac'=>'list','op'=>'list') )?>">列表</a>
	</li>
	<li <?php  if($op == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan', array('ac' => 'list' ,'op'=>'edit'))?>">编辑</a>
	</li> 
	<li <?php  if($op == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('course_scan', array('ac' => 'list','op'=>'new' ))?>">新建  </a>
	</li>
</ul>
    <?php  if($op=='list') { ?>
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>课程ID</th>
					<th>课程名</th>
					<th>总扫码次数</th>
					<th>总扫码人数</th>
					<th>负责教师</th>
                    <th>二维码</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['course_id'];?></td>
					<td><?php  echo $item['course_name'];?></td>
					<td><?php  echo $class_course->scanNum($item['course_id']);?></td>
					<td><?php  echo $class_course->studentNum($item['course_id']);?></td>
					<td><?php  echo $this->teacherName($item['teacher_id']);?></td>
					<td>
                        <a href="<?php  echo $this->createWebUrl('qrcode',array('ac'=>'course_scan','id'=>$item['course_id'],'position'=>'have' ));?>" target="_blank" class="btn btn-default btn-sm" >打印本期【<?php  echo $item['num'];?>】</a>
                        <a href="<?php  echo $this->createWebUrl('qrcode',array('ac'=>'course_scan','id'=>$item['course_id'],'position'=>'next' ));?>" target="_blank" class="btn btn-default btn-sm" >生产下期</a>
					</td>
                    <td>
                        <a href="<?php  echo $this->createWebUrl('course_scan',array('ac'=>'list','id'=>$item['course_id'],'op'=>'edit' ));?>"        class="btn btn-default btn-sm" >编辑</a>
                        <a href="<?php  echo $this->createWebUrl('course_scan',array('ac'=>'data','id'=>$item['course_id'],'op'=>'course_scan' ));?>" class="btn btn-default btn-sm" >查看</a>
                    </td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
    <?php  } ?>
	</div>	
<?php  if($op=='new' || $op=='edit') { ?>
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
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>购买地址</label>
						<div class="col-sm-9 col-xs-8">
							<input type="text" name="buy_url" id="buy_url" class="form-control" value='<?php  echo $result['buy_url'];?>' />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">负责教师</label>
						<div class="col-sm-9 col-xs-8">
							<select class='span2' name ='teacher_id' >
								<?php  if(is_array($teacher_list)) { foreach($teacher_list as $row) { ?>
									<option value='<?php  echo $row['teacher_id'];?>' ><?php  echo $row['teacher_realname'];?></option>
								<?php  } } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">课程介绍</label>
						<div class="col-sm-9 col-xs-8">
							<?php  echo tpl_ueditor("course_contet",$result['course_contet']);?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
						<div class="col-sm-9 col-xs-8">
								<select class='span2' name ='status' >
									<option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
									<option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
							</select>
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
<?php  } ?>