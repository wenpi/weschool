<?php 
    $value     = $_GPC['value'];
    $school_id = getSchoolId();
    $teacher_id= getTeacherId();
    $admin_id  = getDbAdminId();
    $usedo     = $_GPC['use_do'];
    $url       = $this->createMobileUrl($usedo,array('value'=>$value,'school_id'=>$school_id,'teacher_id'=>$teacher_id,'admin_id'=>$admin_id));
    S('fun','createQrcode',array($_W['siteroot'].'app/'.$url));