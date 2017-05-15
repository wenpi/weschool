<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="target-densitydpi=286, width=640, user-scalable=no" />
    <title>用户登录</title>
    <link href="<?php echo MODULE_URL;?>/style/css/bdcss.css?<?php  echo time()?>" rel="stylesheet" />
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>

<body style="height:1300px">
<form class="form-horizontal" method="post" role="form" action="<?php  echo $this->createMobileUrl('login')?>">
    <div class="con1 mgz xi24">
    <div class="con1z">
          <span class="cheng">*</span>使用手机号登录  <a href="<?php  echo $this->createMobileUrl('register')?>" class="btn"> 去注册 </a>
    </div>
    </div>
        <div class="con2 mgz">
            <div class="con2z xh">
                <input placeholder="您的手机号" type="number" name='mobile' id="mobile">
            </div>
        </div>

        <div class="con2 mgz">
              <div class="con2z ">
                  <input placeholder="密码" type="password" name='password' required>
             </div>
        </div>
        <div class=" mgz bd">
            <input type="submit" class="dlz cen xi32 bai" value="登录" name="submit" style="width: 45.5%;margin-left:3%;background-color: #5cb85c">
            <a href="<?php  echo $this->createMobileUrl('FindPass')?>" class="dlz cen xi32 bai" style="width: 45.5%;display:inline-block;margin-left:3%;"> 
                找回密码
            </a>
        </div>
</body>


</html>
