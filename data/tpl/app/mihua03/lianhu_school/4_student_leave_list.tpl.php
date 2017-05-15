<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list)) { foreach($list as $row) { ?>
<div class="weui_panel_bd weui_panel_access " style="border:1px solid #ccc;margin-bottom:10px;"> 
            <div class="weui_media_box weui_media_text">
                <p class="weui_mediaweui_media_desc_title">学生申请：<?php  echo $row['leave_reason'];?></p>
                <p class="weui_media_desc"><?php  if($row['teacher_text']) { ?>教师回复：<?php  echo $row['teacher_text'];?><?php  } ?></p>
                <ul class="weui_media_info">
                    <li class="weui_media_info_meta"><?php  echo date("Y-m-d H:i",$row['time_date_begin'])?></li>
                    <li class="weui_media_info_meta"><?php  echo date("Y-m-d H:i",$row['time_date_end'])?> </li>
                    <li class="weui_media_info_meta"><?php  if($row['leave_status'] ==1) { ?><i class="weui_icon_waiting_circle"></i> <?php  } else if($row['leave_status'] ==2) { ?><i class="weui_icon_success"></i> <?php  } else { ?><i class="weui_icon_cancel"></i> <?php  } ?></li>
                </ul>
            </div>
</div>
<?php  } } ?>