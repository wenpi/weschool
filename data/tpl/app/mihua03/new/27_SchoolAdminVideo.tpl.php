<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
<style>
  .bg-gradient{
    background-color: rgba(51,203,213,0.8);
    background-image: none;
  }
</style>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-no-scroll="1" data-easing="ease-out-quint">
        <div class="w-container">
          <nav class="w-nav-menu nav-menu bg-gradient" role="navigation">
              <div class="nav-menu-header">
                <div class="logo"><?php  echo $_SESSION['school_name'];?></div>
              </div>
              <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("school_home")?>" data-load="1">
                <div class="icon-list-menu">
                  <div class="icon ion-ios-home-outline"></div>
                </div>
                <div class="nav-menu-titles">首页</div>
              </a>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
            </nav>    

          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title">视频广场</div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div> 
      </div>
      <div class="body">
        <div class="news-container item-new">
          <div>
            <div class="text-new no-borders">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
              <div>
                <h2 class="title-new"><?php  echo $row['video_name'];?>  <a class="title_new_edit" href="<?php  echo $this->createMobileUrl("schoolAdminVideoEdit",array("id"=>$row['video_id']))?>">&nbsp;&nbsp;<span class="icon ion-compose"></span> &nbsp;&nbsp; </a> </h2>
                <div class="separator-button"> </div>
                    <?php  if($row['video_type']==1) { ?>
                    <div class="w-embed w-video">
                    <?php  if($row['rmtp']) { ?>
                    <object width='100%' height='100%' 
                            id='StrobeMediaPlayback' name='StrobeMediaPlayback' 
                            type='application/x-shockwave-flash' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' >
                            <param name='movie' value='swfs/StrobeMediaPlayback.swf' /> <param name='quality' value='high' /> 
                            <param name='bgcolor' value='#000000' /> 
                            <param name='allowfullscreen' value='true' /> 
                            <param name='flashvars' value= '&src=<?php  echo $row['video_url'];?>&autoHideControlBar=true&streamType=live&autoPlay=false&verbose=true'/>
                            <embed src='<?php echo MODULE_URL;?>style/swfs/StrobeMediaPlayback.swf' width='100%' height='100%' 
                                    id='StrobeMediaPlayback' quality='high' bgcolor='#000000' name='StrobeMediaPlayback'
                                    allowfullscreen='true' pluginspage='http://www.adobe.com/go/getflashplayer'
                                      flashvars='&src=<?php  echo $row['video_url'];?>&autoHideControlBar=true&streamType=live&autoPlay=false&verbose=true' 
                                      type='application/x-shockwave-flash'> 
                            </embed>
                  </object>    
                  <?php  } else { ?>
                      <video controls="" autoplay="" webkit-playsinline="webkit-playsinline" x-webkit-airplay="allow" width="100%"      height="100%" 
                            preload="auto" poster="<?php  echo $_W['attachurl'];?>/<?php  echo $row['video_img'];?>" 
                            src="<?php  echo $row['video_url'];?>">
                    </video> 
                  <?php  } ?>
                  <?php  } else { ?>
                      <div class="w-embed w-video" style="padding-top: 56.276%;">
                      <?php  echo htmlspecialchars_decode($row['html_content']); ?>
                  <?php  } ?>                
                </div>
                <div class="separator-bottom"></div>
              </div>
            <?php  } } ?>
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