<?php defined('IN_IA') or exit('Access Denied');?><div class='main'>
 <?php  if($ac=='ac_list') { ?>
 	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>课程名</th>
					<th>可选几个</th>
					<th>可报名人数</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>			
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $row) { ?>
					<tr>
						<td><?php  echo $row['course_name'];?></td>
						<td><?php  echo $row['course_type'];?></td>
						<td><?php  echo $row['course_num'];?></td>
						<td><?php  if($row['status']==1) { ?>可报名<?php  } else { ?>关闭<?php  } ?></td>
						<td><a href="<?php  echo $this->createWebUrl('appointment',array('aid'=>$row['course_id'],'ac'=>'ac_edit') )?>">编辑</a></td>
					</tr>
				<?php  } } ?>
			</tbody>
		</table>
        <?php  echo $pager;?>
        </div>
 <?php  } ?>
 <?php  if($ac=='ac_edit' || $ac=='ac_new') { ?>
 	<form method="post" class="form-horizontal form" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='ac_new') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程名</label>
					<div class="col-sm-9 col-xs-8">
						<input type="text" name="course_name" id="course_name" class="form-control" value='<?php  echo $result['course_name'];?>'/>
						<?php  if($ac=='ac_edit') { ?>
						<input type="hidden" name="aid"  class="form-control" value='<?php  echo $result['course_id'];?>' />
						<?php  } ?>
					</div>
				</div>
 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>同类型课程可以报名数(如大课一个，小课两个)</label>
					<div class="col-sm-9 col-xs-8">
                        <input type='radio' name='course_type' value='2' <?php  if($result['course_type']==2) { ?> checked <?php  } ?>>小课（同时选择2个）
                        <input type='radio' name='course_type' value='1'  <?php  if($result['course_type']==1) { ?> checked <?php  } ?>>大课（可选择1个）
					</div>
				</div>   
 				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程时间点安排</label>
					<div class="col-sm-9 col-xs-8">
   					   时间点为同一天内会安排两场相同时间的课程（A,B），而学生只能选择其中一场
                          <br>
                          A场开始时间：<input type='text' name="timea[begin]" value="<?php  echo $time['a']['begin'];?>" placeholder="08:00">
                          A场结束时间：<input type='text' name="timea[end]" value="<?php  echo $time['a']['end'];?>" placeholder="13:00">
                          <br>
                          B场开始时间：<input type='text' name="timeb[begin]" value="<?php  echo $time['b']['begin'];?>" placeholder="14:00">
                          B场结束时间：<input type='text' name="timeb[end]" value="<?php  echo $time['b']['end'];?>" placeholder="15:00">
                    </div>
				</div> 
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>课程可以报名人数</label>
					<div class="col-sm-9 col-xs-8">
						<input type="number" name="course_num" id="course_num" class="form-control" value='<?php  echo $result['course_num'];?>'/>
					</div>
				</div>     
  				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'></span>课程介绍</label>
					<div class="col-sm-9 col-xs-8">
                        <?php  echo tpl_ueditor("course_content",$result['course_content']);?>
					</div>
				</div>                                 
					<div class='form-group'>
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
 <?php  } ?>
 </div>