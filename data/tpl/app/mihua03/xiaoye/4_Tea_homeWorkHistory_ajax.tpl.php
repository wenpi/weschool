<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list)) { foreach($list as $row) { ?>
<?php  $class_look->record_id = $row['record_id']; ?>
<?php  $student_ids           = explode(',',$row['student_ids']);?>
<?php  $look_num_info         = $class_look->recordLookNum();?>
<?php  $all_num               = count($student_ids);?>
            <li class="zyy">
                <div class="zy1"><a href="<?php  if($row['hid']) { ?>
                    <?php  echo $this->createMobileUrl('homeWorkInfo',array('id'=>$row['hid']))?>
                    <?php  } else { ?>
                    <?php  echo $this->createMobileUrl('sendContent',array('type'=>'record','id'=>$row['record_id']))?>
                    <?php  } ?>"><?php  echo date("m月d日H时",$row['add_time'])?>：<?php  echo $row['record_intro'];?></a></div>
                 <?php  if($row['class_ids']) { ?>
                 <?php  $class_arr = explode(',',$row['class_ids']);?>
                <div class="zyy2">
                    <?php  if(is_array($class_arr)) { foreach($class_arr as $val) { ?>
                          <div class="zy2"><?php  echo $this->className($val);?></div>
                    <?php  } } ?>
               </div>
               <?php  } ?>
                <div class="zy3">
                <div class="yz1"><p>发送数</p><span><?php  echo $all_num;?></span></div>
                    <div class="yz2">
                        <div class="yzz"><a href="<?php  echo $this->createMobileUrl("tea_reply_list",array('rid'=>$row['record_id'],'look'=>0 ) );?>">未读<?php  echo $all_num-$look_num_info['count']?></a></div>
                        <div class="yzz lv"><a href="<?php  echo $this->createMobileUrl("tea_reply_list",array('rid'=>$row['record_id'],'look'=>1 ) );?>">已读<?php  echo $look_num_info['count']?></a></div>
                    </div>
                      <?php  if($row['hid']) { ?>
                            <a href="<?php  echo $this->createMobileUrl("tea_homeWork",array('hid'=>$row['hid'],'ac'=>'delete' ));?>">
                                <button class=" homework_delete "  >删&nbsp;&nbsp;除</button>
                            </a>
                     <?php  } ?>
                </div>
            </li>
            <div class="kkz"></div>

<?php  } } ?>


        