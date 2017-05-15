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
                 <div class="row">
                        <div class="col-md-12">
                         <div class="col-md-6">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption ">
                                            <span> 设置</span>
                                        </div>
                                    </div>
                                        <div class="portlet-body form">
                                           <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-body ">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>接收消息管理人</label>
                                                    <div class="col-md-10">
                                                        <select name="admin_id" class="form-control">
                                                            <?php  $school_message_admin_id =  S("system",'getSetContent',array('school_message_admin',$this->school_info['school_id']))?>
                                                            <?php  if(is_array($admin_list)) { foreach($admin_list as $row) { ?>
                                                                <option value="<?php  echo $row['admin_id'];?>" <?php  if($school_message_admin_id == $row['admin_id']) { ?>selected<?php  } ?>> <?php  echo $row['admin_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="form-actions ">
                                                      <div class="row">
                                                        <div class="col-md-offset-2 col-md-10">
                                                	        <input type="submit" name="submit" value="提交" class="btn green" />
                                                        </div>
                                                      </div>
                                                </div>
                                             </div>
                                      </form>
                                    </div>                        
                                </div>                            
                         </div>                            
                         <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class=" icon-social-twitter font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">家长留言</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li <?php  if($_GPC['tab']!='s_page') { ?>class="active" <?php  } ?>>
                                            <a href="#tab_actions_pending" data-toggle="tab"> 未处理 </a>
                                        </li>

                                        <li  <?php  if($_GPC['tab']=='s_page') { ?>class="active" <?php  } ?>>
                                            <a href="#tab_actions_completed" data-toggle="tab"> 已处理 </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane <?php  if($_GPC['tab']!='s_page') { ?> active  <?php  } ?> " id="tab_actions_pending">
                                            <!-- BEGIN: Actions -->
                                            <div class="mt-actions">
                                                <?php  $class_student=D('student'); ?>
                                                <?php  if(is_array($student_not_result['list'])) { foreach($student_not_result['list'] as $row) { ?>
                                                <?php  $student_info = $class_student->getStudentInfo($row['student_id']);?>
                                                <?php  $fanid = $this->class_base->mobileGetFanidByUid($row['send_uid']);?>                                                
                                                    <div class="mt-action" id='message_area_<?php  echo $row['message_id'];?>'>
                                                        <div class="mt-action-img">
                                                            <img style="width:100%" src="<?php  echo $this->class_base->mobileGetAvatarByUid($row['send_uid'])?>" /> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php  echo $student_info['student_name'];?>(<?php  echo $class_student->getRelation($row['student_id'],$fanid);?>)</span>
                                                                        <p class="mt-action-desc"><?php  echo $row['title'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span class="mt-action-date"><?php  echo date("Y-m-d",$row['add_time'])?></span>
                                                                    <span class="mt-action-dot bg-green"></span>
                                                                    <span class="mt=action-time"><?php  echo date("H:i",$row['add_time'])?></span>
                                                                </div>
                                                                <div style="display:none" id='content_<?php  echo $row['message_id'];?>'><?php  echo $row['message_content'];?></div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <button type="button" data-id='<?php  echo $row['message_id'];?>' onclick="handleMessage(this)" class="btn btn-outline green btn-sm">回复</button>
                                                                        <button type="button" data-id='<?php  echo $row['message_id'];?>' onclick="deleteMessage(this)" class="btn btn-outline red btn-sm">删除</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  } } ?>
                                            </div>
                                                        <div class="clearfix  margin-top-10">
                                                            <div class="btn-group btn-group-justified">
                                                                <a href="<?php  if($s_n_page==1 ) { ?>javascript:;<?php  } else { ?> <?php  $new_page =$s_n_page-1; ?><?php  echo $this->createWebUrl('schoolMessage',array('s_n_page'=> $new_page,'tab'=>'s_n_page' ));?>  <?php  } ?>" class="btn btn-default"> 上一页 </a>
                                                                <a href="javascript:;" class="btn btn-default"> <?php  echo $s_n_page;?>/<?php  echo $s_n_page_count;?> </a>
                                                                <a href="<?php  if($s_n_page>= $s_n_page_count ) { ?>javascript:;<?php  } else { ?><?php  echo $this->createWebUrl('schoolMessage',array('s_n_page'=> ++$s_n_page,'tab'=>'s_n_page' ));?>   <?php  } ?> " class="btn btn-default"> 下一页 </a>
                                                            </div>
                                                        </div>                                     
                                        </div>
                                        <!--第二个-->
                                        <div class="tab-pane <?php  if($_GPC['tab']=='s_page') { ?> active  <?php  } ?> " id="tab_actions_completed">
                                            <div class="mt-actions">
                                                <?php  $class_student=D('student'); ?>
                                                <?php  if(is_array($student_result['list'])) { foreach($student_result['list'] as $row) { ?>
                                                <?php  $student_info = $class_student->getStudentInfo($row['student_id']);?>
                                                <?php  $fanid = $this->class_base->mobileGetFanidByUid($row['send_uid']);?>                                                
                                                    <div class="mt-action" id='message_area_<?php  echo $row['message_id'];?>' >
                                                        <div class="mt-action-img">
                                                            <img style="width:100%" src="<?php  echo $this->class_base->mobileGetAvatarByUid($row['send_uid'])?>" /> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php  echo $student_info['student_name'];?>(<?php  echo $class_student->getRelation($row['student_id'],$fanid);?>)</span>
                                                                        <p class="mt-action-desc"><?php  echo $row['title'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span class="mt-action-date"><?php  echo date("Y-m-d",$row['add_time'])?></span>
                                                                    <span class="mt-action-dot bg-green"></span>
                                                                    <span class="mt=action-time"><?php  echo date("H:i",$row['add_time'])?></span>
                                                                </div>
                                                                <div style="display:none" id='content_<?php  echo $row['message_id'];?>'><?php  echo $row['message_content'];?></div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <button type="button" data-id='<?php  echo $row['message_id'];?>' onclick="handleMessage(this)" class="btn btn-outline green btn-sm">回复</button>
                                                                        <button type="button" data-id='<?php  echo $row['message_id'];?>' onclick="deleteMessage(this)" class="btn btn-outline red btn-sm">删除</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  } } ?>
                                            </div>
                                            <div class="clearfix  margin-top-10">
                                            <div class="btn-group btn-group-justified">
                                                  <a href="<?php  if($s_page==1 ) { ?>javascript:;<?php  } else { ?> <?php  $new_page =$s_page-1; ?><?php  echo $this->createWebUrl('schoolMessage',array('s_page'=> $new_page,'tab'=>'s_page' ));?>  <?php  } ?>" class="btn btn-default"> 上一页 </a>
                                                  <a href="javascript:;" class="btn btn-default"> <?php  echo $s_page;?>/<?php  echo $s_page_count;?> </a>
                                                  <a href="<?php  if($s_page>= $s_page_count ) { ?>javascript:;<?php  } else { ?><?php  echo $this->createWebUrl('schoolMessage',array('s_page'=> ++$s_page,'tab'=>'s_page' ));?>   <?php  } ?> " class="btn btn-default"> 下一页 </a>
                                             </div>
                                           </div>                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--
                         <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <i class=" icon-social-twitter font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">教师留言</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li  <?php  if($_GPC['tab']!='t_page') { ?>class="active" <?php  } ?> >
                                            <a href="#tab_actions_pending2" data-toggle="tab"> 未处理 </a>
                                        </li>
                                        <li  <?php  if($_GPC['tab']== 't_page') { ?>class="active" <?php  } ?>>
                                            <a href="#tab_actions_completed2" data-toggle="tab"> 已处理 </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <div class="tab-pane  <?php  if($_GPC['tab']!='t_page') { ?> active <?php  } ?>" id="tab_actions_pending2">
                                            <div class="mt-actions">
                                                <?php  $class_teacher=D('teacher'); ?>
                                                <?php  if(is_array($teacher_not_result['list'])) { foreach($teacher_not_result['list'] as $row) { ?>
                                                <?php  $teacher_info  = $class_teacher->getTeacherInfo($row['teacher_id']);?>
                                                    <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <img style="width:100%" src="<?php  echo $this->class_base->mobileGetAvatarByUid($row['send_uid'])?>" /> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php  echo $teacher_info['teacher_realname'];?></span>
                                                                        <p class="mt-action-desc"><?php  echo $row['title'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span class="mt-action-date"><?php  echo date("Y-m-d",$row['add_time'])?></span>
                                                                    <span class="mt-action-dot bg-green"></span>
                                                                    <span class="mt=action-time"><?php  echo date("H:i",$row['add_time'])?></span>
                                                                </div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <button type="button" class="btn btn-outline green btn-sm">回复</button>
                                                                        <button type="button" class="btn btn-outline red btn-sm">删除</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  } } ?>
                                            </div>
                                                         <div class="clearfix  margin-top-10">
                                                            <div class="btn-group btn-group-justified">
                                                                <a href="<?php  if($t_n_page==1 ) { ?>javascript:;<?php  } else { ?> <?php  $new_page =$t_n_page-1; ?><?php  echo $this->createWebUrl('schoolMessage',array('t_n_page'=> $new_page,'tab'=>'t_n_page' ));?>  <?php  } ?>" class="btn btn-default"> 上一页 </a>
                                                                <a href="javascript:;" class="btn btn-default"> <?php  echo $t_n_page;?>/<?php  echo $t_n_page_count;?> </a>
                                                                <a href="<?php  if($t_n_page>= $t_n_page_count ) { ?>javascript:;<?php  } else { ?><?php  echo $this->createWebUrl('schoolMessage',array('t_n_page'=> ++$t_n_page,'tab'=>'t_n_page' ));?>   <?php  } ?> " class="btn btn-default"> 下一页 </a>
                                                            </div>
                                                        </div>   
                                        </div>
                                        <div class="tab-pane <?php  if($_GPC['tab']=='t_page') { ?> active <?php  } ?> " id="tab_actions_completed2">
                                            <div class="mt-actions">
                                                <?php  $class_teacher=D('teacher'); ?>
                                                <?php  if(is_array($teacher_result['list'])) { foreach($teacher_result['list'] as $row) { ?>
                                                <?php  $teacher_info  = $class_teacher->getTeacherInfo($row['teacher_id']);?>
                                                    <div class="mt-action">
                                                        <div class="mt-action-img">
                                                            <img style="width:100%" src="<?php  echo $this->class_base->mobileGetAvatarByUid($row['send_uid'])?>" /> </div>
                                                        <div class="mt-action-body">
                                                            <div class="mt-action-row">
                                                                <div class="mt-action-info ">
                                                                    <div class="mt-action-details ">
                                                                        <span class="mt-action-author"><?php  echo $teacher_info['teacher_realname'];?></span>
                                                                        <p class="mt-action-desc"><?php  echo $row['title'];?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-action-datetime ">
                                                                    <span class="mt-action-date"><?php  echo date("Y-m-d",$row['add_time'])?></span>
                                                                    <span class="mt-action-dot bg-green"></span>
                                                                    <span class="mt=action-time"><?php  echo date("H:i",$row['add_time'])?></span>
                                                                </div>
                                                                <div class="mt-action-buttons ">
                                                                    <div class="btn-group btn-group-circle">
                                                                        <button type="button" class="btn btn-outline green btn-sm">回复</button>
                                                                        <button type="button" class="btn btn-outline red btn-sm">删除</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  } } ?>
                                            </div>
                                                         <div class="clearfix  margin-top-10">
                                                            <div class="btn-group btn-group-justified">
                                                                <a href="<?php  if($t_page==1 ) { ?>javascript:;<?php  } else { ?> <?php  $new_page =$t_page-1; ?><?php  echo $this->createWebUrl('schoolMessage',array('t_page'=> $new_page,'tab'=>'t_page' ));?>  <?php  } ?>" class="btn btn-default"> 上一页 </a>
                                                                <a href="javascript:;" class="btn btn-default"> <?php  echo $t_page;?>/<?php  echo $t_page_count;?> </a>
                                                                <a href="<?php  if($t_page>= $t_page_count ) { ?>javascript:;<?php  } else { ?><?php  echo $this->createWebUrl('schoolMessage',array('t_page'=> ++$t_page,'tab'=>'t_page' ));?>   <?php  } ?> " class="btn btn-default"> 下一页 </a>
                                                            </div>
                                                        </div>                                                 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/modals', TEMPLATE_INCLUDEPATH)) : (include template('../admin/modals', TEMPLATE_INCLUDEPATH));?>
        <script>
            var handle_message_id=0;
            function handleMessage(obj){
                handle_message_id = $(obj).attr('data-id');
                var title      = $("#message_area_"+handle_message_id).find('.mt-action-desc').text();
                var content    = $("#content_"+handle_message_id).text();
                showModel('modal_notice');                
                $("#modal_notice").find(".modal-title").html("回复【"+title+"】");
                $("#modal_notice").find('.modal-body').html('<div class="note note-info bg-font-grey  bold uppercase">家长：'+content+'</div>');
                getRebackList(handle_message_id);
             }
            //获取回复详细
            function getRebackList(message_id){
                $.ajax({
                    url:"<?php  echo $this->createWebUrl('ajax')?>",
                    type:'post',
                    data:{message_id:message_id,ac:'schoole_message_list'},
                    dataType:'json',
                    success:function(re){
                        if(re.errcode==1){
                            alert(re.msg);
                            return false;
                        }else {
                            $.each(re,function(i,e){
                                if(e.type){
                                    if(e.type==1){
                                        str = '学校：';
                                        color = 'note note-success ';
                                    }else{
                                        str = '家长：';
                                        color = 'note note-info bg-font-grey  bold uppercase';
                                    }               
                                    $("#modal_notice").find('.modal-body').append('<div class="'+color+'">'+str+e.content+'</div>');
                                }
                            });
                        }
                        $("#modal_notice").find('.modal-body').append('<textarea class="form-control" id="textarea_'+handle_message_id+'" rows="3"></textarea> <div class="clearfix  margin-top-10"></div><button class="btn blue btn-block" onclick="handleContent()" >回复</button>');
                    }
                });
            }
            function handleContent(){
                var content = $("#textarea_"+handle_message_id).val();
                if(!content){
                    alert("请先填写回复内容");
                    return false;    
                }
                $.ajax({
                    url:"<?php  echo $this->createWebUrl('ajax')?>",
                    type:'post',
                    data:{message_id:handle_message_id,ac:'handle_message',content:content},
                    dataType:'json',
                    success:function(re){
                        if(re.errcode==1){
                            alert(re.msg);
                        }else{
                            $("#modal_notice").find('.modal-body').html("回复成功，刷新页面可见效果");
                        }
                    }
                }) ; 
            }
            function deleteMessage(obj){
                var message_id = $(obj).attr('data-id');
                $.ajax({
                    url:"<?php  echo $this->createWebUrl('ajax')?>",
                    type:'post',
                    data:{message_id:message_id,ac:'delete_message'},
                    dataType:'json',
                    success:function(re){
                        if(re.errcode==1){
                            alert(re.msg);
                        }else{
                            $("#message_area_"+message_id).remove();
                        }
                    }
                }) ;  
            }
        </script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>