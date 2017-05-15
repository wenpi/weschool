<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
		<div class="z_main" >
			<div class="TP"  >
				<p><?php  echo $result['msg_title'];?></p>
				<p1>发布者： <?php  echo $admin_name;?> 发布时间：<?php  echo date("Y-m-d",$result['add_time'])?></p1>
				<div style="clear:both"></div>
			</div>
		    <div class="head-solid" style="margin-bottom:5px;"></div>
			<div  class = 'z_dp' >
				<?php  echo htmlspecialchars_decode($result['msg_content']);?>
			</div>
			<?php  $imgs =  $this->decodeLineImgsToArr($result['images']);?>
				<?php  if($imgs) { ?>
					<div class="z_dpt3" id="img_list">
						<?php  if(is_array($imgs)) { foreach($imgs as $val) { ?>
							<img src="<?php  echo $val;?>" style="margin-top:5px;" onclick="displayImage('img_list','<?php  echo $val;?>')">
						<?php  } } ?>
					</div>				
				<?php  } else if($result['img']) { ?>
					<div class="tz-tp"  id='img_list_1'>
						<img  src="<?php  echo $this->imgFrom($result['img'])?>" onclick="displayImage('img_list_1','<?php  echo $this->imgFrom($result['img'])?>')" >
					</div>
				<?php  } ?>           
				<div style="clear:both"></div>
		</div>
	 	 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
		  <?php  if($in_type['type']=='student') { ?>
			 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
		  <?php  } else { ?>
		  	<link href="<?php echo MODULE_URL;?>/template/xiaoye/css/teacher.css" rel="stylesheet">
			<?php  $center_class = 'cde'?>
			<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
		  <?php  } ?>
	</body>
</html>