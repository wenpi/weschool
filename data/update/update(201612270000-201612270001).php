<?php
$we7_coupon_exists = pdo_get('modules', array('name' => 'we7_coupon'));
if (!empty($we7_coupon_exists)) {
	pdo_update('modules', array('settings' => '2'), array('mid' => $we7_coupon_exists['mid']));
}

load()->model('cache');
cache_build_account_modules();

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612270001');
return true;

