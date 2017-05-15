<?php defined('IN_IA') or exit('Access Denied');?><?php  if($live_in) { ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>放学扫码</title>
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
            <div class='text_center'>教师放学扫码</div>
        </div>
  </div> 
    <div class='main' style="margin-top:10%">
    <div style='width:100%;text-align:center;color:#666;font-size:1.3em;font-weght:700;margin-bottom:10px;'><?php  echo $student_re['student_name'];?></div>   
    <?php  if($have_send) { ?>
    <a href="#" class="button button-block button-rounded  button-large">放学成功</a>
    <?php  } else { ?>
    <a href="<?php  echo $url;?>&send=1" class="button button-block button-rounded button-action button-large">确认放学</a>
    <?php  } ?>
    <button class="button button-block button-rounded button-royal button-large" style='margin-top:10px;' id='scanQRCode1'>扫码</button>
    </div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('StudentliveIn', TEMPLATE_INCLUDEPATH)) : (include template('StudentliveIn', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>