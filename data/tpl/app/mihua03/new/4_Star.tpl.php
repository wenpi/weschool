<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '星星评价';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
      <div class="weui_panel_bd" >
          <?php  if(is_array($list)) { foreach($list as $row) { ?>
          <a href="#" class="weui_media_box weui_media_appmsg">
                <div class="weui_media_hd">
                    <img class="weui_media_appmsg_thumb" src="<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>" >
                </div>
                <div class="weui_media_bd">
                    <h4 class="weui_media_title"><?php  if($row['teacher_id']) { ?><?php  echo $this->teacherName($row['teacher_id'])?><?php  } else { ?>管理员<?php  } ?></h4>
                    <p class="weui_media_desc" style="color:#ff0033">星星数：<?php  echo $row['star_num'];?></p>
                    <p class="weui_media_desc"><?php  echo $this->clear_html_short($row['star_title']);?></p>
                </div>
            </a>
            <?php  } } ?>    
            </div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>