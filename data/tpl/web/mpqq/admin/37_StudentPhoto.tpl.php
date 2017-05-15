<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                <div class='row'>
                     <div class="col-md-12">
                         <?php  if($model !='someone') { ?>
                            <?php  if($model =='grade') { ?>
                                <?php  $page = '年级列表';?>
                                <?php  $intro ='请选择学生所在的年级'; ?>
                                <?php  $color ='green';?>
                            <?php  } else if($model =='class') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='请选择学生所在的班级'; ?>
                                <?php  $color ='yellow-casablanca';?>
                            <?php  } else if($model =='student') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='请选择具体的学生'; ?>
                                <?php  $color ='blue';?>
                            <?php  } ?>
                             <div class="note note-info">
                                    <h4 class="block"><?php  echo $page;?></h4>
                                    <p><?php  echo $intro;?></p>
                             </div> 
                              <div class="row">
                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <div class="color-demo tooltips" >
                                        <a href="<?php  echo $this->result_result($item,$model,'url','studentPhoto');?>&aw=1">
                                            <div class="color-view bg-<?php  echo $color;?> bg-font-<?php  echo $color;?> bold uppercase"><?php  echo $this->result_result($item,$model,'name','list');?> </div>
                                            <div class="color-info bg-white c-font-14 sbold"> 点击选择 </div>
                                        </a>
                                    </div>
                                </div>
                                <?php  } } ?>                       
                             </div>                       
                         <?php  } ?>
                        <?php  if($model=='someone') { ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $result['student_name'];?></h4>
                                    <p>添加照片</p>
                                </div>                   
                                 <div class="portlet light ">          
                                 <div class="portlet-body form ">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>备注名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name='word' required autofocus >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label"> 照片</label>
                                                <div class="col-sm-10">
                                                    <?php  echo tpl_form_field_multi_image('img', $images);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <input type="submit" name="submit" class="btn blue" value="确认">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>                               
                              </div>     

                            <div class="row">
                             <div class="col-md-12 col-sm-12">
                                <div class="portlet light portlet-fit bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-directions font-green hide"></i>
                                            <span class="caption-subject bold font-dark uppercase "> 相册</span>
                                            <span class="caption-helper">时光轴</span>
                                        </div>
                                        <div class="actions">
                                            <div class="btn-group">
                                                <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> 年份
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php  if(is_array($year_list)) { foreach($year_list as $key => $row) { ?>
                                                        <?php  $year = date("Y",$row);?>
                                                        <li>
                                                            <a href="<?php  echo $this->createWebUrl('studentPhoto',array('year_key'=>$key,'model'=>'someone','sid'=>$_GPC['sid']));?>"> <?php  echo $year;?>年</a>
                                                        </li>
                                                    <?php  } } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="portlet-body">
                                        <div class="cd-horizontal-timeline mt-timeline-horizontal">
                                            <div class="timeline">
                                                <div class="events-wrapper">
                                                    <div class="events">
                                                        <ol>
                                                            <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
                                                                <li>
                                                                    <a href="#0" data-date="<?php  echo date("d/m/Y",$row['add_time'])?>T<?php  echo date("H:i",$row['add_time'])?>" class="border-after-red bg-after-red  <?php  if($key ==0) { ?> selected  <?php  } ?> "><?php  echo date("m-d H",$row['add_time'])?></a>
                                                                </li>
                                                            <?php  } } ?>
                                                        </ol>
                                                        <span class="filling-line bg-red" aria-hidden="true"></span>
                                                    </div>
                                                </div>
                                                <ul class="cd-timeline-navigation mt-ht-nav-icon">
                                                    <li>
                                                        <a href="#0" class="prev inactive btn btn-outline red md-skip">
                                                            <i class="fa fa-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#0" class="next btn btn-outline red md-skip">
                                                            <i class="fa fa-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="events-content">
                                                <ol>
                                                    <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
                                                        <li <?php  if($key ==0 ) { ?> class="selected"  <?php  } ?> data-date="<?php  echo date("d/m/Y",$row['add_time'])?>T<?php  echo date("H:i",$row['add_time'])?>">
                                                            <div class="mt-title">
                                                                <h2 class="mt-content-title"><?php  echo $row['title'];?></h2>
                                                            </div>
                                                            <!--<div class="mt-author">
                                                                <div class="mt-avatar">
                                                                    <img src="<?php echo MODULE_URL;?>/assets/pages/media/users/avatar80_3.jpg" />
                                                                </div>
                                                                <div class="mt-author-name">
                                                                    <a href="javascript:;" class="font-blue-madison">Hugh Grant</a>
                                                                </div>
                                                                <div class="mt-author-datetime font-grey-mint">28 February 2014 : 10:15 AM</div>
                                                            </div>
                                                            <div class="clearfix"></div>-->
                                                            <div class="mt-content border-grey-steel">
                                                                <p><?php  $img_list = C('studentPhoto')->decodePhotos($row['photo_list']);?>
                                                                    <?php  if(is_array($img_list)) { foreach($img_list as $v) { ?>
                                                                        <img src = "<?php  echo $this->imgFrom($v) ?>" />
                                                                    <?php  } } ?>
                                                                </p>
                                                            </div>
                                                        </li>
                                                    <?php  } } ?>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                            </div>
                        <?php  } ?>
                        <style>
                            .mt-content img{
                                width: 200px;
                                margin-left: 20px;
                            }
                        </style>
                    </div>
                </div>
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <script src="<?php echo MODULE_URL;?>/assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
    </body>
    </html>