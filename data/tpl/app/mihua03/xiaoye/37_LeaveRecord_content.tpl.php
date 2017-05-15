<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($list)) { foreach($list as $row) { ?>
	<div class="qj">
		<div class="qj-t">
		<p>申请人:<?php  echo $student_name;?><?php  echo $row['relation'];?></p>
        <?php  if($row['leave_status'] ==2) { ?><img src=" <?php echo MODULE_URL;?>/template/xiaoye/upimg/leave_pass.png"><?php  } else if($row['leave_status'] ==1) { ?><img src=" <?php echo MODULE_URL;?>/template/xiaoye/upimg/leave_wait.png"><?php  } else if($row['leave_status'] !=1) { ?> <img src=" <?php echo MODULE_URL;?>/template/xiaoye/upimg/leave_done.png"><?php  } ?>
		</div>
		<div class="qj-m">
			    <p1>请假时间:<?php  echo date("m-d H:i",$row['time_date_begin'])?>-<?php  echo date("m-d H:i",$row['time_date_end'])?></p1>
		</div>
		<div class="qj-b">
		        <p>申请内容:【<?php  echo $cclass_leave->leave_type[$row['leave_type']];?>】<?php  echo $row['leave_reason'];?></p>       
		</div>
           <?php  if($row['leave_voice']) { ?>
           <div style="clear: both"></div>
            <div class="YY">
                <div id="">
                <audio preload="auto" controls src=" <?php  echo  $this->imgFrom($row['leave_voice']);?>">
                </audio> 
                </div>
            </div>    
            <?php  } ?>   
	</div>
    <?php  if($row['leave_status'] !=1 ) { ?>
        <div class="qj-mm">
            <div class="qj-mm1">
                <p1><?php  echo $row['teacher'];?>回复：</p1>
                <?php  if($row['reply_time']) { ?>
                    <p2><?php  echo date("Y-m-d H:i",$row['reply_time'])?></p2>
                <?php  } ?>
            </div>
            <div class="qj-mm2">
            <p><?php  echo $row['teacher_text'];?></p>
            </div>
        </div>
    <?php  } ?>
	<div class="tz-mm"></div>
<?php  } } ?>