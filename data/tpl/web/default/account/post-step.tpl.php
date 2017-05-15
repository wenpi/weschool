<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/header-gw', TEMPLATE_INCLUDEPATH));?>
<ol class="breadcrumb">
	<li><a href="./?refresh"><i class="fa fa-home"></i></a></li>
	<li><a href="<?php  echo url('account/display');?>">公众号列表</a></li>
	<li class="active">编辑主公众号</li>
</ol>
<style>
	.nav-width{border-bottom:0;}
	.nav-width li.active{width:33%;text-align:center;overflow:hidden;height:40px;}
	.nav-width .normal{background:#EEEEEE;width:33%;text-align:center;overflow:hidden;height:40px;}
	.guide em{font-style:normal; color:#d9534f;}
	.guide .list-group .list-group-item a{color:#07d;}
	.guide .list-group .list-group-item{padding-top:20px;}
	.guide .img{margin-bottom:15px; display:inline-block; border:1px solid #cccccc;padding:3px;}
	.guide .con{padding: 10px 30px;}
</style>
<?php  if(empty($_GPC['from'])) { ?>
<ul class="nav nav-tabs nav-width">
	<li <?php  if($_GPC['step']==2 ||  $_GPC['step'] == '') { ?>class="active"<?php  } ?> class="normal"><a href="javascript:;">1. 设置公众号信息</a></li>
	<li <?php  if($_GPC['step']==3) { ?>class="active"<?php  } ?> class="normal"><a href="javascript:;">2. 设置权限</a></li>
	<li <?php  if($_GPC['step']==4) { ?>class="active"<?php  } ?> class="normal"><a href="javascript:;">3. 引导页面</a></li>
</ul>
<?php  } ?>

<div class="clearfix">
	<?php  if($_GPC['step']==2 || $_GPC['step'] == '') { ?>
	<form action="" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="step" value="2">
		<div class="panel panel-default">
			<div class="panel-heading">
				设置公众号信息
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span> 公众号名称</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="cname" class="form-control" value="<?php  echo $account['name'];?>" autocomplete="off" />
						<span class="help-block">填写公众号的帐号名称</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">描述</label>
					<div class="col-sm-9 col-xs-12">
						<textarea style="height: 80px;" class="form-control" name="description"><?php  echo $account['description'];?></textarea>
						<span class="help-block">用于说明此公众号的功能及用途。</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号帐号</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="account" class="form-control" value="<?php  echo $account['account'];?>" autocomplete="off" />
						<span class="help-block">填写公众号的帐号，一般为英文帐号</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">原始ID</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="original" class="form-control" value="<?php  echo $account['original'];?>" autocomplete="off" />
						<span class="help-block">在给粉丝发送客服消息时,原始ID不能为空。建议您完善该选项</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">级别</label>
					<div class="col-sm-9 col-xs-12">
						<label for="status_1" class="radio-inline"><input autocomplete="off" type="radio" name="level" id="status_1" value="1" <?php  if(empty($account['level']) || $account['level'] == 1) { ?> checked<?php  } ?> > 普通订阅号</label>
						<label for="status_2" class="radio-inline"><input autocomplete="off" type="radio" name="level" id="status_2" value="2" <?php  if($account['level'] == 2) { ?> checked<?php  } ?> /> 普通服务号</label>
						<label for="status_3" class="radio-inline"><input autocomplete="off" type="radio" name="level" id="status_3" value="3" <?php  if($account['level'] == 3) { ?> checked<?php  } ?> /> 认证订阅号</label>
						<label for="status_4" class="radio-inline"><input autocomplete="off" type="radio" name="level" id="status_4" value="4" <?php  if($account['level'] == 4) { ?> checked<?php  } ?> /> 认证服务号/认证媒体/政府订阅号</label>
						<span class="help-block">注意：即使公众平台显示为“未认证”, 但只要【公众号设置】/【账号详情】下【认证情况】显示资质审核通过, 即可认定为认证号.</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppId</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="key" class="form-control" value="<?php  echo $account['key'];?>" autocomplete="off"/>
						<div class="help-block">请填写微信公众平台后台的AppId</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">AppSecret</label>
					<div class="col-sm-9 col-xs-12">
						<input type="text" name="secret" class="form-control" value="<?php  echo $account['secret'];?>" autocomplete="off"/>
						<div class="help-block">请填写微信公众平台后台的AppSecret, 只有填写这两项才能管理自定义菜单</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">Oauth 2.0</label>
					<div class="col-sm-9 col-xs-12">
						<p class="form-control-static">在微信公众号请求用户网页授权之前，开发者需要先到公众平台网站的【开发者中心】<b>网页服务</b>中配置授权回调域名。<?php  if($_W['isfounder']) { ?><a href="http://www.we7.cc/manual/dev:v0.6:qa:mobile_redirect_url_error" target="_black">查看详情</a><?php  } ?></p>
					</div>
				</div>
				<?php  if(!empty($acid)) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label">接口地址</label>
						<div class="col-sm-9 col-xs-12">
							<input type="text" class="form-control" value="<?php  echo $_W['siteroot'];?>api.php?id=<?php  echo $account['acid'];?>" readonly="readonly" autocomplete="off"/>
							<div class="help-block">设置“公众平台接口”配置信息中的接口地址</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:red">Token</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="wetoken" class="form-control" value="<?php  echo $account['token'];?>" readonly="readonly" />
								<span class="input-group-addon" style="cursor:pointer" onclick="tokenGen();">生成新的</span>
							</div>
							<div class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为3到32个字符. 请妥善保管, Token 泄露将可能被窃取或篡改平台的操作数据.</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label" style="color:red">EncodingAESKey</label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<input type="text" name="encodingaeskey" class="form-control" value="<?php  echo $account['encodingaeskey'];?>" />
								<span class="input-group-addon" style="cursor:pointer" onclick="EncodingAESKeyGen();">生成新的</span>
							</div>
							<div class="help-block">与公众平台接入设置值一致，必须为英文或者数字，长度为43个字符. 请妥善保管, EncodingAESKey 泄露将可能被窃取或篡改平台的操作数据.</div>
						</div>
					</div>
				<?php  } ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">二维码</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="qrcode" value="<?php  echo $item['qrcode'];?>">
						<span class="help-block">只支持JPG图片</span>
					</div>
				</div>
				<?php  if(file_exists(IA_ROOT . '/attachment/qrcode_'.$account['acid'].'.jpg')) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<img src="<?php  echo tomedia('qrcode_'.$account['acid'].'.jpg');?>?time=<?php  echo time()?>" class="img-responsive img-thumbnail" width="150" />
							</div>
						</div>
					</div>
				<?php  } ?>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">头像</label>
					<div class="col-sm-9 col-xs-12">
						<input type="file" name="headimg" value="<?php  echo $item['headimg'];?>">
						<span class="help-block">只支持JPG图片</span>
					</div>
				</div>
				<?php  if(file_exists(IA_ROOT . '/attachment/headimg_'.$account['acid'].'.jpg')) { ?>
					<div class="form-group">
						<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
						<div class="col-sm-9 col-xs-12">
							<div class="input-group">
								<img src="<?php  echo tomedia('headimg_'.$account['acid'].'.jpg');?>?time=<?php  echo time()?>" class="img-responsive img-thumbnail" width="150" />
							</div>
						</div>
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<input name="submit" type="submit" value="下一步" class="btn btn-primary" />
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
	<?php  } else if($_GPC['step']==3) { ?>
	<form action="" method="post"  class="form-horizontal" role="form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="step" value="3">
		<input type="hidden" name="uniacid" value="<?php  echo $uniacid;?>">
		<input type="hidden" name="acid" value="<?php  echo $acid;?>">
		<div class="panel panel-default">
			<div class="panel-heading">公众号权限设置</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信剩余条数</label>
					<div class="col-sm-9 col-xs-12">
						<?php  echo tpl_edit_sms('balance', $notify['sms']['balance'], $uniacid , url('account/post-step/edit_sms', array('step' => 3)), $max_num-$notify['sms']['balance'])?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">短信签名</label>
					<div class="col-sm-9 col-xs-12">
						<select name="signature" class="form-control">
							<?php  if(!empty($notify['sms']['signature'])) { ?>
							<?php  if(in_array($notify['sms']['signature'], $signatures)) { ?>
							<option selected value="<?php  echo $notify['sms']['signature'];?>"><?php  echo $notify['sms']['signature'];?></option>
							<?php  } else if(!empty($notify['sms']['signature'])) { ?>
							<option value="<?php  echo $notify['sms']['signature'];?>"><?php  echo $notify['sms']['signature'];?>（未通过云服务审核）</option>
							<?php  } ?>
							<?php  } ?>
							<?php  if(is_array($signatures)) { foreach($signatures as $signa) { ?>
							<?php  if($signa != $notify['sms']['signature']) { ?>
							<option value="<?php  echo $signa;?>"><?php  echo $signa;?></option>
							<?php  } ?>
							<?php  } } ?>
						</select>
						<span class="help-block">请填写短信签名。未审核签名可以通过<a href="<?php  echo url('cloud/sms')?>">云短信</a>审核签名</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">公众号管理员（主）</label>
					<div class="col-sm-9 col-xs-12">
						<p class="form-control-static">
							<span id="manager" class="label label-success">
								<input type="hidden" name="uid" value="<?php  echo $owner['uid'];?>" /><?php  echo $owner['username'];?>
							</span>&nbsp;
							<a id="btn-add" href="javascript:;"><?php  if($owner['username']) { ?>修改<?php  } else { ?>选择用户<?php  } ?></a>&nbsp;-&nbsp;
							如果是新用户请先<a onclick="util.ajaxshow('<?php  echo url('user/create');?>', '添加主管理员', {'width': 800});" href="javascript:;">添加</a>
						</p>
						<div class="help-block">
							一个公众号只可拥有一个主管理员，管理员有管理公众号和添加操作员的权限<br />
							未指定主管理员时将默认属于创始人，则公众号具有所有模块及模板权限
						</div>
					</div>
				</div>
				<div class="form-group">
			<label class="col-xs-12 col-sm-3 col-md-2 control-label">是否设置帐户/服务过期时间</label>
			<div class="col-sm-9 col-xs-12">
				<label class="radio-inline"><input type="radio" <?php  if(!empty($owner['endtime'])) { ?>checked<?php  } ?> name="is-set-endtime" value="1" id="radio_1" onclick="if ($('input[name=uid]').val()) {$('.js-set-endtime-panel').show();} else { util.message('请先选择该公众号所属的主管理员'); return false;}" /> 设置</label>
				<label class="radio-inline"><input type="radio" <?php  if(empty($owner['endtime'])) { ?>checked<?php  } ?> name="is-set-endtime" value="0" id="radio_0" onclick="$('.js-set-endtime-panel').hide();" /> 不限</label>
			</div>
		</div>
		<div class="form-group js-set-endtime-panel" <?php  if(empty($owner['endtime'])) { ?>style="display:none;"<?php  } ?>>
			<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
					<div class="col-sm-9 col-xs-12">
						<p class="form-control-static">
						<?php  echo tpl_form_field_date('endtime', $owner['endtime']);?>
						</p>
						<span class="help-block">用户的使用时间过期时，将来无法登录，公众号权限也暂停使用，不设置为永久可用</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">管理员用户组</label>
					<div class="col-sm-9 col-xs-12">
						<select name="groupid" class="form-control" id="groupid">
							<option value="0" data-package="[]">不设置</option>
							<?php  if(is_array($groups)) { foreach($groups as $row) { ?>
							<?php $package = $row['package'] ? implode(',', iunserializer($row['package'])) : '';?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $owner['groupid']) { ?>selected<?php  } ?> data-package="[<?php  echo $package;?>]"><?php  echo $row['name'];?></option>
							<?php  } } ?>
						</select>
						<span class="help-block"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				公众号可使用的权限（以下选中套餐）
			</div>
			<div class="panel-body table-responsive">
				<table class="table table-hover">
					<thead class="navbar-inner">
						<tr>
							<th style="width:50px;"></th>
							<th style="width:120px;">公众服务套餐</th>
							<th style="width:400px;">模块权限</th>
							<th style="width:400px;">模板权限</th>
						</tr>
					</thead>
					<tbody id="account-package">
						<tr>
							<td><input type="checkbox" name="package[]" autocomplete="off" value="-1" <?php  if(is_array($owner['group']['package']) && in_array('-1', $owner['group']['package'])) { ?>checked disabled<?php  } ?><?php  if(is_array($extend['package']) && !empty($extend['package']['-1'])) { ?>checked <?php  } ?> /></td>
							<td>所有服务</td>
							<td>
								<span class="label label-danger">系统所有模块</span></li>
							</td>
							<td>
								<span class="label label-danger">系统所有模板</span></li>
							</td>
						</tr>
						<?php  if(is_array($unigroups)) { foreach($unigroups as $package) { ?>
						<tr>
							<td><input type="checkbox" name="package[]" autocomplete="off" <?php  if(is_array($owner['group']['package']) && in_array($package['id'], $owner['group']['package'])) { ?>checked disabled<?php  } ?> <?php  if(is_array($extend['package']) && !empty($extend['package'][$package['id']])) { ?>checked <?php  } ?> value="<?php  echo $package['id'];?>" /></td>
							<td><?php  echo $package['name'];?></td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-success">系统模块</span>
								<?php  if(is_array($package['modules'])) { foreach($package['modules'] as $module) { ?>
								<span class="label label-info"><?php  echo $module['title'];?></span>
								<?php  } } ?>
							</td>
							<td style="line-height:25px; white-space:normal;">
								<span class="label label-success">微站默认模板</span>
								<?php  if(is_array($package['templates'])) { foreach($package['templates'] as $template) { ?>
								<span class="label label-info"><?php  echo $template['title'];?></span>
								<?php  } } ?>
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
					<tbody id="account-package-extra" <?php  if(empty($owner['extend'])) { ?>style="display:none;"<?php  } ?>>
						<tr>
							<td></td>
							<td>专属附加权限</td>
							<td class="js-extra-modules" style="line-height:25px; white-space:normal;">
							<?php  if(is_array($owner['extend']['modules'])) { foreach($owner['extend']['modules'] as $module) { ?>
							<span class="label label-info"><?php  echo $module['title'];?></span>
							<input type="hidden" value="<?php  echo $module['name'];?>" name="extra[modules][]">
							<?php  } } ?>
							</td>
							<td class="js-extra-templates" style="line-height:25px; white-space:normal;">
							<?php  if(is_array($owner['extend']['templates'])) { foreach($owner['extend']['templates'] as $template) { ?>
							<span class="label label-info"><?php  echo $template['title'];?></span>
							<input type="hidden" value="<?php  echo $template['id'];?>" name="extra[templates][]">
							<?php  } } ?>
							</td>
						</tr>
					</tbody>
					<tr>
						<td colspan="4" class="text-center">
							<a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal-account-package-extra">附加权限</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<?php  if(empty($_GPC['from'])) { ?>
				<input name="submit" type="submit" value="下一步" class="btn btn-primary" />
				<?php  } else { ?>
				<input name="submit" type="submit" value="提交" class="btn btn-primary" />
				<?php  } ?>
				<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
			</div>
		</div>
	</form>
	<div class="modal fade" id="modal-account-package-extra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h3>
						<ul role="tablist" class="nav nav-pills" style="font-size:14px; margin-top:-20px;">
							<li role="presentation" class="active"><a data-toggle="tab" role="tab" aria-controls="content-modules" href="#content-modules">模块</a></li>
							<li role="presentation"><a data-toggle="tab" role="tab" aria-controls="content-templates" href="#content-templates">模板</a></li>
						</ul>
					</h3>
				</div>
				<div class="modal-body">
					<div class="tab-content">
						<div id="content-modules" class="tab-pane active" role="tabpanel">
							<table class="table">
								<thead>
								<tr>
									<th>模块名称</th>
									<th>模块标识</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
								<?php  if(is_array($modules)) { foreach($modules as $module) { ?>
								<tr>
									<td><?php  echo $module['title'];?><?php  if($module['issystem']) { ?><span class="label label-success">系统模块</span><?php  } ?></td>
									<td><?php  echo $module['name'];?></td>
									<td><a class="btn btn-default js-btn-select <?php  if(is_array($extend['modules']) && in_array($module['name'], $extend['modules'])) { ?>btn-primary<?php  } ?>" data-title="<?php  echo $module['title'];?>" data-name="<?php  echo $module['name'];?>" onclick="$(this).toggleClass('btn-primary')">选取</a></td>
								</tr>
								<?php  } } ?>
								</tbody>
							</table>
						</div>
						<div id="content-templates" class="tab-pane" role="tabpanel">
							<table class="table">
								<thead>
								<tr>
									<th>模板名称</th>
									<th>模板标识</th>
									<th></th>
								</tr>
								</thead>
								<tbody>
								<?php  if(is_array($templates)) { foreach($templates as $temp) { ?>
								<tr>
									<td><?php  echo $temp['title'];?></td>
									<td><?php  echo $temp['name'];?></td>
									<td><a class="btn btn-default js-btn-select <?php  if(is_array($extend['templates']) && in_array($temp['id'], $extend['templates'])) { ?>btn-primary<?php  } ?>" data-title="<?php  echo $temp['title'];?>" data-name="<?php  echo $temp['id'];?>" onclick="$(this).toggleClass('btn-primary')">选取</a></td>
								</tr>
								<?php  } } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button">确认</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	<!--
		$(function(){
			<?php  if($_W['isfounder']) { ?>
			require(['biz', 'underscore'], function(biz, _){
				var seletedUserIds = [];
				$('#btn-add').click(function(){
					var self = this;
					biz.user.browser(seletedUserIds, function(user){
						$.getJSON('./index.php?c=account&a=post-step&do=userinfo&step=3&uid='+user, function(data){
							if (data.message.errno) {
								util.message(data.message.message);
							}
							$('#manager').html('<input type="hidden" name="uid" value="'+data.message.uid+'" />' + data.message.username);
							$('#groupid').val(data.message.group.id);
							$('#account-package-extra').show();
							update_package_list(data.message.package);
							$(self).html('修改');
						});
					},{mode:'invisible', direct : true});
				});
				$('#groupid').change(function(){
					var user = $('input[name="uid"]').val();
					if (!user) {
						$('#groupid').val(0);
						util.message('请先选择管理员');
						return false;
					}
					update_package_list($(this).find('option:selected').data('package'));
				});
				$('#modal-account-package-extra').find('.modal-footer .btn-primary').click(function(){
					var moduleshtml = '',templatehtml = '';
					$('#modal-account-package-extra #content-modules').find('.btn-primary').each(function(){
						moduleshtml += '<span class="label label-info" style="margin-right:3px;">'+$(this).attr('data-title')+'</span><input type="hidden" name="extra[modules][]" value="'+$(this).attr('data-name')+'" />';
					});
					$('#modal-account-package-extra #content-templates').find('.btn-primary').each(function(){
						templatehtml += '<span class="label label-info" style="margin-right:3px;">'+$(this).attr('data-title')+'</span><input type="hidden" name="extra[templates][]" value="'+$(this).attr('data-name')+'" />';
					});
					if (moduleshtml || templatehtml) {
						$('#account-package-extra').show();
					} else {
						$('#account-package-extra').hide();
					}
					$('#account-package-extra .js-extra-modules').html(moduleshtml);
					$('#account-package-extra .js-extra-templates').html(templatehtml);
					$('#modal-account-package-extra').modal('hide');
				});
				function update_package_list(package) {
					$('input[name="package[]"]').prop('checked', false);
					$('input[name="package[]"]').prop('disabled', false);
					for (i in package) {
						$('input[name="package[]"][value="'+package[i]+'"]').prop('checked', true);
						$('input[name="package[]"][value="'+package[i]+'"]').prop('disabled', true);
					}
				}
			});
			<?php  } ?>
		});
	//-->
	</script>
	<?php  } else if($_GPC['step']=='4') { ?>
	<div class="panel panel-default guide">
		<div class="panel-heading">
			接入到公众平台
		</div>
		
		<div class="panel-body">
			<h4 class="alert alert-info">您绑定的微信公众号：<em><?php  echo $account['name'];?></em>，请按照下列引导完成配置。</h4>
			<div class="list-group">
				<?php  if($account['isconnect'] == 0) { ?>
				<div class="list-group-item">
					<h5 class="page-header">登录 <a href="https://mp.weixin.qq.com/" target="_blank">微信公众平台</a>，点击左侧菜单最后一项，进入 [ <em>开发者中心</em> ]</h5>
					<div class="con">
						<div class="img"><img src="resource/images/guide-01.png"/></div>
						<p># 如果您未成为开发者，请勾选页面上的同意协议，再点击 [ <em>成为开发者</em> ] 按钮</p>
					</div>
				</div>
				<div class="list-group-item">
					<h5 class="page-header">在开发者中心，找到［<em> 服务器配置</em> ］栏目下URL和Token设置</h5>
					<div class="con">
						<div class="img"><img src="resource/images/guide-02.png"/></div>
						<p># 将以下链接链接填入对应输入框：</p>
						<form action="" method="post" class="form-horizontal" role="form">
							<div class="form-group clip">
								<label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">URL:</label>
								<div class="col-sm-9 col-xs-12 input-group ">
									<p class="form-control-static"><a href="javascript:;" title="点击复制Token"><?php  echo $_W['siteroot'];?>api.php?id=<?php  echo $account['acid'];?></a></p>
								</div>
							</div>
							<div class="form-group clip">
								<label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">Token:</label>
								<div class="col-sm-9 col-xs-12 input-group">
									<p class="form-control-static"> <a href="javascript:;" title="点击复制Token"><?php  echo $account['token'];?></a></p>
								</div>
							</div>
							<div class="form-group clip">
								<label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 control-label">EncodingAESKey:</label>
								<div class="col-sm-10 input-group">
									<p class="form-control-static"> <a href="javascript:;" title="点击复制EncodingAESKey"><?php  echo $account['encodingaeskey'];?></a></p>
								</div>
							</div>
						</form>
						<p># 如果以前已填写过URL和Token，请点击[<em> 修改配置 </em>] ，再填写上述链接</p>
						<p># 请点击 [<em> 启用 </em>] ，以启用服务器配置：</p>
						<div class="img"><img src="resource/images/guide-03.png" width="524"></div>
					</div>
				</div>
				<?php  } ?>
				<div class="list-group-item">
					<h5 class="page-header">
						<?php  if($account['isconnect'] == 1) { ?>
							<em>公众号 <?php  echo $account['name'];?> 接入成功</em>
						<?php  } else { ?>
						
							<em>公众号 <?php  echo $account['name'];?> 正在等待接入……请及时按照以上步骤操作接入公众平台</em>
						<?php  } ?>
					</h5>
					<div class="con">
						<?php  if($account['isconnect'] == 0) { ?>
							<p># 检查公众平台配置</p>
							<p># 编辑公众号 <a href="<?php  echo url('account/post', array('acid' => $acid, 'uniacid' => $account['uniacid']))?>"><?php  echo $account['name'];?></a></p>
							<a href="javascript:window.location.reload();" class="btn btn-success" style="color:#FFF">检测是否接入成功</a>&nbsp;&nbsp;&nbsp;<a href="<?php  echo url('account/switch', array('uniacid' => $uniacid))?>" class="btn btn-primary" style="color:#FFF">暂不接入，先去查看管理功能</a>
							<a href="<?php  echo url('')?>" class="btn btn-info" style="color:#FFF">返回公众号列表</a>
						<?php  } else { ?>
							<a href="<?php  echo url('account/switch', array('uniacid' => $uniacid))?>" class="btn btn-primary" style="color:#FFF">管理公众号</a>
						<?php  } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php  } ?>
</div>
<script type="text/javascript">
	$('.clip p a').each(function(){
		util.clip(this, $(this).text());
	});
	require(['biz', 'filestyle'], function(biz){
		$(function(){
			$('#username').blur(function(){
				if ($('#username').val()) {
					var type = $('input[name="type"]:checked').val() ? $('input[name="type"]:checked').val() : 1;
					$('#imgverify').attr('src', '<?php  echo url("utility/wxcode")?>username=' + $('#username').val()+'&r='+Math.round(new Date().getTime()));
					$('#imgverify').parent().parent().parent().show();
					return false;
				}
			});
			$('#toggle').click(function(){
				if ($('#username').val()) {
					var type = $('input[name="type"]:checked').val() ? $('input[name="type"]:checked').val() : 1;
					$('#imgverify').attr('src', '<?php  echo url("utility/wxcode")?>username=' + $('#username').val()+'&r='+Math.round(new Date().getTime()));
					$('#imgverify').parent().parent().parent().show();
					return false;
				}
			});
			$(".form-group").find(':file').filestyle({buttonText: '上传图片'});
		});
	});
	function tokenGen() {
		var letters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		var token = '';
		for(var i = 0; i < 32; i++) {
			var j = parseInt(Math.random() * (31 + 1));
			token += letters[j];
		}
		$(':text[name="wetoken"]').val(token);
	}
	function EncodingAESKeyGen() {
		var letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		var token = '';
		for(var i = 0; i < 43; i++) {
			var j = parseInt(Math.random() * 61 + 1);
			token += letters[j];
		}
		$(':text[name="encodingaeskey"]').val(token);
	}
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer-gw', TEMPLATE_INCLUDEPATH)) : (include template('common/footer-gw', TEMPLATE_INCLUDEPATH));?>