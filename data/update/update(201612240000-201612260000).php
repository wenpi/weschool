<?php
if (!file_exists(IA_ROOT . '/web/source/activity/clerk.ctrl.php')) {
	load()->model('setting');
	setting_upgrade_version(IMS_FAMILY, '0.8', '201612260000');
	return true;
}
//当前公众号是否使用系统卡券
$uni_settings = pdo_getall('uni_settings', '', array('exchange_enable', 'coupon_type', 'uniacid'), 'uniacid');
if (!empty($uni_settings)) {
	foreach ($uni_settings as $key => $value) {
		if (!empty($key)) {
			$cachekey = "modulesetting:{$key}:we7_coupon";
			$setting['coupon_type'] = $value['coupon_type'];
			$setting['exchange_enable'] = $value['exchange_enable'];
			cache_write($cachekey, $setting);
		}
	}
}
//修改会员卡和店员手机端后台链接cover_reply
$card_cover_urls = pdo_getall('cover_reply', array('module' => 'card'), array('id', 'module', 'url', 'uniacid'));
foreach ($card_cover_urls as $k=>$value) {
	$new_card_url = "./index.php?i={$value['uniacid']}&c=entry&m=we7_coupon&do=card";
	pdo_update('cover_reply', array('url' => $new_card_url), array('id' => $value['id']));

}
$clerk_cover_urls = pdo_getall('cover_reply', array('module' => 'clerk'), array('id', 'module', 'url', 'uniacid'));
foreach ($clerk_cover_urls as $k=>$value) {
	$new_clerk_url = "./index.php?i={$value['uniacid']}&c=entry&m=we7_coupon&do=clerk";
	pdo_update('cover_reply', array('url' => $new_clerk_url), array('id' => $value['id']));

}

//modules表里插入数据
$title = '微擎卡券';
$ability = '卡券功能，是微擎向有投放卡券需求的公众号提供的管理、推广、经营分析的整套解决方案。商户可通过卡券功能，实现卡券的管理与运营。';
$description = '微擎卡券功能是微擎为商户提供的一套完整的电子卡券解决方案，商户可通过该功能实现电子卡券生成、下发、领取、核销的闭环。';
$insert_data = array(
	'name' => 'we7_coupon',
	'type' => 'business',
	'title' => $title,
	'version' => '1.6',
	'ability' => $ability,
	'description' => $description,
	'author' => '微擎团队',
	'settings' => '2',
);
$we7_coupon_exist = pdo_get('modules', array('name' => 'we7_coupon'));
if (empty($we7_coupon_exist)) {
	pdo_insert('modules', $insert_data);
}

//modules_bindings表里插入数据
pdo_delete('modules_bindings', array('module' => 'we7_coupon'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'cover', 'title' => '会员卡入口设置', 'do' => 'card', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'cover', 'title' => '收银台入口设置', 'do' => 'clerk', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '
会员卡设置', 'do' => 'membercard', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '会员卡管理', 'do' => 'cardmanage', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '会员属性', 'do' => 'memberproperty', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '优惠券管理', 'do' => 'couponmanage', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '优惠券核销', 'do' => 'couponconsume', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '优惠券派发', 'do' => 'couponmarket', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '
兑换优惠券', 'do' => 'couponexchange', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '兑换真实物品', 'do' => 'goodsexchange', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '门店管理', 'do' => 'storelist', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '
店员管理', 'do' => 'clerklist', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '门店收银台', 'do' => 'paycenter', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '签到管理', 'do' => 'signmanage', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'menu', 'title' => '通知管理', 'do' => 'noticemanage', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'profile', 'title' => '会员卡', 'do' => 'card', 'direct' => '0', 'displayorder' => '0'));
pdo_insert('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'profile', 'title' => '兑换商城', 'do' => 'activity'));
//增加模块内，个人中心导航菜单的链接
$coupon_mine_url = murl('entry', array('m' => 'we7_coupon', 'do' => 'activity', 'op' => 'mine'));
$goods_mine_url = murl('entry', array('m' => 'we7_coupon', 'do' => 'activity', 'activity_type' => 'goods', 'op' => 'mine'));
pdo_insert('site_nav', array('uniacid' => $_W['uniacid'], 'module' => 'we7_coupon', 'name' => '我的卡券', 'position' => '2', 'url' => $coupon_mine_url, 'status' => '2'));
pdo_insert('site_nav', array('uniacid' => $_W['uniacid'], 'module' => 'we7_coupon', 'name' => '我的兑换', 'position' => '2', 'url' => $goods_mine_url, 'status' => '2'));


//获取需更改的url地址
$cardmanage_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'cardmanage', 'op' => 'display'));
$cardeditor_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'membercard', 'op' => 'editor'));
$notice_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'noticemanage', 'op' => 'list'));
$sign_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'noticemanage', 'op' => 'list'));
$coupon_exchange = url('site/entry', array('m' => 'we7_coupon', 'do' => 'couponexchange', 'op' => 'display'));
$goods_exchange = url('site/entry', array('m' => 'we7_coupon', 'do' => 'goodsexchange', 'op' => 'display'));
$couponlist_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'couponmanage', 'op' => 'display'));
$couponmarket_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'couponmarket', 'op' => 'display'));
$couponconsume_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'couponconsume', 'op' => 'display'));
$storelist_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'storelist', 'op' => 'display'));
$clerklist_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'clerklist', 'op' => 'display'));
$paycenter_url = url('site/entry', array('m' => 'we7_coupon', 'do' => 'paycenter', 'op' => 'pay'));
//入口文件
$card_cover = pdo_get('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'cover', 'do' => 'card'));
$clerk_cover = pdo_get('modules_bindings', array('module' => 'we7_coupon', 'entry' => 'cover', 'do' => 'clerk'));
$membercard_cover_url = url('platform/cover', array('eid' => $card_cover['eid']));
$clerk_cover_url = url('platform/cover', array('eid' => $clerk_cover['eid']));


//更新core_menu表

//会员卡管理
pdo_update('core_menu', array('url' => $membercard_cover_url), array('permission_name' => 'platform_cover_card'));
pdo_update('core_menu', array('url' => $cardmanage_url), array('permission_name' => 'mc_card_manage'));
pdo_update('core_menu', array('url' => $cardeditor_url), array('permission_name' => 'mc_card_editor'));
pdo_update('core_menu', array('url' => $notice_url), array('permission_name' => 'mc_card_other'));
//积分兑换
pdo_update('core_menu', array('url' => $coupon_exchange), array('permission_name' => 'activity_card_display'));
pdo_update('core_menu', array('url' => $goods_exchange), array('permission_name' => 'activity_goods_display'));
//卡券管理
pdo_update('core_menu', array('url' => $couponlist_url), array('permission_name' => 'activity_coupon_display'));
pdo_update('core_menu', array('url' => $couponmarket_url), array('permission_name' => 'activity_coupon_market'));
pdo_update('core_menu', array('url' => $couponconsume_url), array('permission_name' => 'activity_consume_coupon'));
//工作台
pdo_update('core_menu', array('url' => $storelist_url), array('permission_name' => 'activity_store_list'));
pdo_update('core_menu', array('url' => $clerklist_url), array('permission_name' => 'activity_clerk_list'));
pdo_update('core_menu', array('url' => $paycenter_url), array('permission_name' => 'paycenter_wxmicro_pay'));
pdo_update('core_menu', array('url' => $clerk_cover_url), array('permission_name' => 'paycenter_clerk'));

load()->model('cache');
cache_build_frame_menu();
cache_build_account_modules();

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612260000');
return true;

