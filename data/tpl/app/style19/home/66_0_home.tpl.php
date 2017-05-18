<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	body{padding:0;margin:0;background-image:url('<?php  if(empty($_W['styles']['indexbgimg'])) { ?>./themes/style19/images/bg_index.jpg<?php  } else { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } ?>');background-size:cover;color:<?php  echo $_W['styles']['fontcolor'];?>; background-color:<?php  echo $_W['styles']['indexbgcolor'];?>;<?php  echo $_W['styles']['indexbgextra'];?>}
	a{color:<?php  echo $_W['styles']['linkcolor'];?>; text-decoration:none;}
	<?php  echo $_W['styles']['css'];?>
	.box{width:75%; padding:31% 0 0 5.2%;}
	.box .box-item{float:left; text-align:center;  display:block; width:45%; margin:0 3.2% 5.2% 0; border-radius:3.66em; height:6.82em; text-decoration:none; outline:none;padding:10px; position:relative; overflow:hidden; color:#fff; }
	.box i{display:inline-block; height:50%; margin:10% 0 4%; vertical-align:middle; color:#fff; width:45px; font-size:35px;}
	.box i.icon{position:absolute; width:100%; height:100%; left:0; top:0; margin:0;}
	.box span{color:<?php  echo $_W['styles']['fontnavcolor'];?>;display:inline-block; width:98%; height:1.38em; font-weight:bold; text-align:center; overflow:hidden; position:absolute; bottom:15px; left:0;}
	.box ul li{background-color:rgba(209,166,76,0.95);padding:0 10px;margin:1%;display: inline-block;height:45px;width:100%;}
	.box ul li a{text-decoration: none;}
	.box .title{color:#fff;}
	.box .createtime{color:#999;font-size:12px}
</style>
<div class="box clearfix">
	<?php  $num = 0;?>
	<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>
	<?php  if($num == 0) $bg = 'rgba(209,166,76,0.95)';?>
	<?php  if($num == 1) $bg = 'rgba(100,158,185,0.95)';?>
	<?php  if($num == 2) $bg = 'rgba(124,161,86,0.95)';?>
	<?php  if($num == 3) $bg = 'rgba(202,89,46,0.95)';?>
	<?php  if($num == 4) $bg = 'rgba(103,101,165,0.95)';?>
	<?php  if($num == 5) $bg = 'rgba(194,123,188,0.95)';?>
	<a href="<?php  echo $nav['url'];?>" class="box-item" style="background:<?php  echo $bg;?>;">
		<?php  if(!empty($nav['icon'])) { ?>
		<i style="background:url(<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>) no-repeat;background-size:cover;" class="icon"></i>
		<?php  } else { ?>
		<i class="fa <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i>
		<?php  } ?>
		<span style="<?php  echo $nav['css']['name'];?>" title="<?php  echo $nav['name'];?>"><?php  echo $nav['name'];?></span>
	</a>
	<?php  $num++; if($num > 5) $num = 0;?>
	<?php  } } ?>

	<!-- 该分类下文章-start -->
	<?php  if($_GPC['c'] == 'site' && $_GPC['a'] == 'site') { ?>
	<ul class="list list-unstyled">
		<?php  $result = modulefunc('site', 'site_article', array (
  'func' => 'site_article',
  'cid' => $cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 66,
  'acid' => 0,
)); ?>
			<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
			<li>
				<a href="<?php  echo $row['linkurl'];?>">
					<div class="title"><?php  echo cutstr($row['title'],12,1);?></div>
					<div class="createtime"><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></div>
				</a>
			</li>
			<?php  } } ?>
	</ul>
	<?php  } ?>
	<!-- 该分类下文章-start -->
</div>
