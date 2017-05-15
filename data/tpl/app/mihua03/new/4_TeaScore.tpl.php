<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link href="<?php echo MODULE_URL;?>/style/css/old_css.css?<?php  echo time();?>" rel="stylesheet">
    <link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>
<body style="background-color: #ccccff" class="all_height">
    <header class="tscore_head">
        尊敬的<?php  echo $student_name;?>
    </header>
    <div class="tscore_img" >
        <a href="<?php  echo $this->createMobileUrl("teaScoreList",array("ac"=>$_GPC['ac']))?>" style="color: #FFFF52; position: relative;left: -5px;font-size:1.2em">
        <?php  if($ac=='list') { ?>今年<?php  } else if($ac=='month') { ?>本月<?php  } else if($ac=='day') { ?>今日<?php  } ?>积分<br>
        <?php  echo $result['all_num'];?>
        </a>
    </div>
    <div class="tscore_bottom">
        <span>
            积分排名<br>
            <?php  echo $sort;?>
        </span>
        <span>消费积分<br>
            0
         </span>
    </div>
    <div class="tscore_re">
        <?php  if($ac!="month") { ?>
            <a href="<?php  echo $this->createMobileUrl("teaScore",array("ac"=>'month'))?>">本月</a>
        <?php  } else { ?>
            <a href="<?php  echo $this->createMobileUrl("teaScore",array("ac"=>'list'))?>">今年</a>
        <?php  } ?>
        <a href="<?php  echo $this->createMobileUrl("teain")?>">首页</a>
        <?php  if($ac!='day') { ?>
            <a href="<?php  echo $this->createMobileUrl("teaScore",array("ac"=>'day'))?>">今日</a>
        <?php  } else { ?>
            <a href="<?php  echo $this->createMobileUrl("teaScore",array("ac"=>'list'))?>">今年</a>
        <?php  } ?>
        <div style="clear:both"></div>
    </div>

    <div class="tscore_text">
        点击积分数查看积分记录
    </div>

</body>