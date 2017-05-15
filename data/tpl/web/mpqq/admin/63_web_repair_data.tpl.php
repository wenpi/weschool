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
                                        <div class="form-group  form-md-line-input">
                                                <label class= "col-md-2 control-label">结束时间</label>
                                                <div class="col-md-10">
                                                    <input  class='form-control' name='end_time' id='mask_date1' value="<?php  echo date("Y-m-d",$end_time);?>" >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                          </div>
                                          <div class="form-group form-md-line-input ">
                                                    <label class="control-label col-md-2">成员</label>
                                                    <div class="col-md-10">
                                                        <select multiple="multiple" class="multi-select" id="my_multi_select2" name="my_multi_select2[]">
                                                                    <?php  if(is_array($repair_list)) { foreach($repair_list as $row) { ?>
                                                                        <optgroup label="<?php  echo $row['department_name'];?>">
                                                                            <?php  if(is_array($row['admin_list'])) { foreach($row['admin_list'] as $v) { ?>
                                                                                <option value="<?php  echo $row['department_id'];?>_<?php  echo $v['admin_id'];?>"><?php  echo $v['admin_name'];?></option>
                                                                            <?php  } } ?>
                                                                        </optgroup>
                                                                    <?php  } } ?>
                                                            </select>                                                        
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
                                        <div class="portlet box green-turquoise">
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
                                                            <th>管理员名</th>
                                                            <th>部门</th>
                                                            <th>参与的报修量</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($out_list)) { foreach($out_list as $item) { ?>
                                                        <tr>
                                                            <td><?php  echo $item['admin_name'];?></td>
                                                            <td><?php  echo $item['department_name'];?></td>
                                                            <td><?php  echo $item['count'];?></td>
                                                            <?php  $all+=$item['count']?>
                                                        </tr>
                                                        <?php  } } ?>
                                                        <tr>
                                                            <td>总结</td>
                                                            <td></td>
                                                            <td><?php  echo $all;?></td>
                                                        </tr>

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
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" ></script>
    <style>
        .ms-container{
            width:700px;
        }
    </style>
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
            $('#my_multi_select2').multiSelect({ selectableOptgroup: true });
            </script>


    </body>
    </html>