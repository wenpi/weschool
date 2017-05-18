<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '点评录';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/record_nav', TEMPLATE_INCLUDEPATH)) : (include template('../new/record_nav', TEMPLATE_INCLUDEPATH));?>
      <div class="weui_panel_bd" style="margin-top:50px;">
          <?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
          <a href="<?php  echo $this->createMobileUrl('line_article',array('wid'=>$row['work_id']));?>" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_hd">
                    <img class="weui_media_appmsg_thumb" src="<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>" >
                </div>
                <div class="weui_media_bd">
                    <h4 class="weui_media_title"><?php  if($row['teacher_realname']) { ?><?php  echo $row['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></h4>
                    <p class="weui_media_desc"><?php  echo $this->clear_html_short($row['content']);?>
                    </p>
                </div>
            </a>
            <?php  } } ?>    
            </div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>