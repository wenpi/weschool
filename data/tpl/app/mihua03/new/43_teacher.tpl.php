<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="target-densitydpi=286, width=640, user-scalable=no" />
    <title>绑定教师账户</title>
    <link href="<?php echo MODULE_URL;?>/style/css/bdcss.css" rel="stylesheet" />
</head>
	<?php  $logo   = D('adv')->getUniacidAdvInfoKeyWord('teacher_bd_logo');?>
<body style="height:1288px">
    <div class="logo mgz">
        <div class="logoz">
            <img src="<?php  if($logo) { ?><?php  echo $_W['attachurl'];?><?php  echo $logo;?><?php  } else { ?><?php echo MODULE_URL;?>template/mobile/images/teacher_02.png<?php  } ?>">
        </div>
        </div>
        <form class="form-horizontal" method="post" action="<?php  echo $this->createMobileUrl('teacher')?>" >
        <div class="zh mgz">
            <div class="zhz">
            <input placeholder="请输入系统账号" name="passport">
            </div>
        </div>  
        <div class="zh mgz ">
            <div class="zhz">
            <input placeholder="请输入系统密码" name="password">
            </div>
        </div>
        <div class="dl mgz">
            <input name="submit" type="hidden" value="1">
            <input type="submit" class="dlz cen xi32 bai" value="登录">
        </div>
        </form>
    </div>
</body>
</html>