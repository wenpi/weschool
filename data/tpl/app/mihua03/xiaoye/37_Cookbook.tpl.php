<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<body class="SP">
<div class="z_main">
	<div class="headsp">
		<?php  if(is_array($out_times['duan'])) { foreach($out_times['duan'] as $key => $row) { ?>
			<a href="<?php  echo $this->createMobileUrl('cookbook',array('duan'=>$key) )?>" <?php  if($duan==$key ) { ?> class="pp1" <?php  } ?>><p><?php  echo $row['begin_date'];?>~<?php  echo $row['end_date'];?></p></a>
		<?php  } } ?>
	</div>
	<div >
		<?php  if(is_array($out_times['list'][$duan])) { foreach($out_times['list'][$duan] as $row) { ?>
			<div class="SP-NR">
				<div class="NR-H">
					<?php  $w = date("w",$row['unix']); ?>
					<img src="<?php echo MODULE_URL;?>/template/xiaoye/img/sp<?php  echo $w;?>.png" alt="<?php  if($w==6) { ?>六<?php  } else if($w==0) { ?>日<?php  } ?>">
					<p><?php  echo $row['date'];?></p>
				</div>
				<div class="NR-B">
					<?php  if(is_array($cookbook_class_arr)) { foreach($cookbook_class_arr as $v) { ?>
						<?php  $g++?>
						<li>
							<span1><?php  echo $v;?></span1>
							<span2><?php  echo C('cookbook')->getCookbookText($v,$row['unix']);?></span2>
							<?php  $imgs = C('cookbook')->getCookbookImg($v,$row['unix']);?>
							<div class="z_bjt14 homework_img_list_control<?php  echo $page;?> " id="img_list_<?php  echo $g;?>">
							<?php  if(is_array($imgs)) { foreach($imgs as $val) { ?>
									<?php  $val =  $this->imgFrom($val) ;?>
									<div class="homework_img_list wx_img_list" data-src="<?php  echo $val;?>" style='background-image:url(<?php  echo $val;?>)' onclick="displayImage('img_list_<?php  echo $g;?>','<?php  echo $val;?>')"></div>
							<?php  } } ?>
							<div style="clear: both"></div>
							</div>
						</li>
					<?php  } } ?>				
				</div>
			</div>
		<?php  } } ?>
	</div>
</div>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
