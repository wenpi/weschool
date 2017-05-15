<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
        <div class="bl">学生记录-班级列表</div>
        <ul class="bll">
            <?php  if(is_array($classes_list)) { foreach($classes_list as $row) { ?>
                <li class="bjlb">
                    <div class="bl1"><a href="<?php  echo $this->createMobileUrl('TeaStudentWorkRecord',array('cid'=>$row['class_id']))?>"><p><?php  echo $this->classGradeName($row['class_id'])?></p></a><a href="<?php  echo $this->createMobileUrl('TeaStudentWorkRecord',array('cid'=>$row['class_id']))?>"><p><?php  echo $row['class_name'];?></p></a></div>
                    <div class="bl2"><a href="<?php  echo $this->createMobileUrl('TeaStudentWorkRecord',array('cid'=>$row['class_id']))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg//jt.png"></a></div>
                </li>            
            <?php  } } ?>
        </ul>    
    </div>
    <?php  $center_class = 'cde'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
