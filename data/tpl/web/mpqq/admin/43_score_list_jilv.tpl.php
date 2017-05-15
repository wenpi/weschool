<?php defined('IN_IA') or exit('Access Denied');?><?php  if($op=='list') { ?>
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table class="table table-hover">
				<thead class="navbar-inner">
				<tr>
					<th>ID</th>
					<th>记录名</th>
					<th >年级</th>
					<th >状态</th>
					<th >操作</th>
				</tr>
				</thead>
				<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<tr>
						<td><?php  echo $item['scorejilv_id'];?></td>
						<td><?php  echo $item['scorejilv_name'];?></td>
						<td><?php  echo $item['grade_name'];?></td>
						<td><?php  if($item['status']==1) { ?>正常<?php  } else { ?>关闭<?php  } ?></td>
						<td>
							<a href="<?php  echo $this->createWebUrl('data_in', array('op' => 'edit', 'ac' => 'score_list_jilv','jilv_id'=>$item['scorejilv_id'],'aw'=>1 ))?>" class="btn btn-success btn-sm">编辑</a>
						</td>
					</tr>
				<?php  } } ?>
				</tbody>
			</table>
		</div>
		<?php  echo $pager;?>
	</div>	
<?php  } ?>
<?php  if($op=='create' || $op=='edit') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($op=='create') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class=" col-md-2 control-label"><span style='color:red'>*</span>记录</label>
					<div class="col-sm-10">
						<input type="text" name="scorejilv_name" id="scorejilv_name" class="form-control" value='<?php  echo $result['scorejilv_name'];?>' />
						<?php  if($op=='edit') { ?>
						<input type="hidden" name="jilv_id"  class="form-control" value='<?php  echo $result['scorejilv_id'];?>' />
						<?php  } ?>
					</div>
				</div>
				<div class='form-group'>
					<label class=" col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
					<div class="col-sm-10">
                        <?php  if($op=='edit') { ?>
                         <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                            <?php  if($row['grade_id'] ==$result['grade_id']) { ?> <?php  echo $row['grade_name'];?> <?php  } ?>
                         <?php  } } ?>
                        <?php  } else { ?>
					         <select name='grade_id' class="form-control">
						  <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
						          	<option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id'] ==$result['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
						  <?php  } } ?>
					           </select>
                        <?php  } ?>

					</div>	
				</div>
					<div class='form-group'>
					<label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-10">
					<select name='status'  class="form-control" >
							<option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
							<option value='3' <?php  if($result['status']==3 ) { ?> selected <?php  } ?>>关闭</option>
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