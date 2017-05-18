<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/weui.min.css"     rel="stylesheet" type="text/css" />
<body style="background-color: #fff">
      <div class="body"     style="padding-top:0px;padding-bottom:60px;">
        <div class="w-tabs" data-duration-in="400" data-duration-out="400" data-easing="ease-out-quint">
          <div class="w-tab-content tabs-content" style="background-color:#fff;">
               <div class="w-tab-pane  w--tab-active tab-pane" data-w-tab="Tab 1">
                    <ul class="list list-messages" style="border-top:0px;">
                        <?php  if(is_array($scan_list)) { foreach($scan_list as $row) { ?>
                            <li style="border-bottom:1px solid #e7e7e9;" >
                                <div class="weui_media_box weui_media_text">
                                    <?php  $student_info = $this->getStudentInfo($row['student_id']);?>
                                    <h4 class="weui_media_title"><?php  echo $this->gradeName($student_info['grade_id'])?>-<?php  echo $this->className($student_info['class_id'])?>：<?php  echo $student_info['student_name'];?></h4>
                                    <p class="weui_media_desc button_list">
                                        课时数：<?php  echo $code_info['qrcode_num'];?>&nbsp;&nbsp;时间：<?php  echo date("Y-m-d H:i:s",$row['add_time']) ?>
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
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>