<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body  ng-controller='ShowController'>
<div class='class_week'>
    <div class="title">选择时间</div>
    <div>
        <ul>
            <?php  if(is_array($data_list)) { foreach($data_list as $row) { ?>
                <a href="<?php  echo $this->createMobileUrl('card_record',array('week'=>$row['week']) )?>">
                <li class="<?php  echo $row['class'];?>">星期<br><?php  echo $row['week'];?><br><?php  echo $row['date'];?></li>
                </a>
            <?php  } } ?>
            <div class='clear'></div>
        </ul>
    </div>
</div>
<?php  if($sign_average_temp) { ?>
<div class="class_week">
    <div class="sign_average_temp">
        今日平均体温：<span><?php  echo $sign_average_temp;?></span>
        </div>
        <div class='clear'></div>
    </div>
</div>
<?php  } ?>
   <?php  if($in_result) { ?> 
   <div class="class_week">
         <div class="title">进校打卡</div>
       <?php  if(is_array($in_result)) { foreach($in_result as $row) { ?>

         <div>
             <span class="card_time">
                 <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?>
             </span>
             <img src='<?php  echo $row['img_url'];?>' onclick="displayImage('<?php  echo $row['img_url'];?>')">
             <?php  if($row['img_url2']) { ?>
                <img src='<?php  echo $row['img_url2'];?>' onclick="displayImage('<?php  echo $row['img_url2'];?>')">
             <?php  } ?>
         </div> 
    <?php  } } ?>
    </div> 
<?php  } ?>
<?php  if($out_result) { ?> 
   <div class="class_week">
         <div class="title">离校打卡</div>
        <?php  if(is_array($out_result)) { foreach($out_result as $row) { ?>
         <div>
             <span class="card_time">
                 <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?>
             </span>
             <img src='<?php  echo $row['img_url'];?>' onclick="displayImage('<?php  echo $row['img_url'];?>')">
             <?php  if($row['img_url2']) { ?>
                <img src='<?php  echo $row['img_url2'];?>' onclick="displayImage('<?php  echo $row['img_url2'];?>')">
             <?php  } ?>
         </div> 
        <?php  } } ?>
    </div> 
<?php  } ?>
<?php  if($other_result) { ?> 
   <div class="class_week">
         <div class="title">异常打卡</div>
        <?php  if(is_array($other_result)) { foreach($other_result as $row) { ?>
         <div>
             <span class="card_time">
                 <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?>
             </span>
             <img src='<?php  echo $row['img_url'];?>' onclick="displayImage('<?php  echo $row['img_url'];?>')">
              <?php  if($row['img_url2']) { ?>
                <img src='<?php  echo $row['img_url2'];?>' onclick="displayImage('<?php  echo $row['img_url2'];?>')" >
             <?php  } ?>
         </div> 
        <?php  } } ?>
    </div> 
<?php  } ?>
<script>
    function displayImage(src){
        var img_urls    = [];
        img_urls[0] = src;
        img_urls.pop()
        wx.previewImage({
            current: src,
            urls: img_urls
        });
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>