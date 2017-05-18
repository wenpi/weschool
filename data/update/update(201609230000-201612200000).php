<?php


load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201612200000');
return true;

