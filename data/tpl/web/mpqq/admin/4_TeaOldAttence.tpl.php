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
                <?php  if($ac=='list') { ?>
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选考勤数据</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="TeaOldAttence" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">开始时间</label>
                                                            <div class="col-md-4">
                                                                <input name='begin_time' class="form-control"  id="mask_date"  value="<?php  echo $_GPC['begin_time'];?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">结束时间</label>
                                                            <div class="col-md-4">
                                                                <input name='end_time' class="form-control"  id="mask_date1" value="<?php  echo $_GPC['end_time'];?>">
                                                            </div>
                                                        </div>
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索"></button>
                                                                     <button class="btn btn-default" type="button">总记录数：<?php  echo $count;?></button>				
                                                                     <button class="btn btn-default" name='csv' value='1' >导出csv</button>	
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>
                             </div>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>打卡 
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> ID</th>
                                                <th>  姓名 </th>
                                                <th> 打卡时间 </th>
                                                <th> 打卡机 </th>
                                                <th> 卡值 </th>
                                                <th> 照片 </th>
                                                <th> 照片2 </th>
                                                <th> 进出 </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['record_id'];?></td>
                                                <td><?php  echo D("teacher")->teacherName($item['teacher_id']);?></td>
                                                <td><?php  if($item['play_card_time'] ) { ?><?php  echo date("Y-m-d H:i:s",$item['play_card_time']);?><?php  } else { ?><?php  echo date("Y-m-d H:i:s",$item['add_time']);?><?php  } ?></td>
                                                <?php  $device_info = $class_card->deviceInfo($item['device_id']); ?>
                                                <td><?php  echo $device_info['device_name'];?></td>
                                                <td><?php  echo $item['rfid_value'];?></td>
                                                <td><img src="<?php  echo $item['img_url'];?>" style="width:80px;"></td>
                                                <td><img src="<?php  echo $item['img_url2'];?>" style="width:80px;"></td>
                                                <?php  if($item['up_low']==1) { ?>
                                                    <?php  $text='<span class="font-red">进校</span>'; ?>
                                                <?php  } else if($item['up_low']==2) { ?>
                                                    <?php  $text='<span class="font-green">出校</span>'; ?>
                                                <?php  } else { ?>
                                                    <?php  $text='<span class="font-blue">异常</span>'; ?>
                                                <?php  } ?>
                                                <td><?php  echo $text;?></td>
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                        <?php  echo $pager;?>
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
                                $("#mask_date").inputmask("y-m-d h:s", {
                                    autoUnmask: true
                                }); //direct mask 
                                $("#mask_date1").inputmask("y-m-d h:s", {
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