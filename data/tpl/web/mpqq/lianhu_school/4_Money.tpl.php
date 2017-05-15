<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('money');?>">收款项目列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
		<a href="#">编辑</a>
	</li> 
	<?php  } ?>
	<li <?php  if($ac == 'new') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('money',array('ac'=>'new'));?>">新增</a>
	</li> 
</ul>
<div class='main'>
<?php  if($ac=='list') { ?>
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th > 名称</th>
					<th > 金额</th>
					<th >发布时间</th>
					<th >收费机制</th>
					<th >参与人数</th>
					<th >目前总额</th>
					<th >状态</th>
					<th >操作</th>
				</tr>
			</thead>			
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
					<tr>
						<td><?php  echo $row['limit_name'];?></td>
						<td><?php  echo $row['limit_much'];?></td>
						<td><?php  echo date("Y-m-d H:i:s",$row['addtime'])?></td>
						<td><?php  echo $limit_type_arr[$row['limit_type']]?></td>
						<td><?php  echo $this->money_people_num($row['limit_id']);?></td>
						<td><?php  echo $this->money_much($row['limit_id']);?></td>
						<td> <?php  if($row['status']==1) { ?>生效中<?php  } else { ?>关闭<?php  } ?></td>
						<td><a href="<?php  echo $this->createWebUrl('money',array('limit_id'=>$row['limit_id'],'ac'=>'edit') )?>">编辑</a>
						<a href="<?php  echo $this->createWebUrl('moneylist',array('limit_id'=>$row['limit_id'],'ac'=>'list') )?>">查看缴费</a></td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
<?php  } ?>	
<?php  if($ac=='new' ||$ac=='edit') { ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="cid"   value='<?php  echo $class['class_id'];?>' />
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>付费时间限制</label>
					<div class="col-sm-9 col-xs-8">
						<select name='limit_type' id="limit_type" >
								<option value='1' <?php  if($result['limit_type']==1) { ?> selected <?php  } ?>>一次缴费，永远免费</option>
								<option value='2' <?php  if($result['limit_type']==2) { ?> selected <?php  } ?>>按年</option>
								<option value='3' <?php  if($result['limit_type']==3) { ?> selected <?php  } ?>>按月</option>
						</select>
					</div>	
				</div>	
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-8">
						<input type='text' value='<?php  echo $result['limit_name'];?>' name='limit_name' class='form-control' >
						<?php  if($ac=='edit') { ?>
						<input type='hidden' value='<?php  echo $result['limit_id'];?>' name='limit_id'>
						<?php  } ?>
					</div>	
				</div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>金额</label>
					<div class="col-sm-9 col-xs-8">
						<input type='text' value='<?php  echo $result['limit_much'];?>' name='limit_much' class='form-control' >
					</div>	
				</div>
				
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>限制模块</label>
					<div class="col-sm-9 col-xs-8">
						请填写每个模块访问链接do=后面的关键字;如[do=lianhu&ac=list]则填写lianhu
						<input type='text' value='<?php  echo $result['limit_module'];?>' name='limit_module' class='form-control' >
					</div>	
				</div>
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
					<select name='status'>
							<option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>生效</option>
							<option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
					</select>
					</div>							
					</div>
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