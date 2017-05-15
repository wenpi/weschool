<?php
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_hardware';
	$left_nav     = 'hardware_card';
	$sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校硬件'),
        array('fun_str'=>'device','fun_name'=>'进校打卡&校车'),
	);
	$top_action = array(
        array('action_name'=>'添加新的设备','action'=>'device','arr'=>array('aw'=>1,'ac'=>'new') ),
    );

    $class_schoolBus = C('schoolBus');
    $class_device    = C('device');
    $device_id       = $_GPC['id'];
    $device_info     = $class_device->use_class->dataEdit($device_id);
    $title           = $device_info['device_name']."行驶轨迹";
    
    if($device_info['school_id']==getSchoolId()){
        $class_schoolBus->device_id  = $device_id;
        $class_schoolBus->begin_time = $_GPC['begin_time'] ? strtotime($_GPC['begin_time']):  strtotime(date("Y-m-d",time())) ;
        $class_schoolBus->end_time   = $_GPC['end_time']   ? strtotime($_GPC['end_time']): $class_schoolBus->begin_time+3600*24;
        $list = $class_schoolBus->timeOrbit();
    }
	include $this->template('../admin/SchoolBus');
    exit();