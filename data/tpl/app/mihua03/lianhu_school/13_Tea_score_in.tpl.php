<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>发布成绩-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<style>
		.table-hover input{
			display:inline;
			width:75%;
			border:1px solid #ccc;
			height:30px;
			line-height:30px;
			border-radius:3px;
		}
		.col-xs-8 {
			width: 100%;
		}
	</style> 
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>发布成绩</div>
        </div>
 </div>  
<div class='main'>
		<div class="panel-body table-responsive">
		<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<?php  if($model!='student') { ?>
		<table class="table table-hover">
			<tbody>
				<?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
				<tr>
				<td><a href="<?php  echo $this->result_result($item,$model,'url','tea_score_in');?>" ><?php  echo $this->classGradeName($item)?>-<?php  echo $this->className($item);?>&nbsp;&nbsp;>> 
				</a>
				</td>					
			</tr>
			<?php  } } ?>
			</tbody>
		</table>		
		<?php  } else { ?>
		<script>
		</script>
			<ul id='score_list'>
				<?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
						<li  class='score_student'>
							<?php  echo $this->result_result($item,$model,'name','msg');?>
									<input data-id='0' name='score[<?php  echo $item['student_id'];?>]' type='text' placeholder="请填入成绩">	
						</li>
				<?php  } } ?>
					<div class="clear"></div>
			</ul>
		<?php  } ?>
		<?php  if($model =='student') { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				添加成绩记录
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择课程</label>
					<div class="col-sm-9 col-xs-8">
						<select name='course_id' onChange="ajax_up()" id="course_id"  class='form-control'>
						<?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
							<option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
						<?php  } } ?>
					</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择考试记录</label>
					<div class="col-sm-9 col-xs-8">
						<select name='scorejilv_id' onChange="ajax_up()"id="scorejilv_id"  class='form-control'>
						<?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
							<option value='<?php  echo $row['scorejilv_id'];?>'><?php  echo $row['scorejilv_name'];?></option>
						<?php  } } ?>
					</select>
					</div>
				</div>							
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<br>
			<input type='hidden' value='<?php  echo $_GPC['cid'];?>' name='class_id'>
			
			<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</div>
	<?php  } ?>
</div>

</div>
<?php  if($model=='student') { ?>
	<script>
		$(function(){
			ajax_up();
		});
		function ajax_up(){
				var cid=<?php  echo $_GPC['cid'];?>;
				var course_id=$('#course_id').val();
				var scorejilv_id=$('#scorejilv_id').val();
				$.ajax({
					type:'post',
					url:'<?php  echo $this->createMobileUrl('ajax',array('ac'=>'student_score_list'))?>',
					data:{cid:cid,course_id:course_id,scorejilv_id:scorejilv_id},
					dataType:'json',
					success:function(obj){
						if(obj.status=='yes'){
							$("#score_list").find('input').attr("data-id",0);
							$.each(obj.student_score_list,function(i,e){
								$('input[name="score['+e.student_id+']"]').val(e.score);
								$('input[name="score['+e.student_id+']"]').attr("data-id",1);
							});
							$.each($("#score_list").find('input'),function(i,e){
								if($(this).attr('data-id')!=1)
										$(this).val(0);
							});
						}
					}
				});								
		}
	</script>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>