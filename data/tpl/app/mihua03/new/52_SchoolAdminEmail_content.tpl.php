<?php defined('IN_IA') or exit('Access Denied');?>        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <li class="list-message" data-ix="list-item">
                <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('schoolAdminEmailInfo',array("mid"=>$row['message_id']) )?>" data-load="1">
                <div class="w-clearfix column-left">
                    <div class="image-message background_img list_img"  style="background-image: url(<?php  echo C('student')->studentImg($row['student_id']);?>)"></div>
                </div>
                <div class="column-right">
                    <div class="message-title"><?php  echo $row['title'];?></div>
                    <div class="message-text"> <?php  echo $row['message_content'];?></div>
                    <div class="message-text " style="text-align: right;font-size: 0.6rem;"> <?php  echo date("Y-m-d H:i:s",$row['add_time'])?></div>
                </div>
                </a>
            </li>
        <?php  } } ?>