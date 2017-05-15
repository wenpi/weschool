<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('appointment');?>">列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
		<a href="#">编辑</a>
	</li> 
	<?php  } ?>
	<li <?php  if($ac == 'new') { ?> class="active"<?php  } ?>>
		<a href="<?php  echo $this->createWebUrl('appointment',array('ac'=>'new'));?>">新增</a>
	</li> 
	<li>
		<a href="<?php  echo $this->createWebUrl('applist');?>">预约活动列表</a>
	</li>
    
 	<li <?php  if($ac=='ac_list') { ?> class='active'<?php  } ?> >
		<a href="<?php  echo $this->createWebUrl('appointment',array('ac'=>'ac_list'));?>">可预约的具体活动</a>
	</li>
    
    <?php  if($ac=='ac_edit') { ?>
 	<li <?php  if($ac=='ac_edit') { ?> class='active'<?php  } ?> >
		<a href="#">编辑可预约的具体活动</a>
	</li>
  	<?php  } ?>
    
    <li <?php  if($ac=='ac_new') { ?> class='active'<?php  } ?> >
		<a href="<?php  echo $this->createWebUrl('appointment',array('ac'=>'ac_new'));?>">新增可预约的具体活动</a>
	</li>
</ul>
<?php  if($ac=='ac_list' || $ac=='ac_new'||$ac=='ac_edit') { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('Activity', TEMPLATE_INCLUDEPATH)) : (include template('Activity', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<div class='main'>
<?php  if($ac=='list') { ?>
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th style="width:10%">类目</th>
					<th style="width:10%">名称</th>
					<th style="width:20%">简要</th>
					<th style="width:10%">发布时间</th>
					<th style="width:20%">起始时间</th>
					<th style="width:5%">申请人数</th>
					<th style="width:15%">操作</th>
				</tr>
			</thead>			
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
					<tr>
						<td><?php  echo $appointment[$row['appointment_type']];?></td>
						<td><?php  echo $row['appointment_name'];?></td>
						<td><?php  echo $row['appointment_intro'];?></td>
						<td><?php  echo date("Y-m-d H:i:s",$row['appointment_addtime'])?></td>
						<td><?php  echo date("Y-m-d ",$row['appointment_start'])?>--<?php  echo date("Y-m-d",$row['appointment_end'])?></td>
						<td><span class='red'><?php  echo $row['appointment_join_num'];?></span></td>
						<td><a href="<?php  echo $this->createWebUrl('appointment',array('aid'=>$row['appointment_id'],'ac'=>'edit') )?>">编辑</a>
						<a href="<?php  echo $this->createWebUrl('applist',array('aid'=>$row['appointment_id'],'ac'=>'list') )?>">管理报名</a></td>
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
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
					<div class="col-sm-9 col-xs-8">
						<select name='limit_type' id="limit_type" >
							<?php  if($teacher!='teacher' ) { ?>
							<?php  if(is_array($appointment_limit)) { foreach($appointment_limit as $key => $row) { ?>
								<option value='<?php  echo $key;?>' <?php  if($limit_type==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
							<?php  } } ?>
							<?php  } else { ?>
								<option value='class' >班级限制</option>
							<?php  } ?>
						</select>
					</div>	
				</div>	
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>限制具体</label>
					<div class="col-sm-9 col-xs-8" id='limit_content' data-type='<?php  echo $limit_type;?>'>
						<?php  if($limit_type==0) { ?>无<?php  } ?>
						<?php  if($limit_type==1) { ?>
							<?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
								<input  name='grades[]' type='checkbox' value='<?php  echo $row['grade_id'];?>' <?php  if(in_array($row['grade_id'],$limit_arr)) { ?> checked <?php  } ?>><?php  echo $row['grade_name'];?>&nbsp;&nbsp;
							<?php  } } ?>
						<?php  } ?>
						<?php  if($limit_type==2) { ?>
							<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
								<input name='class[]' type='checkbox' value='<?php  echo $row['class_id'];?>' <?php  if(in_array($row['class_id'],$limit_arr)) { ?> checked <?php  } ?>><?php  echo $row['class_name'];?>&nbsp;&nbsp;
							<?php  } } ?>							
						<?php  } ?>
					</div>
				</div>								
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-8">
						<input type='text' value='<?php  echo $result['appointment_name'];?>' name='aname' class='form-control' >
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>活动类型</label>
					<div class="col-sm-9 col-xs-8">
						<select name='atype'>
							<?php  if(is_array($appointment)) { foreach($appointment as $key => $list) { ?>
								<option value='<?php  echo $key;?>' <?php  if($result['appointment_type']==$key) { ?> selected <?php  } ?>><?php  echo $list;?></option>
							<?php  } } ?>

						</select>
					</div>
				</div>
				<div class="form-group"  id='mutex_content'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择活动</label>
					<div class="col-sm-9 col-xs-8">
                        大课：    
                        <?php  if(is_array($list_max)) { foreach($list_max as $vo) { ?>
                            <input type="checkbox" name='appointment_mutex[]'  value="<?php  echo $vo['course_id'];?>" 
                            <?php  if($ac=='edit') { ?>
                            <?php  if(in_array($vo['course_id'],$result['appointment_mutex']) ) { ?> checked <?php  } ?>
                            <?php  } ?>
                            ><?php  echo $vo['course_name'];?>&nbsp;&nbsp;
                        <?php  } } ?>
                        <br>
                        小课：
                        <?php  if(is_array($list_min)) { foreach($list_min as $vo) { ?>
                            <input type="checkbox" name='appointment_mutex[]'  value="<?php  echo $vo['course_id'];?>" 
                            <?php  if($ac=='edit') { ?>
                            <?php  if(in_array($vo['course_id'],$result['appointment_mutex']) ) { ?> checked <?php  } ?>
                            <?php  } ?>
                            ><?php  echo $vo['course_name'];?>&nbsp;&nbsp;
                        <?php  } } ?>                        
					</div>
				</div>	
    			<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>开始时间-结束时间</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_form_field_daterange('atime',array('start'=>date("Y-m-d H:i:s",$result['appointment_start']),'end'=>date("Y-m-d H:i:s",$result['appointment_end'])))?>	
					</div>
				</div>				
	
    			<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>简介</label>
					<div class="col-sm-9 col-xs-8">
						<textarea name='aintro' class='form-control'><?php  echo $result['appointment_intro'];?></textarea>
					</div>
				</div>					
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>预约内容</label>
					<div class="col-sm-9 col-xs-8">
						<?php  echo tpl_ueditor('acontent',$result['appointment_content']);?>	
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
	<script>
		$(function(){
			<?php  if($teacher!='teacher') { ?>
				var grade_html='';
				<?php  if(is_array($grade_list)) { foreach($grade_list as $key => $row) { ?>
					grade_html +="<input value='<?php  echo $row['grade_id'];?>' type='checkbox' onclick='checkbox(this)' name='grades[]'><?php  echo $row['grade_name'];?>&nbsp;&nbsp;";
				<?php  } } ?>
			<?php  } ?>
			var class_html='';
			<?php  if(is_array($class_list)) { foreach($class_list as $key => $row) { ?>
				class_html +="<input value='<?php  echo $row['class_id'];?>' type='checkbox' onclick='checkbox(this)'name='class[]'><?php  echo $row['class_name'];?>&nbsp;&nbsp;";
			<?php  } } ?>
				var data_type=new Array();
			$('#limit_type').change(function(){
				var val=$(this).val();
					var limit_type=$('#limit_content').attr('data-type');
					limit_type=limit_type ? limit_type :0;
					data_type[limit_type]=$('#limit_content').html();
					$('#limit_content').attr('data-type',val);
					if(!data_type[val]){
						if(val==1){
							var content=grade_html;
						}else if(val==2){
							var content=class_html;
						}else if(val==0){
							var content='无';
						}
						$('#limit_content').html(content);
					}else{
						$('#limit_content').html(data_type[val]);
					}
			});
		});
	function checkbox(obj){
			if($(obj).is(":checked")){
				$(obj).attr('checked','checked');
			}else{
				$(obj).attr('checked',false);
			}
		}
	</script>
<?php  } ?>
<?php  } ?>
</div>