<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
		<ul class="kcc">
            <?php  $count = count($re['weeks']);?>
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <?php  if($row['new'] == $now_week) { ?>
        			<li class="kcl llv"  style="width:<?php  echo 100/$count?>%"><a href="<?php  echo $this->createMobileUrl("Tea_today_course",array('week'=>$row['old']))?>">周<?php  echo $row['new'];?></a></li>
                <?php  } else { ?>
        			<li class="kcl"  style="width:<?php  echo 100/$count?>%"><a href="<?php  echo $this->createMobileUrl("Tea_today_course",array('week'=>$row['old']))?>">周<?php  echo $row['new'];?></a></li>
                <?php  } ?>
            <?php  } } ?>
		</ul>
      <?php  if(is_array($my_courselist)) { foreach($my_courselist as $g => $row) { ?>
		<div class="jrbj"><?php  echo $this->classGradeName($row['class_id'])?>-<?php  echo $row['name'];?></div>
        <?php  $course_do = false;?>
                <?php  if(is_array($row['course'])) { foreach($row['course'] as $begin_key => $v) { ?>
                        <?php  if($v) { ?>
                        <?php  if($begin_key>0) { ?>
                            <div class="kzzz"></div>
                            <?php  if($begin_key==1) { ?>
                                <?php  $begin_add = $this->school_info['am_much'];?>
                            <?php  } else if($begin_key==2) { ?>
                                <?php  $begin_add = $this->school_info['am_much']+$this->school_info['pm_much'];?>
                            <?php  } ?>
                        <?php  } ?>
                        <ul class="kbb">
                            <?php  if(is_array($v)) { foreach($v as $key => $rw) { ?>
                                    <li class="kbbb">
                                        <div class="kb1">
                                            <p class="pp1">第<?php  echo $begin_add+$key?>节</p>
                                            <p class="pp2"><?php  echo $rw['begin_time'];?>-<?php  echo $rw['end_time'];?></p>
                                        </div>
                                        <div class="kb2"><?php  echo $rw['course_name'];?></div>
                                    </li>
                            <?php  $course_do = true;?>
                            <?php  } } ?>               
                          </ul>
                        <?php  } ?>
                <?php  } } ?>
                <?php  if(!$course_do) { ?>
                 <ul class="kbb">
                    <div class="kb2">无</div>
                </ul>
                <?php  } ?>
        <?php  } } ?>
		<?php  $center_class = 'cde'?>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
    </div>
</body>
</html>
