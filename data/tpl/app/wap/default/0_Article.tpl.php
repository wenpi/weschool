<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $class_info['class_name'];?></div>
          <a class="w-inline-block navbar-button" href="<?php  echo $this->createMobileUrl('wapCategories',array('cid'=>$class_info['pid']))?>" data-load="1">
            <div class="navbar-button-icon icon ion-ios-close-empty"></div>
          </a>
        </div>
      </div>

      <div class="news-mask"></div>
      <div class="news-container">
        <ul class="w-clearfix list-news">
            <?php  if(is_array($article_list)) { foreach($article_list as $row) { ?>
                <li class="list-item-new">
                    <a class="w-inline-block link-blog-list" href="<?php  echo $this->createMobileUrl('wapContent',array("aid"=>$row['list_id']) )?>" data-load="1">
                    <div class="image-new" style="background-image:url('<?php  echo $_W['attachurl'];?><?php  echo $row['artice_img'];?>')"></div>
                    <div class="text-new">
                        <h2 class="title-new"><?php  echo $row['article_title'];?></h2>
                        <p class="description-new"><?php  echo $row['article_intro'];?></p>
                    </div>
                    </a>
                </li>

            <?php  } } ?>

        </ul>
      </div>
      <!--<div class="w-clearfix options-new less-padding-sides-blog border-top">
        <a class="w-clearfix w-inline-block small-button icon-only grey" href="#">
          <div class="icon-button">
            <div class="icon ion-ios-arrow-left bigger"></div>
          </div>
        </a>
        <a class="w-clearfix w-inline-block small-button grey last right" href="#">
          <div class="icon-button bigger">
            <div class="icon ion-ios-arrow-right"></div>
          </div>
          <div class="text-button">NEXT</div>
        </a>
      </div>-->
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