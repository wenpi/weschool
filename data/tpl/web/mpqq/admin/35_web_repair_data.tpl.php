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
                                                    <input type="submit" name="submit" class="btn blue" value="确认"></button>
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
    <script src="<?php echo MODULE_URL;?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
    <style>
        .ms-container{
            width:700px;
        }
    </style>
    <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" ></script>


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
                    "pageLength": 50,
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