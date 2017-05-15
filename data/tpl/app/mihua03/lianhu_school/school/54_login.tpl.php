<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body style="height: 100%">
  <section class="w-section mobile-wrapper" style="height: 100%">
    <div class="page-content bg-gradient" id="main-stack" data-scroll="0">
      <div class="body padding">
    	<?php  $bg_img = D('adv')->getUniacidAdvInfoKeyWord('admin_bd_logo');?>
      <div class="logo-login" <?php  if($bg_img) { ?> style="background-image: url(<?php  echo $_W['attachurl'];?><?php  echo $bg_img;?>);"<?php  } ?> ></div>
       <div class="logo font-white" >管理入口</div>
        <div class="bottom-section padding">
          <div class="w-form">
            <form  method='post' action="<?php  echo $this->createMobileUrl('school_bangding')?>">
              <div>
                <label class="label-form light" for="email-field">用户名</label>
                <input class="w-input input-form light" id="text-field" type="text" name="passport" data-name="text" required="required">
                <div class="separator-fields"></div>
              </div>
              <div>
                <label class="label-form light" for="email">密码</label>
                <div class="block-input-combined">
                  <input class="w-input input-form light left" id="password-field" type="password" name="password" data-name="password" required="required">
                  <!--<a class="right-input-link" href="forgot.html" data-load="1">Forgot Password</a>-->
                </div>
                <div class="separator-button-input"></div>
              </div>
              <input class="w-button action-button" type="submit" name='submit' value="绑定" data-wait="请稍等...">
              <!--<div class="separator-button"></div><a class="link-upper" href="signup.html" data-load="1">Don't have an account? <strong class="b-link">Sign Up</strong></a>-->
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>