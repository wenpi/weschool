<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_left', TEMPLATE_INCLUDEPATH)) : (include template('school/app_left', TEMPLATE_INCLUDEPATH));?>
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $simple_title;?></div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="news-mask"></div>
      <div class="news-container">
        <ul class="w-clearfix list-news">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="list-item-new">
                    <a class="w-inline-block link-blog-list" href="<?php  echo $this->createMobileUrl("school_notice_content",array('id'=>$row['msg_id']));?>" data-load="1">
                    <?php  if($row['img']) { ?>
                        <div class="image-new" style="background-image:url(<?php  echo $_W['attachurl'];?><?php  echo $row['img'];?>)"></div>
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
      <?php  $page_controller="school_notice";?>
      <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_page', TEMPLATE_INCLUDEPATH)) : (include template('school/app_page', TEMPLATE_INCLUDEPATH));?>
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