<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_base_set';
    $left_nav     = 'caidan';
    $title        = '独立菜单分类';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校基本设置'),
        array('fun_str'=>'caidan','fun_name'=>'独立菜单'),
    );
    $top_action = array(
        array('action_name'=>'菜单列表','action'=>'caidan'),
        array('action_name'=>'新增菜单','action'=>'caidan','arr'=>array('ac'=>'new')),
        array('action_name'=>'菜单分类列表','action'=>'caidanClass'),
        array('action_name'=>'新增菜单分类','action'=>'caidanClass','arr'=>array('ac'=>'new')),
    );	
    $page_name    = '菜单分类列表';
    if($ac=='new'){
         $page_name    = '新增菜单分类';
    }
    $class_caidanClass = D('caidanClass');
    $where[":status"]  = array("!=",'-1');
    $relist = $class_caidanClass->getList($where);
    $list   = $relist['list'];
    if($ac=='new' && $_GPC['submit']){
        $arr = getNewUpdateData($_GPC,$class_caidanClass);
        $class_caidanClass->add($arr);
        $this->myMessage("新增成功",$this->createWebUrl('caidan'),'成功');
    }

    if($ac=='edit'){
        $id = $_GPC['id'];
        $re = $class_caidanClass->edit(array('class_id'=>$id));
        $result = $re;
        if($re && $_GPC['submit']){
            $arr = getNewUpdateData($_GPC,$class_caidanClass);
            $re  = $class_caidanClass->edit(array('class_id'=>$id),$arr);
            $this->myMessage("编辑成功",$this->createWebUrl('caidan'),'成功');
        }
    }
    if($ac=='delete'){
        $id = $_GPC['id'];
        $re = $class_caidanClass->edit(array('class_id'=>$id),array('status'=>'-1'));
        $this->myMessage("删除成功",$this->createWebUrl('caidan'),'成功');
    }

    include $this->template('../admin/CaidanClass');
    exit();