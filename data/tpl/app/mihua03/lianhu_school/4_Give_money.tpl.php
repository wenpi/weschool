<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>需要缴费记录</title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
</head>
<style>
    .list_left{width:80%;float: left;height:100%;}
    .list_right{width:20%;float: left;background-color:#FFAE00;color:#fff;height:100%;}
    .list_button{text-align:center;font-weight: 700;font-size:1.1em;}
    </style>
<body class="body-gray" style="width:100%;overflow:hidden">
 <!-- <div class="top-wrap">
	<div class="fn-clear tr-box top">
	   <div class='text_center'>需要缴费记录</div>
  </div>
</div>-->
<div class="wrap" style="margin-bottom:60px;">
    <ul class="ul-list focus-list" id="focus-list">
      <?php  if(is_array($arr)) { foreach($arr as $row) { ?>
         <li style='height:2.5em;line-height:2.5em'>
             <div class='list_left'>&nbsp;&nbsp;<?php  echo $row['name'];?>&nbsp;&nbsp;<i style='color:red'>金额<?php  echo $row['money'];?></i></div>
             <a href="<?php  echo $this->createMobileUrl('give_money_order',array('name'=>$row['limit_module']));?>"><div class='list_right list_button'>去缴费</div></a>
         </li>        
      <?php  } } ?>
      <?php  if(!$arr) { ?>
         <li style='height:2.5em;line-height:2.5em'>
             <div class='list_left'> 暂无缴费</div>
         </li>              
      <?php  } ?>
    </ul>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
