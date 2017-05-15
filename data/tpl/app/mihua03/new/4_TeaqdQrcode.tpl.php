<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '签到二维码';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css?<?php  echo time()?>">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
  <script type="text/javascript" src="<?php echo MODULE_URL;?>/style/app/js/framework.js"></script>
<body>
  <div class="body" style="padding-top:0px;padding-bottom:60px;background-color:#fff;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
            <img src='<?php  echo $_W['siteroot'];?>/attachment/<?php  echo $up_file_name;?>'>
            <p>名称：<span><?php  echo $result['activity_name'];?></span></p>
            <p>截止时间：<span><?php  echo date("m-d H:i",$result['endtime'])?></span></p>
            <p>小提示：<span>截屏分享出去即可</span></p>
	    </div>
 </div>
 <style>
     .w-tabs p{
         width: 100%;
         text-align: center;
     }
     .w-tabs p span{
         color:#ff0033;
     }
 </style>