<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list)) { foreach($list as $row) { ?>
<div class="weui_panel_bd weui_panel_access " style="border:1px solid #ccc;margin-bottom:10px;"> 
            <div class="weui_media_box weui_media_text">
                <p class="weui_mediaweui_media_desc_title">申请人：<?php  echo $this->studentName($row['student_id']);?></p>
                <p class="weui_mediaweui_media_desc_title">申请理由：<?php  echo $row['leave_reason'];?></p>
                <p class="weui_mediaweui_media_desc_title">请假时间：<?php  echo date("Y-m-d H:i",$row['time_date_begin'])?> 至 <?php  echo date("Y-m-d H:i",$row['time_date_end'])?></p>
                <?php  if($row['leave_voice']) { ?>
                    <p class="weui_mediaweui_media_desc_title">语音：</p>
                     <audio src="<?php  echo $this->imgFrom($row['leave_voice']);?>" controls ></audio>
                 <?php  } ?>               
                <p class="weui_mediaweui_media_desc_title" style="color: #ff0033"><?php  if($row['teacher_text']) { ?>教师回复：<?php  echo $row['teacher_text'];?><?php  } ?></p>
                <p class="weui_mediaweui_media_desc_title">
                <?php  if($row['leave_status'] ==1) { ?><i class="weui_icon_waiting_circle"></i> <?php  } else if($row['leave_status'] ==2) { ?><i class="weui_icon_success"></i> <?php  } else { ?><i class="weui_icon_cancel"></i> <?php  } ?>
                </p>
            </div>
</div>
<?php  } } ?>