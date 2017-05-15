<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>预约活动-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<body>
 <div class="nav">
			<a  href="<?php  echo $this->createMobileUrl('applist');?>" 
                          style="width:50%" class='active'>预约项目</a>
			<a  href="<?php  echo $this->createMobileUrl('Applist_result');?>" 
                        style="width:50%" >预约结果</a>	
    </div> 
<div>
    <ul class="ul-list focus-list" id="focus-list" style='padding-left:0'>
      <?php  if(is_array($list)) { foreach($list as $row) { ?>
         <li>
            <a href="<?php  echo $this->createMobileUrl('appointment_article',array('op'=>$row['appointment_id']));?>"><b>
                <strong style="color:#ff0033;display:inline-block;float:left;">【 <?php  if($row['status']==1 && $row['appointment_end']>time()  && time()>$row['appointment_start']) { ?>进行中<?php  } else if($row['status']==1 && $row['appointment_end']< time() ) { ?>已结束 <?php  } else if($row['status']==1 && $row['appointment_start']>time() ) { ?>未开始<?php  } ?> 】</strong> <?php  echo $row['appointment_name'];?></b>
              &nbsp;&nbsp;<?php  echo $this->clear_html_short($row['appointment_intro']);?>......</a>
            <p class="p-btm"><u><?php  if($row['appointment_type_limit']==0) { ?>全校<?php  } else if($row['appointment_type_limit']==1) { ?>年级<?php  } else if($row['appointment_type_limit']==2) { ?>班级<?php  } ?></u>|<time><?php  echo date("m-d H:i",$row['appointment_start']);?>--<?php  echo date("m-d H:i",$row['appointment_end']);?></time>|<i>
            <a href="#">申请数(<?php  echo $row['appointment_join_num'];?>)</a></i></p>              
        </li>        
      <?php  } } ?>
    </ul>
<!--     <div class="idx-pages" <?php  if($total> $pagesize) { ?> onclick='ajax_con(<?php  echo $type;?>)'<?php  } ?>>
       <a href="#" ><?php  if($total<$pagesize) { ?>没有啦<?php  } else { ?>更多<?php  } ?></a>
    </div> -->
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>