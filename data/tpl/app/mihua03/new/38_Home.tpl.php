<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
    <script src="<?php echo MODULE_URL;?>style/js/angular.min.js"></script>
    <script src="<?php echo MODULE_URL;?>style/js/new.js"></script>
    
<body  ng-controller='ShowController'>
<div class="weui_dialog_alert" ng-show='menuState.show' >
    <div class="weui_mask" ng-click="toggleMenu()" ></div>
    <div class="weui_dialog"  style="top:5%">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">切换学生</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access">
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                    <a class="weui_cell " href="<?php  echo $this->createMobileUrl('change_student',array('op'=>'post','sid'=>$row['student_id']) );?>" >
                        <div class="weui_cell_bd weui_cell_primary">
                            <p <?php  if($row['student_id']== $result['student_id']) { ?> style="color:red" <?php  } ?> > <?php  echo $row['student_name'];?></p>
                        </div>
                    </a>
                    <?php  } } ?>
                </div>
        </div>
        <?php  if(D('school')->getSchoolParams('much_class')) { ?>
            <div class="weui_dialog_hd"><strong class="weui_dialog_title">切换班级</strong></div>
            <div class="weui_dialog_bd">
                    <div class="weui_cells weui_cells_access">
                        <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                        <a class="weui_cell " href="<?php  echo $this->createMobileUrl('change_student',array('op'=>'class_post','sid'=>$result['student_id'],'class_id'=>$row['class_id'] ) );?>" >
                            <div class="weui_cell_bd weui_cell_primary">
                                <p <?php  if($row['class_id']==  $now_class_id ) { ?> style="color:red" <?php  } ?> > <?php  echo $row['class_name'];?></p>
                            </div>
                        </a>
                        <?php  } } ?>
                    </div>
            </div>
        <?php  } ?>
        <div class="weui_dialog_ft">
        </div>        
    </div>
</div>
<div class="weui_dialog_alert" ng-show='toggleImg.show' >
    <div class="weui_mask" ng-click="toggleImg()" ></div>
    <div class="weui_dialog"  >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">学生二维码</strong></div>
        <div class="weui_dialog_bd">
            <img src="<?php  echo $class_student->getStudentQrcode($result['student_id']);?>" style="width:200px;">
        </div>
            <div class="weui_dialog_ft">
                <br>
            </div>        
    </div>
</div>
<div class="m-box" >
    <div class='plus_student'>
        <a href="<?php  echo $this->createMobileUrl('add_student');?>"> <i class="fa fa-plus" style="color:#fff"></i> </a>
    </div>
    <div class="m-img blur" style="background-image:url(<?php  echo $_W['attachurl'];?><?php  echo D('adv')->getAdvInfoKeyWord('student_top_img'); ?>);"  ></div>
    <div class="m-title">
        <div class="m-masker" align="left" style="margin-left: 6%; margin-top: -13%; background-color:rgba(0,0,0,0); "> 
            <div class="weui-avatar">
                <img class="weui-avatar-img1_1" src="<?php  echo $_W['attachurl'];?><?php  echo $result['student_img'];?>" ng-click="toggleImg()" />
            </div>
         </div>
        <div class="m-masker" style="left: 18%; margin-top: -4.5%; background-color:rgba(0,0,0,0);"> 
            <span class="f25" style="margin-left: -18%;" ng-click="toggleMenu()" > <?php  echo $result['student_name'];?> <span class=" f-white f12">切换</span> </span> 
            <br />
            <div style=" margin-left: 22%;"><hr /></div>
            <span class="weui_btn_primary f-white f12">&nbsp;<?php  echo $grade_name;?> </span>
            <span>&nbsp;<?php  echo $class_name;?></span> 
        </div>
    </div> 
</div>
<?php  $class_mobile = D('mobile');?>
<?php  $index_list  = $class_mobile->getIndexNav(true); ?>
<?php  if(is_array($index_list)) { foreach($index_list as $row) { ?>
    <?php  if($row['top']['name']) { ?>
            <div class="weui_cells_title"><?php  echo $row['top']['name'];?></div>
    <?php  } ?>
    <div class="weui_grids">
    <?php  if(is_array($row['list'])) { foreach($row['list'] as $val) { ?>
    <?php  $params = json_decode($val['dis_three'],1);?>
        <a href="<?php  if($val['url']) { ?><?php  echo $val['url'];?><?php  } else { ?><?php  echo $this->createMobileUrl($val['keyword'],$params)?><?php  } ?>" class="weui_grid js_grid" >
            <div class="weui_grid_icon">
                <i class="<?php  echo $val['dis_two'];?> <?php  echo $row['top']['dis_one'];?> f30" style="<?php  echo $row['top']['dis_two'];?>"></i>
            </div>
            <p class="weui_grid_label">
               <?php  echo $val['name'];?>
            </p>
        </a>    
    <?php  } } ?>
    </div>
<?php  } } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>