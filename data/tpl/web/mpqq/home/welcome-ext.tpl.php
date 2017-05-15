<?php defined('IN_IA') or exit('Access Denied');?><style>

.welcome-container .modules a span {
display: block;
font-size: 12px;
overflow: hidden;
white-space: nowrap;
}

.welcome-container .modules a {
margin: 12px 0px 0px 0px;
display: block;
float: left;
text-align: center;
padding: 8px 5px;
width: 115px;
overflow: hidden;
color: #333;
}

.welcome-container .modules a img {
display: block;
height: 60px;
width: 60px;
margin: .85em auto;
border-radius: 60px;
}

</style>
 <?php  
	load()->model('module');
	$modtypes = module_types();
	 ?>

<?php  if($moudles) { ?>

<?php  if($enable_modules) { ?>

<div class="page-header">

	<h4><i class="fa fa-cubes"></i> 已启用的模块</h4>
	  <div class="alert alert-danger">

温馨提示：如果发现功能模块很少，可以依次点击：左上角‘返回系统’---‘公众号管理’---找到你的公众号的‘服务套餐’---选择‘体验套餐服务’。

	</div>
			<ul class="nav navbar-nav nav-btns" style="width: 100%;border-color: #e7e7e7;  background-color: #f8f8f8;">

				<li class="active"><a href="">全部</a></li>

				<li><a href="#" data-type='system' class="type">系统</a></li>

				<?php  if(is_array($modtypes)) { foreach($modtypes as $type) { ?>

				<li><a href="#" data-type=<?php  echo $type['name'];?> class="type"><?php  echo $type['title'];?></a></li>

				<?php  } } ?>

			</ul>

  

<div class="modules clearfix">

	<?php  if(is_array($enable_modules)) { foreach($enable_modules as $key => $row) { ?>

			<a class="item" data-type=<?php  echo $row['type'];?> href="<?php  echo url('home/welcome/ext', array('m'=>$row['name']));?>" title="<?php  echo $row['ability'];?>" >

			<img alt="<?php  echo $row['ability'];?>" src="<?php  echo $row['icon'];?>" class="img-rounded">

				<span><?php  echo $row['title'];?></span>
			</a>

		<?php  } } ?>

	</div>	

</div>

<?php  } ?>

<?php  if($unenable_modules) { ?>

<div class="page-header">

	<h4><i class="fa fa-cubes"></i> 未启用的模块</h4>

</div>

<div class="panel panel-default row">

	<div class="table-responsive panel-body">

	<table class="table">

		<tr>

			<th style="width:10%"></th>

			<th style="width:15%">模块名称</th>

			<th>描述</th>

			<th></th>

		</tr>

		<?php  if(is_array($unenable_modules)) { foreach($unenable_modules as $key => $row) { ?>

		<tr>

			<td>

				<img alt="<?php  echo $row['title'];?>" src="<?php  echo $row['icon'];?>" width="48" height="48" class="img-rounded">

			</td>

			<td>

				<?php  echo $row['title'];?>

			</td>

			<td>

				<?php  echo $row['ability'];?>

			</td>

			<td>

				&nbsp;

			</td>

		</tr>

		<?php  } } ?>

	</table>

	</div>

</div>

<?php  } ?>

<?php  } else { ?>

	<div class="page-header">

		<h4><i class="fa fa-plane"></i> 核心功能设置</h4>

	</div>

	<div class="shortcut clearfix">

		<?php  if($entries['cover']) { ?>

			<?php  if(is_array($entries['cover'])) { foreach($entries['cover'] as $cover) { ?>

			<a href="<?php  echo $cover['url'];?>" title="<?php  echo $cover['title'];?>">

				<i class="fa fa-external-link-square"></i>

				<span><?php  echo $cover['title'];?></span>

			</a>

			<?php  } } ?>

		<?php  } ?>

		<?php  if($module['isrulefields']) { ?>

			<a href="<?php  echo url('platform/reply', array('m' => $m))?>">

				<i class="fa fa-comments"></i>

				<span>回复规则列表</span>

			</a>

		<?php  } ?>

		<?php  if($entries['home'] || $entries['profile'] || $entries['shortcut']) { ?>

			<?php  if($entries['home']) { ?>

				<a href="<?php  echo url('site/nav/home', array('m' => $m))?>">

					<i class="fa fa-home"></i>

					<span>微站首页导航</span>

				</a>

			<?php  } ?>

			<?php  if($entries['profile']) { ?>

				<a href="<?php  echo url('site/nav/profile', array('m' => $m))?>">

					<i class="fa fa-user"></i>

					<span>个人中心导航</span>

				</a>

			<?php  } ?>

			<?php  if($entries['shortcut']) { ?>

				<a href="<?php  echo url('site/nav/shortcut', array('m' => $m))?>">

					<i class="fa fa-plane"></i>

					<span>快捷菜单</span>

				</a>

			<?php  } ?>

		<?php  } ?>

		<?php  if($module['settings']) { ?>

			<a href="<?php  echo url('profile/module/setting', array('m' => $m));?>">

				<i class="fa fa-cog"></i>

				<span title="参数设置">参数设置</span>

			</a>

		<?php  } ?>

	</div>

	<?php  if($entries['menu']) { ?>

	<div class="page-header">

		<h4><i class="fa fa-plane"></i> 业务功能菜单</h4>

	</div>

	<div class="shortcut clearfix">

		<?php  if(is_array($entries['menu'])) { foreach($entries['menu'] as $menu) { ?>

		<a href="<?php  echo $menu['url'];?>" title="<?php  echo $menu['title'];?>">

			<i class="<?php  echo $menu['icon'];?>"></i>

			<span><?php  echo $menu['title'];?></span>

		</a>

		<?php  } } ?>

	</div>

	<?php  } ?>

	<?php  if($entries['mine']) { ?>

	<div class="page-header">

		<h4><i class="fa fa-plane"></i> 自定义菜单</h4>

	</div>

	<div class="shortcut clearfix">

		<?php  if(is_array($entries['mine'])) { foreach($entries['mine'] as $mine) { ?>

		<a href="<?php  echo $mine['url'];?>" title="<?php  echo $mine['title'];?>">

			<i class="<?php  echo $mine['icon'];?>"></i>

			<span><?php  echo $mine['title'];?></span>

		</a>

		<?php  } } ?>

	</div>

	<?php  } ?>

<?php  } ?>
<script type="text/javascript">
		require(['bootstrap'],function(){
		$('.type').click(function() {
			var b = $(this).attr('data-type');
			$('.active').attr('class','');
			$(this).parent('li').attr('class','active');
			$('.item').hide();
			$('.item').each(function() {
				if($(this).attr('data-type')==b) {
					$(this).show();
				}
			});
		});
		})
	</script>

<script type="text/javascript">

<!--

	<?php  if($_W['isfounder']) { ?>

	function checkupgradeModule() {

		require(['util'], function(util) {

			if (util.cookie.get('checkupgrade_<?php  echo $m;?>')) {

				return;

			}

			$.getJSON("<?php  echo url('utility/checkupgrade/module', array('m' => $m));?>", function(ret){

				if (ret && ret.message && ret.message.upgrade == '1') {

					$('body').prepend('<div id="upgrade-tips-module" class="upgrade-tips"><a class="module" href="./index.php?c=cloud&a=upgrade&">【'+ret.message.name+'】检测到新版本'+ret.message.version+'，请尽快更新！</a><span class="tips-close" onclick="checkupgradeModule_hide()"><i class="fa fa-times-circle"></i></span></div>');

					if ($('#upgrade-tips').size()) {

						$('#upgrade-tips-module').css('top', '25px');

					}

				}

			});

		});

	}

	function checkupgradeModule_hide() {

		require(['util'], function(util) {

			util.cookie.set('checkupgrade_<?php  echo $m;?>', 1, 3600);

			$('#upgrade-tips-module').hide();

		});

	}

	$(function(){

		checkupgradeModule();

	});

	<?php  } ?>

//-->

</script>

