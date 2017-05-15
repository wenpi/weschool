<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title><?php  echo $result['teacher_realname'];?>教师主页</title>
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimum-scale=1,user-scalable=no">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>/template/mobile/asas_files/5f0d6b0f.base.css">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>/template/mobile/asas_files/a6490475.content.css">
  <script src="<?php echo MODULE_URL;?>/template/mobile/asas_files/share.js"></script>
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>/template/mobile/asas_files/share_style0_16.css"></head>
</head>
<body>
<div class="container">
<div class="cover">
    <div class="cover-image" style="background-image : url(<?php echo MODULE_URL;?>/template/mobile/asas_files/FlU5aiJm5LJtNXQkOcbxBU0K2itL!preface.jpg)"></div>
</div>
<div class="tutor-full">
    <div class="column">
	<div class="tutor-full-main" id="tutorInfo">
		<span class="tutor-avatar tutorAvatar">
			<img src="<?php  if($result['teacher_img']) { ?>../attachment/<?php  echo $result['teacher_img'];?><?php  } else { ?><?php echo MODULE_URL;?>icon.jpg<?php  } ?>" alt="<?php  echo $result['teacher_realname'];?>">
		</span>
	             <div class="tutor-info">
	            		<div>
			             <span class="tutor-name"><?php  echo $result['teacher_realname'];?></span>
			             <span class="tutor-title"><?php  echo $result['course_name'];?></span>
	                	</div>
	             </div>
        	</div>
    </div>
</div>
<div class="content">
    <div class="main topic-top">
        <div class="tutor-content">
			<h2>资料</h2>
			<ul id="topicList" class="topic-list">
                <li class="topic-item">
                    <div class="topic-info">
                        <h3 class="topic-title topicTitle" data-topic_id="29864408" data-topic_price="399" data-is_meeting="false">电话：<?php  echo $result['teacher_telphone'];?></h3>
                         <h3>关于老师</h3>
                        <div class="about-tutor"><div>
                            <?php  echo  htmlspecialchars_decode($result['teacher_introduce']);?>
                        </div>
                        </div>
            
                        <h3 class="topic-title topicTitle" data-topic_id="29864408" data-topic_price="399" data-is_meeting="false">微信二维码：</h3>
                        <img src='<?php  echo $_W['attachurl'];?><?php  echo $result['weixin_code'];?>' style="display:block;width:60%;margin:auto;">
                        <span class="stars stars-10"></span>
                    </div>
                </li>
			</ul>

		</div>
    </div>
</div>
</div>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/template/mobile/asas_files/118fcd46.base.js"></script>
<script src="<?php echo MODULE_URL;?>/template/mobile/asas_files/e7ed3e6e.main.js"></script>
<script src="<?php echo MODULE_URL;?>/template/mobile/asas_files/d4442b7e.content.js"></script>
</body>
</html>