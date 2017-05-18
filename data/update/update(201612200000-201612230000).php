<?php
pdo_update('core_menu', array('permission_name' => 'platform_cover_clerk'), array('permission_name' => 'paycenter_clerk'));

load()->model('cache');
cache_build_frame_menu();

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612230000');
return true;

