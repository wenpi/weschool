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
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                 	 <input type='hidden' value='<?php  echo $model;?>' name='model'>
                          <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>请选择需要发送消息的教师 </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                      <th class="table-checkbox">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" onclick="checkBox()"/>
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                <th> 教师名 </th>
                                                <th> 授课 </th>
                                                <th> 班级 </th>
                                                <th> 班主任 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
 
                                            <?php  if(is_array($teacher_list)) { foreach($teacher_list as $item) { ?>
                                                <tr class="odd gradeX">
                                                     <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                          <input type='checkbox' class='teacher_checkbox' value='<?php  echo $item['teacher_id'];?>' name='have[]'>
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td><?php  echo $item['teacher_realname'];?> </td>
                                                    <td><?php  echo $this->teacherCourse($item['teacher_id'],'echo');?></td>
                                                    <?php  $class_list = D('teacher')->getTeacherClass($item['teacher_id'],true);?>
                                                    <td>
                                                        <?php  if(is_array($class_list['list_all'])) { foreach($class_list['list_all'] as $row) { ?>
                                                            <?php  echo $row['grade_name'];?>-
                                                            <?php  echo $row['class_name'];?>,
                                                        <?php  } } ?>
                                                    </td>
                                                    <td><?php  if($result=$this->classHead($item['teacher_id'])) { ?>
                                                        <a class='a_use_title' href='' title="<?php  echo $this->echoArrOne($result,'class_name');?>">班主任</a>
                                                        <?php  } else { ?>否
                                                        <?php  } ?>
                                                    </td>
                                                </tr>                                           
                                            <?php  } } ?>
 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>                       
                       <div style="clear:both"></div>
                              <div class="col-md-12 ">
                                <div class="portlet box green ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i> 	添加发送内容【微信模板机制】 </div>
                                        <div class="tools">
                                            <a href="" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">标题</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control input-lg"  name='weixin_title'  placeholder="" > </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><span style='color:red'>*</span>内容说明</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='content' class='form-control'  ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>备注信息</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='remark' class='form-control'></textarea>
                                                    </div>
                                                </div>	
                                                <div class="form-group">
                                                    <label class=" col-md-3 control-label"><span style='color:red'>*</span>链接地址（https:// 或者http://）</label>
                                                    <div class="col-sm-9 ">
                                                        <textarea name='url' class='form-control'></textarea>
                                                    </div>
                                                </div>     
                                            </div>
                                            <div class="form-actions ">
                                                	<input type="submit" name="submit_weixin" value="提交" class="btn green" />
                                            </div>
                                    </div>
                                </div>

                            </div>
                    </form>
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
    <script src="<?php echo MODULE_URL;?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script>
            var TableDatatablesManaged = function () {
                var initTable3 = function () {
                var table = $('#sample_3');
                // begin: third table
                table.dataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "没有数据",
                        "info": "显示 _START_ to _END_  ",
                        "infoEmpty": "No records found",
                        "infoFiltered": "(filtered1 from _MAX_ total records)",
                        "lengthMenu": "每页数 _MENU_",
                        "search": "搜索:",
                        "zeroRecords": "无搜索结果",
                        "paginate": {
                            "previous":"上一页",
                            "next": "下一页",
                            "last": "最后页",
                            "first": "第一页"
                        }
                    },
                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "lengthMenu": [
                        [6, 15, 20, 50, 200, -1],
                        [6, 15, 20, 50, 200, "全部"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": -1,
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ] 
                });
                var tableWrapper = jQuery('#sample_3_wrapper');

                table.find('.group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            $(this).prop("checked", true);
                        } else {
                            $(this).prop("checked", false);
                        }
                    });
                });
            }

            return {

                //main function to initiate the module
                init: function () {
                    if (!jQuery().dataTable) {
                        return;
                    }

                    initTable3();
                }

            };

        }();

        if (App.isAngularJsApp() === false) { 
            jQuery(document).ready(function() {
                TableDatatablesManaged.init();
            });
        }
    </script>
    </body>
    </html>