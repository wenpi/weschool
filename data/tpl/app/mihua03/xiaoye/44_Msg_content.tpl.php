<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
		<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
	</head>
	<body>
		<div class="z_main" >
			<div class="tx-t"  >
				<p1><?php  echo $result['msg_title'];?></p1>
				<p2>发布者： <?php  echo $admin_name;?>；</p2> <p2>发布时间：<?php  echo date("Y-m-d",$result['add_time'])?></p2>
				<div style="clear:both"></div>
			</div>
			<div  id = 'html_content' style="padding: 0 10px;" >
						<?php  $urls =  $this->decodeLineImgsToArr($result['images']);?>
							<?php  if($urls) { ?>
								<div class="z_dpt3" id="img_list">
									<?php  if(is_array($urls)) { foreach($urls as $val) { ?>
										<img src="<?php  echo $val;?>" style="margin-top:10px;" onclick="displayImage('img_list','<?php  echo $val;?>')">
									<?php  } } ?>
								</div>				
							<?php  } else if($result['img']) { ?>
							<div class="tz-tp"  id='img_list_1'>
								<img  src="<?php  echo $this->imgFrom($result['img'])?>" onclick="displayImage('img_list_1','<?php  echo $this->imgFrom($result['img'])?>')" >
							</div>
							<?php  } ?>           
				<?php  echo htmlspecialchars_decode($result['msg_content']);?>
				<div style="clear:both"></div>
			</div>
		</div>
		    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
		 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
	</body>
</html>