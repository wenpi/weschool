<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
        <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
        <link rel="canonical" href="/examples/audio-player-responsive-and-touch-friendly">
        <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/audioplayer.js"></script>
        <script>
            $( function(){
                $( 'audio' ).audioPlayer();
            });
        </script>
</head>
<body>
<div class="z_main">
    <div class="TP">
        <p><?php  echo $result['word'];?></p>
        <p1> 发布:<?php  if($result['teacher_name']) { ?><?php  echo $result['teacher_name'];?><?php  } else { ?>管理员<?php  } ?></p1>
        <p1> 发布时间:<?php  if($result['add_time']) { ?><?php  echo date("m-d H:i:s",$result['add_time'])?><?php  } else { ?><?php  echo date("m-d H:i:s",$result['addtime'])?><?php  } ?> </p1>
    </div>
    <div class="YY">
        <div id="">
        <?php  if($result['voice']) { ?>
            <audio preload="auto" controls>
                <source src=" <?php  echo  $this->imgFrom($result['voice']);?>" />
                <source src="audio.ogg" />
                <source src="audio.wav" />
            </audio>   
        <?php  } ?>   
        </div>
    </div>
    <?php  if($result['img'] && $result['img']!='qiniu' ) { ?>
        <div class="MT">
                <img src='<?php  echo  $this->imgFrom($result['img']);?>' >
        </div>
    <?php  } ?>
    <div class="NR">
        <p>  <?php  echo htmlspecialchars_decode($result['content']);?>
        </p>
    </div>
</div>
<?php  $footer_type = 'center';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>