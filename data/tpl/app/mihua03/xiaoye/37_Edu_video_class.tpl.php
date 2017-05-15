<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main">
	<?php  if(is_array($list)) { foreach($list as $row) { ?>
		<div class="bb">
			<a href="/"><p><?php  echo $row['class_name'];?></p></a>
		</div>
		<ul class="bb-b">
			<?php  if(is_array($row['sec'])) { foreach($row['sec'] as $val) { ?>
				<a href="<?php  echo $this->createMobileUrl('edu_video',array("cid"=>$val['class_id'])) ?>">
				<li class="bbb">
					<div style="background-image: url(<?php  echo $_W['attachurl'];?><?php  echo $val['class_img'];?>);width: 436px;height: 236px;" class="background_img">
					</div>
					<p><?php  echo $val['class_name'];?></p>
					<span>
					<img src="<?php echo MODULE_URL;?>/template/xiaoye/upimg/ll.png">
						<p><?php  $cclass_eduClass->class_id = $val['class_id'];?>
							<?php  echo $cclass_eduClass->getClassViews();?></p>
					</span>
				</li>			
				</a>
			<?php  } } ?>
		</ul>	
		<div class="kk"></div>
	<?php  } } ?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
