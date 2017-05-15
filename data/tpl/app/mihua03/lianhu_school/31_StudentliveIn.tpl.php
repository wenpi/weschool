<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>二维码操作</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
 <div class="top-wrap">
        <div class="fn-clear tr-box top">
            <div class='text_center'>教师二维码操作</div>
        </div>
  </div> 
    <div class='main' style="margin-top:10%">
    <div style='width:100%;text-align:center;color:#666;font-size:1.3em;font-weght:700;margin-bottom:10px;'><?php  echo $student_re['student_name'];?></div>   
    <a href="<?php  echo $url;?>&live_in=in" class="button button-block button-rounded  button-large">入校操作</a>
    <a href="<?php  echo $url;?>&live_in=live" class="button button-block button-rounded button-action button-large" style='margin-top:10px;'>离校操作</a>
    </div>
  
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>