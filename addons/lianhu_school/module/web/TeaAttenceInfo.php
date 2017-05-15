<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_msg';
    $left_nav     = 'TeaAttence';
    $title        = '教师考勤';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'班级管校务管理理'),
            array('fun_str'=>'TeaAttence','fun_name'=>'教师考勤'),
    );
    $top_action = array(
            array('action_name'=>'当日数据','action'=>'TeaAttence' ),
            array('action_name'=>'历史数据','action'=>'TeaOldAttence' ),
    );
    $page_name    = '当日数据';
    $id           = $_GPC['id'];
    $result       = D("teacher")->getTeacherInfo($id);
    if(!$result){
        $this->myMessage("未找到该教师",$this->createWebUrl("teaAttence"),"错误");
    }
    if($_GPC['begin_time']){
        $begin_time = strtotime($_GPC['begin_time']);
    }else{
        $begin_time = time()-31*24*3600;
    }
    if($_GPC['end_time']){
        $end_time = strtotime($_GPC['end_time']);
    }else{
        $end_time = time(); 
    }
    $list = D('card')->TeacherCardList($id,$begin_time,$end_time);
    $we7_js = 'no';
    include $this->template('../admin/TeaAttenceInfo');
    exit();
    