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
				<p1><?php  echo $result['course_name'];?></p1>
				<div style="clear:both"></div>
			</div>
			<div class="tx-m" id = 'html_content' >
				<?php  echo htmlspecialchars_decode($result['course_content']);?>
				<div style="clear:both"></div>
			</div>
		</div>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
	</body>
</html>