<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "预约结果-".$_SESSION['school_name']?>
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
            <a class="w-tab-link w-inline-block toolbar-top-button w--current " data-w-tab="Tab 1" href="<?php  echo $this->createMobileUrl('applist');?>">
              <div>预约活动</div>
            </a>
            <a class="w-tab-link  w-inline-block toolbar-top-button w--current " data-w-tab="Tab 2"  >
              <div>预约结果</div>
            </a>
          </div>
		<div class="w-tab-content tabs-content" style="background-color:#fff;padding-top:20px;">
            <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 2">
                <ul class="ul-list focus-list" id="focus-list" style='padding-left:0'>
                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <li>
                    <a href=" "><b><strong style="color:#ff0033;display:inline-block;float:left;">【<?php  if($row['status']==0) { ?>默认通过<?php  } else if($row['status']==2) { ?>未通过<?php  } ?>】</strong>
                        <b style="color:#333"><?php  echo $row['my_course'];?></b></b>
                        <?php  if($row['reason']) { ?>
                            <p style="color:#333">&nbsp;&nbsp;<?php  echo $row['reason'];?></p>
                        <?php  } ?>
                        </a>
                        <p class="p-btm"><time><?php  echo date("Y-m-d",$row['addtime']);?></time></p>              
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