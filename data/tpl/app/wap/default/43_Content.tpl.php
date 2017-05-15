<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = $title;?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php  if($head_controller != 'no') { ?>
       <meta name="viewport" content="user-scalable=no"/>
    <?php  } ?>
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/wap/default/css/css.css">
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>

<body>
<div class="z_main" >
	<div class="tx-t">
		<p1><?php  echo $result['article_title'];?></p1>
	  <p2>发布时间：</p2><p2><?php  echo date("Y-m-d",$result['add_time'])?></p2>
	</div>
	<div class="tx-m" id = 'html_content'>
        	<?php  echo myHtmlspecialchars_decode($result['article_content']);?>
	</div>
</div>
</body>
</html>

