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
                             <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>教师今日考勤详情</div>
                                </div>
                                </div>
                                <?php  if($_GPC['module']=='tea_list') { ?>
                                   <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                                <tr>
                                                    <th></th>
                                                    <th> 教师名 </th>
                                                    <th> 是否打卡 </th>
                                                    <th></th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                                    <?php  $up  = D("card")->teacherRecord($time,$item['teacher_id'],'in');?>
                                                    <?php  $low = D("card")->teacherRecord($time,$item['teacher_id'],'out');?>
                                                    <?php  if(!$up && !$low ) { ?>
                                                        <?php  $color ='blue';?>
                                                        <?php  $str ='未打卡'?>
                                                    <?php  } ?>
                                                    <?php  if($up && $low) { ?>
                                                        <?php  $color='yellow-crusta';?>
                                                        <?php  $str ='全打'?>
                                                    <?php  } ?>
                                                    <?php  if($up && !$low) { ?>
                                                        <?php  $color='green-jungle';?>
                                                        <?php  $str ='到校'?>
                                                    <?php  } ?>
                                                    <?php  if(!$up && $low) { ?>
                                                        <?php  $color='grey-gallery';?>
                                                        <?php  $str ='离校'?>
                                                    <?php  } ?>     
                                                    <tr class="odd gradeX">
                                                        <td></td>
                                                        <td><?php  echo $item["teacher_realname"];?></td>
                                                        <td class="font-<?php  echo $color;?>"><?php  echo $str;?></td>
                                                        <td style="text-align: center" > 
                                                            <a  href="<?php  echo $this->createWebUrl('TeaAttenceInfo', array('id' => $item['teacher_id']) )?>" class="btn blue">
                                                                        <i class="fa fa-edit"></i> 查看 </a>
                                                        </td>
                                                    </tr>                                           
                                                <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php  } else { ?>
                                <div class="row">
                                  <div class="col-md-6 col-sm-6">
                                        <div class="portlet-title">
                                            <div class=" ">
                                                <span class=" font-dark bold uppercase"><?php  echo $now_date;?></span>
                                                <span class="caption-helper">到校率</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="studentIn" class="CSSAnimationChart"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="portlet-title">
                                            <div class=" ">
                                                <span class="font-dark bold uppercase"><?php  echo $now_date;?></span>
                                                <span class="caption-helper">离校率</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="studentOut" class="CSSAnimationChart"></div>
                                        </div>
                                    </div>                                  
                                  </div>

                                    <div class="col-md-2 col-sm-2 col-xs-6">
                                        <div class="color-demo tooltips" >
                                            <a href="<?php  echo $this->createWebUrl("TeaAttence",array("module"=>'tea_list'))?>" title="">
                                                <div class="color-view bg-green bg-font-font bold uppercase">教师</div>
                                                <div class="color-info bg-white c-font-14 sbold"> 点击选择 </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php  } ?>
                             </div>                       
                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
            <?php  if($_GPC['module']=='tea_list') { ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>        
            <?php  } else { ?>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/horizontal-timeline/horozontal-timeline.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
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
          <!-- END PAGE LEVEL PLUGINS -->  
            <script>
                var Dashboard = function() {
                    return {
                        studentIn: function() {
                            if (typeof(AmCharts) === 'undefined' || $('#studentIn').size() === 0) {
                                return;
                            }

                            var chart = AmCharts.makeChart("studentIn", {
                                "type": "pie",
                                "theme": "light",
                                "path": "<?php echo MODULE_URL;?>/assets/global/plugins/amcharts/ammap/images/",
                                "dataProvider": [ {
                                    "country": "未打卡",
                                    "value": <?php  echo $teacher_count-$pay_card_people_moring?>
                                }, {
                                    "country": "打卡",
                                    "value": <?php  echo $pay_card_people_moring;?>
                                }],
                                "valueField": "value",
                                "titleField": "country",
                                "outlineAlpha": 0.4,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b>人 ([[percents]]%)</span>",
                                "angle": 30,
                                "export": {
                                    "enabled": true
                                }
                            });
                            jQuery('.chart-input').off().on('input change', function() {
                                var property = jQuery(this).data('property');
                                var target = chart;
                                var value = Number(this.value);
                                chart.startDuration = 0;

                                if (property == 'innerRadius') {
                                    value += "人";
                                }
                                target[property] = value;
                                chart.validateNow();
                            });
                        },   
                         studentOut: function() {
                            if (typeof(AmCharts) === 'undefined' || $('#studentOut').size() === 0) {
                                return;
                            }
                            var chart = AmCharts.makeChart("studentOut", {
                                "type": "pie",
                                "theme": "light",
                                "path": "<?php echo MODULE_URL;?>/assets/global/plugins/amcharts/ammap/images/",
                                "dataProvider": [{
                                    "country": "未打卡",
                                    "value": <?php  echo $teacher_count-$pay_card_people_afternoon?>
                                }, {
                                    "country": "已打卡",
                                    "value": <?php  echo $pay_card_people_afternoon;?>
                                }, ],
                                "valueField": "value",
                                "titleField": "country",
                                "outlineAlpha": 0.4,
                                "depth3D": 15,
                                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b>人 ([[percents]]%)</span>",
                                "angle": 30,
                                "export": {
                                    "enabled": true
                                }
                            });
                            jQuery('.chart-input').off().on('input change', function() {
                                var property = jQuery(this).data('property');
                                var target   = chart;
                                var value    = Number(this.value);
                                chart.startDuration = 0;
                                if (property == 'innerRadius') {
                                    value += "人";
                                }
                                target[property] = value;
                                chart.validateNow();
                            });
                        },          
                    init: function() {
                        this.studentIn();
                        this.studentOut();
                    }               

                }
                }();
                    if (App.isAngularJsApp() === false) {
                        jQuery(document).ready(function() {
                            Dashboard.init(); // init metronic core componets
                        });
                    }                
            </script>
        <?php  } ?>
    </body>
    </html>