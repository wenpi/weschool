<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<style>
    .margin-5{
        display: inline-block;
        margin-bottom: 5px;
    }
</style>
<ul class="nav nav-tabs">
	<li <?php  if($ac == 'list') { ?>class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('syllabus')?>">班级列表</a>
	</li>
	<?php  if($ac=='edit') { ?>
	<li <?php  if($ac == 'edit') { ?> class="active"<?php  } ?>>
	<a href="#">编辑班级课程表</a>
	</li> 
	<?php  } ?>
	<?php  if($_GPC['cid'] >0 ) { ?>
	<li <?php  if($ac == 'new') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('syllabus',array('cid'=>$_GPC['cid'],'ac'=>'new'))?>">编辑班级课程表</a>
	</li> 
	<?php  } ?>	
	<li <?php  if($ac == 'edit_course_time') { ?> class="active"<?php  } ?>>
	<a href="<?php  echo $this->createWebUrl('syllabus',array('ac'=>'edit_course_time'))?>">编辑课程时间</a>
	</li> 
</ul>
<?php  if($ac=='list') { ?>
	<div class="panel-body table-responsive">
		  <ul class='record_list'>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <?php  if(!$grade_list_id) { ?>
                        <?php  $grade_list_id=$item['grade_id'];?>
                    <?php  } ?>        
				<?php  if($grade_list_id !=$item['grade_id'] && $grade_list_id ) { ?>
                    <?php  $grade_list_id=$item['grade_id']?>
                    <div class='clear'></div>
                <?php  } ?>                         
   				<li>
					<a href="<?php  echo $this->createWebUrl('syllabus',array('cid'=>$item['class_id'],'ac'=>'new'))?>" ><div class='btn btn-primary'  style='background-color:#7DCC4A;border:1px solid #7DCC4A;font-weight:700' >
                        【<?php  echo $this->gradeName($item['grade_id'])?>】<?php  echo $item['class_name'];?> <?php  if($item['syllabus_id']>0) { ?>:<span class='red'>已经设置</span><?php  } ?></div></a>
				</li>

                <?php  } } ?>
          </ul>
	</div>
<?php  } ?>
<?php  if($ac=='new') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="cid"  class="form-control" value='<?php  echo $class_result['class_id'];?>' />
		<input type="hidden" name="ac"  class="form-control" value='save' />
		<div class="panel panel-default">
			<div class="panel-heading">
				是否用链接代替家校通课表
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">链接地址[填写则会替代]</label>
						<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
							<input type="text" name="url" id="url" class="form-control" value="<?php  echo $old_result['url'];?>" />
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				编辑班级课程表 【<?php  echo $this->gradeName($class_result['grade_id'])?>】【<?php  echo $class_result['class_name'];?>】【改变课程后-授课老师无法及时更新，请保存后再编辑授课老师】
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<?php  $g=1;?>
					<?php  if(is_array($loop)) { foreach($loop as $value) { ?>
						<?php  if($g> $on_school) { ?><?php  break;?><?php  } ?>
                        <?php  if($begin_course ) { ?>
                        <?php  $begin_week=$begin_course+$g-1;?>
                        <?php  } else { ?>
                        <?php  $begin_week=$g;?>
                        <?php  } ?>
							<div class="form-group">
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>星期<?php  echo $begin_week;?></label>
								<?php  if($am_much>0) { ?>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
										  <?php  $i=1;?>
									上午：<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $am_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：
                                            <select name='am[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
												<?php  if(is_array($courses)) { foreach($courses as $v) { ?>
													<option value='<?php  echo $v['name'];?>' <?php  if($data['am'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
												<?php  } } ?>
												<option value='自习' <?php  if($data['am'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
												<option value='休息' <?php  if($data['am'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
											 </select>&nbsp;&nbsp;&nbsp;
                                             <?php  if($data['am'][$g][$i] && $data['am'][$g][$i]!='自习' && $data['am'][$g][$i]!='休息') { ?>
                                               <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['am'][$g][$i])?>
										     授课老师：<select name='teacher_am[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
                                                <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                    <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_am'][$g][$i] ==$vs['teacher_id']) { ?> selected <?php  } ?> ><?php  echo $vs['teacher_realname'];?></option>
                                                <?php  } } ?>
                                            </select>
                                            <?php  } ?>
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php  if($i%2==0 && $i !=0) { ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  } ?>
                                          <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
								<?php  if($pm_much>0) { ?>
								<div style='clear:both;'></div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
										  <?php  $i=1;?>
									下午：<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $pm_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：<select name='pm[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
												<?php  if(is_array($courses)) { foreach($courses as $v) { ?>
													<option value='<?php  echo $v['name'];?>' <?php  if($data['pm'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
												<?php  } } ?>
												<option value='自习' <?php  if($data['pm'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
												<option value='休息' <?php  if($data['pm'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
											 </select>&nbsp;&nbsp;&nbsp;
                                             <?php  if($data['pm'][$g][$i] && $data['pm'][$g][$i]!='自习' && $data['pm'][$g][$i]!='休息') { ?>
                                               <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['pm'][$g][$i])?>
										     授课老师：<select name='teacher_pm[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
                                                <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                    <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_pm'][$g][$i] ==$vs['teacher_id']) { ?> selected <?php  } ?> ><?php  echo $vs['teacher_realname'];?></option>
                                                <?php  } } ?>
                                            </select>
                                            <?php  } ?>
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php  if($i%2==0 && $i !=0) { ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  } ?>
										  <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
								<?php  if($ye_much>0) { ?>
								<div style='clear:both;'></div>
								<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
								    <?php  $i=1;?>
									晚上：<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $ye_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：<select name='ye[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
												<?php  if(is_array($courses)) { foreach($courses as $v) { ?>
													<option value='<?php  echo $v['name'];?>' <?php  if($data['ye'][$g][$i]==$v['name'] ) { ?> selected <?php  } ?>><?php  echo $v['name'];?></option>
												<?php  } } ?>
												<option value='自习' <?php  if($data['ye'][$g][$i]=='自习' ) { ?> selected <?php  } ?>>自习</option>
												<option value='休息' <?php  if($data['ye'][$g][$i]=='休息' ) { ?> selected <?php  } ?>>休息</option>
											 </select>&nbsp;&nbsp;&nbsp;
                                             <?php  if($data['ye'][$g][$i] && $data['ye'][$g][$i]!='自习' && $data['ye'][$g][$i]!='休息') { ?>
                                               <?php  $teacher_list=$this->classCouldCourse($class_result['class_id'],$data['ye'][$g][$i])?>
										     授课老师：<select name='teacher_ye[<?php  echo $g;?>][<?php  echo $i;?>]' class='margin-5'>
                                                <?php  if(is_array($teacher_list)) { foreach($teacher_list as $vs) { ?>
                                                    <option value='<?php  echo $vs['teacher_id'];?>'  <?php  if($data['teacher_ye'][$g][$i] == $vs['teacher_id']) { ?> selected <?php  } ?>><?php  echo $vs['teacher_realname'];?></option>
                                                <?php  } } ?>
                                            </select>
                                            <?php  } ?>
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php  if($i%2==0 && $i !=0) { ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  } ?>
										  <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
							</div>
							<?php  $g++;?>
					<?php  } } ?>
				</div>
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>
</div>	
<?php  } ?>
<?php  if($ac=='edit_course_time') { ?>
	<div class="main">
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				编辑课程上课时间【24小时制】
			</div>
			<div class="panel-body">
				<div class="tab-content">
							<div class="form-group">
								<?php  if($am_much>0) { ?>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
							    <?php  $i=1;?>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $am_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：
                                            <input type='text' name='begin_time[<?php  echo $i;?>]' value='<?php  echo $result['begin_time'][$i];?>' placeholder="课程开始时间">&nbsp;&nbsp;  
                                            <input type='text' name='end_time[<?php  echo $i;?>]' value='<?php  echo $result['end_time'][$i];?>' placeholder="课程结束时间">  
                                            <br>   
                                            <br> 
										  <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
                                <br>    
								<?php  if($pm_much>0) { ?>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $pm_much+$am_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：
                                            <input type='text' name='begin_time[<?php  echo $i;?>]' value='<?php  echo $result['begin_time'][$i];?>' placeholder="课程开始时间">&nbsp;&nbsp;  
                                            <input type='text' name='end_time[<?php  echo $i;?>]' value='<?php  echo $result['end_time'][$i];?>'  placeholder="课程结束时间">
                                             <br>                                           
                                             <br>                                           
										  <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
                                <br>    
								<?php  if($ye_much>0) { ?>
								<div class="col-sm-8 col-xs-8" style='margin-bottom:10px;'>
									<?php  if(is_array($loop)) { foreach($loop as $row) { ?>
											<?php  if($i> $ye_much+$pm_much+$am_much) { ?><?php  break;?><?php  } ?>
											第<?php  echo $i;?>节课：
                                             <input type='text' name='begin_time[<?php  echo $i;?>]' value='<?php  echo $result['begin_time'][$i];?>' placeholder="课程开始时间">&nbsp;&nbsp;  
                                            <input type='text' name='end_time[<?php  echo $i;?>]' value='<?php  echo $result['end_time'][$i];?>' placeholder="课程结束时间">
                                            <br>                                               
                                            <br>                                               
										  <?php  $i++;?>
										  <?php  } } ?>
								</div>
								<?php  } ?>
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