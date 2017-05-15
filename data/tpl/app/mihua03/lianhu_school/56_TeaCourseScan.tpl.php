<?php defined('IN_IA') or exit('Access Denied');?><?php  $title = "独立课程-".$_SESSION['school_name']?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/weui.min.css"     rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/new_style.css"    rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/weui2.css"        rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/weui_example.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css"     rel="stylesheet" type="text/css" />
<body style="background-color: #fff">
      <div class="body"     style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-content tabs-content" style="background-color:#fff;">
               <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                    <ul class="list list-messages" style="border-top:0px;">
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                            <li style="border-bottom:1px solid #e7e7e9;" >
                                <div class="weui_media_box weui_media_text">
                                    <h4 class="weui_media_title"><?php  echo $row['course_info']['course_name'];?> </h4>
                                    <p class="weui_media_desc button_list">
                                       <button class="weui_btn weui_btn_mini weui_btn_primary">课时数：<?php  echo $row['course_info']['nums'];?></button>
                                        <a href="<?php  echo $this->createMobileUrl("teaCourseScanCode",array('id'=>$row['course_id'] ));?>"> 
                                                <button class="weui_btn weui_btn_mini weui_btn_warn">获取二维码</button>
                                        </a>
                                        <div style="clear:both"></div>
                                    </p>
                                </div> 
                            </li>                
                        <?php  } } ?>
                    </ul>
                </div>
            </div>

        </div>
      </div>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
