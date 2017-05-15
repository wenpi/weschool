<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  echo $intro;?>详情-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">    
</head>

<body>
<div class="wrap" style="margin-bottom:60px;width:100%;over-flow:hidden">
    <div class="neirong">
   <?php  if($home_work==1) { ?>
        <h1><?php  echo date("m-d",$result['add_time']);?>日<?php  echo $result['course_name'];?>作业</h1>
        <div class="other"><u>发布人：<?php  if($result['teacher_name']) { ?><?php  echo $result['teacher_name'];?><?php  } else { ?>管理员<?php  } ?></u></div>
                <br>
                <?php  $imgs = unserialize($result['img']);?>
                <p>
                <?php  if($imgs) { ?>
                     <?php  $img_list =S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                     <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                        <img src='<?php  echo $row;?>' style="width:90%;margin-left:5%;margin-top:10px;">
                     <?php  } } ?>
                </p>
                <?php  } ?>
                <?php  if($result['voice']) { ?>
                        <div style="width:100%;text-align:center">
                            <?php  echo  $this->echoVoiceUrl($result['voice']);?>
                        </div>    
                <?php  } ?>   
               <?php  echo htmlspecialchars_decode($result['content'])?>  
   <?php  } else if($record==1) { ?>
         <h1><?php  echo $result['word'];?></h1>
         <h3><?php  echo date("m-d H:i:s",$result['addtime']);?></h3>
        <div class="other"><u><?php  if($result['teacher_name']) { ?><?php  echo $result['teacher_name'];?><?php  } else { ?>管理员<?php  } ?></u></div>
                <br>
                <?php  $imgs = json_decode($result['imgs'],1);?>
                <?php  if($imgs) { ?>
                <p>
                     <?php  $img_list =S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                     <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                        <img src='<?php  echo $row;?>' style="width:90%;margin-left:5%;margin-top:10px;">
                     <?php  } } ?>
                </p>
                <?php  } ?>
                <?php  if($result['voice']) { ?>
                        <div style="width:100%;text-align:center">
                            <?php  echo  $this->echoVoiceUrl($result['voice']);?>
                        </div>    
                <?php  } ?>                
                <?php  echo htmlspecialchars_decode($result['content'])?>    
   
   <?php  } else { ?>
   <h1><?php  echo $result['line_title'];?></h1>
    <div class="other"><u><?php  if($result['teacher_realname']) { ?><?php  echo $result['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></u>|<time><?php  echo date("Y-m-d H:i:s",$result['addtime']);?></time>|<i><a href=" ">查看(<?php  echo $result['line_look'];?>)</a></i></div>
        <table cellpadding="0" cellspacing="0" class="neirong-box" >
            <tbody>
              <tr>
            <td id="article_content">
                <?php  $imgs = json_decode($result['imgs'],1);?>
                <?php  if($imgs) { ?>
                <p>
                     <?php  $img_list =S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                     <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                        <img src='<?php  echo $row;?>' style="width:90%;margin-left:5%;margin-top:10px;">
                     <?php  } } ?>
                </p>
                <?php  } ?>
                <?php  if($result['voice']) { ?>
                        <br>
                        <div style="width:100%;text-align:center">
                            <?php  echo  $this->echoVoiceUrl($result['voice']);?>
                        </div>    
                <?php  } ?> 
                <?php  echo htmlspecialchars_decode($result['line_content'])?></td></tr>
            </tbody>
        </table>
    <?php  } ?>
    </div>
</div>
<script type="text/javascript">
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
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>