<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  echo $info['class_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/line_css.css?<?php echo TIMESTAMP;?>">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo MODULE_URL;?>style/js/modernizr.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/jquery.lazyload.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/main.js"></script>
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<link href="<?php echo MODULE_URL;?>template/mobile/style/user.min.css" rel="stylesheet" type="text/css" />
	</head>
<body  style="background-color:#fff">
<section style='background:#fff;margin-bottom:60px;'>
<div class="wrap" id="list" style="margin-top:20px;">
          <?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
      		<ul>
            <li class="box" >
            		<div class="author">
                    		<a href="#"><img src="<?php  if($row['teacher_id']) { ?><?php  echo $_W['attachurl'];?><?php  echo $this->getTeacherImg($row['teacher_id']);?><?php  } else { ?><?php echo MODULE_URL;?>icon.jpg<?php  } ?>"></a>
                            <p class="author_name"><?php  if($row['teacher_realname']) { ?><?php  echo $row['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></p>
                            <p class="author_time">&nbsp;&nbsp;时间：<?php  echo date("Y-m-d H:i:s",$row['addtime']);?></p>
                    </div>
                    <div class="topic" style='margin-top:-10px;'>
                           <a href='<?php  echo $this->createMobileUrl('line_article',array('wid'=>$row['work_id']));?>'>
                                <p><?php  echo $this->clear_html_short($row['content']);?>......</p>
                          </a>
                          <div onclick='displayImage(this)'>
                                    <?php  echo $this->decodeLineImgs($row['img']);?>
                                    <div class='clear'></div>
                          </div>   
                         <?php  if($row['voice']) { ?>
                         <br>
                         <div><?php  echo  $this->echoVoiceUrl($row['voice']);?></div>    
                         <?php  } ?>                             
                   </div>
            </li>           
            </ul> 
            <?php  } } ?>   
</div>
</section>
<script>
  function displayImage(obj){
      var img_urls=[];
      var img_current='';
        if($(obj).find('.lazy').length>0){
             img_current=$(obj).find('.lazy').attr('src');
             img_urls=[img_current];
        }
        if($(obj).find('div').length>0){
                img_current=$(obj).find('div').eq(0).attr('data-img');
                $.each($(obj).find('div'),function(i,e){
                    img_urls.push($(this).attr('data-img'));
                });
        }
        img_urls.pop()
        wx.previewImage({
        current: img_current,
        urls: img_urls
        });
  }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('record_nav', TEMPLATE_INCLUDEPATH)) : (include template('record_nav', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
