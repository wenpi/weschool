<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" style="height:45px;padding-top:0"  data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">在线报修</div>
            <?php  if($in_type['type']=='teacher') { ?>
                <a href="<?php  echo $this->createMobileUrl('teain')?>">
            <?php  } else { ?>
                <a href="<?php  echo $this->createMobileUrl('home')?>">
            <?php  } ?>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
          </a>
          <a class="w-inline-block navbar-button right" href="<?php  echo $this->createMobileUrl('sendRepair')?>">
            <div class="navbar-button-icon icon ion-ios-plus-empty"></div>
          </a>
        </div>
      </div>
      <div class="body"   style="padding-top:45px;">
        <ul class="list list-messages">
          <?php  if(!$list) { ?>
            <div class="middle_botton">暂无数据</div>
          <?php  } else { ?>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="list-message" data-ix="list-item">
                    <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('lookMyRepair',array("id"=>$row['repair_id']) )?>" data-load="1">
                    <div class="w-clearfix column-left">
                        <div class="image-message">
                            <?php  if($row['img_list']) { ?>
                                <div style="background-image: url(<?php  echo $this->imgFrom($row['img_list']['0']);?>);width:50px;height:50px;" class="background_img"></div>
                            <?php  } ?>
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="message-title"><?php  echo $row['repair_title'];?></div>
                        <div class="message-text"> <?php  echo $row['repair_content'];?></div>
                        <div class="message-text" style="color:#ff0033;"><?php  if($row['do_status']) { ?><?php  echo $row['do_status'];?><?php  } else { ?>暂无回复<?php  } ?></div>
                    </div>
                    </a>
                </li>
            <?php  } } ?>
            <?php  } ?>
        </ul>
      </div>
    </div>

  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
  <?php  if($in_type['type']=='teacher') { ?>
    <style>
        .navbar{
            background-color: rgba(51,204,102,0.7) !important;
        } 
    </style>
  <?php  } ?>
</body>
</html>