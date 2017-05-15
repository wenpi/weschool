<?php
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
    $left_top     = 'schoolHouse';
    $left_nav     = 'teaRoom';
    $title        = '教室管理';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'基本设置'), 
        array('fun_str'=>'teaRoom','fun_name'=>'教室管理'),
    );
	$top_action = array(
		array('action_name'=>'教室列表','action'=>'teaRoom' ),
		array('action_name'=>'添加教室','action'=>'teaRoom','arr'=>array('ac'=>'new') ),
	);
    $we7_js         = 'no';
    $class_building = D("teaBuilding");
    $class_room     = D("teaRoom");
    $class_building->each_page = 10000;
    $where[":status"] = 1;
    $build_re        = $class_building->getList($where);
    $building_list   = $build_re['list'];

    if($_GPC["submit"]){
        $in["tea_building_id"] = $_GPC['tea_building_id'];
        $in["room_num"]        = $_GPC['room_num'];
    }

    if($ac=='delete'){
        if($_GPC['id']){
            $arr['room_id'] = $_GPC['id'];
            $up["status"]   = -1;
            $class_room->edit($arr,$up);  
            $this->myMessage("删除成功",$this->createWebUrl("teaRoom"),'成功');            
        }        
    }
    if($ac=='list'){
        $page_name = '教室列表';
        $list      = $class_room->getRoomList(true);
    }
    if($ac=='edit'){
        $page_name    = '编辑房间';
        $id           = $_GPC['room_id'];
        $result       = $class_room->edit(array('room_id'=>$id));
        if($_GPC['submit']){
            $in['status'] = $_GPC['status'];
            $class_room->edit(array("room_id"=>$id),$in);
            $this->myMessage("编辑房间成功",$this->createWebUrl("teaRoom"),'成功');            
        }
    }
    
    if($ac=='new'){
        $page_name = '添加教室';
        if($_GPC['submit']){
            $room_nums = explode(',',$in['room_num']);
            foreach ($room_nums as $key => $value) {
                $in["room_num"] = $value;
                $class_room->add($in);
            }
            $this->myMessage("添加房间成功",$this->createWebUrl("teaRoom"),'成功');            
        }
    }
    include $this->template('../admin/TeaRoom');
	exit();
