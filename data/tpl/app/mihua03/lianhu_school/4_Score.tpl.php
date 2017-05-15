<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>考试成绩-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<!-- <div class="top-wrap">
        <div class="fn-clear tr-box top">
            <div class='text_center'><?php  if($ac=='list') { ?>考试列表<?php  } else { ?><?php  echo $scorejilv_name;?><?php  } ?></div>
        </div>
  </div>     
    -->
	 <?php  if($ac=='list') { ?>
     <div class="panel member-nav" style="margin-bottom:60px;">
        <ul class="side-nav">
          <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li class="">
                <a href="<?php  echo $this->createMobileUrl('score',array('ac'=>'listall','op'=>$row['scorejilv_id']))?>" style='text-align:left;width:90%;overflow:hidden;display:inline-block' >
                    <i class="fa fa-bar-chart" style='color:#ff0033'></i>&nbsp;&nbsp;
                    <span class="text" style='text-align:left'><?php  echo $row['scorejilv_name'];?></span>
                    </a>
                    <i class="fa fa-share"></i>&nbsp;&nbsp;
            </li>
          <?php  } } ?>
        </ul>
    </div>
    <?php  } ?>
    
    <?php  if($ac=='listall') { ?>
     <div class="panel member-nav" style="margin-bottom:60px;">
                &nbsp;&nbsp;<i class="fa fa-bar-chart" style='color:#ff0033'></i>&nbsp;&nbsp;<span class="text">总分：<span class='red'><?php  echo $all_score;?></span></span>&nbsp;&nbsp;&nbsp;&nbsp;
                <div id="disstroe-sub" class="member-nav-sub"style='display:block'>
                    <ul class="member-nav-sub-ul" >
                      <?php  if(is_array($score_list)) { foreach($score_list as $row) { ?>
                             <li class="member-nav-sub-li"  >
                            <i class="fa fa-cubes"></i>&nbsp;<span class="text"><?php  echo $row['course_name'];?>:<?php  echo $row['score'];?></span></li> 
                      <?php  } } ?>
                    </ul>
                </div>
    </div>
    <?php  } ?>
      <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
      <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
