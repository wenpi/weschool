<?php defined('IN_IA') or exit('Access Denied');?> <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
 <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <body style="background-color: whitesmoke;">
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack" style="background-color:whitesmoke">
       <div class="body" style="padding-top:0px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-content tabs-content">
                	<?php  if(is_array($list)) { foreach($list as $k => $v) { ?>

                       <?php  if($v['class_img']) { ?>

                    <div class="group-block" style="padding-left:4px;">

                    <?php  } else { ?>
                    <div class="" style="padding-left:4px;display:inline-block;width:100%;">
                 <?php  } ?>

                      <a class="w-inline-block" href="<?php  if($_GPC['cid']) { ?><?php  echo $this->createMobileUrl('edu_video',array("cid"=>$v['class_id']) )?><?php  } else { ?><?php  echo $this->createMobileUrl('edu_video_class',array("cid"=>$v['class_id']) )?> <?php  } ?>" data-load="1">
                      <?php  if($v['class_img']) { ?> 
                       <div class="group-image" style="background-image:url('<?php  echo $_W['attachurl'];?><?php  echo $v['class_img'];?>')"></div> 
                       <?php  } ?>
                        <div class="group-title">
                           <div class="title-text" style="text-align:left;padding-left:20px;"><?php  echo $v['class_name'];?> </div>
                        </div>
                      </a>
                    </div>
             <?php  } } ?> 
          </div>
        </div>
      </div>
    </div>
  </section>
<!--<?php  if($_SESSION['teacher_mobile']) { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>--!>
