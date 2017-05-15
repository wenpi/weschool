<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $title;?></div>
          <a class="w-inline-block navbar-button" href="<?php  echo $this->createMobileUrl('wapArticle',array("cid"=>$result['class_id']) )?>" data-load="1">
            <div class="navbar-button-icon icon ion-ios-close-empty"></div>
          </a>
        </div>
      </div> 
      <div class="body">
        <div class="news-container item-new">
          <div>
            <div class=" hero-slider"  data-duration="500" data-infinite="1" data-nav-spacing="5" data-delay="2500" data-autoplay="1">
              <div class="w-slider-mask">
                <div class="w-slide slide" style="background-image:url('<?php  echo $_W['attachurl'];?><?php  echo $result['artice_img'];?>')"></div>
              </div>
  
              <div class="w-slider-nav w-round slider-bullets"></div>
            </div>
            <div class="text-new no-borders">
              <div class="separator-fields"></div>
              <h2 class="title-new"><?php  echo $result['article_title'];?></h2>
              <div class="separator-fields"></div>
              <p class="description-new"> <?php  echo htmlspecialchars_decode ($result['article_content']);?> </p>
              <div class="separator-button"></div>
              <div class="separator-button"></div>
              <div class="separator-bottom"></div>
            </div>
          </div>
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