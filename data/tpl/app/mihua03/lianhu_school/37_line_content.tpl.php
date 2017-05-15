<?php defined('IN_IA') or exit('Access Denied');?>        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php  if($row['student_send']==1 && $row['student_id']==0) { ?>
                <?php  $fanid=$this->class_base->mobileGetFanidByUid($row['send_uid']);?>
                <?php  $teacher_result = $this->findTeacherInfoByMobileUid($row['send_uid']);?>
                <?php  $student_id  = $class_student->getStudentIdByFanid($fanid,$class_id);?>
                <?php  $student_info = $class_student->getStudentInfo($student_id);?>
           <?php  } ?>
            <?php  if($row['student_send']==1 && $row['student_id']>0 ) { ?>
                <?php  unset($teacher_result);?>
                <?php  $student_info = $class_student->getStudentInfo($row['student_id']);?>
           <?php  } ?>
            <?php  if($row['student_send']==0 && $row['teacher_id']>0 ) { ?>
                <?php  $teacher_result = D('teacher')->getTeacherInfo($row['teacher_id']);?>
            <?php  } ?>
            
      		<ul id='list_id_<?php  echo $row['send_id'];?>' class="line_list_content">
             <li class="box" >
            		<div class="author">
                    		<a href="#">
                                <img src="<?php  if($teacher_result) { ?><?php  echo D('teacher')->teacherImg($teacher_result['teacher_id']);?><?php  } else { ?> <?php  echo $_W['attachurl'];?><?php  echo $student_info['student_img'];?><?php  } ?>">
                            </a>
                            <p class="author_name"> 
                                <?php  if(!$teacher_result) { ?>
                                    <?php  echo $student_info['student_name'];?>
                                    <?php  if($row['relation']) { ?>（<?php  echo $row['relation'];?>）<?php  } ?>
                                <?php  } else { ?>
                                    <?php  echo $teacher_result['teacher_realname'];?>(教师)
                                <?php  } ?>
                            </p>
                            <?php  if($uid==$row['send_uid']  || $in_type['type']=='teacher' ) { ?>
                            <?php  if($in_type['type']!='teacher') { ?>
                               <span class='no_pass'><?php  if($row['send_status']==2) { ?>审核中<?php  } ?></span>
                            <?php  } ?>
                            <?php  if($in_type['type']=='teacher' && $row['send_status']==2) { ?>
                               <a href="javascript:;" class="pass " data-send='<?php  echo $row['send_id'];?>' id="pass<?php  echo $row['send_id'];?>" >
                                 <i class="fa fa-check" aria-hidden="true" style="color:#00ff00"></i>
                               </a>                            
                            <?php  } ?>
                               <a href="javascript:;" class="close delete" data-send='<?php  echo $row['send_id'];?>' >
                                  <img src="<?php echo MODULE_URL;?>/style/images/close.png">
                               </a>
                            <?php  } ?>
                    </div>
                        <div class="topic">
                            <p><?php  echo $row['send_content'];?></p>
                            <div onclick='displayImage(this)'>
                                <?php  echo $this->decodeLineImgs($row['send_image']);?>
                                <div class='clear'></div>
                             </div>
                            <p class="author_time"><?php  echo date("m-d H:i",$row['add_time']);?></p>
                        </div>
                    <div class="click_hf">
                        <div class='line_jian_tou'><i class="fa fa-sort-asc"></i></div>
                        <?php  $zan_have=$this->zanLine($row['send_id']);?>
                        <a href="javascript:;" class="zan" id="zan_<?php  echo $row['send_id'];?>" data-send='<?php  echo $row['send_id'];?>' style="<?php  if($zan_have==1) { ?>color:#07E<?php  } else { ?>color:#333<?php  } ?>">
                            <i class="fa fa-heart-o"></i>
                       </a>
                       <span id="like_num_<?php  echo $row['send_id'];?>" class='like_name'><?php  echo D('line')->getLineZanName($row['send_id']);?>
                       </span>
                        <div  class='comment huifu' data-id='<?php  echo $row['send_id'];?>'><i class="fa fa-comment-o"></i></div>
                        <div  class='comment_list_line' id="comment_list_line<?php  echo $row['send_id'];?>">
                         <?php  $comment_list = D('line')->getLineComment($row['send_id']);?>
                         <?php  if($comment_list ) { ?>
                            <?php  if(is_array($comment_list)) { foreach($comment_list as $val) { ?>
                                <span><?php  echo $val['nickname'];?>:</span><?php  echo $val['comment_text'];?><br>
                            <?php  } } ?>
                         <?php  } ?>
                         </div>
                    </div>
            </li>           
            </ul>      
        <?php  } } ?>
        <script>
            $('.zan').on('click',function(){
                send_id=$(this).attr('data-send');
                ajaxComment(send_id,1,'line_like','like_num_')
                $('#zan_'+send_id).css('color','#07E');    
            });
            $('.huifu').click(function(){
                send_id=$(this).attr('data-id');
                $('#comment_area').show();
            });            
            $('.delete').on('click',function(){
                send_id=$(this).attr('data-send');
                line_ajax(send_id,'delete');
            });   
           $('.pass').on('click',function(){
                 send_id=$(this).attr('data-send');
                 line_ajax(send_id,'line_pass');
            });  

        </script>
