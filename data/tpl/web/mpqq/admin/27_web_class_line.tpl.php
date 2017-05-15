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
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>班级列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th width="20%"  > 班级</th>
                                                <th> 	班主任 </th>
                                                <th class="numeric"> 学生数 </th>
                                                <th > 年级 </th>
                                                <th > 状态 </th>
                                                <th class="numeric">  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td>  <?php  echo $this->gradeName($item['grade_id']) ?>&nbsp;<i class="fa fa-toggle-right"></i>&nbsp;<?php  echo $item['class_name'];?> </td>
                                                <td>  <?php  echo $this->teacherName($item['teacher_id'])?>  </td>
                                                <td class="numeric"><?php  echo $this->classStudentNum($item['class_id']);?> </td>
                                                <td> <?php  echo $this->gradeName($item['grade_id']) ?></td>
                                                <td>	<?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='red'>关闭</span><?php  } ?></td>
                                                <td>
                                                    <!--<a  href="<?php  echo $this->createWebUrl('class_line', array('ac' => 'new','cid'=>$item['class_id'],'aw'=>1))?>" class="btn btn-outline btn-circle btn-sm purple">-->
                                                            <!--<i class="fa fa-plus-square"></i> 发布 </a>-->
                                                <a href="<?php  echo $this->createWebUrl('class_line', array('ac' => 'look','cid'=>$item['class_id'] ,'aw'=>1 ))?>" 
                                                    class="btn btn-outline btn-circle dark btn-sm black" title="查看"><i class="fa fa-eye"></i>
                                                    查看
                                                </a>               
                                                </td>                          
                                            </tr>
                                        <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php  if($ac=='look') { ?>
               <div class="portlet light portlet-fit ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-microphone font-green"></i>
                                <span class="caption-subject bold font-green uppercase"> <?php  echo $class['class_name'];?></span>
                                <span class="caption-helper">班级圈</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="mt-timeline-2">
                                <div class="mt-timeline-line border-grey-steel"></div>
                                <ul class="mt-container">
                                    <?php  if(is_array($line_list)) { foreach($line_list as $row) { ?>
                                                <?php  $class_student= D("student");?> 
                                                <?php  $fanid        = D('base')->mobileGetFanidByUid($row['send_uid']);?>
                                                <?php  $avatar       = D('base')->mobileGetAvatarByUid($row['send_uid']);?>
                                                <?php  $nickname     = D('base')->mobileGetNicknameByUid($row['send_uid']);?>
                                                <?php  $student_id   = $class_student->getStudentIdByFanid($fanid,$row['class_id']);?>
                                                <?php  $student_info = $class_student->getStudentInfo($student_id);?>
                                                <?php  $relation     = $class_student->getCLassFirstRelation($fanid,$row['class_id']);?>

                                        <li class="mt-item">
                                            <div class="mt-timeline-icon bg-green-turquoise bg-font-green-turquoise border-grey-steel" style="line-height:70px">
                                              <i >  <?php  echo date("m-d",$row['add_time'])?></i>
                                            </div>
                                            <div class="mt-timeline-content">
                                                <div class="mt-content-container">
                                                    <div class="mt-title">
                                                    </div>
                                                    <div class="mt-author">
                                                        <div class="mt-avatar">
                                                            <img src="<?php  echo $avatar;?>" />
                                                        </div>
                                                        <div class="mt-author-name">
                                                            <a href="javascript:;" class="font-blue-madison"><?php  if($student_info) { ?><?php  echo $student_info['student_name'];?>（<?php  echo $relation;?>）<?php  } else { ?><?php  echo $nickname;?><?php  } ?></a>
                                                        </div>
                                                        <div class="mt-author-notes font-grey-mint"><?php  echo date("Y-m-d H:i:s",$row['add_time'])?></div>
                                                    </div>
                                                    <div class="mt-content border-grey-salt">
                                                            <?php  echo $this->webDecodeLineImgs($row['send_image']);?>
                                                            <div style="clear:both"></div>
                                                            <p>
                                                                    <?php  echo $row['send_content'];?>
                                                            </p>
                                                        <?php  if($row['send_status']==2) { ?>
                                                            <a href="<?php  echo $this->createWebUrl('class_line',array('aw'=>1,'op'=>'pass','sid'=>$row['send_id'] ,'cid'=>$class['class_id'] ) );?>" class="btn btn-circle btn-icon-only blue">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        <?php  } ?>
                                                        <a href="<?php  echo $this->createWebUrl('class_line',array('aw'=>1,'op'=>'delete','sid'=>$row['send_id'] ,'cid'=>$class['class_id']  ) );?>" class="btn btn-circle btn-icon-only red pull-right">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php  } } ?>
                                </ul>
                                <?php  echo $pager;?>
                            </div>
                        </div>
                    </div>                        
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>