<?php defined('IN_IA') or exit('Access Denied');?>	<?php  if(S("system",'getSetContent',array('xiaoye_bottom',$this->school_info['school_id'])) ==1 ) { ?>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/footer', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/footer', TEMPLATE_INCLUDEPATH));?>
	<?php  } else { ?>
		<div class="zk caidan"></div>
		<div class="z_cz6 caidan">
			<ul class="ccc">
				<li class="cda <?php  if($footer_center=='cda') { ?>cda_on<?php  } ?>"><a href="<?php  if($this->school_info['host_url'] ) { ?><?php  echo $this->school_info['host_url'];?><?php  } else { ?> <?php  echo $this->createMobileUrl('wapHome',array('school_id'=>$this->school_info['school_id'] ))?> <?php  } ?>"></a></li>
				<li class="cdb <?php  if($footer_center=='cdb') { ?>cdb_on<?php  } ?>"><a href="<?php  echo $this->createMobileUrl("Personer_list")?>"></a></li>
				<li class="cdc <?php  if($footer_center=='cdc') { ?>cdc_on<?php  } ?>"><a href="<?php  echo $this->createMobileUrl("line")?>"></a></li>
				<li class="cde <?php  if($footer_center=='cde' || !$footer_center) { ?>cde_on<?php  } ?>"><a href="<?php  echo $this->createMobileUrl("home")?>"></a></li>
			</ul>
      </div>
		<style>
						.zk{width:100%;height: 15vw;overflow: hidden;}
						.z_cz6 {position: fixed;bottom: 0;width: 100%;height: 15vw;background-size: cover;background: #fff;z-index: 100}
						.ccc{width:100%;overflow: hidden;border-top: 1px solid #eee;}
						.ccc li{width:25%;height: 15vw;float: left;}
						.cda a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh1.png) center;float: left;background-size: cover;}
						.cda_on a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh1-h.png) center no-repeat;float: left;background-size: cover;}
						.cdb a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh2.png) center no-repeat;float: left;background-size: cover;}
						.cdb_on a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh2-h.png) center no-repeat;float: left;background-size: cover;}
						.cdc a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh3.png) center no-repeat;float: left;background-size: cover;}
						.cdc_on a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh3-h.png) center no-repeat;float: left;background-size: cover;}
						.cde a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh4.png) center no-repeat;float: left;background-size: cover;}
						.cde_on a{width:100%;height: 14vw;background:url(<?php echo MODULE_URL;?>/template/xiaoye/upimg/dh4-h.png) center no-repeat;float: left;background-size: cover;}
			</style>
	<?php  } ?>
	<div style="display:none">
		<?php  echo htmlspecialchars_decode(S("system",'getSetContent',array('ask_url',$school_id)));?>
		<style>#tuige{display: none}</style>
	</div>

