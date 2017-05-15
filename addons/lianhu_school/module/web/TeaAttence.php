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

    $teacher_count              = D("teacher")->getTeacherCount($this->school_info['school_id']);
    $pay_card_people_moring     = D('card')->countStudentPlayCard('morning',true);
    $pay_card_people_afternoon  = D('card')->countStudentPlayCard('afternoon',true);
    $teacher_count             = $teacher_count ? $teacher_count :0;
    $pay_card_people_moring    = $pay_card_people_moring ? $pay_card_people_moring :0;
    $pay_card_people_afternoon = $pay_card_people_afternoon ? $pay_card_people_afternoon :0;
    if($_GPC['module']=='tea_list'){
        $result = D("teacher")->getTeacherList($this->school_info['school_id']);
        list($time['year'],$time['month'],$time['day'])=explode('-',date('Y-m-d',time() ) );
        $we7_js = 'no';
    }
    include $this->template('../admin/TeaAttence');
    exit();