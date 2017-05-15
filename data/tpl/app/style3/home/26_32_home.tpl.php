<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<style>
	body{
	font:<?php  echo $_W['styles']['fontsize'];?> <?php  echo $_W['styles']['fontfamily'];?>;
	color:<?php  echo $_W['styles']['fontcolor'];?>;
	padding:0;
	margin:0;
	background-image:url('<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } ?>');
	background-size:cover;
	background-color:<?php  if(empty($_W['styles']['indexbgcolor'])) { ?>#370f05<?php  } else { ?><?php  echo $_W['styles']['indexbgcolor'];?><?php  } ?>;
	<?php  echo $_W['styles']['indexbgextra'];?>
	}
	a{color:<?php  echo $_W['styles']['linkcolor'];?>; text-decoration:none;}
	<?php  echo $_W['styles']['css'];?>
	.box{padding:0 2% 0 0; overflow:hidden;margin-top:10px;}
	.box .box-item{float:left;text-align:center;display:block;text-decoration:none;outline:none;margin:0 0 2% 2%;width:48%;height:100px; background:#d47314; margin-bottom:8px;position:relative; color:#FFF;}
	.box .box-item i{display:inline-block; position:absolute; font-size:35px; color:#FFF; overflow:hidden;}
	.box .box-item img{display:inline-block; height:40px; margin:0 auto;}
	.box .box-item span{color:<?php  echo $_W['styles']['fontnavcolor'];?>; font-size:16px; display:block; position:absolute; text-align:left; overflow:hidden;}
	.box .box-item.icon i{right:5px; bottom:5px; width:40px; height:40px;}
	.box .box-item.icon span{top:10px; left:10px; width:50%;}
	.box .box-item.pic{width:98%;}
	.box .box-item.pic i{width:65%; height:100px; line-height:100px; left:0;}
	.box .box-item.pic img{display:block; height:100px; margin:0 auto;}
	.box .box-item.pic span{width:31%; right:2%; top:30%;}
	.footer{color:#dddddd;}
</style>
<div class="box clearfix">
	<?php  $num = 0;?>
	<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>
	<?php  if($num == 0) $bg = '#d47314';?>
	<?php  if($num == 1) $bg = '#50ad38';?>
	<?php  if($num == 2) $bg = '#dd399a';?>
	<?php  if($num == 3) $bg = '#1f75ae';?>
	<?php  if($num == 4) $bg = '#543da5';?>
	<a href="<?php  echo $nav['url'];?>" class="box-item <?php  if($num == 2) { ?>pic<?php  } else { ?>icon<?php  } ?>" style="background:<?php  echo $bg;?>;">
		<?php  if(!empty($nav['icon'])) { ?>
		<i><img src="<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>"></i>
		<?php  } else { ?>
		<i class="fa <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i>
		<?php  } ?>
		<span style="<?php  echo $nav['css']['name'];?>" title="<?php  echo $nav['name'];?>"><?php  echo $nav['name'];?></span>
	</a>
	<?php  $num++; if($num > 4) $num = 0;?>
	<?php  } } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>