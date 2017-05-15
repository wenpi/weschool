<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">  
  <link href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav " data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        </div>
      </div>
      <div class="news-mask" ></div>
      <div class="news-container" style="    margin-top: 10px; width: 100%;height: 100%;margin-bottom:60px;">
        <div>
                          <h2 class="title-new"><?php  echo $result['msg_title'];?></h2>
            <?php  if($result['img']) { ?>
                        <div class="image-new" style="background-image:url(<?php  echo $_W['attachurl'];?><?php  echo $result['img'];?>)"></div>
            <?php  } ?>
            <div class="text-new no-borders" style="padding:0px;padding-top:20px;">
              <div class="separator-fields"></div>
              <h2 class="title-new"><?php  echo $result['msg_title'];?></h2>
              <div class="separator-fields"></div>
              <p class="description-new">
                  <?php  echo htmlspecialchars_decode($result['msg_content']);?>
              </p>
              <div class="w-clearfix">
                <div class="w-widget w-widget-facebook social-block">
                </div>
                <div class="w-widget w-widget-twitter social-block">
                </div>
                <div class="w-widget w-widget-gplus social-block">
                </div>
              </div>
              <div class="separator-bottom"></div>
            </div>
          </div>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
<?php  if($_SESSION['teacher_mobile']) { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>