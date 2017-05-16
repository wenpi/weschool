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
	);
    $we7_js         = 'no';
    $class_building = Au("room/building");
    $class_room     = Au("room/room");
    $class_building->each_page = 10000;
    $where[":status"] = 1;
    $build_re        = $class_building->getList($where);
    $building_list   = $build_re['list'];

    if($_GPC["submit"]){
        $in["building_id"] = $_GPC['building_id'];
        $in['floor_id']    = $_GPC['floor_id'];
        $in["room_num"]    = $_GPC['room_num'];
    }

    if($ac=='delete'){
        if($_GPC['id']){
            $arr['room_id'] = $_GPC['id'];
            $up["status"]   = -1;
            $class_room->edit($arr,$up);  
            $this->myMessage("删除成功",$this->createWebUrl("funcroom_room"),'成功');            
        }        
    }
    if($ac=='list'){
        $page_name = '房间列表';
        $list      = $class_room->getRoomList();

    }
    if($ac=='edit'){
        $page_name    = '编辑房间';
        $id           = $_GPC['id'];
        $result       =  $class_room->edit(array('room_id'=>$id));
        if($_GPC['submit']){
            $in['status'] = $_GPC['status'];
            $class_room->edit(array("room_id"=>$id),$in);
            $this->myMessage("编辑房间成功",$this->createWebUrl("funcroom_room"),'成功');            
        }
    }
    
    if($ac=='new'){
        $page_name = '添加房间';
        if($_GPC['submit']){
            $room_nums = explode(',',$in['room_num']);
            foreach ($room_nums as $key => $value) {
                $in["room_num"] = $value;
                $class_room->add($in);
            }
            $this->myMessage("添加房间成功",$this->createWebUrl("funcroom_room"),'成功');            
        }
    }
    include $this->template('../admin/Room');
	exit();
