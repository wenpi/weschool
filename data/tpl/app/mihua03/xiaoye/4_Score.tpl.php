<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
    <div class="head-ks">
        <p><?php  echo $scorejilv_name;?></p>
    </div>
	<div class="ksx">
        <?php  if(is_array($score_list)) { foreach($score_list as $row) { ?>
            <li class="ym">
                <p><?php  echo $row['score'];?></p>
                <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/<?php  echo $cclass_scoreList->echoScoreImg($row['score'])?>">
                <p><?php  echo $row['course_name'];?></p>
                
            </li>
        <?php  } } ?>
	</div>
	<div class="ks-m">
		<p1>总成绩：<?php  echo $all_score;?></p1>
		<p2>班级平均分：<?php  echo $average_score;?></p2>
	</div>
	<div class="y-xx"></div>
    <?php  if(is_array($score_list)) { foreach($score_list as $row) { ?>
    <a href="<?php  echo $this->createMobileUrl('scoreInfo',array('course_id'=>$row['course_id']))?>">
        <li class="kxy-b">
            <?php  if($row['score']>=60) { ?>
                <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/TZ-Z.png">
            <?php  } else { ?>
                <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/CY.png">
            <?php  } ?>
            <p1><?php  echo $row['course_name'];?></p1>
            <p2>成绩：<?php  echo $row['score'];?></p2>
            <p2>班级平均分：<?php  echo $cclass_scoreList->getCourseAverageScore($row['course_id'])?></p2>
            <div class="t-x-j">
                    <div class="t-x-j">
                                <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jt.png">
                        
                    </div>
            </div>
        </li>    
        </a>
    <?php  } } ?>
</div>
    <?php  $footer_type = 'center';?>
   <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
