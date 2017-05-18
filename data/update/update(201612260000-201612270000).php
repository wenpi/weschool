<?php
@unlink(IA_ROOT . '/addons/we7_coupon/manifest.xml');
@unlink(IA_ROOT . '/addons/we7_coupon/install.php');
@unlink(IA_ROOT . '/addons/we7_coupon/developer.cer');

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612270000');
return true;

