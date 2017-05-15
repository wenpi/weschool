<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style>
	ul,li {padding:0; margin:0; border:0;}
	body{background:#d2e6e9; padding-bottom:63px;}
	.btn-group-top-box{padding:10px 0; border-bottom:1px solid #a5d7de; font-family:Helvetica, Arial, sans-serif; text-align:center; width:100%;}
	.btn-group-top{overflow:hidden;}
	.btn-group-top .btn{ -webkit-box-shadow:none; box-shadow:none; border-color:#5ac5d4; color:#5ac5d4; background:#d1e5e9; padding:6px;}
	.btn-group-top .btn:hover{color:#FFF; background:#addbe1;}
	.btn-group-top .btn.active{color:#FFF; background:#5ac5d4;}
	.btn.use{background:#56c6d6; color:#FFF; border:0; border-radius:4px;}
	
	.scroll-container .list-group {list-style:none; padding:0; margin:0; width:100%; text-align:left;}
	.scroll-container .list-group .list-group-item{border:none; background:#d2e6e9;}
	.scroll-container .list-group .list-group-item .con{background:#ffffff; width:280px; margin:0 auto;}
	.scroll-container .list-group .list-group-item .list-hd{padding:5px 20px;}
	.scroll-container .list-group .list-group-item .list-hd h5{font-weight:bold; margin-bottom:2px; font-size:16px; color:#444444;}
	.scroll-container .list-group .list-group-item .list-hd p{color:#b8b8b9;}
	.scroll-container .list-group .list-group-item .list-con img{display:block; width:90%; margin:0 auto;}
	.scroll-container .list-group .list-group-item .list-con .derpn{padding:10px 10px 0 10px; border-top:1px dotted rgb(204, 204, 204); margin-top:10px;display:none;}
	.scroll-container .list-group .list-group-item .list-ft{width:290px; background: transparent url('resource/images/ft-bg.png') no-repeat 0 0; background-size: 100% auto; height: 44px; line-height: 48px; overflow: hidden; position:relative; left:-5px; top:5px; padding:0 0 0 15px;}
	.scroll-container .list-group .list-group-item .list-ft b{color: #56c6d6; font-size: 30px; margin-right:5px;}
	.scroll-container .list-group .list-group-item .list-ft .btns{width:105px; text-align:center; font-size:18px; color:#ffffff; line-height:44px;}
	.scroll-container .list-group .list-group-item .list-ft .btns a{color:#ffffff;}
	.scroll-container .load-more{padding:10px;text-align:center;font-size:1em;}
		
	.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#5ac5d4; border-color:#5ac5d4;}
	.pagination>li>a, .pagination>li>span{color:#5ac5d4; border:1px solid #a5d7de;}
	.panel.deliver{margin:0; padding:0 15px 10px 15px; background:transparent url('resource/images/home-bg.jpg') no-repeat; background-size:100% 100%;}
	.deliver form .btn.btn-primary{background:#5ac5d4; border:0;}
	@media screen and (max-width: 767px) {.tpl-district-container div{margin-bottom:10px;}}
</style>
<?php  if($do == 'display') { ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('activity/nav', TEMPLATE_INCLUDEPATH)) : (include template('activity/nav', TEMPLATE_INCLUDEPATH));?>
<div class="scroll-container">
	<div class="wrapper">
		<ul class="list-group" >
			<?php  if(is_array($lists)) { foreach($lists as $list) { ?>
				<li class="list-group-item">
					<div class="con">
						<div class="list-hd">
							<h5><?php  echo $list['title'];?>(<?php  echo $list['extra']['title'];?>)</h5>
							<p>有效期至<?php  echo date('Y年m月d日', $list['endtime']);?></p>
						</div>
						<div class="list-con">
							<img src="<?php  echo tomedia($list['thumb'])?>">
							<div class="derpn">
								<?php  echo htmlspecialchars_decode($list['description'])?>
							</div>
						</div>
						<div class="list-ft">
							<div class="pull-left"><?php  echo $creditnames[$list['credittype']];?>:<b><?php  echo $list['credit'];?></b></div>
							<div class="pull-right btns"><a href="javascript:;" data-id="<?php  echo $list['id'];?>" class="use-token">立即兑换</a></div>
						</div>
					</div>
				</li>
			<?php  } } ?>
		</ul>
		<div class="btn-group-top-box">
			<div class="btn-group btn-group-top">
				<?php  echo $pager;?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	require(['util'], function(u){
		$('.con').click(function(){
			var description = $(this).find('.derpn').text();
			if (description.indexOf('<') >= 0) {
				$(this).find('.derpn').html(description);
			}
			$(this).find('.derpn').slideToggle(500);
		});

		$('.use-token').click(function(){
			var id = parseInt($(this).data('id'));
			if(!id) {
				return false;
			}
			$.post("<?php  echo url('activity/goods/post');?>", {'id':id}, function(data) {
				var data = $.parseJSON(data);
				if(data.message.errno < 0) {
					u.message(data.message.message, '', 'error');
				} else {
					u.message(data.message.message, "<?php  echo rtrim(url('activity/goods/deliver'), '&');?>"+'&tid='+data.message.errno, 'success');
				}
				return false;
			});
		});
	});
</script>
<?php  } else if($do == 'deliver') { ?>
<style>
	.panel{margin:.5em;padding:.5em;}
	.actions{margin:.8em auto;}
	.nav.nav-tabs{margin-bottom:.8em;}
</style>
<script type="text/javascript">	
	$("#form1").submit(function(){
		if($("#realname").val().trim() == '') {
			util.message('请填写收货人姓名');
			return false;
		}
		if($("#mobile").val().trim() == '') {
			util.message('请填写收货人电话');
			return false;
		}
		var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
		if (!reg.test($('#mobile').val())) {
			util.message('收货人电话格式不正确');
			return false;
		}
		if($("#zipcode").val().trim() == '') {
			util.message('请填写收货人邮编');
			return false;
		}
		if($("#zipcode").val().trim() == '') {
			util.message('请填写收货人邮编');
			return false;
		}
		if($("#address").val().trim() == '') {
			util.message('请填写收货人地址');
			return false;
		}
		
	});
</script>
<div class="btn-group-top-box">
	<div class="btn-group btn-group-top">
		<a href="<?php  echo url('activity/goods/mine/', array('status' => '0'))?>" class="btn btn-default <?php  if(($_GPC['type'] != 'used')) { ?>active<?php  } ?>">待发货</a>
		<a href="<?php  echo url('activity/goods/mine/', array('status' => '1'))?>" class="btn btn-default <?php  if(($_GPC['type'] == 'used')) { ?>active<?php  } ?>">已发货</a>
		<a href="<?php  echo url('activity/goods/mine/', array('status' => '2'))?>" class="btn btn-default <?php  if(($_GPC['type'] == 'used')) { ?>active<?php  } ?>">已完成</a>
	</div>
</div>
<div class="panel deliver">
	<div class="panel-heading text-center">
		<h4>收货人信息</h4>
	</div>
	<form name="theform" method="post" id="form1" action="">
		<div class="tab-content">
			<div class="tab-pane animated active">
				<div class="form-group">
					<label class="control-label">收货人姓名</label>
					<input name="realname" id="realname" type="text" class="form-control" placeholder="收货人姓名" value="<?php  echo $ship['name'];?>">
				</div>
				<div class="form-group">
					<label class="control-label">收货人电话</label>
					<input name="mobile" id="mobile" type="text" class="form-control" placeholder="收货人电话" value="<?php  echo $ship['mobile'];?>">
				</div>
				<div class="form-group">
					<label class="control-label">收货人邮编</label>
					<input name="zipcode" id="zipcode" type="text" class="form-control" placeholder="收货人邮编" value="<?php  echo $ship['zipcode'];?>">
				</div>
				<div class="form-group">
					<label class="control-label">邮寄省市县(区)</label>
					<?php  echo tpl_fans_form('reside', array('province' => $ship['province'], 'city' => $ship['city'], 'district' => $ship['district']));?>
				</div>
				<div class="form-group">
					<label class="control-label">收货人地址</label>
					<input name="address" id="address" type="text" class="form-control" placeholder="收货人地址" value="<?php  echo $ship['address'];?>">
				</div>
			</div>
		</div>
		<input type="hidden" name="status" value="{$list.status}">
		<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
		<input type="hidden" name="id" value="<?php  echo $id;?>" >
		<input type="hidden" name="sid" value="<?php  echo $sid;?>" >
		<input type="submit" name="submit" class="btn btn-primary btn-block" value="提交资料">
		<?php  if($list['status'] == 1) { ?>
			<input type="submit" name="submit" class="btn btn-warning btn-block" value="确认收获">
		<?php  } ?>
	</form>
</div>
<?php  } else if($do == 'mine') { ?> 
<div class="voucher-main">
	<div class="btn-group-top-box">
		<div class="btn-group btn-group-top">
			<a href="<?php  echo url('activity/goods/mine/', array('status' => '0'))?>" class="btn btn-default <?php  if(($_GPC['status'] == '' || $_GPC['status'] == 0)) { ?>active<?php  } ?>">待发货</a>
			<a href="<?php  echo url('activity/goods/mine/', array('status' => '1'))?>" class="btn btn-default <?php  if(($_GPC['status'] == '1')) { ?>active<?php  } ?>">已发货</a>
			<a href="<?php  echo url('activity/goods/mine/', array('status' => '2'))?>" class="btn btn-default <?php  if(($_GPC['status'] == '2')) { ?>active<?php  } ?>">已完成</a>
		</div>
	</div>
	<div class="scroll-container">
		<div class="wrapper">
			<ul class="list-group" >
				<?php  if(is_array($lists)) { foreach($lists as $list) { ?>
					<li class="list-group-item">
						<div class="con">
							<div class="list-hd">
								<h5><?php  echo $list['title'];?>(<?php  echo $list['extra']['title'];?>)</h5>
								<p>有效期至<?php  echo date('Y年m月d日', $list['endtime']);?></p>
							</div>
							<div class="list-con">
								<img src="<?php  echo tomedia($list['thumb'])?>">
								<div class="derpn">
									<?php  echo htmlspecialchars_decode($list['description'])?>
								</div>
							</div>
							<div class="list-ft">
								<div class="pull-left"><?php  echo $creditnames[$list['credittype']];?>:<b><?php  echo $list['credit'];?></b></div>
								<?php  if($list['status'] == 0) { ?>
									<div class="pull-right btns"><a href="<?php  echo url('activity/goods/deliver', array('tid' => $list['tid']))?>">收货人信息</a></div>
								<?php  } else if($list['status'] == 1) { ?>
									<div class="pull-right btns"><a href="<?php  echo url('activity/goods/confirm', array('tid' => $list['tid']))?>">确认收货</a></div>
								<?php  } else { ?>
									<div class="pull-right btns"><a href="javascript:;">交易已完成</a></div>
								<?php  } ?>
							</div>
						</div>
					</li>
				<?php  } } ?>
			</ul>
		</div>
	</div>
	<div class="btn-group-top-box">
		<div class="btn-group btn-group-top">
			<?php  echo $pager;?>
		</div>
	</div>
</div>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/toolbar', TEMPLATE_INCLUDEPATH)) : (include template('common/toolbar', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
