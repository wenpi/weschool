<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>教室监控-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <?php  if($out_time_list && !$video_list) { ?>
    <div style="width:100%;text-align:center">抱歉，请在每天的<code><?php  echo $out_time_list[0]['begin_time'];?></code>——<code><?php  echo $out_time_list[0]['end_time'];?></code>观看
   </div>
  <?php  } ?>
  <?php  if(is_array($video_list)) { foreach($video_list as $vo) { ?>
  <?php  if($vo['video_type']==1) { ?>
   <?php  if($vo['rmtp']) { ?>
    <object width='100%' height='100%' 
            id='StrobeMediaPlayback' name='StrobeMediaPlayback' 
            type='application/x-shockwave-flash' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' >
            <param name='movie' value='swfs/StrobeMediaPlayback.swf' /> <param name='quality' value='high' /> 
            <param name='bgcolor' value='#000000' /> 
            <param name='allowfullscreen' value='true' /> 
            <param name='flashvars' value= '&src=<?php  echo $vo['video_url'];?>&autoHideControlBar=true&streamType=live&autoPlay=false&verbose=true'/>
            <embed src='<?php echo MODULE_URL;?>style/swfs/StrobeMediaPlayback.swf' width='100%' height='100%' 
                     id='StrobeMediaPlayback' quality='high' bgcolor='#000000' name='StrobeMediaPlayback'
                     allowfullscreen='true' pluginspage='http://www.adobe.com/go/getflashplayer'
                      flashvars='&src=<?php  echo $vo['video_url'];?>&autoHideControlBar=true&streamType=live&autoPlay=false&verbose=true' 
                      type='application/x-shockwave-flash'> 
            </embed>
   </object>    
   <?php  } else { ?>
      <video controls="" autoplay="" webkit-playsinline="webkit-playsinline" x-webkit-airplay="allow" width="100%"      height="100%" 
            preload="auto" poster="<?php  echo $_W['attachurl'];?>/<?php  echo $vo['video_img'];?>" 
            src="<?php  echo $vo['video_url'];?>">
     </video> 
   <?php  } ?>
   <?php  } else { ?>
      <div style="width:100%;overflow:hidden" id='video_html_content'>
      <?php  echo htmlspecialchars_decode($vo['html_content']); ?>
    </div>
    <script>
      $(function(){
          $("#video_html_content").find('iframe').width('100%');
      });
    </script>
   <?php  } ?>
    <br>   
  <?php  } } ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
  </body>