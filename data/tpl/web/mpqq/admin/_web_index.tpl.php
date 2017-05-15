<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
    <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
        <div class="page-content-wrapper">
	    <div class="page-content">
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
             <h1 class="page-title"> 
                    <?php  echo $_SESSION['school_name'];?>
                    <small> 学校概况 </small>
              </h1>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php  echo $grade_count;?>">0</span>
                                    </div>
                                    <div class="desc"> 年级数 </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                                <div class="visual">
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php  echo $class_count;?>">0</span></div>
                                    <div class="desc"> 班级数 </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php  echo $teacher_count;?>">0</span>
                                    </div>
                                    <div class="desc"> 教师人数</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                <div class="visual">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="details">
                                    <div class="number"> 
                                        <span data-counter="counterup" data-value="<?php  echo $student_count;?>">0</span></div>
                                    <div class="desc"> 学生人数 </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">班级圈发布数</span>
                                        <span class="caption-helper">周统计</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="site_statistics_loading">
                                        <img src="<?php echo MODULE_URL;?>assets/global/img/loading.gif" alt="loading" /> </div>
                                    <div id="site_statistics_content" class="display-none">
                                        <div id="site_statistics" class="chart"> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">作业发布数</span>
                                        <span class="caption-helper">周统计</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="site_activities_loading">
                                        <img src="<?php echo MODULE_URL;?>assets/global/img/loading.gif" alt="loading" /> </div>
                                    <div id="site_activities_content" class="display-none">
                                        <div id="site_activities" class="chart"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class="icon-bubbles font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">最新班级圈</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="portlet_comments_1">
                                            <div class="mt-comments">
                                             <?php  if(is_array($last_sends)) { foreach($last_sends as $row) { ?>
                                                <div class="mt-comment">
                                                    <div class="mt-comment-img ">
                                                        <img src="<?php  if($row['teacher_result']) { ?> <?php  echo D('teacher')->teacherImg($row['teacher_result']['teacher_id']) ?> <?php  } else { ?> <?php  echo $_W['attachurl'];?><?php  echo $row['student_info']['student_img'];?><?php  } ?>" style="width:50px;"/> </div>
                                                    <div class="mt-comment-body">
                                                        <div class="mt-comment-info">
                                                            <span class="mt-comment-author">
                                                                <?php  if(!$row['teacher_result']) { ?>
                                                                    <?php  echo $row['student_info']['student_name'];?>
                                                                    <?php  if($row['relation']) { ?>（<?php  echo $row['relation'];?>）<?php  } ?>
                                                                <?php  } else { ?>
                                                                    <?php  echo $row['teacher_result']['teacher_realname'];?>(教师)
                                                                <?php  } ?>
                                                            </span>
                                                            <span class="mt-comment-date"><?php  echo date("Y-m-d H:i:s",$row['add_time'])?></span>
                                                        </div>
                                                        <div class="mt-comment-text"> <?php  echo $row['send_content'];?> 
                                                        </div>
                                                            <?php  echo $this->decodeLineImgs($row['send_image']);?>
                                                         <div style='clear:both'></div>
                                                        <div class="mt-comment-details">
                                                            <span class="mt-comment-status mt-comment-status-pending"><?php  echo $row['grade_name'];?>=><?php  echo $row['class_name'];?></span>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                             <?php  } } ?>                                               
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">到校人数统计</span>
                                        <span class="caption-helper">日统计</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="on_school_loading">
                                        <img src="<?php echo MODULE_URL;?>assets/global/img/loading.gif" alt="loading" /> 
                                    </div>
                                    <div id="on_school_content" class="display-none">
                                        <div id="on_school" class="chart"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
          <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
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
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
            <script src="<?php echo MODULE_URL;?>assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
            <script>
              var Dashboard = function() {
                    return {
                        initCharts: function() {
                            if (!jQuery.plot) {
                                return;
                            }
                            function showChartTooltip(x, y, xValue, yValue) {
                                $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
                                    position: 'absolute',
                                    display: 'none',
                                    top: y - 40,
                                    left: x - 40,
                                    border: '0px solid #ccc',
                                    padding: '2px 6px',
                                    'background-color': '#fff'
                                }).appendTo("body").fadeIn(200);
                            }

                            var data = [];
                            var totalPoints = 250;

                            // random data generator for plot charts

                            function getRandomData() {
                                if (data.length > 0) data = data.slice(1);
                                // do a random walk
                                while (data.length < totalPoints) {
                                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                                    var y = prev + Math.random() * 10 - 5;
                                    if (y < 0) y = 0;
                                    if (y > 100) y = 100;
                                    data.push(y);
                                }
                                // zip the generated y values with the x values
                                var res = [];
                                for (var i = 0; i < data.length; ++i) res.push([i, data[i]])
                                return res;
                            }

                            function randValue() {
                                return (Math.floor(Math.random() * (1 + 50 - 20))) + 10;
                            }

                            var visitors = [
                                <?php  if(is_array($send_date)) { foreach($send_date as $row) { ?>
                                    ['<?php  echo $row['time']['begin'];?>-<?php  echo $row['time']['end'];?>', <?php  echo $row['count'];?>],
                                <?php  } } ?>
                            ];


                            if ($('#site_statistics').size() != 0) {

                                $('#site_statistics_loading').hide();
                                $('#site_statistics_content').show();

                                var plot_statistics = $.plot($("#site_statistics"), [{
                                        data: visitors,
                                        lines: {
                                            fill: 0.6,
                                            lineWidth: 0
                                        },
                                        color: ['#f89f9f']
                                    }, {
                                        data: visitors,
                                        points: {
                                            show: true,
                                            fill: true,
                                            radius: 5,
                                            fillColor: "#f89f9f",
                                            lineWidth: 3
                                        },
                                        color: '#fff',
                                        shadowSize: 0
                                    }],

                                    {
                                        xaxis: {
                                            tickLength: 0,
                                            tickDecimals: 0,
                                            mode: "categories",
                                            min: 0,
                                            font: {
                                                lineHeight: 14,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        yaxis: {
                                            ticks: 5,
                                            tickDecimals: 0,
                                            tickColor: "#eee",
                                            font: {
                                                lineHeight: 14,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        grid: {
                                            hoverable: true,
                                            clickable: true,
                                            tickColor: "#eee",
                                            borderColor: "#eee",
                                            borderWidth: 1
                                        }
                                    });

                                var previousPoint = null;
                                $("#site_statistics").bind("plothover", function(event, pos, item) {
                                    $("#x").text(pos.x.toFixed(2));
                                    $("#y").text(pos.y.toFixed(2));
                                    if (item) {
                                        if (previousPoint != item.dataIndex) {
                                            previousPoint = item.dataIndex;

                                            $("#tooltip").remove();
                                            var x = item.datapoint[0].toFixed(2),
                                                y = item.datapoint[1].toFixed(2);

                                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + ' 条');
                                        }
                                    } else {
                                        $("#tooltip").remove();
                                        previousPoint = null;
                                    }
                                });
                            }


                            if ($('#site_activities').size() != 0) {
                                //site activities
                                var previousPoint2 = null;
                                $('#site_activities_loading').hide();
                                $('#site_activities_content').show();

                                var data1 = [
                               <?php  if(is_array($homework_date)) { foreach($homework_date as $row) { ?>
                                    ['<?php  echo $row['time']['begin'];?>-<?php  echo $row['time']['end'];?>', <?php  echo $row['count'];?>],
                                <?php  } } ?>
                                ];

                                var plot_statistics = $.plot($("#site_activities"),

                                    [{
                                        data: data1,
                                        lines: {
                                            fill: 0.2,
                                            lineWidth: 0,
                                        },
                                        color: ['#BAD9F5']
                                    }, {
                                        data: data1,
                                        points: {
                                            show: true,
                                            fill: true,
                                            radius: 4,
                                            fillColor: "#9ACAE6",
                                            lineWidth: 2
                                        },
                                        color: '#9ACAE6',
                                        shadowSize: 1
                                    }, {
                                        data: data1,
                                        lines: {
                                            show: true,
                                            fill: false,
                                            lineWidth: 3
                                        },
                                        color: '#9ACAE6',
                                        shadowSize: 0
                                    }],

                                    {

                                        xaxis: {
                                            tickLength: 0,
                                            tickDecimals: 0,
                                            mode: "categories",
                                            min: 0,
                                            font: {
                                                lineHeight: 18,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        yaxis: {
                                            ticks: 5,
                                            tickDecimals: 0,
                                            tickColor: "#eee",
                                            font: {
                                                lineHeight: 14,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        grid: {
                                            hoverable: true,
                                            clickable: true,
                                            tickColor: "#eee",
                                            borderColor: "#eee",
                                            borderWidth: 1
                                        }
                                    });

                                $("#site_activities").bind("plothover", function(event, pos, item) {
                                    $("#x").text(pos.x.toFixed(2));
                                    $("#y").text(pos.y.toFixed(2));
                                    if (item) {
                                        if (previousPoint2 != item.dataIndex) {
                                            previousPoint2 = item.dataIndex;
                                            $("#tooltip").remove();
                                            var x = item.datapoint[0].toFixed(2),
                                                y = item.datapoint[1].toFixed(2);
                                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + '条');
                                        }
                                    }
                                });

                                $('#site_activities').bind("mouseleave", function() {
                                    $("#tooltip").remove();
                                });
                            }
                            //到校人数
                            if ($('#on_school').size() != 0) {
                                var previousPoint2 = null;
                                $('#on_school_loading').hide();
                                $('#on_school_content').show();
                                var data1 = [
                                    <?php  if(is_array($out_list)) { foreach($out_list as $row) { ?>
                                        ['<?php  echo $row['time'];?>','<?php  echo $row['count'];?>'],
                                    <?php  } } ?>
                                ];

                                var plot_statistics = $.plot($("#on_school"),

                                    [{
                                        data: data1,
                                        lines: {
                                            fill: 0.2,
                                            lineWidth: 0,
                                        },
                                        color: ['#BAD9F5']
                                    }, {
                                        data: data1,
                                        points: {
                                            show: true,
                                            fill: true,
                                            radius: 4,
                                            fillColor: "#9ACAE6",
                                            lineWidth: 2
                                        },
                                        color: '#9ACAE6',
                                        shadowSize: 1
                                    }, {
                                        data: data1,
                                        lines: {
                                            show: true,
                                            fill: false,
                                            lineWidth: 3
                                        },
                                        color: '#9ACAE6',
                                        shadowSize: 0
                                    }],
                                    {

                                        xaxis: {
                                            tickLength: 0,
                                            tickDecimals: 0,
                                            mode: "categories",
                                            min: 0,
                                            font: {
                                                lineHeight: 18,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        yaxis: {
                                            ticks: 5,
                                            tickDecimals: 0,
                                            tickColor: "#eee",
                                            font: {
                                                lineHeight: 14,
                                                style: "normal",
                                                variant: "small-caps",
                                                color: "#6F7B8A"
                                            }
                                        },
                                        grid: {
                                            hoverable: true,
                                            clickable: true,
                                            tickColor: "#eee",
                                            borderColor: "#eee",
                                            borderWidth: 1
                                        }
                                    });

                                $("#on_school").bind("plothover", function(event, pos, item) {
                                    $("#x").text(pos.x.toFixed(2));
                                    $("#y").text(pos.y.toFixed(2));
                                    if (item) {
                                        if (previousPoint2 != item.dataIndex) {
                                            previousPoint2 = item.dataIndex;
                                            $("#tooltip").remove();
                                            var x = item.datapoint[0].toFixed(2),
                                                y = item.datapoint[1].toFixed(2);
                                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + '人');
                                        }
                                    }
                                });

                                $('#on_school').bind("mouseleave", function() {
                                    $("#tooltip").remove();
                                });
                            }

                        },
                        init: function() {
                            this.initCharts();
                        }
                    };

                }();

                if (App.isAngularJsApp() === false) {
                    jQuery(document).ready(function() {
                        Dashboard.init(); // init metronic core componets
                    });
                }
            </script>
    </body>
    </html>
