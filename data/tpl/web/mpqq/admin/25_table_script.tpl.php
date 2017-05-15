<?php defined('IN_IA') or exit('Access Denied');?>    <script src="<?php echo MODULE_URL;?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <?php  if(!$everP) { ?>
        <?php  $everP=-1;?>
    <?php  } ?>
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
                        [6, 15, 20, 50, 200,<?php  echo $everP;?>],
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