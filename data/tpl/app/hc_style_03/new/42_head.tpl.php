<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html ng-app='new_app'>
<head>
 <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <script src="<?php echo MODULE_URL;?>style/js/angular.min.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/new.js"></script>
    <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/weui2.css?<?php  echo time();?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
 