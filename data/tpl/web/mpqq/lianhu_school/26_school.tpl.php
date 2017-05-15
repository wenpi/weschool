<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($op == 'list' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('school')?>">学校列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
		<li <?php  if($op == 'edit') { ?> class="active"<?php  } ?>>
		<a href="#">编辑学校</a>
		</li> 
	<?php  } ?>
	<li <?php  if($op == 'new') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('school', array('op' => 'new'))?>">新增学校</a>
	</li>

</ul>
<?php  if($op=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
					<tr>
						<th >学校ID</th>
						<th >学校</th>
						<th >学校类型</th>
						<th >状态</th>
						<th >模板</th>
						<th >班级圈</th>
						<th >班级公告</th>
						<th >操作</th>
					</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['school_id'];?></td>
					<td><?php  echo $item['school_name'];?><?php  if($_SESSION['school_id']==$item['school_id']) { ?>【登陆状态】<?php  } ?></td>
					<td><?php  if($item['school_type']==0) { ?>未设置<?php  } else { ?><?php  echo S('school','getSchoolTypeName',array($item['school_type']) );?> <?php  } ?></td>
					<td><?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>注销<?php  } ?></td>
                    <td><?php  if($item['mu_str']) { ?><?php  echo $item['mu_str'];?><?php  } else { ?>默认<?php  } ?></td>
					<td><?php  if($item['line_status'] ==1) { ?><code>不审核</code><?php  } else { ?>审核<?php  } ?></td>
					<td><?php  if($item['class_notice_status'] ==1) { ?><code>不审核</code><?php  } else { ?>审核<?php  } ?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('school', array('op' => 'edit','sid'=>$item['school_id']))?>" class="btn btn-success btn-sm">编辑</a>
						<a href="<?php  echo $this->createWebUrl('school', array('op' => 'select','sid'=>$item['school_id']))?>" class="btn btn-success btn-sm">登入</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>	
<?php  } ?>
<?php  if($op=='new' || $op=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增学校<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>学校名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="school_name" id="school_name" class="form-control" value='<?php  echo $result['school_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="sid"  class="form-control" value='<?php  echo $result['school_id'];?>' />
						<?php  } ?>
					</div>
				</div>
                    <div class='form-group'>
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择学校类型</label>
                        <div class="col-sm-9 col-xs-8">
                        <select name='school_type'>
                            <?php  if(is_array($type_list)) { foreach($type_list as $row) { ?>
                                <option value='<?php  echo $row['id'];?>' <?php  if($row['id'] == $result['school_type']) { ?> selected <?php  } ?>><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                        </div>	
                    </div>			
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>模板（不填写为默认）</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="mu_str" id="mu_str" class="form-control" value='<?php  echo $result['mu_str'];?>' />
					</div>
				</div>                
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
						<input type="radio" name="status"   value='1' <?php  if($op=='new') { ?> checked <?php  } else { ?> <?php  if($result['status']==1) { ?> checked <?php  } ?> <?php  } ?> />正常&nbsp;&nbsp;
						<input type="radio" name="status"   value='0' <?php  if($op=='edit') { ?> <?php  if($result['status']==0) { ?> checked <?php  } ?>  <?php  } ?>/>注销
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>班级圈</label>
					<div class="col-sm-9 col-xs-8">
						<input type="radio" name="line_status"   value='1' <?php  if($result['line_status']==1) { ?> checked <?php  } ?>  /><code>不审核</code>
						<input type="radio" name="line_status"   value='2' <?php  if($result['line_status']==2) { ?> checked <?php  } ?>  />需审核
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>班级公告</label>
					<div class="col-sm-9 col-xs-8">
						<input type="radio" name="class_notice_status"   value='1' <?php  if($result['class_notice_status']==1) { ?> checked <?php  } ?>  /><code>不审核</code>
						<input type="radio" name="class_notice_status"   value='2' <?php  if($result['class_notice_status']==2) { ?> checked <?php  } ?>  />需审核
					</div>
				</div>				
				</div>
			</div>
		<div class="panel panel-default">
			<div class="panel-heading">学校基本设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">学校微官网地址</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="host_url" class="form-control" value="<?php  echo $result['host_url'];?>" />
					</div>
				</div>				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">在校时间（学校配置用）</label>
					<div class="col-sm-9 col-xs-12">
						<input type='text' value='<?php  echo $result['on_school'];?>' name='on_school' placeholder="5"> 天制&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">周几课程开始（给培训学校用：周一开始上课的学校可以不填写。）</label>
					<div class="col-sm-9 col-xs-12">
						周<input type='text' value='<?php  echo $result['begin_day'];?>' name='begin_day' placeholder="6"> 开始上课&nbsp;&nbsp;
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">上下午课时配置（上几节课，配置后请勿随便修改）</label>
					<div class="col-sm-9 col-xs-12">
						上午：<input type="text" name="am_much" class="form-control" value="<?php  echo $result['am_much'];?>" />
						下午：<input type="text" name="pm_much" class="form-control" value="<?php  echo $result['pm_much'];?>" />
						晚上：<input type="text" name="ye_much" class="form-control" value="<?php  echo $result['ye_much'];?>" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">班级圈类别</label>
					<div class="col-sm-9 col-xs-12">
						每个不同的类别以||分开
						<textarea name='line_type' class='form-control'><?php  if($result['line_type'] ) { ?><?php  echo $result['line_type'];?><?php  } else { ?>班级活动||班级公告||日常点滴||重要事务<?php  } ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">预约类别</label>
					<div class="col-sm-9 col-xs-12">
						每个不同的类别以||分开
						<textarea name='appointment' class='form-control'><?php  if($result['appointment'] ) { ?><?php  echo $result['appointment'];?><?php  } else { ?>课程预约||兴趣小组||集体活动<?php  } ?></textarea>
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
