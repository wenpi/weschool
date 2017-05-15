<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/slide', TEMPLATE_INCLUDEPATH)) : (include template('common/slide', TEMPLATE_INCLUDEPATH));?>
<style>
	body{
	font:<?php  echo $_W['styles']['fontsize'];?> <?php  echo $_W['styles']['fontfamily'];?>;
	color:<?php  echo $_W['styles']['fontcolor'];?>;
	padding:0;
	margin:0;
	background-size:cover;
	background-color:<?php  if(empty($_W['styles']['indexbgcolor'])) { ?>#D9D9D9<?php  } else { ?><?php  echo $_W['styles']['indexbgcolor'];?><?php  } ?>;
	<?php  echo $_W['styles']['indexbgextra'];?>
	}
	a{color:<?php  echo $_W['styles']['linkcolor'];?>; text-decoration:none;}
	<?php  echo $_W['styles']['css'];?>
	.box {
    width: 100%;
    overflow: hidden;
    margin: 5px 0;
    
}
.carousel-caption {
display:none;
}
.carousel-indicators{
    bottom: -10px;
}
	.box .box-item{float:left; text-align:center; display:block; text-decoration:none; outline:none; width:<?php  echo (100/3).'%';?>; height:105px; position:relative; color:#000;  padding:15px 10px;border: 1px solid #efefef; background: #fff;border-radius: 0px;}
	
	.box-item.darkblue{background:rgba(24,155,234,0.9); opacity:0.8;}
	.box-item.blue{background: rgba(92,188,242,0.9); opacity:0.8;}
	.box .box-item i{display:inline-block; width:50px; height:50px; line-height:50px; font-size:35px; color:#FFF; overflow:hidden; background:#38b3f4; border-radius:50%; color:#fff;}
	.box .box-item span{color:#000;display:block;font-size:14px; width:90%; height:20px; line-height:20px; margin:0 5%; text-align:center; overflow:hidden;}
	.bar{width:100%; height:45px; line-height:45px; padding:0 0 0 15px; color:#000; font-size:16px; background:#fff;  border-bottom:#c8c8c8 solid 1px;}
	.bar a{display:block; width:100%; text-align:center; text-decoration:none; color:<?php  if(empty($_W['styles']['fontnavcolor'])) { ?>#FFFFFF<?php  } else { ?><?php  echo $_W['styles']['fontnavcolor'];?><?php  } ?>}
	.list,h3,p{padding:0px; margin:0px;}
	.list li{padding: 0 ; list-style:none;}
	.list li a{display:block; height:71px;background:#fff;  border-bottom:#c8c8c8 solid 1px; color:#333; overflow:hidden; text-decoration:none !important; position:relative; padding:5px 5px 5px 10px;}
	.list li a .thumb{width:80px; height:60px;}
	.list li a .title{font-size:14px; padding-left:100px;}
	.list li a .createtime{font-size:12px; color:#999; position:absolute; bottom:5px;padding-left:100px;}
</style>
<!--<div class="box clearfix">
	<?php  $num = 1;?>
	<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '1',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 61,
  'uniacid' => 37,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
	<a href="<?php  echo $nav['url'];?>" class="box-item <?php  if($num%2) { ?>darkblue<?php  } else { ?>blue<?php  } ?>">
		<?php  if(!empty($nav['icon'])) { ?>
		<i style="background:url(<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>) no-repeat;background-size:cover;" class=""></i>
		<?php  } else { ?>
		<i class="fa <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i>
		<?php  } ?>
		<span style="<?php  echo $nav['css']['name'];?>" title="<?php  echo $nav['name'];?>"><?php  echo $nav['name'];?></span>
	</a>
	<?php  $num++;?>
	<?php  } } ?>
</div>-->


<div class="box clearfix">



	<?php  $num = 1;?>

	<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>



	<a href="<?php  echo $nav['url'];?>" class="box-item img-rounded">

		<?php  if(!empty($nav['icon'])) { ?>

		<img src="<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>">

		<?php  } else { ?>

		<i class="fa <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i>

		<?php  } ?>

		<span style="<?php  echo $nav['css']['name'];?>"><?php  echo $nav['name'];?></span>

	</a>

	<?php  $num++;?>

	<?php  if($num >= 7) $num = 1;?>

	<?php  } } ?>

</div>


<div class="bar">最新发布
	<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '2',
  'item' => 'row',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 61,
  'uniacid' => 37,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $row) { $i++; $row['iteration'] = $i; ?>
	<a href="<?php  echo $row['url'];?>" class="box-item">
		<span style="<?php  echo $row['css']['name'];?>" title="<?php  echo $row['name'];?>"><?php  echo $row['name'];?> </span>
	</a>
	<?php  if($row['iteration'] > 0) break;?>
	<?php  } } ?>
</div>
<div class="list clearfix">
	<?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'cid' => $cid,
  'assign' => 'result',
  'return' => 'true',
  'limit' => '10000',
  'index' => 'iteration',
  'multiid' => 61,
  'uniacid' => 37,
  'acid' => 0,
)); ?>
	<?php  $num = 1;?>
	<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
	
	<li>
		<a href="<?php  echo $row['linkurl'];?>">
			<?php  if($row['thumb']) { ?><img src="<?php  echo $row['thumb'];?>" class="pull-left thumb" onerror="this.parentNode.removeChild(this)" /><?php  } ?>
			<div class="title"><?php  echo $row['title'];?></div>
			<div class="createtime"><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></div>
		</a>
	</li>
	<?php  $num ++;?>
	<?php  } } ?>
</div>
</div>
<?php  if( $num> 5) break;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>