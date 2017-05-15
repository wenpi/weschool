<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('homework');?>">作业发布</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
		<a href="#">编辑</a>
	</li> 
	<?php  } ?>
	<?php  if($ac=='new') { ?>
	<li <?php  if($ac == 'new') { ?> class="active"<?php  } ?>>
		<a href="#">新增</a>
	</li> 
	<?php  } ?>	
</ul>
<script>
    $(function(){
         $("#checkAction").click(function(){
            obj=$(".class_ids");
            if(obj.prop("checked"))
                obj.prop('checked',false);
            else 
                obj.prop('checked',true);
         });
    });
</script>
<div class="main">
	<?php  if($ac=='list') { ?>
		<div class="panel-body table-responsive">
     	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<table class="table table-hover" style='max-width:30%;float:left;'>
			<thead class="navbar-inner">
				<tr>
					<th style="width:30%">选择班级</th>
					<th style="width:20%"><span id='checkAction' class='red'>全选/取消</span> &nbsp;&nbsp;操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><a href="<?php  echo  $this->createWebUrl('homework',array('ac'=>'new','cid'=>$item['class_id']))?>">
                        【<?php  echo $this->gradeName($item['grade_id']);?>】<?php  echo $item['class_name'];?></a></td>
					<td> 
                        <input type='checkbox' name='class_ids[]' class='class_ids' value='<?php  echo $item['class_id'];?>'>
						&nbsp;&nbsp;
                        <a href="<?php  echo $this->createWebUrl('homework',array('ac'=>'old','cid'=>$item['class_id']))?>"  
                             class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title='查看以往'><i class='fa fa-clock-o'></i>
                        </a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
        <div style='max-width:60%;float:left;margin-left:5%'>
            <div class="panel panel-default">
                <div class="panel-heading">
                    新增
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容</label>
                        <div class="col-sm-9 col-xs-8">
                            <?php  echo tpl_ueditor('content',$result['content']);?>	
                        </div>
                    </div>	
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>图片组</label>
                        <div class="col-sm-9 col-xs-8">
                        <?php  echo tpl_form_field_multi_image('img', $images);?>
                        </div>
                    </div>               
                    <div class='form-group'>
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程</label>
                    <div class="col-sm-9 col-xs-8">
                        <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                            <input type='radio' value='<?php  echo $row['course_id'];?>' name='course_id' ><?php  echo $row['course_name'];?>&nbsp;&nbsp;
                        <?php  } } ?>
                    </div>							
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-8">
                    <input type='hidden' name='ac' value='new'>
                    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                </div>
                </div>
            </div>		
        </div>
	</form>	       
	</div>
	<?php  } ?>
	<?php  if($ac=='old') { ?>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>班级</th>
					<th>发布老师</th>
					<th>科目</th>
					<th>时间</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $class['class_name'];?></td>
                    <td><?php  echo $t_name;?></td>
                    <td><?php  echo $this->courseName($item['course_id']);?></td>
                    <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
					<td><?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?></td>
					<td>
						<a href="<?php  echo $this->createWebUrl('homework',array('ac'=>'edit','hid'=>$item['homework_id']))?>"
                               class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top"  title='编辑'
                            ><i class='fa fa-edit'></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
	</div>
	<?php  } ?>
	<?php  if($ac=='new' || $ac=='edit') { ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="cid"   value='<?php  echo $class['class_id'];?>' />
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>内容</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_ueditor('content',$result['content']);?>	
					</div>
				</div>	
 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>图片组</label>
					<div class="col-sm-9 col-xs-8">
					<?php  echo tpl_form_field_multi_image('img', $images);?>
					</div>
				</div>               
				<div class='form-group'>
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程</label>
				<div class="col-sm-9 col-xs-8">
                    <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                        <input type='radio' value='<?php  echo $row['course_id'];?>' name='course_id' <?php  if($row['course_id']==$result['course_id']) { ?> checked  <?php  } ?> ><?php  echo $row['course_name'];?>&nbsp;&nbsp;
                    <?php  } } ?>
				</div>							
			    </div>
				<?php  if($ac=='edit') { ?>
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
					<select name='status'>
							<option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
							<option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
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
	<?php  } ?>
</div>