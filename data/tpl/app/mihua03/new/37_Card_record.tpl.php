<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<body  ng-controller='ShowController'>
<div class='class_week'>
    <div class="title">选择时间</div>
    <div>
        <ul>
            <?php  if(is_array($data_list)) { foreach($data_list as $row) { ?>
                <a href="<?php  echo $this->createMobileUrl('card_record',array('week'=>$row['week']) )?>">
                <li class="<?php  echo $row['class'];?>">星期<br><?php  echo $row['week'];?><br><?php  echo $row['date'];?></li>
            <?php  } } ?>
            <div class='clear'></div>
        </ul>
    </div>
</div>
<div class="class_week">
    <div class="title">选择时间</div>
    <div class="record_list">
        <div class="record_info">
            <div class="up">
                全天<br>上学
            </div>
            <div class="up_info  <?php  if($in_result) { ?> font_green <?php  } else { ?> font_red <?php  } ?>">
              <?php  if($in_result) { ?> 正常 <?php  } else { ?> 异常 <?php  } ?>
            </div>
        </div>
        <div class="record_info">
            <div class="out">
                全天<br>放学
            </div>
            <div class="out_info  <?php  if($out_result) { ?> font_green <?php  } else { ?> font_red <?php  } ?>">
              <?php  if($out_result) { ?> 正常 <?php  } else { ?> 异常 <?php  } ?>
            </div>            
        </div>
            <div class='clear'></div>
    </div>
</div>
   <?php  if($in_result) { ?> 
   <?php  if(is_array($in_result)) { foreach($in_result as $row) { ?>
   <div class="class_week">
         <div class="title">进校打卡：<?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?></div>
         <div>
             <img src='<?php  echo $row['img_url'];?>'>
         </div> 
    </div> 
    <?php  } } ?>
<?php  } ?>
   <?php  if($out_result) { ?> 
   <?php  if(is_array($out_result)) { foreach($out_result as $row) { ?>
   <div class="class_week">
         <div class="title">离校打卡：<?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?></div>
         <div>
             <img src='<?php  echo $row['img_url'];?>'>
         </div> 
    </div> 
    <?php  } } ?>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>