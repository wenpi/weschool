<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<body  ng-controller='ShowController'>
<style>
    .course{
        display: inline-block;
        text-overflow: ellipsis;
        white-space:nowrap;
        height: 20px; line-height: 20px;overflow: hidden; max-width: 75%;margin-left: 15%;
    }
</style>
<div class="m-box" >
    <div class="m-img blur" style="background-image:url(<?php  echo $_W['attachurl'];?><?php  echo D('adv')->getAdvInfoKeyWord('adminSchool_top_img'); ?>);"  ></div>
    <div class="m-title">
        <div class="m-masker" align="left" style="margin-left: 6%; margin-top: -13%; background-color:rgba(0,0,0,0); "> 
            <div class="weui-avatar">
                <img class="weui-avatar-img1_1" src = "<?php  echo $this->imgFrom($have_school_admin['info']['admin_img']);?>" />
            </div>
         </div>
        <div class="m-masker" style="left: 18%; margin-top: -4.5%; background-color:rgba(0,0,0,0);"> 
            <span class="f25" style="margin-left: -18%;" ng-click="toggleMenu()"  ><?php  echo $student_name;?></span> 
            <br />
            <div style=" margin-left: 22%;"><hr /></div>
            <span ><?php  echo $_SESSION['school_name'];?></span> 
        </div>
    </div> 
</div>

<?php  $class_mobile = D('mobile');?>
<?php  $class_mobile->do_schoolAdmin = true;?>
<?php  $index_list   = $class_mobile->getIndexNav(false); ?>
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/schoolAdmin_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/schoolAdmin_footer', TEMPLATE_INCLUDEPATH));?>