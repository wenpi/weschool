<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>班级授课老师列表</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<style>
	 .accordion-heading img{
          height:60px;
          width:60px;
          display: inline;
          border-radius: 50px;
          margin-top:10px;
          float: left;
          margin-left:10px;
      }
	  .rightClick img {
    width: 15px;
    height: 15px;
    background: none;
	margin: 10px 20px 0 0;
}
	</style>
</head>
<body style="background:#efefef;">
  <div   style='margin: 10px 0 60px 0;'>
     <?php  if(is_array($teacher_list)) { foreach($teacher_list as $key => $row) { ?>
     <a href='<?php  echo $this->createMobileUrl('personer',array('t_id'=>$row['teacher_id']))?>'>
           <div class="accordion-heading" style='height:80px; background-color:#fff;margin-bottom:10px;' >
           <img src="<?php  if($row['teacher_img'] ) { ?>../attachment/<?php  echo $row['teacher_img'];?> <?php  } else { ?> <?php echo MODULE_URL;?>icon.jpg<?php  } ?>"  >
               <ul class='other_info' style="width:50%;overflow:hidden;">
                <li><b>姓名：</b><?php  echo $row['teacher_realname'];?></li>
                <li><b>授课：</b><?php  echo $this->courseName($row['course_id'])?></li>
             </ul>
			  <div class="rightClick"><img src="<?php echo MODULE_URL;?>template/mobile/style/right.png"/></div>
        </div> 
    </a>
     <?php  } } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>