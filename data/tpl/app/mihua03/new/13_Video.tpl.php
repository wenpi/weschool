<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "教室监控-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="body" style="padding-top:0px;">
        <div class="news-container item-new">
          <div>
            <div class="grey-header">
              <h2 class="grey-heading-title">视频列表</h2>
            </div>
            <div class="text-new no-borders">
              <?php  if($out_time_list && !$video_list) { ?>
                    <div style="width:100%;text-align:center">抱歉，请在每天的<code><?php  echo $out_time_list[0]['begin_time'];?></code>——<code><?php  echo $out_time_list[0]['end_time'];?></code>观看
                    </div>
            <?php  } ?>

            <?php  if(is_array($video_list)) { foreach($video_list as $row) { ?>
              <div>
                <h2 class="title-new"><?php  echo $row['video_name'];?></h2>
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>