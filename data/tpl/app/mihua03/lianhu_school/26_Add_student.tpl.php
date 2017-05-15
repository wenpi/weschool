<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>

<link type="text/css" rel="stylesheet" href="../addons/lianhu_school/images/style.css">
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<style>
body{
padding:0;
}
</style>
  <div class="nav">
			<a  href="<?php  echo $this->createMobileUrl('Add_student');?>" 
                          style="width:50%"class='active' >绑定其他学生账号</a>
			<a  href="<?php  echo $this->createMobileUrl('change_student');?>" 
                        style="width:50%" >切换学生</a>	
    </div> 
<form class="form-horizontal" method="post" role="form" action="<?php  echo $this->createMobileUrl('add_student', array('submit' => '1'))?>">
	<div class="order-main">
		<div class="add-address img-rounded" id="" >
			<div class="add-address-hd">请仔细填写相应资料：</div>
			<div class="add-address-main">
				<div class="form-group">
					<label class="col-sm-3 control-label">学生姓名：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='student_name' id='student_name'>
					</div>
				</div>
                <?php  if($config['family_set']!='alone_school') { ?>
				<div class="form-group">
					<label class="col-sm-3 control-label">系统编号：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='student_passport' id='student_passport'>
					</div>
				</div>
                <?php  } else { ?>	
				<div class="form-group">
					<label class="col-sm-3 control-label">学生学号：</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name='student_passport' id='student_passport'>
					</div>
				</div>                			
                <?php  } ?>
 				<div class="form-group">
					<label class="col-sm-3 control-label">关系：</label>
					<div class="col-sm-9">
						<?php  $relation_list = $this->class_base->getRelation(); ?>
						<select name='relation' class="form-control" style="border: 1px solid #ccc !important;" >
							<?php  if(is_array($relation_list)) { foreach($relation_list as $row) { ?>
								<option value="<?php  echo $row;?>"><?php  echo $row;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>				
				<div class="form-group">
					<div class="col-sm-12">
					 <button class="button button-raised button-caution" type="submit" ><i class="fa fa-user"></i>&nbsp;&nbsp;提交</button>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
