<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<div class='main'>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list'  ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('student_record')?>">发布记录</a>
	</li>
	<li <?php  if($ac == 'class'  ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('student_record',array('ac'=>'class'))?>">记录分类</a>
	</li>
</ul>
<?php  if($ac=='list') { ?>
	<?php  if($model!='someone') { ?>
	<div class="panel-body table-responsive">
        <div class='title'><?php  if($model=='grade') { ?>年级列表<?php  } else if($model=='class') { ?>班级列表<?php  } else if($model=='student') { ?>学生列表<?php  } ?> </div>
        <ul class='record_list'>
				<?php  if(is_array($result)) { foreach($result as $item) { ?>
				<li>
					<a href="<?php  echo $this->result_result($item,$model,'url','list');?>">
                            <div class='btn btn-primary' style='background-color:#7DCC4A;border:1px solid #7DCC4A;'> <?php  echo $this->result_result($item,$model,'name','list');?></div>
				</a></li>
				<?php  } } ?>
                <div class="clear"></div>
        </ul>
        <?php  if($model!='grade') { ?>
					<a href="javascript:;" onclick="window.history.back() "> <div class='btn btn-primary' >返回</div>
    	<?php  } ?> 
	</div>
	<?php  } ?>
	<?php  if($model=='someone') { ?>
	<div class="panel panel-info">
	<div class="panel-body ">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				添加新的记录【<?php  echo $result['student_name'];?>】
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>记录名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="word" id="word" class="form-control" />
						<input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>记录分类</label>
					<div class="col-sm-9 col-xs-8">
						<select name='jilv_class'  >
							<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
								<option value='<?php  echo $row['class_id'];?>'  <?php  if($row['class_id']== $result['jilv_class']) { ?>selected  <?php  } ?> ><?php  echo $row['class_name'];?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 内容</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='content' class='form-control'></textarea>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"> 照片</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_image('img',$result['img']);?>
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
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:10%">记录ID</th>
					<th style="width:10%">记录名</th>
					<th style="width:10%">记录类型</th>
					<th style="width:5%">学生</th>
					<th style="width:10%">教师</th>
					<th style="width:10%">图片</th>
					<th style="width:20%">内容</th>
					<th style="width:10%">添加时间</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<?php $teacher=$item['teacher_realname'] ? $item['teacher_realname'] :'管理员无法绑定教师';?>
				<tr>
					<td><?php  echo $item['work_id'];?></td>
					<td><?php  echo $item['word'];?></td>
					<td><?php  echo $item['class_name'];?></td>
					<td><?php  echo $result['student_name'];?></td>
					<td><?php  echo $teacher;?></td>
					<td><img src="<?php  echo $this->imgFrom($item['img'])?>" style="width:80px;"></td>
					<td><?php  echo $item['content'];?></td>
					<td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
	<?php  } ?>
	<?php  } ?>
	<?php  if($ac=='class') { ?>
		<?php  if($op=='list') { ?>
			<a href='<?php  echo $this->createWebUrl('student_record',array('ac'=>'class','op'=>'edit'));?>'>新增记录分类</a><br>
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<table class="table table-hover">
						<thead class="navbar-inner">
							<tr>
								<th>ID</th>
								<th>记录名</th>
								<th>状态</th>
								<th>添加时间</th>
								<th>编辑</th>
							</tr>
						</thead>
						<tbody>
							<?php  if(is_array($list)) { foreach($list as $item) { ?>
							<tr>
								<td><?php  echo $item['class_id'];?></td>
								<td><?php  echo $item['class_name'];?></td>
								<td><?php  if($item['class_status'] ==1 ) { ?>正常<?php  } else { ?>注销<?php  } ?></td>
								<td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
								<td><a href='<?php  echo $this->createWebUrl('student_record',array('ac'=>'class','class_id'=>$item['class_id'],'op'=>'edit'));?>'>编辑 </a></td>
							</tr>
							<?php  } } ?>
						</tbody>
					</table>
				</div>
				</div>			
		<?php  } ?>
		<?php  if($op=='edit' || $op=='new' ) { ?>
			<a href='<?php  echo $this->createWebUrl('student_record',array('ac'=>'class','op'=>'list'));?>'>记录列表</a><br>
			<div class="panel-body ">
			<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="tab-content">
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>名称</label>
							<div class="col-sm-9 col-xs-8">
								<input type="text" name="class_name" id="class_name" class="form-control" value='<?php  echo $result['class_name'];?>' />
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12 col-sm-3 col-md-2 control-label">状态</label>
							<div class="col-sm-9 col-xs-8">
								<input type='radio'  value='0' name='class_status'<?php  if($result['class_status']==0) { ?> checked<?php  } ?>  > &nbsp;&nbsp;注销 &nbsp;&nbsp; &nbsp;&nbsp;
								<input type='radio' value='1' name='class_status' <?php  if($result['class_status']==1) { ?> checked<?php  } ?>  > &nbsp;&nbsp;正常								
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
</div>