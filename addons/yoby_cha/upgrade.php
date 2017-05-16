<?php
if(!pdo_fieldexists('yoby_cha_reply', 'is_show')) {
	pdo_query("ALTER TABLE ".tablename('yoby_cha_reply')." ADD  `is_show` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('yoby_cha_reply', 'is_m')) {
	pdo_query("ALTER TABLE ".tablename('yoby_cha_reply')." ADD  `is_m` tinyint(1) DEFAULT '0';");
}
