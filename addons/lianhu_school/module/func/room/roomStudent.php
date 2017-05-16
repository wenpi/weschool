<?php
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
    
    $left_top     = 'schoolHouse';
    $left_nav     = 'room';
    $title        = '房间管理';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'基本设置'), 
        array('fun_str'=>'funcroom_room','fun_name'=>'房间管理'),
    );
	$top_action = array(
		array('action_name'=>'房间列表','action'=>'funcroom_room' ),
		array('action_name'=>'添加房间','action'=>'funcroom_room','arr'=>array('ac'=>'new') ),
		array('action_name'=>'宿舍成员管理' ),
	);

    $we7_js             = 'no';
    $class_building     = Au("room/building");
    $class_room         = Au("room/room");
    $class_roomStudent  = Au("room/roomStudent");
    $page_name          = "宿舍成员管理";
    $id                 = $_GPC['id'];
    $room_re            = $class_room->edit(array("room_id"=>$id));
    $building_name      = $class_building->getBuildNum($room_re['building_id']);
    $we7_js             = 'no';
    //提交
    if($_GPC['submit'] && $room_re){
        if($_GPC['student_id']){
            $where["room_id"] = $id;
            $class_roomStudent->delete($where);
            $in['room_id']      = $id;
            $in['building_id']  = $room_re['building_id'];
            foreach ($_GPC['student_id'] as $key => $value) {
                $in['student_id'] = $value;
                $class_roomStudent->add($in);
            }
            $this->myMessage("更新成功",$this->createWebUrl("funcroom_roomStudent",array("id"=>$id)),"成功");
        }else{
            $this->myMessage("请选择学生",$this->createWebUrl("funcroom_roomStudent",array("id"=>$id)),"错误");
        }        
    }
    //所有学生列表
    $student_list = D('student')->getStudentlist();
    if($room_re){
        $class_roomStudent->room_id = $id;
        $room_student_list          = $class_roomStudent->roomStudentList();
        foreach ($room_student_list as $key => $value) {
            $do_student_ids[] = $value['student_id'];
        }
    }
    $all_student_ids  = $class_roomStudent->allRoomStudentIds();

    include $this->template('../admin/RoomStudent');
	exit();
