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
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 报名列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>报名列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <?php  if(!$aname) { ?>
                                                <th>名称</th>
                                                <?php  } ?>
                                                <th>学生名</th>
                                                <th>年级班级</th>
                                                <th>添加时间</th>
                                                <th>申请理由</th>
                                                <th>项目</th>
                                                <th>状态</th>
                                                <th>操作</th>
                                            </tr>                                            
                                        </thead>
                                            <tbody>
                                                <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                        <tr>
                                                            <?php  if(!$aname) { ?>
                                                            <td><?php  echo $row['appointment_name'];?></td>
                                                            <?php  } ?>
                                                            <td><?php  echo $row['student_name'];?></td>
                                                            <td><?php  echo  $this->className($row['class_id']);?></td>
                                                            <td><?php  echo date('Y-m-d H:i:s',$row['addtime'])?></td>
                                                            <td><?php  echo $row['reason'];?></td>
                                                            <td><?php  echo $row['my_course'];?></td>
                                                            <td><?php  if($row['status']==0) { ?>默认通过<?php  } else if($row['status']==2) { ?>不通过<?php  } ?></td>
                                                            <td><a  class="btn btn-outline btn-circle dark btn-sm black"     href="javascript:;" onclick="apply_no(<?php  echo $row['list_id'];?>)">不通过</a></td>
                                                        </tr>		
                                                <?php  } } ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a class='btn btn-primary' href="<?php  echo $this->createWebUrl('applist',array('excel_out'=>'yes','aid'=>$_GPC['aid'],'aw'=>1 ));?>">数据导出 </a>
                            <div id='black_mu' style="display:none;width:100%;height:100%;position:fixed;top:0px;left:0px;background:rgba(0,0,0,0.5);z-index:300">
                                <form method="post" action="<?php  echo $this->createWebUrl('applist',array('aw'=>1) ) ?>">		
                                    <div style="width:300px;margin:20% auto; height:400px;">
                                        <b style="color:#fff">理由：</b>
                                            <textarea name='content' id="content" class='form-control'></textarea>
                                            <input type='hidden' name='list_id' id="list_id">
                                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-3" id="submit" style="margin-top:10px;margin-left:100px;" />
                                </form>
                                            <div class="btn btn-primary col-lg-3" onclick="return hide_button()" style="margin-top:10px;margin-left:20px;">关闭</div>
                            </div>
                            </div>
                            <script>
                            var list_id=0;
                                function apply_no(list_id){
                                    $('#black_mu').show();
                                    list_id=list_id;
                                    $('#list_id').val(list_id);
                                }
                                function hide_button(){
                                    $('#black_mu').hide();
                                    return false;
                                }
                            </script>

                    </div>
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
                                $("#mask_date").inputmask("y-m-d", {
                                    autoUnmask: true
                                }); //direct mask 
                                $("#mask_date1").inputmask("y-m-d", {
                                    autoUnmask: true
                                }); //direct mask  
                                 $(".mask_date3").inputmask("h:s", {
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
         </body>
    </html>