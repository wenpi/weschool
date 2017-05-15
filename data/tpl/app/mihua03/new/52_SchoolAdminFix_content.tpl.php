<?php defined('IN_IA') or exit('Access Denied');?>        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li class="list-message" data-ix="list-item">
                <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('SchoolAdminFixInfo',array("id"=>$row['repair_id']) )?>" data-load="1">
                    <div class="w-clearfix column-left">
                        <div class="image-message" style="background-image: url(<?php  if($row['teacher_id']) { ?>
                            <?php  echo D('teacher')->teacherImg($row['teacher_id']);?>
                        <?php  } else { ?>
                            <?php  echo C('student')->studentImg($row['student_id']);?>
                        <?php  } ?>)" >
                        </div>
                    </div>
                    <div class="column-right">
                        <div class="message-title"><?php  echo $row['repair_title'];?></div>
                        <div class="message-text"> <?php  echo $row['repair_content'];?></div>
                        <div class="message-text " style="text-align: right;font-size: 0.6rem;"> <?php  echo date("Y-m-d H:i:s",$row['add_time'])?></div>
                        <div class="message-text" style="color:#ff0033;<?php  if($row['repair_content']) { ?>float: left;margin-left: 75px;<?php  } ?>"><?php  if($row['do_status']) { ?><?php  echo $row['do_status'];?><?php  } else { ?>暂无回复<?php  } ?></div>
                    </div>
                </a>
            </li>
        <?php  } } ?>