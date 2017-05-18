<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<?php  if($do == 'display') { ?>
	<div class="mui-content mc-we7-home">
		<div class="mui-banner" style="background-image:url(<?php  if(!empty($ucpage['params'][0]['params']['bgImage'])) { ?>'<?php  echo $ucpage['params'][0]['params']['bgImage'];?>'<?php  } else { ?>'resource/images/head-bg.png'<?php  } ?>); background-repeat:no-repeat;background-size:cover;">
			<div class="setting"><a href="<?php  echo url('mc/bond/settings') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>">设 置</a></div>
			<img src="<?php  echo tomedia($profile['avatar']);?>" alt="" class="mui-logo mui-img-circle" />
			<div class="mui-banner-info">
				<div class="mui-big"><?php  if(!empty($profile['nickname'])) { ?><?php  echo $profile['nickname'];?><?php  } else { ?><a href="<?php  echo url('mc/profile') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" style="color:red;">设置昵称</a><?php  } ?></div>
				<div class="mui-mt5"><?php  if(!empty($profile['mobile'])) { ?><?php  echo $profile['mobile'];?><?php  } else { ?><a href="<?php  echo url('mc/bond/mobile', array('op' => 'mobilechange'))?>" class="mui-btn mui-btn-outlined">绑定手机</a><?php  } ?></div>
			</div>
			<div class="mui-row banner-nav">
				<div class="mui-col-xs-6 mui-text-center">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit2', 'type' => 'record', 'period' => '1'))?>">
						<span class="fa fa-rmb"></span>
						<?php  echo $creditnames[$behavior['currency']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['currency']];?></span>
					</a>
				</div>
				<div class="mui-col-xs-6 mui-text-center">
					<a href="<?php  echo url('mc/bond/credits', array('credittype' => 'credit1', 'type' => 'record', 'period' => '1'))?>">
						<span class="fa fa-database"></span>
						<?php  echo $creditnames[$behavior['activity']]['title'];?>: <span class="mui-ml5 mui-big"><?php  echo $credits[$behavior['activity']];?></span>
					</a>
				</div>
			</div>
		</div>

		<div class="mui-table mui-table-inline mui-mt15 nav-action">
			<div class="mui-table-cell">
				<a href="<?php  echo url('entry', array('m' => 'recharge', 'do' => 'pay'));?>" class="mui-block">
					<img src="resource/images/sum-recharge.png" alt="" />
					余额充值
				</a>
			</div>
			<div class="mui-table-cell">
				<a href="javascript:;" id="scanqrcode">
					<img src="resource/images/scan-pay.png" alt="" />
					扫码付款
				</a>
			</div>
		</div>
		<ul class="mui-table-view mui-table-view-chevron">
			<?php  if($uni_setting['exchange_enable'] == '1') { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('activity/coupon') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					兑换商城
				</a>
			</li>
			<?php  } ?>
			<?php  if($card_setting['status'] == '1') { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('mc/card/mycard') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					会员卡
				</a>
			</li>
			<?php  } ?>
		</ul>
		<ul class="mui-table-view mui-table-view-chevron">
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('activity/coupon/mine') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					我的卡券
				</a>
			</li>
			<li class="mui-table-view-cell">
				<a href="<?php  echo url('activity/goods/mine') . 'wxref=mp.weixin.qq.com#wechat_redirect'?>" class="mui-navigate-right">
					我的兑换
				</a>
			</li>
		</ul>
		<?php  if(!empty($others) || !empty($groups)) { ?>
		<ul class="mui-table-view mui-table-view-chevron">
		<?php  if(!empty($others)) { ?>
			<?php  if(is_array($others)) { foreach($others as $nav) { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo $nav['url']?>" class="mui-navigate-right">
					<?php  echo $nav['name'];?>
				</a>
			</li>
			<?php  } } ?>
		<?php  } ?>
		<?php  if(is_array($groups)) { foreach($groups as $name => $navs) { ?>
			<?php  if(is_array($navs)) { foreach($navs as $nav) { ?>
			<li class="mui-table-view-cell">
				<a href="<?php  echo $nav['url']?>" class="mui-navigate-right">
					<?php  echo $nav['name'];?>
				</a>
			</li>
			<?php  } } ?>
		<?php  } } ?>
		</ul>
		<?php  } ?>
		<?php  echo $ucpage['html'];?>
	</div>
<?php  } ?>

<script type="text/javascript">
	wx.ready(function(){
		$('#scanqrcode').click(function(){
			wx.scanQRCode({
				needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
				scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
				success: function (res) {
					var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
				}
			});
		});
	});
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>