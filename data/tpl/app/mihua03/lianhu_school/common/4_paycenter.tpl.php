<?php defined('IN_IA') or exit('Access Denied');?><?php  define('MUI', true);?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="mui-content pay-method">
	<h5 class="mui-desc-title mui-pl10">订单详情</h5>
	<ul class="mui-table-view">
		<li class="mui-table-view-cell">
			商品名称<span class="mui-pull-right mui-text-muted"><?php  echo $params['title'];?></span>
		</li>
		<li class="mui-table-view-cell">
			订单编号<span class="mui-pull-right mui-text-muted"><?php  echo $params['ordersn'];?></span>
		</li>
		<li class="mui-table-view-cell">
			商家名称<span class="mui-pull-right mui-text-muted"><?php  echo $_W['account']['name'];?></span>
		</li>
		<?php  if(!empty($mine)) { ?>
		<li class="mui-table-view-cell">
			优惠信息<span class="mui-pull-right mui-text-muted"><?php  echo $mine['name'];?></span>
		</li>
		<?php  } ?>
		<li class="mui-table-view-cell">
			您需要支付<span class="mui-pull-right mui-text-success mui-big mui-rmb"><?php  echo sprintf('%.2f', $params['fee']);?> 元</span>
		</li>
	</ul>
	<?php  if(!empty($token) || !empty($coupon)) { ?>
	<h5 class="mui-desc-title mui-pl10">可用卡券</h5>
	<ul class="mui-table-view ">
		<?php  if(!empty($token)) { ?>
		<li class="mui-table-view-cell mui-table-view-chevron">
			<a href="#pay-select-token-modal" class="mui-navigate-right js-token">
				代金券
				<?php  if(!empty($token)) { ?>
				<span class="used-num"><?php  echo count($token);?>张可用</span>
				<?php  } ?>
				<span class="mui-pull-right mui-mr10">
					<span class="mui-mr10 js-card-info"><?php  if(!empty($token)) { ?>未使用<?php  } else { ?>无可用<?php  } ?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($coupon)) { ?>
		<li class="mui-table-view-cell mui-table-view-chevron">
			<a href="#pay-select-coupon-modal" class="mui-navigate-right js-coupon">
				折扣券
				<?php  if(!empty($coupon)) { ?>
				<span class="used-num"><?php  echo count($coupon);?>张可用</span>
				<?php  } ?>
				<span class="mui-pull-right mui-mr10">
					<span class="mui-mr10 js-card-info"><?php  if(!empty($coupon)) { ?>未使用<?php  } else { ?>无可用<?php  } ?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
	</ul>
	<?php  } ?>
	<h5 class="mui-desc-title mui-pl10">选择支付方式</h5>
	<ul class="mui-table-view mui-table-view-chevron">
		<?php  if(!empty($pay['credit']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/credit');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/money.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					余额
					<span class="mui-block mui-text-muted mui-rmb mui-mt5"> <?php  echo sprintf('%.2f', $credtis[$setting['creditbehaviors']['currency']]);?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($pay['baifubao']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/baifubao');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/baidu-pay.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					百度钱包
					<span class="mui-block mui-text-muted mui-mt5">百度安全支付服务</span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($pay['unionpay']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/unionpay');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/yl-icon.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					银联支付
					<span class="mui-block mui-text-muted mui-mt5">银联安全支付服务</span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($pay['wechat']['switch']) && intval($pay['wechat']['switch']) != 4) { ?>
		<li class="mui-table-view-cell mui-disabled js-wechat-pay">
			<a class="mui-navigate-right mui-media" href="javascript:;">
				<form action="<?php  echo url('mc/cash/wechat');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/wx-icon.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					<span id="wetitle">微信支付(必须使用微信内置浏览器)</span>
					<span class="mui-block mui-text-muted mui-mt5">微信支付,安全快捷</span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($pay['alipay']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/alipay');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/zfb-icon.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					支付宝
					<span class="mui-block mui-text-muted mui-mt5">简单、安全、快速</span>
				</span>
			</a>
		</li>
		<?php  } ?>
		<?php  if(!empty($pay['delivery']['switch'])) { ?>
		<li class="mui-table-view-cell">
			<a class="mui-navigate-right mui-media js-pay" href="javascript:;">
				<form action="<?php  echo url('mc/cash/delivery');?>" method="post">
					<input type="hidden" name="params" value="<?php  echo base64_encode(json_encode($params));?>" />
					<input type="hidden" name="code" value="" />
					<input type="hidden" name="coupon_id" value="" />
				</form>
				<img src="resource/images/sum-recharge.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					货到付款
					<span class="mui-block mui-text-muted mui-mt5">支持货到付款</span>
				</span>
			</a>
		
		<?php  } ?>
		<?php  if(!empty($pay['line']['switch'])) { ?>
		<li class="mui-table-view-cell mui-disabled">
			<a class="mui-navigate-right mui-media">
				<img src="resource/images/icon-vip.png" alt="" class="mui-media-object mui-pull-left"/>
				<span class="mui-media-body mui-block">
					线下汇款
					<span class="mui-block mui-text-muted mui-mt5"><?php  echo htmlspecialchars_decode($pay['line']['message'])?></span>
				</span>
			</a>
		</li>
		<?php  } ?>
	</ul>
</div>
<?php  if(!empty($cards)) { ?>
<div id="pay-select-coupon-modal" class="mui-modal">
	<header class="mui-bar mui-bar-nav">
		<a class="mui-icon mui-icon-close mui-pull-right" href="#pay-select-coupon-modal"></a>
		<h1 class="mui-title">请选择卡券</h1>
	</header>
	<nav class="mui-bar mui-bar-footer">
		<div class="js-coupon-submit">
			<input type="hidden" name="couponid" value="">
			<button class="mui-btn mui-btn-success mui-btn-block js-submit">确定</button>
		</div>
	</nav>
	<div class="mui-content">
		<div class="pay-select-coupon">
			<div class="js-coupon-show">
				<?php  if(is_array($coupon)) { foreach($coupon as $li) { ?>
				<div class="mui-input-row mui-radio">
					<label>
						<div class="coupon-panel">
							<div class="mui-row">
								<div class="mui-col-xs-4 mui-text-center">
									<div class="coupon-panel-left">
										<?php  echo $li['icon'];?>
									</div>
								</div>
								<div class="mui-col-xs-8">
									<div class="store-title mui-ellipsis"><?php  echo $li['title'];?></div>
									<div class="date"><?php  echo $li['extra_date_info'];?></div>
								</div>
							</div>
						</div>
						<input type="radio" name="coupon" value="<?php  echo $li['id'];?>" />
					</label>
					<ol class="coupon-rules" style="display:none;">
						<?php  if(empty($li['description'])) { ?>
						暂无说明
						<?php  } else { ?>
						<?php  echo htmlspecialchars_decode($li['description'])?>
						<?php  } ?>
					</ol>
					<div class="scan-rules js-scan-rules">折扣券使用规则<span class="fa fa-angle-up"></span></div>
				</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>

<div id="pay-select-token-modal" class="mui-modal">
	<header class="mui-bar mui-bar-nav">
		<a class="mui-icon mui-icon-close mui-pull-right" href="#pay-select-token-modal"></a>
		<h1 class="mui-title">请选择卡券</h1>
	</header>
	<nav class="mui-bar mui-bar-footer">
		<div class="js-coupon-submit">
			<input type="hidden" name="couponid" value="">
			<button class="mui-btn mui-btn-success mui-btn-block js-submit">确定</button>
		</div>
	</nav>
	<div class="mui-content">
		<div class="pay-select-coupon">
			<div class="js-token-show">
				<?php  if(is_array($token)) { foreach($token as $li) { ?>
				<div class="mui-input-row mui-radio">
					<label>
						<div class="coupon-panel">
							<div class="mui-row">
								<div class="mui-col-xs-4 mui-text-center">
									<div class="coupon-panel-left">
										<?php  echo $li['icon'];?>
									</div>
								</div>
								<div class="mui-col-xs-8">
									<div class="store-title mui-ellipsis"><?php  echo $li['title'];?></div>
									<div class="date"><?php  echo $li['extra_date_info'];?></div>
								</div>
							</div>
						</div>
						<input type="radio" name="coupon" value="<?php  echo $li['id'];?>" />
					</label>
					<ol class="coupon-rules" style="display:none;">
						<?php  if(empty($li['description'])) { ?>
						暂无说明
						<?php  } else { ?>
						<?php  echo htmlspecialchars_decode($li['description'])?>
						<?php  } ?>
					</ol>
					<div class="scan-rules js-scan-rules">代金券使用规则<span class="fa fa-angle-up"></span></div>
				</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('click', '.js-scan-rules', function() {
		$(this).prev().toggle();
		$(this).find('span').toggleClass('fa-angle-up');
		$(this).find('span').toggleClass('fa-angle-down');
	});
	$(document).on('click', 'input[type="radio"]', function() {
		hidden_couponid = $('input[name="couponid"]').val();
		var couponid = $(this).val();
		if (!hidden_couponid) {
			$('input[type="radio"]').prop('checked', false);
			$(this).prop('checked', true);
			$('input[name="couponid"]').val(couponid);
		} else {
			if (hidden_couponid == couponid) {
				$(this).prop('checked', false);
				$('input[name="couponid"]').val('');
			} else {
				$('input[type="radio"]').prop('checked', false);
				$(this).prop('checked', true);
				$('input[name="couponid"]').val(couponid);
			}
		}
	});
	var cards_str = '<?php  echo $cards_str;?>';
	if (cards_str) {
		cards_str = $.parseJSON(cards_str);
	} else {
		cards_str = {};
	}
	$(document).on('click', '.js-submit', function() {
		var checked_card = $('input[name="couponid"]').val();
		if(checked_card && cards_str[checked_card]) {
			if (cards_str[checked_card].type == '1') {
				$('.js-coupon .js-card-info').html('已抵用'+cards_str[checked_card].discount_cn+'元');
				$('.js-token .js-card-info').html('未使用');
			};
			if (cards_str[checked_card].type == '2') {
				$('.js-token .js-card-info').html('已抵用'+cards_str[checked_card].discount_cn+'元');
				$('.js-coupon .js-card-info').html('未使用');
			};
			$('.js-pay input[name="coupon_id"]').val(checked_card);
			$('.js-pay input[name="code"]').val(cards_str[checked_card]['code']);
		} else {
			$('.js-token .js-card-info').html('未使用');
			$('.js-coupon .js-card-info').html('未使用');
			$('.js-pay input[name="coupon_id"]').val(0);
		}
		$('#pay-select-coupon-modal').removeClass('mui-active');
		$('#pay-select-token-modal').removeClass('mui-active');
		$('.mui-backdrop').remove('.mui-backdrop');
		$('.pay-method').removeAttr('style');
	})
</script>
<?php  } ?>
<script type="text/javascript">
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		$('.js-wechat-pay').removeClass('mui-disabled');
		$('.js-wechat-pay a').addClass('js-pay');
		$('#wetitle').html('微信支付');
	});
	$(document).on('click', '.js-pay', function() {
		$(this).find('form').submit();
	})
</script>


