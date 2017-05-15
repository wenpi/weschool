<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="target-densitydpi=286, width=640, user-scalable=no" />
<title></title>
<link href="<?php echo MODULE_URL;?>template/mobile/css/css.css" rel="stylesheet" />
<link href="<?php echo MODULE_URL;?>template/mobile/css/swiper-3.3.1.min.css" rel="stylesheet" />
<script src="<?php echo MODULE_URL;?>template/mobile/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo MODULE_URL;?>template/mobile/js/swiper-3.3.1.jquery.min.js"></script>
</head>
<body>
	<?php  $bg_img = D('adv')->getUniacidAdvInfoKeyWord('teacher_bd_bg');?>
	<?php  $logo   = D('adv')->getUniacidAdvInfoKeyWord('teacher_bd_logo');?>

<style>
	body{ background:url(<?php  if($bg_img) { ?><?php  echo $_W['attachurl'];?><?php  echo $bg_img;?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/images/teacher.jpg<?php  } ?>) center 0 no-repeat;}
</style>
<div class="tcher1 mgz cen"><img align="absmiddle" src="<?php  if($logo) { ?><?php  echo $_W['attachurl'];?><?php  echo $logo;?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/images/teacher_02.png<?php  } ?>" /></div>
<div class="tcher2 mgz xi34 bai cen">绑定教师帐号<span class="xi24">通过系统帐号绑定</span></div>
<form class="form-horizontal" method="post" action="<?php  echo $this->createMobileUrl('teacher')?>">
	<div class="tcher3 mgz bai">系统帐号：</div>
	<div class="tcher4 mgz">
		<input type="text" class="bd1 f bai form-control" name='passport' id='passport'>
		<input type="hidden" class="form-control" name='submit' value='1'>
	</div>
	<div class="tcher3 mgz bai">系统密码：</div>
	<div class="tcher4 mgz"><input type="password" class="bd1 f bai form-control" name='password' id='password'></div>
	<div class="tcher5 mgz"><button class="an1 bai f xi28 button button-raised button-caution" type="submit" >保存&nbsp;&nbsp;SIGN IN</button></div>
</form>
<script src="js/mjs.js"></script>
</body>
</html>