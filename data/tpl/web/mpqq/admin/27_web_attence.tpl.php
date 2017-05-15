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
                         <?php  if($model !='someone') { ?>
                            <?php  if($model =='grade') { ?>
                                <?php  $page = '年级列表';?>
                                <?php  $intro ='全校的到校情况'; ?>
                                <?php  $color ='green';?>
                            <?php  } else if($model =='class') { ?>
                                <?php  $page = '班级列表';?>
                                <?php  $intro ='该年级的到校情况'; ?>
                                <?php  $color ='yellow-casablanca';?>
                            <?php  } else if($model =='student') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='班级的到校情况'; ?>
                                <?php  $color ='blue';?>
                                <?php  $class_card = D('card');?>
                                <?php  list($time['year'],$time['month'],$time['day'])=explode('-',date('Y-m-d',time() ) );   ?>
                            <?php  } ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $page;?></h4>
                                    <p><?php  echo $intro;?></p>
                                </div> 
                              <div class="row">
                                  <div class="col-md-6 col-sm-6">
                                        <div class="portlet-title">
                                            <div class="caption ">
                                                <span class="caption-subject font-dark bold uppercase"><?php  echo $now_date;?></span>
                                                <span class="caption-helper">到校率</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="studentIn" class="CSSAnimationChart"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <div class="portlet-title">
                                            <div class="caption ">
                                                <span class="caption-subject font-dark bold uppercase"><?php  echo $now_date;?></span>
                                                <span class="caption-helper">离校率</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="studentOut" class="CSSAnimationChart"></div>
                                        </div>
                                    </div>                                  
                                  </div>

                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <div class="color-demo tooltips" >
                                        <?php  if($model =='student') { ?>
                                            <!--查询该学生有没有打卡，今天-->
                                            <?php  $up  = $class_card->studentRecord($time,$item['student_id'],'in');?>
                                            <?php  $low = $class_card->studentRecord($time,$item['student_id'],'out');?>
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
                                        <?php  } ?>
                                        <a href="<?php  echo $this->result_result($item,$model,'url','list');?>&aw=1&do=attence" title="<?php  echo $str;?>">
                                            <div class="color-view bg-<?php  echo $color;?> bg-font-<?php  echo $color;?> bold uppercase"><?php  echo $this->result_result($item,$model,'name','list');?> </div>
                                            <div class="color-info bg-white c-font-14 sbold"> 点击选择 </div>
                                        </a>
                                    </div>
                                </div>
                                <?php  } } ?>                       
                             </div>                       
                         <?php  } ?>
                        <?php  if($model=='someone') { ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $result['student_name'];?></h4>
                                </div>                   
                                 <div class="portlet light ">          
                                 <div class="portlet-body form ">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">开始时间</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name='begin_time'  id='mask_date' value="<?php  echo date("Y-m-d",$begin_time);?>" >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        <div class="form-group  form-md-line-input has-success">
                                                <label class= "col-md-2 control-label">结束时间</label>
                                                <div class="col-md-10">
                                                    <input  class='form-control' name='end_time' id='mask_date1' value="<?php  echo date("Y-m-d",$end_time);?>" >
                                                    <div class="form-control-focus"> </div>
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
                                                <table class="table table-bordered table-striped table-condensed flip-content">
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th class="numeric">记录ID</th>
                                                            <th>年级</th>
                                                            <th>班级</th>
                                                            <th>设备</th>
                                                            <th>卡</th>
                                                            <th>图片</th>
                                                            <th>添加时间</th>                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                            <?php  $grade_info  = D('grade')->getGradeInfo($item['grade_id']);?>
                                                            <?php  $device_info = D('card')->deviceInfo($item['device_id']);?>
                                                        <tr>
                                                            <td><?php  echo $item['record_id'];?></td>
                                                            <td><?php  echo $grade_info['grade_name'];?></td>
                                                            <td><?php  echo $this->className($item['class_id']);?></td>
                                                            <td><?php  echo $device_info['device_name'];?></td>
                                                            <td><?php  echo $item['rfid_value'];?></td>
                                                            <td><img src="<?php  echo $item['img_url'];?>" style="width:80px;"></td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
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
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
            <!-- BEGIN PAGE LEVEL PLUGINS -->
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
                                    "value": <?php  echo $student_count-$pay_card_people_moring?>
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
                                    "value": <?php  echo $student_count-$pay_card_people_afternoon?>
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
                <?php  if($model!='someone') { ?>
                    if (App.isAngularJsApp() === false) {
                        jQuery(document).ready(function() {
                            Dashboard.init(); // init metronic core componets
                        });
                    }                
                <?php  } ?>
            </script>
    </body>
    </html>