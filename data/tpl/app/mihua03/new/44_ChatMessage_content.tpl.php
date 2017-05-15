<?php defined('IN_IA') or exit('Access Denied');?>          <?php  if(is_array($out_list)) { foreach($out_list as $row) { ?>
                <li class=" list-chat <?php  if($row['type']=='main' ) { ?> right <?php  } ?>" data-ix="list-item">
                 <?php  if($row['type']=='other' ) { ?>
                    <div class=" column-left chat">
                        <div class="image-message chat">
                            <div data-src='left' style="background-image: url(<?php  if($row['teacher_id']) { ?> <?php  echo $teacher_img;?> 
                            <?php  } else if($row['to_teacher_id']&& $_GPC['type'] =='teacher' ) { ?>  
                                <?php  echo $to_teacher_img;?>
                            <?php  } else if($row['to_student_id']) { ?>
                                <?php  echo $to_student_img;?>
                            <?php  } else { ?>
                                <?php  echo $student_img;?>
                             <?php  } ?>);width: 100%;height: 100%;background-size: 100%">
                             </div>
                        </div>
                    </div>                
                  <?php  } ?>
                <div class="w-clearfix column-right chat <?php  if($row['type']=='main' ) { ?> right <?php  } ?> " >
                    <?php  if($row['teacher_id'] && !$_GPC['o_id']) { ?>
                            <div class="chat-time  <?php  if($row['type']=='main' ) { ?> right  <?php  } ?>" style="width: 100%; <?php  if($row['type']=='main' ) { ?> text-align: right; <?php  } ?> color:#666" ><?php  echo $teacher_name;?></div>
                    <?php  } else if($row['to_teacher_id'] && $_GPC['type'] =='teacher' ) { ?>

                            <div class="chat-time  <?php  if($row['type']=='main' ) { ?> right  <?php  } ?>" style="width: 100%; <?php  if($row['type']=='main' ) { ?> text-align: right; <?php  } ?> color:#666" > <?php  if($row['type']!='main' ) { ?><?php  echo $to_teacher_name;?><?php  } ?></div>
                            
                    <?php  } else if($row['to_student_id']) { ?>
                            <div class="chat-time  <?php  if($row['type']=='main' ) { ?> right  <?php  } ?>" style="width: 100%; <?php  if($row['type']=='main' ) { ?> text-align: right; <?php  } ?> color:#666" >
                        <?php  if($row['type']!='main' ) { ?>
                                <?php  echo $to_student_name;?>[<?php  $fanid = D('base')->mobileGetFanidByUid($row['mobile_uid']);?><?php  echo D('student')->getRelation($row['to_student_id'],$fanid);?>]</div>
                        <?php  } ?>
                    <?php  } else { ?>
                            <div class="chat-time  <?php  if($row['type']=='main' ) { ?> right <?php  } ?>" style=" width: 100%; <?php  if($row['type']=='main' ) { ?> text-align: right; <?php  } ?> color:#666" ><?php  echo $student_name;?>[<?php  echo $row['relation'];?>]</div>
                    <?php  } ?>
                        <?php  if(is_array($row['display_content'])) { foreach($row['display_content'] as $k => $val) { ?>
                            <div class="chat-text  <?php  if($row['type']=='main' ) { ?> right <?php  } ?>"  <?php  if($k =='voice') { ?> style="width: 130px;overflow: hidden"<?php  } ?>>
                            <?php  if($k =='img') { ?>
                                <img src="<?php  echo $this->imgFrom($val)?>" style="height: auto;"  onclick="displayImageThis('<?php  echo $this->imgFrom($val)?>')" >
                            <?php  } else if($k =='text') { ?>
                                <?php  echo $val;?>
                            <?php  } else if($k =='voice') { ?>
                                <audio preload="auto"  style="width: 100px;overflow: hidden" controls   src="<?php  echo $this->imgFrom($val)?>" ></audio>
                            <?php  } ?>
                            </div>
                        <?php  } } ?>
                    <div class="chat-time  <?php  if($row['type']=='main' ) { ?> right <?php  } ?>"><?php  echo date("m-d H:i",$row['add_time'])?></div>
                </div>
                </li>          
          <?php  } } ?>