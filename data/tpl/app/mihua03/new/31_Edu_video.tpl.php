<?php defined('IN_IA') or exit('Access Denied');?> <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/normalize.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/framework.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/styles.css">
  <link rel="stylesheet"        type="text/css"     href="<?php echo MODULE_URL;?>/style/app/css/chart.css">
  <link rel="shortcut icon"     type="image/x-icon" href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link href="<?php echo MODULE_URL;?>/style/app/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
  <link rel="apple-touch-icon"   href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">

  <body style="background-color: whitesmoke;">
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack" style="background-color:whitesmoke">
       <div   class="body"   style="padding-top:0px;">
        <div class="news-container item-new">
          <div>
            <div class="grey-header">
              <h2 class="grey-heading-title">视频列表</h2>
            </div>
            <div class="text-new no-borders">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
              <div >
                <h2 class="title-new"><?php  echo $row['list_name'];?></h2>
                 <div class="separator-fields"></div>
                 <p class="description-new"><?php  echo $row['list_intro'];?></p>
                <div class="separator-button"> </div>
                    <?php  if($row['list_src_type']==0) { ?>
                    <div class="w-embed w-video">
                      <video onclick="lookVideo(<?php  echo $row['list_id'];?>)" controls="" autoplay="0" webkit-playsinline="webkit-playsinline" x-webkit-airplay="allow" width="100%" height="100%" 
                            preload="auto" poster="<?php  echo $_W['attachurl'];?>/<?php  echo $row['list_img'];?>" 
                            src="<?php  echo $row['list_src'];?>">
                    </video> 
                     <div class="separator-bottom"></div>
                    </div>
                  <?php  } else if($row['list_src_type']==1) { ?>
                  <div class="w-embed w-video w-iframe"  onclick="lookIframe(this,<?php  echo $row['list_id'];?>,'<?php  echo $row['list_src_content']; ?>')" style="padding-top: 56%;background-image:url(<?php  echo $_W['attachurl'];?>/<?php  echo $row['list_img'];?>)">
                        <iframe  class="embedly-embed" src="" scrolling="no" frameborder="0" allowfullscreen=""></iframe>
                  </div>
                  <?php  } else if($row['list_src_type']==2) { ?>
                  <a href="<?php  echo $row['list_src_content']; ?>">
                    <div class="w-embed w-video w-iframe" style="padding-top: 56%;background-image:url(<?php  echo $_W['attachurl'];?>/<?php  echo $row['list_img'];?>)">
                    </div>
                  </a>
                  <?php  } ?>    

            <?php  } } ?>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>
<style>
  .w-iframe{
    z-index:990;
  }
  .w-iframe iframe.embedly-embed{
    height:0px;
  }
</style>
  <script>
    function lookVideo(list_id){
      videoLook(list_id);
    }
    function lookIframe(obj,list_id,video_src){
      $(obj).find('iframe').attr('src',video_src);
      $(obj).find('iframe').css('height','100%');
      videoLook(list_id);
    }
    function videoLook(list_id){
      $.ajax({
        url:'<?php  echo $this->createMobileUrl('ajax')?>',
        type:'post',
        dataType:'json',
        data:{ac:'video_look',list_id:list_id},
        success:function(obj){

        }
      });
    }
  </script>
