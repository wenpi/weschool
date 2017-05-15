<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/web/default/js/jquery.min.js"> </script>
<body>
<div class="weui_dialog_alert" id="weui_dialog_alert" style="display: none" >
    <div class="weui_mask" onclick="$('#weui_dialog_alert').hide();"></div>
    <div class="weui_dialog"  >
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">切换身份</strong></div>
        <div class="weui_dialog_bd">
                <div class="weui_cells weui_cells_access">
                    <?php  if(is_array($teacher_list)) { foreach($teacher_list as $row) { ?>
                    <a class="weui_cell " href="<?php  echo $this->createMobileUrl('teacenter',array('teacher_id'=>$row['teacher_id']) );?>" >
                        <div class="weui_cell_bd weui_cell_primary">
                            <p <?php  if($row['teacher_id'] == $result['teacher_id'] ) { ?> style="color:#ff0033" <?php  } ?>> <?php  echo $row['teacher_realname'];?></p>
                        </div>
                    </a>
                    <?php  } } ?>
                </div>
        </div>
            <div class="weui_dialog_ft">
                <br>
            </div>        
    </div>
</div>

<style>
    .course{
        display: inline-block;
        text-overflow: ellipsis;
        white-space:nowrap;
        height: 20px; line-height: 20px;overflow: hidden; max-width: 75%;margin-left: 15%;
    }
</style>
<div class="m-box" >
    <div class='plus_student'>
        <a href="<?php  echo $this->createMobileUrl('teacher');?>"> <i class="fa fa-plus" style="color:#fff"></i> </a>
    </div>

    <div class="m-img " style="background-image:url(<?php  echo $_W['attachurl'];?><?php  echo D('adv')->getAdvInfoKeyWord('teacher_top_img'); ?>);"  ></div>
    <div class="m-title">
        <div class="m-masker" align="left" style="margin-left: 6%; margin-top: -13%; background-color:rgba(0,0,0,0); "> 
            <div class="weui-avatar">
                <img class="weui-avatar-img1_1" src="<?php  echo $_W['attachurl'];?><?php  echo $result['teacher_img'];?>" />
            </div>
         </div>
        <div class="m-masker" style="left: 18%; margin-top: -4.5%; background-color:rgba(0,0,0,0);" onclick="$('#weui_dialog_alert').show();"> 
            <span class="f25" style="margin-left: -18%;"   > <?php  echo $result['teacher_realname'];?>  <span class=" f-white f12">切换</span> </span> 
            <br />
            <div style=" margin-left: 22%;"><hr /></div>
            <span class="weui_btn_primary f-white f12 course" >&nbsp;<?php  echo $this->teacherCourse($result['teacher_id'],'echo')?>&nbsp;</span>
            <span>&nbsp;<?php  echo $class_s;?></span> 
        </div>
    </div> 
</div>

<?php  $class_mobile = D('mobile');?>
<?php  $index_list   = $class_mobile->getIndexNav(false); ?>
<?php  if(is_array($index_list)) { foreach($index_list as $row) { ?>
    <?php  if($row['top']['name']) { ?>
            <div class="weui_cells_title"><?php  echo $row['top']['name'];?></div>
    <?php  } ?>
<div class="weui_grids">
    <?php  if(is_array($row['list'])) { foreach($row['list'] as $val) { ?>
    <?php  $params = json_decode($val['dis_three'],1);?>
        <?php  $params["token"] = $token;?>
        <a href="<?php  if($val['url']) { ?><?php  echo $val['url'];?><?php  } else { ?><?php  echo $this->createMobileUrl($val['keyword'],$params)?><?php  } ?>" class="weui_grid js_grid" 
            <?php  if($val['keyword']=='tea_school_free') { ?>
                onclick=" if(!confirm('该操作会通知您所有班级的学生家长，该学生已经放学！')){return false;}"
            <?php  } ?> >
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>