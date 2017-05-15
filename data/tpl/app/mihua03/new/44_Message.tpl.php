<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div style="height:45px;padding-top:0;"  class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">校长信箱</div>
          <a href="<?php  echo $this->createMobileUrl('home')?>">
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
          </a>
          <a class="w-inline-block navbar-button right" href="<?php  echo $this->createMobileUrl('sendMessage')?>">
            <div class="navbar-button-icon icon ion-ios-plus-empty"></div>
          </a>
        </div>
      </div>
      <div class="body"  style="padding-top:45px;" >
        <ul class="list list-messages">
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li class="list-message" data-ix="list-item">
                <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('messageChat',array("id"=>$row['message_id']) )?>" data-load="1">
                <div class="w-clearfix column-left">
                     <div class="image-message background_img list_img"  style="background-image: url(<?php  echo $this->class_base->mobileGetAvatarByUid($row['send_uid']);?>)"></div>
                </div>
                <div class="column-right">
                    <div class="message-title"><?php  echo $row['title'];?></div>
                    <div class="message-text"> <?php  echo $row['message_content'];?></div>
                </div>
                </a>
            </li>
        <?php  } } ?>
        </ul>
      </div>
    </div>

  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>