<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
		<title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/template/xiaoye/css/content_css.css?<?php  echo time();?>">
		<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
    <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
</head>

<body style="background: #fafafa;">
<div class="z_main">
  <div class="z_riqi">
    <div class="z_riqil datepicker " id="input_01" title='select_time'>
      <?php  echo $get_year;?>年<br/>
      <?php  echo $get_month;?>月 
    </div>
    <div class="z_leftl">
      <ul>
            <?php  if(is_array($out_time)) { foreach($out_time as $key => $row) { ?>
                <li class="z_ri">
                <p  <?php  if($key!=0) { ?> class="p2" <?php  } ?> ><?php  echo $row['week'];?></p>
                <p  class="<?php  if($in_time == $row['time']) { ?>p4<?php  } ?>"><a href="<?php  echo $this->createMobileUrl('card_record',array('time'=>$row['time']) )?>" ><?php  echo date("d",$row['time'])?></a></p>
                </li>
            <?php  } } ?>
      </ul>
    </div>
  </div>
  <div class="z_center">
   <?php  if($in_result) { ?> 
       <?php  if(is_array($in_result)) { foreach($in_result as $row) { ?>
            <div class="z_jin">
            <div class="z_jin1" id='img_list_<?php  echo $row['record_id'];?>' > 
                <img src="<?php  echo $row['img_url'];?>"  onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url'];?>')">
                <?php  if($row['img_url2'] ) { ?>
                <img src="<?php  echo $row['img_url2'];?> " onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url2'];?>')">
                <?php  } ?>
            </div>
            <div class="z_jin2"> <span>打卡时间： <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?></span> 
            <?php  if($row['signTemp']) { ?>
            <span>体温：<span class="<?php  if($row['signTemp'] <= 37.1) { ?> p6 <?php  } else { ?> z_ri <?php  } ?>"><?php  echo $row['signTemp'];?></span></span> </div>
            <?php  } ?>
            <div class="z_jin3 p4">进</div>
            </div>
    <?php  } } ?>
   <?php  } ?>
   <?php  if($out_result) { ?> 
       <?php  if(is_array($out_result)) { foreach($out_result as $row) { ?>
            <div class="z_jin">
            <div class="z_jin1" id='img_list_<?php  echo $row['record_id'];?>' > 
                <img src="<?php  echo $row['img_url'];?>"  onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url'];?>')">
                <?php  if($row['img_url2'] ) { ?>
                <img src="<?php  echo $row['img_url2'];?> " onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url2'];?>')">
                <?php  } ?>
            </div>
            <div class="z_jin2"> <span>打卡时间： <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?></span> 
            <?php  if($row['signTemp']) { ?>
            <span>体温：<span class="<?php  if($row['signTemp'] <= 37.1) { ?> p6 <?php  } else { ?> z_ri <?php  } ?>"><?php  echo $row['signTemp'];?></span></span> </div>
            <?php  } ?>
            <div class="z_jin3 p4">出</div>
            </div>
    <?php  } } ?>
   <?php  } ?>
    <?php  if($other_result) { ?> 
       <?php  if(is_array($other_result)) { foreach($other_result as $row) { ?>
            <div class="z_jin">
              <div class="z_jin1" id='img_list_<?php  echo $row['record_id'];?>' > 
                  <img src="<?php  echo $row['img_url'];?>"  onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url'];?>')">
                  <?php  if($row['img_url2'] ) { ?>
                  <img src="<?php  echo $row['img_url2'];?> " onclick="displayImage('img_list_<?php  echo $row['record_id'];?>','<?php  echo $row['img_url2'];?>')">
                  <?php  } ?>
              </div>
            <div class="z_jin2"> 
                <span>打卡时间： <?php  if(!$row['play_card_time']) { ?><?php  echo date("H:i:s",$row['add_time'])?> <?php  } else { ?><?php  echo date("H:i:s",$row['play_card_time'])?><?php  } ?></span> 
                <?php  if($row['signTemp']) { ?>
                  <span>体温：<span class="<?php  if($row['signTemp'] <= 37.1) { ?> p6 <?php  } else { ?> z_ri <?php  } ?>"><?php  echo $row['signTemp'];?></span></span> 
                <?php  } ?>
              </div>
              <div class="z_jin3 card_not" >异</div>
           </div>
    <?php  } } ?>
  <?php  } ?> 
  <?php  if(!$in_result && !$out_result && !other_result) { ?>
         <div class="z_jin">
            <div class="z_jin1">  </div>
            <div class="z_jin2"> </span> 
            <div class="z_jin3 card_not" >无</div>
          </div> 
  <?php  } ?>
    <div class="jie"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/2.png"><span>异常</span><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/1.png"><span>正常</span></div>
    <div id="container"></div>
  </div>
</div>
</div>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
  <?php  $url = $this->createMobileUrl("card_record");?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/timeDate', TEMPLATE_INCLUDEPATH)) : (include template('../new/timeDate', TEMPLATE_INCLUDEPATH));?>
</body>
</html>