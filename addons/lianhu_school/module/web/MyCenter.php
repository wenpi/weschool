<?php
    $this->checkAdminWeb();
    $class_admin    = D('admin');
    $class_teacher  = D('teacher');
    $admin_result = $class_admin->judeAdminType();
    $left_top     = 'system_index';
    $left_nav     = 'myCenter';
    $title        = '个人中心';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统首页'),
        array('fun_str'=>'myCenter','fun_name'=>'个人中心'),
    );
    if($admin_result['admin'] != 'top' ||  $admin_result['use_set'] == 1){
        $result = $admin_result['info'];
        if($_GPC['submit']){
            if($admin_result['admin']=='teacher'){
                if($result['teacher_id']){
                    $up['teacher_realname'] = $_GPC['admin_name'];
                    $up['teacher_telphone'] = $_GPC['phone'];
                    $up['teacher_img']      = $_GPC['admin_img'];
                    $class_teacher->edit(array('teacher_id'=>$result['teacher_id']),$up);
                }
            }
            $class_admin->updateJiaAdmin($result['admin_id'],'admin_img',$_GPC['admin_img']);
            $class_admin->updateJiaAdmin($result['admin_id'],'admin_name',$_GPC['admin_name']);
            $class_admin->updateJiaAdmin($result['admin_id'],'phone',$_GPC['phone']);
            if($_GPC['password']){
                    $class_admin->updateJiaAdmin($result['admin_id'],'password',$_GPC['password']);
            }
            $this->myMessage("更新成功",$this->createWebUrl('myCenter'),'跳转');
        }
    }else{
        $this->myMessage("超级管理员不在此修改信息",$this->createWebUrl('adminindex'),'跳转');
    }
	include $this->template('../admin/MyCenter');
	exit();
    