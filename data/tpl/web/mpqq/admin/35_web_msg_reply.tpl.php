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
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="<?php  echo $send_num;?>"><?php  echo $send_num;?></span>
                                    </div>
                                    <div class="desc">  <?php  if($teacher_web) { ?>发送总教师数<?php  } else { ?>发送总学生数<?php  } ?></div>
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
                                        <span data-counter="counterup" data-value="<?php  echo $look_num_info['count'];?>"><?php  echo $look_num_info['count'];?></span></div>
                                    <div class="desc"> 总查看数 </div>
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
                                        <span data-counter="counterup" data-value="<?php  echo $reply_num_info['count'];?>"><?php  echo $reply_num_info['count'];?></span>
                                    </div>
                                    <div class="desc"> 有内容回复数</div>
                                </div>
                            </a>
                        </div>
                    <div class="clearfix"></div>
                         <div class="col-md-12 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>详细列表 </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                <th>  <?php  if($teacher_web) { ?>教师<?php  } else { ?>学生<?php  } ?> </th>
                                                <th> 状态 </th>
                                                <th> 时间 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr class="odd gradeX">
                                                    <td> <?php  echo $row['student_name'];?> </td>
                                                    <td> <?php  echo $row['status'];?> </td>
                                                    <td> <?php  echo $row['add_time'];?> </td>
                                                    <td>
                                                        <?php  if($row['look_id'] && $row['look_content']) { ?>
                                                            <button  class="btn btn-outline btn-circle btn-sm purple" onclick="lookInfo(<?php  echo $row['look_id'];?>)">  
                                                                <i class="fa fa-edit"></i> 查看回复详情 
                                                            </button>
                                                        <?php  } else if($row['look_id']) { ?>
                                                            无回复
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

                    </div>
                </div>
             </div>
            <!-- BEGIN QUICK SIDEBAR -->
          <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
          <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/modals', TEMPLATE_INCLUDEPATH)) : (include template('../admin/modals', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
    <script>
    function lookInfo(look_id){
        $.ajax({
            url:'<?php  echo $this->createWebUrl('ajax')?>',
            type:'post',
            data:{ac:'look_info',look_id:look_id},
            dataType:'json',
            success:function(obj){
                if(obj.errcode==0){
                    $("#msg_replay").find('.text').html(obj.text);
                    $("#msg_replay").find('.voice').html(obj.voice);
                    $("#msg_replay").find('.images').html(obj.imgs);
                    showModel('msg_replay');
                }
            }    
        });
    }
    function reSend(rid,student_id){
        $.ajax({
            url:'<?php  echo $this->createWebUrl('ajax')?>',
            type:'post',
            data:{ac:'reSend',rid:rid,student_id:student_id},
            dataType:'json',
            success:function(obj){
                if(obj.errcode==0){
                    $("#modal_notice").find('.modal-body').html("发送成功");
                    showModel('modal_notice');
                }
            }    
        });
    }
    </script>
    <!--筛选表格-->
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>           
    </body>
    </html>
