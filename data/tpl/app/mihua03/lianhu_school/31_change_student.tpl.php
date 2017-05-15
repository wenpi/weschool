<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>切换学生账户-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>

<body>
<!-- <div class="top-wrap">
        <div class="fn-clear tr-box top">
            <div class='text_center'>切换学生</div>
        </div>
  </div> -->  
  
  <div class="nav">
			<a  href="<?php  echo $this->createMobileUrl('Add_student');?>" 
                          style="width:50%">绑定其他学生账号</a>
			<a  href="<?php  echo $this->createMobileUrl('change_student');?>" 
                        style="width:50%" class='active' >切换学生</a>	
    </div> 
  <div class="accordion" style='margin-bottom:60px'>
      <?php  $g=1;?>
      <?php  if(is_array($list)) { foreach($list as $row) { ?>
      <div class="accordion-heading">
             <a class="accordion-toggle collapsed"  href="<?php  echo $this->createMobileUrl('change_student',array('op'=>'post','sid'=>$row['student_id']) );?>"  ><?php  echo $row['student_name'];?></a>
     </div>  
      <?php  $g++;?>
      <?php  } } ?>
 </div>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>

