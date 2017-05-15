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
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/audioplayer.js"></script>
<script>
    $( function(){
        $( 'audio' ).audioPlayer();
    });
</script>
<body>
    <div class="z_main">
        <div class="z_dp">
            <div class="z_dpt"><?php  echo date("Y-m-d",$re['add_time']);?>日<?php  echo $this->courseName($re['course_id']);?>家庭作业</div>
                <div class="z_dpt1">发布：<?php  if($re['teacher_realname']) { ?><?php  echo $re['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></div>
                <?php  if($re['voice']) { ?>
                    <div id="">
                        <audio preload="auto" controls >
                            <source src="<?php  echo $this->imgFrom($re['voice'])?>" />
                        </audio>
                    </div>                
                <?php  } ?>
                <div class="z_dpt4">
                    <p><?php  echo myHtmlspecialchars_decode($re['content'])?></p>
                </div>
                <div class="z_dpt3" id="img_list">
                    <?php  $urls =  $this->decodeLineImgsToArr($re['img']);?>
                        <?php  if($urls) { ?>
                            <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                            <img src="<?php  echo $val;?>"  onclick="displayImage('img_list','<?php  echo $val;?>')">
                            <?php  } } ?>
                        <?php  } ?>           
                </div>

        </div>
    </div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
