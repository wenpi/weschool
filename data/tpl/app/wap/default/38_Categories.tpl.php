<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body style="background-color: whitesmoke;">
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack" style="background-color:whitesmoke">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $title;?></div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <a href="<?php  if($_GPC['cid']) { ?><?php  echo $this->createMobileUrl('wapCategories')?><?php  } else { ?><?php  echo $this->createMobileUrl('wapHome')?><?php  } ?>">
                <div class="bar-home-icon top"></div>
                <div class="bar-home-icon middle"></div>
                <div class="bar-home-icon bottom"></div>
              </a>
            </div>
          </div>
          </div>
       <div class="body">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-content tabs-content">
                	<?php  if(is_array($article_class)) { foreach($article_class as $k => $v) { ?>
                    <div class="group-block ">
                      <a class="w-inline-block" href="<?php  if($_GPC['cid']) { ?><?php  echo $this->createMobileUrl('wapArticle',array("cid"=>$v['class_id']) )?><?php  } else { ?><?php  echo $this->createMobileUrl('wapCategories',array("cid"=>$v['class_id']) )?> <?php  } ?>" data-load="1">
                        <div class="group-image" style="background-image:url('<?php  echo $_W['attachurl'];?><?php  echo $v['class_img'];?>')"></div>
                        <div class="group-title">
                          <div class="title-text"><?php  echo $v['class_name'];?> </div>
                        </div>
                      </a>
                    </div>
            	    <?php  } } ?> 
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