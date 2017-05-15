<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>请假列表-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>请假列表</div>
        </div>
 </div>  
<?php  if($ac=='list') { ?>
<div class="main" style="margin-bottom:60px;">
<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th >学生姓名</th>
					<th >家长</th>
					<th >请假时间</th>
					<th >理由</th>
					<th style="text-align:right;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  echo $this->studentName($item['student_id']);?></td>
					<td><?php  echo $this->memberNickName($item['member_uid'])?></td>
                    <td><?php  echo date("m-d",$item['time_date_begin'])?>--<?php  echo date("m-d",$item['time_date_end'])?></td>
					<td><?php  echo $item['leave_reason'];?></td>
					<td style="text-align:right;">
						<a href="<?php  echo $this->createMobileUrl('tea_leave', array('id' => $item['leave_id'],'ac'=>'edit'))?>"class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="编辑"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<?php  } ?>
<?php  if($ac=='edit') { ?>
 	<div class="main">
	<form action="" method="post" class="form-horizontal form" >
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="tab-content">
                    <div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label"> 请假人：</label>
                             <?php  echo $this->studentName($result['student_id']);?> </div><div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">时间</label><?php  echo date("Y-m-d",$result['time_date_begin'])?>--<?php  echo date("Y-m-d",$result['time_date_end'])?> 
                            </div><div class='form-group'>
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label">理由：</label><?php  echo $result['leave_reason'];?>
                     </div>
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>处理备注</label>
					<div class="col-sm-9 col-xs-12">
                        <textarea name='teacher_text' rows=4 class='form-control'><?php  echo $result['teacher_text'];?></textarea>
					</div>	
				</div>								

				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-8">
				<input type="submit" name="submit" value="准许" class="btn btn-primary col-lg-1" />
				<input type="submit" name="submit" value="不允" class="btn  col-lg-1" style='margin-left:10px;'/>
			</div>
			</div>
		</div>		
	</form>
</div>	   
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>