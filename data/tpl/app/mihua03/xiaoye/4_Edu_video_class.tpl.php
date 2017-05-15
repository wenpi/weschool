<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
	<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<div class="bb">
			<a href="/"><p><?php  echo $row['class_name'];?></p></a>
		</div>
		<ul class="bb-b">
			<?php  if(is_array($row['sec'])) { foreach($row['sec'] as $val) { ?>
				<a href="<?php  echo $this->createMobileUrl('edu_video',array("cid"=>$val['class_id'])) ?>">
				<li class="bbb">
					<div style="background-image: url(<?php  echo $this->imgFrom($val['class_img'])?>);width:100%;height: 100px;background-size:100%" class="background_img" >
					</div>
					<p><?php  echo $val['class_name'];?></p>
					<span>
						<img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/ll.png" style="width:20px;">
						<p><?php  $cclass_eduClass->class_id = $val['class_id'];?>
							<?php  echo $cclass_eduClass->getClassViews();?></p>
					</span>
				</li>			
				</a>
			<?php  } } ?>
		</ul>	
		<div class="kk"></div>
	<?php  } } ?>
<?php  if($in_type['type']=='teacher') { ?>
	<link href="<?php echo MODULE_URL;?>/template/xiaoye/css/teacher.css" rel="stylesheet">
	<?php  $center_class = 'cde'?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>  
</body>
</html>
