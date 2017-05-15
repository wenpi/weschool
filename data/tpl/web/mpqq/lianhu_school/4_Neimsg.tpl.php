<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
    <li <?php  if($op == 'display') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('neimsg',array('op' =>'display'))?>">站内信</a></li>
    <li<?php  if($op == 'new') { ?> class="active" <?php  } ?>><a href="<?php  echo $this->createWebUrl('neimsg',array('op' =>'new'))?>">添加站内信</a></li>
    <?php  if($op=='edit') { ?>
    <li class="active" ><a href="<?php  echo $this->createWebUrl('neimsg',array('op' =>'edit'))?>">编辑站内信</a></li>
    <?php  } ?>
</ul>
<?php  if($op=='display') { ?>
<div class="main">
	<div class="panel panel-info">
	<div class="panel-heading">筛选</div>
	<div class="panel-body">
		<form action="./index.php" method="get" class="form-horizontal" role="form">
			<input type="hidden" name="c" value="site" />
			<input type="hidden" name="a" value="entry" />
			<input type="hidden" name="m" value="lianhu_school" />
			<input type="hidden" name="do" value="neimsg" />
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
<div class="panel panel-default" style='min-width:1100px;'>
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:5%;">ID</th>
					<th style="width:15%;">标题</th>
					<th style="width:10%;">添加时间</th>
					<th style="width:5%;">状态</th>
					<th style="text-align:right; width:10%;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['msg_id'];?></td>
					<td><?php  echo $item['msg_title'];?></td>
					<td><?php  echo date("Y-m-d H:i:s",$item['addtime'])?></td>
					<td>
						<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?>
					</td>
					</td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('neimsg', array('id' => $item['msg_id'],'op'=>'edit'))?>"class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
						<a href="<?php  echo $this->createWebUrl('neimsg', array('id' => $item['msg_id'], 'op'=>'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="删除"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>	
<?php  } ?>
<?php  if($op=='new' || $op=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增站内信<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>封面图</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_image('img',$result['img']);?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="msg_title" id="msg_title" class="form-control" value='<?php  echo $result['msg_title'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['msg_id'];?>' />
						<?php  } ?>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>消息（请控制字数）</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_ueditor('msg_content',$result['msg_content']);?>
					</div>
				</div>															
				<?php  if($op=='edit') { ?>
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
		</div>		
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>
</div>		
<?php  } ?>