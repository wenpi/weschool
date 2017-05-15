<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<style>
	.left-div{width:120px;overflow:hidden}
	.right-fa{width:20px;}
	.pad-left {padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -545px;}
	.pad-bottom {padding-left:50px;height:30px;line-height:30px;background:url('./resource/images/bg_repno.gif') no-repeat -245px -595px;}
	.add{cursor:pointer;padding-top:5px;}
	.position{display:inline-block;width:100px;}
</style>

<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('system/welcome');?>">系统</a></li>
	<li class="active">模块权限</li>
</ol>
<ul class="nav nav-tabs">
	<li><a href="<?php  echo url('extension/menu');?>">菜单列表</a></li>
	<li class="active"><a href="<?php  echo url('extension/menu/module');?>">模块菜单</a></li>
</ul>
<?php  if($do == 'module') { ?>
<div class="clearfix">
	<h5 class="page-header">设置权限验证</h5>
	<form action="" method="post" class="form-horizontal">
		<div class="panel">
			<div class="panel-body table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th width="90">排序</th>
							<th  width="300">模块名称</th>
							<th width="300">图标</th>
							<th>链接地址</th>
							<th style="text-align:center">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
							<?php  if(!empty($module['entry'])) { ?>
								<tr>
									<td></td>
									<td colspan="4"><span class="label label-success"><?php  echo $module['title'];?></span></td>
								</tr>
								<?php  if(!empty($module['entry']['menu'])) { ?>
									<?php  if(is_array($module['entry']['menu'])) { foreach($module['entry']['menu'] as $menu) { ?>
										<tr>
											<input type="hidden" name="eid[]" value="<?php  echo $menu['eid'];?>"/>
											<input type="hidden" name="entry[]" value="menu"/>
											<input type="hidden" name="url[]" value=""/>
											<td>
												<input type="text" name="displayorder[]" value="<?php  echo $menu['displayorder'];?>" class="form-control" style="width:80px">
											</td>
											<td><div class="pad-left"> <span class="text-success position">业务功能菜单</span><?php  echo $menu['title'];?></div></td>
											<td>
												<div class="input-group" style="width:250px">
													<input type="text" class="form-control" name="icon[]" value="<?php  echo $menu['icon'];?>"/>
													<span class="input-group-addon"><i class="<?php  echo $menu['icon'];?>"></i></span>
													<span class="input-group-btn">
														<button class="btn btn-default showIconDialog" type="button">图标</button>
													</span>
												</div>
											</td>
											<td></td>
											<td></td>
										</tr>
									<?php  } } ?>
								<?php  } ?>
								<?php  if(!empty($module['entry']['mine'])) { ?>
									<?php  if(is_array($module['entry']['mine'])) { foreach($module['entry']['mine'] as $mine) { ?>
										<tr>
											<input type="hidden" name="eid[]" value="<?php  echo $mine['eid'];?>"/>
											<input type="hidden" name="entry[]" value="mine"/>
											<td>
												<input type="text" name="displayorder[]" value="<?php  echo $mine['displayorder'];?>" class="form-control" style="width:80px">
											</td>
											<td><div class="pad-left"> <span class="text-danger position">自定义菜单</span><?php  echo $mine['title'];?></div></td>
											<td>
												<div class="input-group" style="width:250px">
													<input type="text" class="form-control" name="icon[]" value="<?php  echo $mine['icon'];?>"/>
													<span class="input-group-addon"><i class="<?php  echo $mine['icon'];?>"></i></span>
													<span class="input-group-btn">
														<button class="btn btn-default showIconDialog" type="button">图标</button>
													</span>
												</div>
											</td>
											<td>
												<input type="text" name="url[]" value="<?php  echo $mine['url'];?>" class="form-control" style="width:300px">
											</td>
											<td align="center">
												<a href="javascript:;" class="btn btn-danger del-eid" data-id="<?php  echo $mine['eid'];?>">删除</a>
											</td>
										</tr>
									<?php  } } ?>
								<?php  } ?>
								<tr>
									<td></td>
									<td colspan="4">
										<div class="pad-bottom pull-left"></div>
										<div class="pull-left add" data-module="<?php  echo $module['name'];?>">
											 <i class="fa fa-plus-circle"></i> 自定义菜单
										</div>
									</td>
								</tr>
							<?php  } ?>
						<?php  } } ?>
					</tbody>
				</table>
			</div>
		</div>
		<input type="submit" name="submit" class="btn btn-primary" value="提交"/>
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
	</form>
</div>
<?php  } ?>

<script>
	require(['util'], function(u){
		$('.title').hover(function(){
			$(this).tooltip('show');
		},function(){
			$(this).tooltip('hide');
		});

		$('.table').on('click', '.showIconDialog', function(){
			var btn = $(this);
			var spview = btn.parent().prev();
			var ipt = spview.prev();
			if(!ipt.val()){
				spview.css("display", "none");
			}
			u.iconBrowser(function(ico){
				ipt.val(ico);
				spview.show();
				spview.find("i").attr("class","");
				spview.find("i").addClass("fa").addClass(ico);
			});
		});

		$('.add').click(function(){
			var module = $(this).attr('data-module');
			var html =
					'<tr>' +
						'<input name="add_module[]" value="'+module+'" type="hidden">' +
						'<td><input style="width:80px;" type="text" name="add_displayorder[]" value="0" class="form-control"></td>' +
						'<td>' +
							'<div class="pad-left">' +
								'<input style="width:100px;" placeholder="菜单名称" type="text" name="add_title[]" value="" class="form-control">' +
							'</div>' +
						'</td>' +
						'<td>' +
							'<div class="input-group" style="width:300px">' +
								'<input type="text" class="form-control" name="add_icon[]" value="fa fa-puzzle-piece"/>' +
								'<span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>' +
								'<span class="input-group-btn">' +
									'<button class="btn btn-default showIconDialog" type="button">图标</button>' +
								'</span>' +
							'</div>' +
						'</td>' +
						'<td><input style="width:300px;" placeholder="菜单链接地址" type="text" name="add_url[]" value="" class="form-control"></td>' +
						'<td><i class="fa fa-times-circle" onclick="$(this).parents(\'tr\').remove()"></i></td>' +
					'</tr>';
			$(this).parents('tr').before(html)
		});

		$('.del-eid').click(function(){
			if(!confirm('确认删除吗')) return false;
			var eid = $(this).attr('data-id');
			if(eid) {
				$.post("<?php  echo url('extension/menu/del_bind')?>", {'eid':eid}, function(){
					location.reload();
					return false;
				});
			}
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>