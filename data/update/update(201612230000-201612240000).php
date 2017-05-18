<?php
if (!pdo_tableexists('activity_clerks')) {
	pdo_delete('core_menu', array('permission_name ' => 'profile_deskmenu'));
	pdo_delete('core_menu', array('permission_name ' => 'stat_card'));
	pdo_delete('core_menu', array('permission_name ' => 'stat_paycenter'));
	pdo_delete('core_menu', array('permission_name ' => 'stat_cash'));
}

load()->model('cache');
cache_build_frame_menu();

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612240000');
return true;

