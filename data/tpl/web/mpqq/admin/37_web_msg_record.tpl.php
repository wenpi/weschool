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
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 模板消息发送记录 </p>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>模板消息发送记录 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div> 
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>PC/WEIXIN</th>
                                                <th>标题</th>
                                                <th>发送时间</th>
                                                <th width="50%">简要</th>
                                                <th  class="numeric" >发送数量</th>
                                                <th></th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr>
                                                    <td>
                                                        <?php  echo $class_sendRecord ->msgSendType($row['record_type']);  ?>
                                                    </td>
                                                    <td><?php  echo $row['record_title'];?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$row['add_time'])?></td>
                                                    <td style="word-break:break-all;"><?php  echo $row['record_intro'];?></td>
                                                    <?php  $student_ids = explode(',',$row['student_ids']);?>
                                                    <?php  if($row['student_teacher']==2) { ?>
                                                    <?php  $teacher_ids = explode(',',$row['teacher_ids']);?>
                                                        <td>教师数：<?php  echo count($teacher_ids);?></td>
                                                        <?php  $teacher_web=1?>
                                                    <?php  } else { ?>
                                                        <?php  $teacher_web=0?>
                                                        <td><?php  echo count($student_ids);?></td>
                                                    <?php  } ?>
                                                    <td>
                                                    <a  href="<?php  echo $this->createWebUrl('msgReplay', array('rid' => $row['record_id'],'record_type'=>$row['record_type'],'teacher_web'=>$teacher_web))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-edit"></i> 查看 </a>
                                                    </td>
                                                </tr>
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                    <?php  echo $pager;?>	
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
    </body>
    </html>