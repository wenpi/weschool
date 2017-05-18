<?php
if (!pdo_getcolumn('core_menu', array('title' => '邮件通知参数'), 'id')) {
	$item_id = pdo_getcolumn('core_menu', array('title' => '会员及粉丝选项'), 'id');
	pdo_insert('core_menu', array(
		'pid' => $item_id,
		'title' => '邮件通知参数',
		'name' => 'setting',
		'url' => './index.php?c=profile&a=notify&',
		'append_title' => '',
		'append_url' =>  '',
		'displayorder' => '0',
		'type' => 'url',
		'is_display' => '1',
		'is_system' => '1',
		'permission_name' => 'profile_notify',
	));
	load()->model('cache');
	cache_build_frame_menu();
}

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201704080000');
return true;
