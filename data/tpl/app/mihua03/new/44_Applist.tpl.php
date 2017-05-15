<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "预约活动-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/new_style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui2.css?<?php  echo time();?>" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
 <body>
 <div class="body" style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-menu top-buttons">
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1">
              <div>预约活动</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button" data-w-tab="Tab 2"  href="<?php  echo $this->createMobileUrl('Applist_result');?>">
              <div>预约结果</div>
            </a>
          </div>
		<div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
            <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                <ul class="ul-list focus-list" id="focus-list" style='padding-left:0'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <li>
                        <a href="<?php  echo $this->createMobileUrl('appointment_article',array('op'=>$row['appointment_id']));?>"><b>
                            <strong style="color:#ff0033;display:inline-block;float:left;">【 <?php  if($row['status']==1 && $row['appointment_end']>time()  && time()>$row['appointment_start']) { ?>进行中<?php  } else if($row['status']==1 && $row['appointment_end']< time() ) { ?>已结束 <?php  } else if($row['status']==1 && $row['appointment_start']>time() ) { ?>未开始<?php  } ?> 】</strong> <b style="color:#333"><?php  echo $row['appointment_name'];?></b>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $this->clear_html_short($row['appointment_intro']);?></p>
                        </a>
                        <p class="p-btm"><u><?php  if($row['appointment_type_limit']==0) { ?>全校<?php  } else if($row['appointment_type_limit']==1) { ?>年级<?php  } else if($row['appointment_type_limit']==2) { ?>班级<?php  } ?></u>|<time><?php  echo date("m-d H:i",$row['appointment_start']);?>--<?php  echo date("m-d H:i",$row['appointment_end']);?></time>|<i>
                        <a href="#">申请数(<?php  echo $row['appointment_join_num'];?>)</a></i></p>              
                    </li>        
                <?php  } } ?>
                </ul>                
            </div>           
        </div>
        </div>
    </div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>