<?php defined('IN_IA') or exit('Access Denied');?><?php  if(S("system",'getSetContent',array('xiaoye_tea_bottom',$school_id)) ==0 ) { ?> 
	<div class="zk"></div>
	<div class="z_cz6 caidan">
				<ul class="ccc">
					<li class="cda <?php  if($center_class== 'cda') { ?> cdalive <?php  } ?>"><a href="
					<?php  if($this->school_info['host_url'] ) { ?>
						<?php  echo $this->school_info['host_url'];?>
					<?php  } else { ?>
						<?php  echo $this->createMobileUrl("wapHome");?>
					<?php  } ?>
					"></a></li>
					<li class="cdb <?php  if($center_class== 'cdb') { ?> cdblive <?php  } ?>"><a href="<?php  echo $this->createMobileUrl("teaChat");?>"></a></li>
					<li class="cdc <?php  if($center_class== 'cdc') { ?> cdclive <?php  } ?>"><a href="<?php  echo $this->createMobileUrl("tea_to_line");?>"></a></li>
					<li class="cde <?php  if($center_class== 'cde') { ?> cdelive <?php  } ?>"><a href="<?php  echo $this->createMobileUrl("teacenter");?>"></a></li>
				</ul>
	</div>
	<div style="display:none">
		<?php  echo htmlspecialchars_decode(S("system",'getSetContent',array('ask_url',$school_id)));?>
		<style>#tuige{display: none}</style>
	</div>
<?php  } else { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/teafooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/teafooter', TEMPLATE_INCLUDEPATH));?>
	<style>
		.caidan ul {
			width: 100%;
			bottom: 0px;
			z-index: 1;
			overflow: hidden;
			position: fixed;
			margin: 0 auto;
			background: #fafafa;
			border-top: 1px solid #e5e5e5;
		}
		.caidan ul li {
			text-align: center;
			width: 25%;
			max-width: 25%;
			float: left;
			margin-top: 5px;
		}
		.caidan ul li img {
			width:45%;
		}

	</style>
<?php  } ?>