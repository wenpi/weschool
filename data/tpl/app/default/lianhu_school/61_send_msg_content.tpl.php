<?php defined('IN_IA') or exit('Access Denied');?>            <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php  $class_look->record_id = $row['record_id']; ?>
            <?php  $student_ids           = explode(',',$row['student_ids']);?>
            <?php  $look_num_info         = $class_look->recordLookNum();?>
            <?php  $all_num               = count($student_ids);?>
                <div class="weui_media_box weui_media_text">
                    <h4 class="weui_media_title" style="white-space:normal;line-height: 25px;">
                        <a href="<?php  if($row['hid']) { ?>
                                <?php  echo $this->createMobileUrl('homeWorkInfo',array('id'=>$row['hid']))?>
                            <?php  } else { ?>
                                <?php  echo $this->createMobileUrl('sendContent',array('type'=>'record','id'=>$row['record_id']))?>
                            <?php  } ?>">
                            <?php  echo date("m月d日H时",$row['add_time'])?>：<?php  echo $row['record_intro'];?>
            
                        </a></h4>
                    <?php  if($row['class_ids']) { ?>
                    <?php  $class_arr = explode(',',$row['class_ids']);?>
                        <ul>
                            <?php  if(is_array($class_arr)) { foreach($class_arr as $val) { ?>
                                <li> <?php  echo $this->className($val);?></li>
                            <?php  } } ?>
                        </ul>
                        <div style="clear: both"></div>
                    <?php  } ?>
                    <p class="weui_media_desc button_list">
                        <a href="javascript:;"><button class="weui_btn weui_btn_mini weui_btn_plain_primary">发送数：<?php  echo $all_num;?></button></a>
                        <a href="<?php  echo $this->createMobileUrl("tea_reply_list",array('rid'=>$row['record_id'],'look'=>1 ) );?>"><button class="weui_btn weui_btn_mini weui_btn_primary">查看数：<?php  echo $look_num_info['count']?></button></a>
                        <a href="<?php  echo $this->createMobileUrl("tea_reply_list",array('rid'=>$row['record_id'],'look'=>0 ) );?>"><button class="weui_btn weui_btn_mini weui_btn_warn">未查看：<?php  echo $all_num-$look_num_info['count']?></button></a>
                        <?php  if($row['hid']) { ?>
                            <a href="<?php  echo $this->createMobileUrl("tea_homeWork",array('hid'=>$row['hid'],'ac'=>'delete' ));?>">
                                    <button class="weui_btn weui_btn_mini weui_btn_warn" style="background-color:#ff9900;margin-top:10px;display:block;float:left"  >删&nbsp;&nbsp;除</button>
                            </a>
                        <?php  } ?>
                        <div style="clear:both"></div>
                    </p>
                </div>                 
              <?php  } } ?>


        