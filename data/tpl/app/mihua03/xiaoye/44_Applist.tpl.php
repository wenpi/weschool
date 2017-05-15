<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
		<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
	</head>
<body>
<div class="z_main">
     <div class="head-yy">
        <a href="<?php  echo $this->createMobileUrl('applist')?>" class="pp"><p>预约活动</p></a>
        <a href="<?php  echo $this->createMobileUrl('applist_result')?>"><p>预约结果</p></a>
    </div>
    <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <div class="yy">
                <div class="yy-top">
                <div class="yy-t-l">
                <?php  if($row['status']==1 && $row['appointment_end']>time()  && time()>$row['appointment_start']) { ?>
                    <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jxz.png">
                <?php  } else if($row['status']==1 && $row['appointment_end']< time() ) { ?>
                    <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/yjs.png">
                <?php  } else if($row['status']==1 && $row['appointment_start']>time() ) { ?>
                    <img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/wks.png">
                <?php  } ?> 
                    <a href="<?php  echo $this->createMobileUrl('appointment_article',array('op'=>$row['appointment_id']));?>"><p><?php  echo $row['appointment_name'];?></p></a>
                    </div>
                <div class="yy-t-r">
                    <p1>申请数：</p1>
                    <p2><?php  echo $row['appointment_join_num'];?></p2>
                </div>
                    
                </div>
                <div class="yy-m">
                    <a href="<?php  echo $this->createMobileUrl('appointment_article',array('op'=>$row['appointment_id']));?>"><p>
                        <?php  echo $this->clear_html_short($row['appointment_intro']);?>
                    </p></a>
                </div>
                <div class="yy-b">
                    <div>报名范围：<?php  if($row['appointment_type_limit']==0) { ?>全校<?php  } else if($row['appointment_type_limit']==1) { ?>年级<?php  } else if($row['appointment_type_limit']==2) { ?>班级<?php  } ?></div>
                    <div> 报名时间：<?php  echo date("m-d H:i",$row['appointment_start']);?>&nbsp;至&nbsp;<?php  echo date("m-d H:i",$row['appointment_end']);?></div>
                </div>
                <div class="y-t"></div>
            </div>
    <?php  } } ?>    
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>