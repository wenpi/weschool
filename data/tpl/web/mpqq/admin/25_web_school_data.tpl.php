<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
            <!--结束公共头部-->
                <div class='row'>
                     <div class="col-md-12">
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $title;?></h4>
                                </div>                   
                                 <div class="portlet light ">          
                                 <div class="portlet-body form ">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">开始时间</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name='begin_time'  id='mask_date' value="<?php  echo date("Y-m-d",$begin_time);?>" >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        <div class="form-group  form-md-line-input has-success">
                                                <label class= "col-md-2 control-label">结束时间</label>
                                                <div class="col-md-10">
                                                    <input  class='form-control' name='end_time' id='mask_date1' value="<?php  echo date("Y-m-d",$end_time);?>" >
                                                    <div class="form-control-focus"> </div>
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
                                    <div class="col-md-12">
                                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>记录列表</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body flip-scroll">
                                           <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                             <thead class="flip-content">
                                                        <tr>
                                                            <th>学校名</th>
                                                            <th>学生绑定率</th>
                                                            <th>教师绑定率</th>
                                                            <th>班级作业发送比率</th>
                                                            <th>班级公告发送比率</th>
                                                            <th>学校公告发送量</th>
                                                            <th>文章发布量</th>                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($out_list)) { foreach($out_list as $item) { ?>
                                                        <tr>
                                                            <td><?php  echo $item['school_info']['school_name'];?></td>
                                                            <td>[绑定数：<?php  echo $item['have_bd_student_count'];?>]/[学生数：<?php  echo $item['student_count'];?>]=<?php  echo $item['student_bi_lv'];?></td>
                                                            <td>[绑定数：<?php  echo $item['have_bd_teacher_count'];?>]/[教师数：<?php  echo $item['teacher_count'];?>]=<?php  echo $item['teacher_bi_lv'];?></td>
                                                            <td>[发送数：<?php  echo $item['homework_count'];?>]/[班级数：<?php  echo $item['classes_count'];?>]=<?php  echo $item['homework_bi_lv'];?></td>
                                                            <td>[发送数：<?php  echo $item['class_send_count'];?>]/[班级数：<?php  echo $item['classes_count'];?>]=<?php  echo $item['class_send_bi_lv'];?></td>
                                                            <td>[发送数：<?php  echo $item['school_send_count'];?>]/[班级数：<?php  echo $item['classes_count'];?>]=<?php  echo $item['school_send_bi_lv'];?></td>
                                                            <td><?php  echo $item['school_info']['school_name'];?>:<?php  echo $item['article_send_count'];?></td>
                                                        </tr>
                                                        <?php  } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>                          
                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
            <!--筛选表格-->
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>              
            <script>
            var FormInputMask = function () {
                var handleInputMasks = function () {
                    $("#mask_date").inputmask("y-m-d", {
                        autoUnmask: true
                    }); 
                    $("#mask_date1").inputmask("y-m-d", {
                        autoUnmask: true
                    }); 
                    $(".mask_date3").inputmask("h:s", {
                        autoUnmask: true
                    });
                }                                 
                return {
                    init: function () {
                        handleInputMasks();
                    }
                };
            }();
            if (App.isAngularJsApp() === false) { 
                jQuery(document).ready(function() {
                    FormInputMask.init(); 
                });
            }                
            </script>
    </body>
    </html>