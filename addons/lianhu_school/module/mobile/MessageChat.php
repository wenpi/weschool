<?php 
$result       = $this->mobile_from_find_student();
$class_message= D("message");
$message_id   = $_GPC['id'];
$page_title   = '详情';
$message_info = $class_message->getMessageInfo($message_id);
$handle_list  = $class_message->getMessageHandle($message_id);
$school_logo_url = $_W['attachurl'].S("system",'getSetContent',array('school_logo',getSchoolId() ));