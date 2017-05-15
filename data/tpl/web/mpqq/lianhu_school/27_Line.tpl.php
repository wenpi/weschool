<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('line');?>">发布列表</a>
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
	<?php  if($teacher!='teacher') { ?>
		<li <?php  if($ac == 'wait_to_pass') { ?> class="active"<?php  } ?>>
			<a href="<?php  echo $this->createWebUrl('line',array("ac"=>'wait_to_pass'));?>">待审核列表</a>
		</li> 		
	<?php  } ?>	
</ul>
<div class="main">
	<?php  if($ac=='list') { ?>
		<div class="panel-body table-responsive">
		<table class="table table-hover" style='max-width:30%;float:left;'>
			<thead class="navbar-inner">
				<tr>
					<th style="width:30%">选择班级</th>
					<th style="width:20%">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><a href="<?php  echo  $this->createWebUrl('line',array('ac'=>'new','cid'=>$item['class_id']))?>">【<?php  echo $this->gradeName($item['grade_id']);?>】<?php  echo $item['class_name'];?></a></td>
					<td > 
                        <a href="<?php  echo $this->createWebUrl('line',array('ac'=>'new','cid'=>$item['class_id']))?>"  
                                 class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top"  title='新增班级记录'><i class="fa fa-plus"></i>
                         </a>
						&nbsp;&nbsp;
                        <a href="<?php  echo $this->createWebUrl('line',array('ac'=>'old','cid'=>$item['class_id']))?>"  
                             class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title='查看以往'><i class='fa fa-clock-o'></i>
                        </a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	<?php  } ?>
	<?php  if($ac=='old'  || $ac=='wait_to_pass' ) { ?>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>班级</th>
					<th>标题</th>
					<th>发布老师</th>
					<th>类型</th>
					<th>查看数</th>
					<th>状态</th>
					<th>发布时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr id="line_<?php  echo $item['line_id'];?>">
					<td><?php  echo $item['class_name'];?></td>
					<td><?php  echo $item['line_title'];?></td>
					<td><?php  if($item['teacher_realname']) { ?><?php  echo $item['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></td>
					<td><?php  echo $line_type[$item['line_type']];?></td>
					<td><?php  echo $item['line_look'];?></td>
					<td id="line_status_<?php  echo $item['line_id'];?>"><?php  if($item['status'] ==1) { ?>正常<?php  } else if($item['status']  == 2) { ?>审核中  <?php  } else { ?>关闭<?php  } ?></td>
					<td><?php  echo date("Y-m-d H:i:s",$item['addtime']);?></td>
					<td>
					<a href="<?php  echo $this->createWebUrl('line',array('ac'=>'edit','lid'=>$item['line_id']))?>"
                               class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top"  title='编辑'
                            ><i class='fa fa-edit'></i></a>
					<?php  if($teacher !='teacher' && $item['status'] == 2 ) { ?>
						<span class='btn red  btn-default btn-sm ' onclick="passThis('<?php  echo $item['line_id'];?>','line')">审核通过</span>
					<?php  } ?>
					<span class='btn btn-default btn-sm red ' onclick="deleteThis('<?php  echo $item['line_id'];?>','line')"  >删除</span>
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
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-8">
						<input type='text' value='<?php  echo $result['line_title'];?>' name='line_title' >
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>类型</label>
					<div class="col-sm-9 col-xs-8">
						<select name='line_type'>
							<?php  if(is_array($line_type)) { foreach($line_type as $key => $list) { ?>
								<option value='<?php  echo $key;?>' <?php  if($result['line_type']==$key) { ?> selected <?php  } ?>><?php  echo $list;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>消息内容</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_ueditor('line_content',$result['line_content']);?>	
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