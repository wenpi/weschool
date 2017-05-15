<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main">
    <div class="headqj">
        <a href="<?php  echo $this->createMobileUrl('leave')?>"><p>请假申请</p></a>
        <a href="<?php  echo $this->createMobileUrl('leaveRecord')?>"  class="pp"><p>申请记录</p></a>
    </div>
<?php  if(is_array($list)) { foreach($list as $row) { ?>
	<div class="qj">
		<div class="qj-t">
		<p>申请人:<?php  echo $student_name;?><?php  echo $row['relation'];?></p>
			<a href="/"><?php  if($row['leave_status'] ==2) { ?><img src=" <?php echo MODULE_URL;?>/template/xiaoye/img/qj-dh.png"><?php  } else if($row['leave_status'] ==1) { ?>Wait<?php  } else if($row['leave_status'] !=1) { ?> <img src=" <?php echo MODULE_URL;?>/template/xiaoye/img/qj-ch.png"> <?php  } ?></a>
		</div>
		<div class="qj-m">
		<p1>请假类别:<?php  echo $cclass_leave->leave_type[$row['leave_type']];?></p1>
			<p2>请假时间:<?php  echo date("m-d H:i",$row['time_date_begin'])?>-<?php  echo date("m-d H:i",$row['time_date_end'])?></p2>
			</div>
			<div class="qj-b">
		<p>申请内容:<?php  echo $row['leave_reason'];?></p>
		</div>
	</div>
    <?php  if($row['leave_status'] !=1 ) { ?>
        <div class="qj-mm">
            <div class="qj-mm1">
                <p1>老师回复：<?php  echo $row['teacher'];?></p1>
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
</div>
    <?php  $footer_type = 'center';?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
