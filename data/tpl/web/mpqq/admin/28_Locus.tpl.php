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
                                      <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选学生</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="locus" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="id" value="<?php  echo $student_id;?>" />
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">日期</label>
                                                            <div class="col-md-4">
                                                                <input name='get_time' class="form-control"  id='mask_date' value="<?php  echo date("Y-m-d",$get_time)?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-group">
                                                                    <label class="control-label col-md-3"></label>
                                                                    <div class="col-md-4">
                                                                        <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                        <button class="btn btn-default" type="button">总记录数：<?php  echo count($locus_list)?></button>				
                                                                    </div>
                                                        </div>   
                                                </form>
                                              </div>
                                        </div>
                <div class='row'>
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                 	 <input type='hidden' value='<?php  echo $model;?>' name='model'>
                          <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-road"></i> <?php  echo $student_info['student_name'];?>轨迹列表 </div>
                                </div> 
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                <th width='20%'> 时间 </th>
                                                <th width='80%'> 进出信息 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($locus_list)) { foreach($locus_list as $item) { ?>
                                                <tr>
                                                    <td><?php  echo $item['time'];?></td>
                                                    <td><?php  echo $item['info'];?></td>
                                                </tr>                                                                                       
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
                            
                    </form>
                    </div>
                </div>
              </div>
            </div>
    <script>
        function checkBox(){
            $(".teacher_checkbox").prop("checked",true);
        }
    </script>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
    </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <!--筛选表格-->
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>      
           <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
            <script>
                        var FormInputMask = function () {
                            var handleInputMasks = function () {
                                $("#mask_date").inputmask("y-m-d", {
                                    autoUnmask: true
                                }); 
                            }                                 
                            return {
                                //main function to initiate the module
                                init: function () {
                                    handleInputMasks();
                                }
                            };
                        }();
                        if (App.isAngularJsApp() === false) { 
                            jQuery(document).ready(function() {
                                FormInputMask.init(); // init metronic core componets
                            });
                        }                
                </script>

    </body>
    </html>