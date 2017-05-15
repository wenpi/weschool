<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>预约结果-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
   <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<body >
<!--  <div class="top-wrap">
    <div class="fn-clear tr-box top">
       <div class='text_center'>预约结果</div>
  </div>
</div>-->
  <div class="nav">
			<a  href="<?php  echo $this->createMobileUrl('applist');?>" 
                          style="width:50%">预约项目</a>
			<a  href="<?php  echo $this->createMobileUrl('Applist_result');?>" 
                        style="width:50%" class='active' >预约结果</a>	
    </div> 
<div class="wrap" style="margin-bottom:60px !important;margin-top:0px !important;">
    <ul class="ul-list focus-list" id="focus-list" style='padding-left:0'>
      <?php  if(is_array($list)) { foreach($list as $row) { ?>
         <li>
          <a href=" "><b><strong style="color:#ff0033;display:inline-block;float:left;">【<?php  if($row['status']==0) { ?>默认通过<?php  } else if($row['status']==2) { ?>未通过<?php  } ?>】</strong><?php  echo $row['my_course'];?></b>
              &nbsp;&nbsp;<?php  echo $row['reason'];?></a>
            <p class="p-btm">|<time><?php  echo date("Y-m-d",$row['addtime']);?></time>|</p>              
        </li>        
      <?php  } } ?>
    </ul>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>