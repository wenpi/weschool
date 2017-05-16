<?php 
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
    
    $left_top     = 'schoolHouse';
    $left_nav     = 'building';
    $title        = '进出详情';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'基本设置'), 
        array('fun_str'=>'funcroom_building','fun_name'=>'楼栋管理'),
    );
	$top_action = array(
		array('action_name'=>'楼栋列表','action'=>'funcroom_building' ),
		array('action_name'=>'添加楼栋','action'=>'funcroom_building','arr'=>array('ac'=>'new') ),
		array('action_name'=>'进出详情','action'=>'funcroom_buildingInList'),
	);    
    $page_name  = '进出详情';
    $class_building = Au("room/building");
    $class_roomCard = Au("room/roomCard");
    $id             = $_GPC['id'];
    $result         = $class_building->edit(array("building_id"=>$id));
    $we7_js          = 'no';
    //
    $class_roomCard->time_str = time();
    $in_re = $class_roomCard->muchIn();
    $out_re= $class_roomCard->muchOut();
    $unusual_re   = $class_roomCard->muchUnusual();
    $student_list = Au("room/roomStudent")->buildingStudentList($id);
    foreach ($student_list as $key => $value) {
        $student_list[$key]['student_name'] = D("student")->getStudentName($value['student_id']);
        $student_list[$key]['room_num']     = Au("room/room")->getRoom($value['room_id']);
        $in_out_list =  $class_roomCard->studentInOut($value['student_id']);
        foreach ($in_out_list as $val) {
            $text = $val['in_out']==1 ? "进入":$val['in_out']==2? "出去" : "异常";
            $student_list[$key]['str'] .= $text.'['.date("m-d H:i",$val['add_time']).']<br>';
        }
    }
    include $this->template('../admin/BuildingInList');
	exit();
