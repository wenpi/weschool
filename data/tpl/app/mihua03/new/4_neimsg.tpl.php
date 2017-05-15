<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title   = '学校公告';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
 <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <body>
  <section class="w-section mobile-wrapper" >
    <div class="page-content" id="main-stack">
      <div class="w-nav " data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        </div>
      </div>
      <div class="news-mask" ></div>
      <div class="news-container" style="margin-top:10px;">
        <ul class="w-clearfix list-news" style="margin-bottom:60px;">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="list-item-new">
                    <a class="w-inline-block link-blog-list" href="<?php  echo $this->createMobileUrl("msg_content",array('id'=>$row['msg_id']));?>" data-load="1">
                    <?php  if($row['img']) { ?>
                        <div class="image-new" style="background-image:url(<?php  echo $this->imgFrom($row['img'])?>)"></div>
                    <?php  } ?>
                    <div class="text-new">
                        <h2 class="title-new"><?php  echo $row['msg_title'];?></h2>
                        <p class="description-new"><?php  echo S('fun','formatLimitContent',array($row['msg_content']));?></p>
                    </div>
                    </a>
                </li>           
            <?php  } } ?>
        </ul>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
<?php  if($_SESSION['teacher_mobile']) { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>