<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = $_W['uniaccount']['name'].'-家校互通';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body style="height: 100%">
  <section class="w-section mobile-wrapper" style="height: 100%">
    <div class="page-content bg-gradient" id="main-stack" data-scroll="0" data-splash="2000" data-redirect="<?php  echo $this->createMobileUrl("school_home");?>">
      <div class="body padding">
       <?php  $bg_img = D('adv')->getUniacidAdvInfoKeyWord('admin_bd_logo');?>
        <div class="splash-logo" <?php  if($bg_img) { ?> style="background-image: url(<?php  echo $_W['attachurl'];?><?php  echo $bg_img;?>);"<?php  } ?>  >
          <div class="loading-icon splash">
            <div class="navbar-button-icon icon ion-load-d"></div>
          </div>
        </div>
        <div class="bottom-section padding text-centered">
          <div class="separator-big"></div>
          <div class="link-upper"><?php  echo $_W['uniaccount']['name'];?>-家校互通</div>
          <div class="separator-bottom"></div>
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