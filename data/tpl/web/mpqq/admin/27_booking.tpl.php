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
                    <?php  if($ac == 'list' ) { ?>
                          <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>校外可报名活动列表 </div>
                                </div> 
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                <th> 名称 </th>
                                                <th> 起止时间 </th>
                                                <th> 简介 </th>
                                                <th> 限制人数 </th>
                                                <th> 报名人数 </th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?php  echo $item['booking_title'];?> </td>
                                                    <td><?php  echo date("Y-m-d H:i",$item['begin_time'])?>--<?php  echo date("Y-m-d H:i",$item['end_time'])?></td>
                                                    <td><?php  echo $item['booking_intro'];?> </td>
                                                    <td><?php  echo $item['limit_num'];?></td>
                                                    <td><?php  echo $item['up_num'];?></td>
                                                    <td> 
                                                        <a  href="<?php  echo $this->createWebUrl('booking', array('id' => $item['booking_id'],'ac'=>'edit'))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                    <i class="fa fa-edit"></i> 编辑 </a>
                                                        <a href="<?php  echo $this->createWebUrl('booking', array('id' => $item['booking_id'],'ac'=>'delete'))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');"
                                                            class="btn btn-outline btn-circle dark btn-sm black" title="删除"><i class="fa fa-trash-o"></i>
                                                            删除
                                                        </a>  
                                                        <a href="<?php  echo $this->createWebUrl('booking_list', array('id' => $item['booking_id'] ))?>" class="btn btn-outline btn-circle red btn-sm " target="_blank"><i class="fa fa-barcode"></i>
                                                            查看报名
                                                        </a>                                                            
                                                    </td>
                                                </tr>                                           
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>    
                    <?php  } ?>
                    <?php  if($ac=='new' || $ac=='edit' ) { ?>
                    <div class="col-md-12 col-sm-12">
                            <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 活动名称</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="booking_title" id="booking_title" class="form-control" value='<?php  echo $result['booking_title'];?>' required />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 活动简介</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="booking_intro" id="booking_intro" class="form-control" value='<?php  echo $result['booking_intro'];?>' required />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 限制人数</label>
                                            <div class="col-sm-10 ">
                                                <input type="number" name="limit_num" id="limit_num" class="form-control" value='<?php  echo $result['limit_num'];?>' required />
                                                <div class="form-control-focus"> </div>
                                                <span class="help-block"> 填为0 不限制 </span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>起止时间</label>
                                            <div class="col-sm-10">
                                                <br>
                                                开始时间：<input type='text' name="begin_time" value="<?php  echo $result['begin_time'];?>"   placeholder="2016-9-15 08:00" id="mask_date" class="mask_date">
                                                结束时间：<input type='text' name="end_time"   value="<?php  echo $result['end_time'];?>"     placeholder="2016-10-15 13:00" id="mask_date1" class="mask_date1">
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">封面图片</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_image('booking_img',$result['booking_img']);?>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">详情说明</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_ueditor('booking_content',$result['booking_content']);?>
                                            </div>
                                        </div>                                        				
                                        
                                         <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >是否需要登记姓名</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="ask_name"   value='1' <?php  if($result['ask_name']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>需要</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="ask_name"   value='0' <?php  if($result['ask_name']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不</label>
                                                </div>
                                            </div>
                                        </div>      
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >是否需要登记电话</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol_phone" class="md-radiobtn"  name="ask_phone"   value='1' <?php  if($result['ask_phone']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol_phone">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>需要</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1_phone' class="md-radiobtn" name="ask_phone"   value='0' <?php  if($result['ask_phone']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1_phone">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不</label>
                                                </div>
                                            </div>
                                        </div>              
                                        <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >是否需要身份证</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol_id" class="md-radiobtn"  name="ask_id"   value='1' <?php  if($result['ask_id']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol_id">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>需要</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1_id' class="md-radiobtn" name="ask_id"   value='0' <?php  if($result['ask_id']==0) { ?> checked <?php  } ?> />
                                                    <label for="radiol1_id">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>不</label>
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
                    <?php  } ?>                   
                    </div>
                </div>
            <!--开始公共尾部-->
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
     <?php  if($ac=='list') { ?>
         <!--筛选表格-->
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>
    <?php  } else { ?>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
        <script>
                        var FormInputMask = function () {
                            var handleInputMasks = function () {
                                $("#mask_date").inputmask("y-m-d h:s", {
                                    autoUnmask: true
                                }); //direct mask 
                                $("#mask_date1").inputmask("y-m-d h:s", {
                                    autoUnmask: true
                                }); //direct mask  
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
    <?php  } ?>
    </body>
    </html>