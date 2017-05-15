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
                <?php  if($ac!='list') { ?>
                 <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/department_edit', TEMPLATE_INCLUDEPATH)) : (include template('../admin/department_edit', TEMPLATE_INCLUDEPATH));?>
                <?php  } else { ?>
                <div class='row'>
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                 	 <input type='hidden' value='<?php  echo $model;?>' name='model'>
                          <div class="col-md-12 col-sm-12">
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i><?php  if($op!='add_admin') { ?>选择需要管理的部门<?php  } else { ?><?php  echo $result['department_name'];?><?php  } ?></div>
                                       <div class="tools">
                                        <?php  if($op=='add_admin') { ?>
                                            <a href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'], 'op' => 'add_admin','ac'=>'new'))?>" data-toggle="modal" style="color:#fff"><i class="fa fa-plus"></i>添加成员 </a>
                                        <?php  } ?>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <?php  if($op=='add_admin') { ?>
                                                <tr>
                                                    <th> 姓名 </th>
                                                    <th> 添加时间 </th>
                                                    <th> 角色 </th>
                                                    <th> 账号 </th>
                                                    <th></th>
                                                </tr>
                                            <?php  } else { ?>
                                                <tr>
                                                    <th> 部门名 </th>
                                                    <th> 添加时间 </th>
                                                    <th> 部门性质 </th>
                                                    <th> 部门主管 </th>
                                                    <th></th>
                                                </tr>
                                            <?php  } ?>
                                        </thead>
                                        <tbody>
                                            <?php  if($op=='add_admin') { ?>
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php  echo $item['admin_name'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$item['de_add_time']);?></td>
                                                        <td><?php  echo $class_department->level[$item['level']]?></td>
                                                        <td><?php  echo $item['passport'];?></td>
                                                        <td>
                                                        <a  href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'],'peadmin_id'=>$item['admindepart_id'], 'op' => 'add_admin','ac'=>'edit'))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                    <i class="fa fa-edit"></i> 编辑 </a>
                                                        <a href="<?php  echo $this->createWebUrl('department', array('id' => $result['department_id'],'peadmin_id'=>$item['admindepart_id'],'op' => 'add_admin','ac'=>'delete'))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');"
                                                            class="btn btn-outline btn-circle dark btn-sm black" title="删除"><i class="fa fa-trash-o"></i>
                                                            删除
                                                        </a>  
                                                        </td>
                                                    </tr>                                           
                                                <?php  } } ?>
                                            <?php  } else { ?>
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php  echo $item['department_name'];?></td>
                                                        <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                        <td><?php  echo $item['property'];?></td>
                                                        <td><?php  echo $item['main_admin'];?></td>
                                                        <td>
                                                        <a  href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'department','ac'=>'edit'))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                    <i class="fa fa-edit"></i> 编辑 </a>
                                                        <a href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'department','ac'=>'delete'))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');"
                                                            class="btn btn-outline btn-circle dark btn-sm black" title="删除"><i class="fa fa-trash-o"></i>
                                                            删除
                                                        </a>  
                                                        <a href="<?php  echo $this->createWebUrl('department', array('id' => $item['department_id'], 'op' => 'add_admin','ac'=>'list' ))?>" class="btn btn-outline btn-circle dark btn-sm " target="_blank" title="打印二维码">
                                                            <i class="fa fa-eye"></i>查看成员
                                                        </a>
                                                        </td>
                                                    </tr>                                           
                                                <?php  } } ?>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                       
                       <div style="clear:both"></div>
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
    <?php  } ?>