<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'schoolHouse';
    $left_nav     = 'teaBuilding';
    $title        = '教学楼管理';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'建筑管理'),
            array('fun_str'=>'teaBuilding','fun_name'=>'教学楼管理'),
    );
    $top_action = array(
            array('action_name'=>'教学楼管理' ,'action'=>'teaBuilding'),
            array('action_name'=>'添加楼栋','action'=>'teaBuilding','arr'=>array('ac'=>'new') ),
    );
    $class_building = D("teaBuilding");

    if($_GPC['submit']){
            $in['building_name'] = $_GPC['building_name'];
            $in["status"]       = $_GPC['status'];
    }
    if($ac=='new'){
        if($_GPC['submit']){
            $re = $class_building->add($in);
            $this->myMessage("添加成功",$this->createWebUrl("teaBuilding"),"成功");
        }
    }
    if($ac=='edit'){
        $id     = $_GPC['id'];
        $result = $class_building->edit(array("building_id"=>$id));
        $page_name = '编辑楼栋';
        if($_GPC['submit']){
            $class_building->edit(array("building_id"=>$id),$in);
            $this->myMessage("编辑成功",$this->createWebUrl("teaBuilding"),"成功");
        }
    }
    if($ac=='delete'){
        if($_GPC['id']){
            $arr['building_id'] = $_GPC['id'];
            $re = $class_building->use_class->delete($arr);  
            if(is_array($re)){
                 $msg_info['type']    = 'success';
                 $msg_info["msg"]     = '删除成功';              
            }
            $ac='list';
        }        
    }
    if($ac=='list'){
        $page_name        = '教学楼管理';
        $where[":status"] = array("!=",-1);
        $class_building->each_page = 10000;
        $list                      = $class_building->getList($where);
        $list                      = $list['list'];
    }   
    include $this->template('../admin/TeaBuilding');
    exit();
