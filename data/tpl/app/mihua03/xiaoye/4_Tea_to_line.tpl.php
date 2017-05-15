<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
		<div class="bl">班级列表-管理的班级圈</div>
        <ul class="bll">
            <?php  if(is_array($list['list_all'])) { foreach($list['list_all'] as $item) { ?>
                <li class="bjlb">
                    <div class="bl1"><a href="<?php  echo $this->createMobileUrl("line",array("class_id"=>$item['class_id']))?>"><p><?php  echo $item['grade_name'];?></p></a><a href="<?php  echo $this->createMobileUrl("line",array("class_id"=>$item['class_id']))?>"><p><?php  echo $item['class_name'];?></p></a></div>
                    <div class="bl2"><a href="<?php  echo $this->createMobileUrl("line",array("class_id"=>$item['class_id']))?>"><img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/teacherimg/jt.png"></a></div>
                </li>     
            <?php  } } ?>
        </ul>
    </div>
    <?php  $center_class = 'cdc'?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
