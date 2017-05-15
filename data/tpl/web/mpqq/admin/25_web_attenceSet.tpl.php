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
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                                        
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>类别</label>
                                                <div class="col-sm-10">
                                                    <select name='time_type' class="form-control">
                                                        <?php  if(is_array($class_attenceTime->type_name)) { foreach($class_attenceTime->type_name as $key => $row) { ?>
                                                            <option value='<?php  echo $key;?>' <?php  if($key == $result['time_type']) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                </div>	
                                            </div>

                                       <div class="form-group form-md-line-input ">
                                           <label class="col-md-2 control-label">时间</label>
                                            <div class="col-md-10 ">
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input  ">
                                                        <div class="input-icon col-md-8">
                                                            <input type="text"  name="begin_time" class="form-control" value="<?php  echo $result['begin_time'];?>" placeholder="00:00"  required id='begin_time' >
                                                            <label for="am_much">开始时间</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-md-line-input has-warning">
                                                        <div class="input-icon col-md-8">
                                                        <input type="text" name="end_time" class="form-control" value="<?php  echo $result['end_time'];?>" placeholder="12:00" required id="end_time" >
                                                        <label for="pm_much">结束时间</label>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>                                                          
                                        </div> 

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                    </div>
                                                </div>
                                            </div>                                                                                
                                    </form>
                                  </div>    
                             </div>            
                      </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>考勤时间段列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 类别</th>
                                                <th> 开始时间 </th>
                                                <th> 停止时间 </th>
                                                <th>     </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $class_attenceTime->type_name[$item[$class_attenceTime->time_type]];?></td>
                                                <td><?php  echo $item['begin_time'];?></td>
                                                <td><?php  echo $item['end_time'];?></td>
                                                <td><a  href="<?php  echo $this->createWebUrl('attenceSet', array('ac' => 'edit','id'=>$item[$class_attenceTime->time_id] ))?>" class="btn btn-outline btn-circle btn-sm purple">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                <a href="<?php  echo $this->createWebUrl('attenceSet', array('ac' => 'delete','id'=>$item[$class_attenceTime->time_id] ))?>" 
                                                    onclick="return confirm('此操作不可恢复，确认删除？');"
                                                    class="btn btn-outline btn-circle dark btn-sm black" ><i class="fa fa-trash-o"></i>
                                                    删除
                                                </a>               
                                                </td>                          
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
        <script>
                        var FormInputMask = function () {
                            var handleInputMasks = function () {
                                $("#begin_time").inputmask("h:s", {
                                    autoUnmask: true
                                }); 
                                $("#end_time").inputmask("h:s", {
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