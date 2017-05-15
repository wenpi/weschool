<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php  if($head_controller != 'no') { ?>
       <meta name="viewport" content="user-scalable=no"/>
    <?php  } ?>
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/css.css?<?php  echo time();?>">
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
    
</head>
