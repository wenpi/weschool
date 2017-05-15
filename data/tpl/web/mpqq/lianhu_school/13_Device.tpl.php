<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('device')?>">设备列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('device', array( 'ac' => 'edit'))?>">编辑</a>
	</li> 
    <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('device', array('ac' => 'new'))?>">新增</a>
	</li>	
</ul>
<?php  if($ac=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>ID</th>
					<th>设备识别</th>
					<th>备注名</th>
					<th>状态</th>
					<th>添加时间</th>
					<th style="width:120px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['device_id'];?></td>
					<td><?php  echo $item['device_openid'];?></td>
                    <td><?php  echo $item['device_name'];?></td>
					<td><?php  if($item['device_status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
					<td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('device', array('ac' => 'edit','id'=>$item['device_id']))?>" class="btn btn-success btn-sm">编辑</a>
					</td>
				</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
	</div>	
<?php  } ?>
<?php  if($ac=='new' || $ac=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增设备<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>设备备注名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="device_name" id="device_name" class="form-control" value='<?php  echo $result['device_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['device_id'];?>' />
						<?php  } ?>
					</div>
				</div>
                
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>设备识别</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="device_openid" id="device_openid" class="form-control" value='<?php  echo $result['device_openid'];?>' />
					</div>
				</div>
	                
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="img_ad_name" id="img_ad_name" class="form-control" value='<?php  echo $result['img_ad_name'];?>' />
					</div>
					</div>
					<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">图片组</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_multi_image('img_ads', $result['img_ads']);?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">标题：</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="video_name" id="video_name" class="form-control" value='<?php  echo $result['video_name'];?>' />
					</div>
					</div>
					<div class="form-group">					
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">视频地址（mp4）(需：http://)：</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="video_url" id="video_url" class="form-control" value='<?php  echo $result['video_url'];?>' />
					</div>

				</div>				
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
                        <select name='device_status'>
                            <option value='1' <?php  if(1 ==$result['device_status']) { ?> selected <?php  } ?>>正常</option>
                            <option value='0' <?php  if(0 ==$result['device_status']) { ?> selected <?php  } ?>>关闭</option>
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
