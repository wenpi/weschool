<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('video')?>">视频头列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('video', array( 'ac' => 'edit'))?>">编辑视频头</a>
	</li> <?php  } ?>
	<li <?php  if($ac == 'new' ) { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('video', array('ac' => 'new'))?>">新增视频头</a>
	</li>	
</ul>
<?php  if($ac=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>视频ID</th>
					<th>视频名</th>
					<th>视频起止时间</th>
					<th>今日被查看数</th>
					<th>历史被查看数</th>
					<th style="width:120px; text-align:right;">操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $item['video_id'];?></td>
					<td><?php  echo $item['video_name'];?></td>
					<td><?php  echo $item['begin_time'];?>---<?php  echo $item['end_time'];?></td>
					<td>0</td>
					<td>0</td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createWebUrl('video', array('ac' => 'edit','id'=>$item['video_id']))?>" class="btn btn-success btn-sm">编辑</a>
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
				<?php  if($ac=='new') { ?>新增视频<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="video_name" id="video_name" class="form-control" value='<?php  echo $result['video_name'];?>' />
						<?php  if($ac=='edit') { ?>
						<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['video_id'];?>' />
						<?php  } ?>
					</div>
				</div>
  				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频方式</label>
					<div class="col-sm-9 col-xs-8">
                        <select name='video_type' onchange="videoChange(this)">
                            <option value='1' <?php  if(1 ==$result['video_type']) { ?> selected <?php  } ?>>流地址模式</option>
                            <option value='2' <?php  if(2 ==$result['video_type']) { ?> selected <?php  } ?>>富文本模式</option>
                        </select>                       
					</div>
				</div>
				<div class='form-group' id='video_html_content' <?php  if($result['video_type']==1 || !$result['video_type'] ) { ?> style="display:none" <?php  } ?> >
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>教师简介</label>
					<div class="col-sm-9 col-xs-12">
                        <?php  echo tpl_ueditor('html_content',$result['html_content']);?>
					</div>	
				</div>
				<div class="form-group" id="video_url"  <?php  if($result['video_type']==2 ) { ?> style="display:none" <?php  } ?>>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频取流地址</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="video_url" id="video_url" class="form-control" value='<?php  echo $result['video_url'];?>' />
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频可看的开始时间（24小时制）</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="begin_time" id="begin_time" class="form-control" value='<?php  echo $result['begin_time'];?>' placeholder="08:00:00"/>
					</div>
				</div> 

				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频可看的结束时间（24小时制）</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="end_time" id="end_time" class="form-control" value='<?php  echo $result['end_time'];?>'  placeholder="18:00:00"/>
					</div>
				</div> 
  
  				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>视频封图</label>
					<div class="col-sm-9 col-xs-8">
                         <?php  echo tpl_form_field_image('video_img',$result['video_img']);?>
					</div>
				</div> 
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-8">
                        <select name='status'>
                            <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                            <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
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
