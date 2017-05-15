<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>

<style>

body{background:#EBEBEB;}

.category{display:block; overflow:hidden; background:#EEE; border-top:1px #DDD solid;border-bottom:1px #DDD solid;}

.category a{display:inline-block; overflow:hidden; height:30px; width:33.33%; text-align:center; color:#666; font-size:14px; float:left; padding:5px;}

.list li{padding: 5px 5px 0 5px;}

.list li a{display:block; height:71px; padding:5px;background:#FFF; border:1px #DDD solid; border-radius:3px;color:#333; overflow:hidden; text-decoration:none !important; position:relative;}

.list li a .thumb{width:80px; height:60px;}

.list li a .title{font-size:14px; padding-right:90px;}

.list li a .createtime{font-size:12px; color:#999; position:absolute; bottom:5px;}

.head{height:40px; line-height:40px; background:#2786fb; padding:0 5px; color:#FFF;}

.head .bn{display:inline-block; height:30px; line-height:30px; padding:0 10px; margin-top:4px; font-size:20px; border:1px #1176f2 solid; background:#3f95ff; color:#FFF; text-decoration:none;}

.head .bn.pull-right{position:absolute; right:5px; top:0;}

.head .title{font-size:14pt;display:block;padding-left:10px;font-weight:bolder;margin-right:49px;text-align:center;height:40px;line-height:40px;text-overflow:ellipsis;white-space:nowrap;overflow: hidden;}

.head .order{background:#F9F9F9; position:absolute; z-index:9999; right:0;}

.head .order li > a{display:block; padding:0 10px; min-width:100px; height:35px; line-height:35px; font-size:16px; color:#333; text-decoration:none; border-top:1px #EEE solid;}

.head .order li.fa-caret-up{font-size:20px;color:#F9F9F9;position:absolute;top:-11px;right:16px;}

.pager-position{width:100%;margin:0 auto;text-align:center;}

</style>



<div class="category">

	<?php  $site_category = modulefunc('site', 'site_category', array (
  'module' => 'site',
  'func' => 'site_category',
  'parentid' => $cid,
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 39,
  'acid' => 0,
)); if(is_array($site_category)) { $i=0; foreach($site_category as $i => $row) { $i++; $row['iteration'] = $i; ?>

	<a href="<?php  echo $row['linkurl'];?>"><?php  echo $row['name'];?></a>

	<?php  } } ?>

</div>

<ul class="list list-unstyled">

	<?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'cid' => $cid,
  'assign' => 'result',
  'return' => 'true',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 39,
  'acid' => 0,
)); ?>

	<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>

	<li>

		<a href="<?php  echo $row['linkurl'];?>">

			<?php  if($row['thumb']) { ?><img src="<?php  echo $row['thumb'];?>" class="pull-right thumb" onerror="this.parentNode.removeChild(this)" /><?php  } ?>

			<div class="title"><?php  echo $row['title'];?></div>

			<div class="createtime"><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></div>

		</a>

	</li>

	<?php  } } ?>

</ul>

<script>

	require(['jquery'], function($){

		$(function(){

			$('#category_show').click(function(){

				$('.head .order').toggleClass('hide');

				return false;

			});

		});

	});

</script>

<div class="pager-position"><?php  echo $result['pager'];?></div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>