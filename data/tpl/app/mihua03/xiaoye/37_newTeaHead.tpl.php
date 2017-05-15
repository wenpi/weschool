<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="<?php echo MODULE_URL;?>/template/xiaoye/css/teacher.css?<?php  echo time()?>" rel="stylesheet">
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <script src="<?php echo MODULE_URL;?>/web/default/js/jquery.min.js"> </script>
    <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
</head>