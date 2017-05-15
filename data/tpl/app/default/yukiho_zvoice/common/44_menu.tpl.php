<?php defined('IN_IA') or exit('Access Denied');?><body class="dual-sidebar">
	<div id="footer-fixed" class="footer-menu footer-light">
        <?php  $footerbars = M('quickmenu')->getall();?>
        <?php  if(is_array($footerbars)) { foreach($footerbars as $footer) { ?>
        <?php  $menus = $this->getMenus()?>
        <?php  $menu = $menus[$footer['ido']]?>
		<a href="<?php  echo $footer['link']?>" class="<?php  if($_GPC['do']==$footer['ido']) { ?>active-footer-item<?php  } ?> footer-mobile"><i class="<?php  echo $footer['icon']?>"></i><?php  echo $footer['title'];?></a>
        <?php  } } ?>
	</div>
	<div class="gallery-fix"></div>
	<div class="all-elements">