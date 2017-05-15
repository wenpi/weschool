<?php
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'system_data';
    $left_nav     = 'teacher_his_data';
    $title        = '教师数据';  
    $we7_js       = 'no';
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统数据'),
        array('fun_str'=>'teacher_his_data','fun_name'=>'教师数据'),
    );
    if($admin_result['admin']=='top'){
        $school_list    =  S('school','getSchoolByUniacid',array($_W['uniacid']) );
            //过滤掉没有权限的学校
            $data_group = D('power')->getDataInfo($_GPC['_data_group_id']);
            if($data_group['school']){
                foreach ($school_list as $key => $value) {
                    if(!in_array($value['school_id'],$data_group['school'])){
                        unset($school_list[$key]);
                    }    
                }
            }  
    }else{
        $class_school   = D("school");
        $school_list[]  =  $class_school->getSchoolInfo();
    }
    if(!$_GPC['school_id']){
        $school_id = getSchoolId();
    }else{
        $school_id = $_GPC['school_id'];
    }
    
    $out_list       = array();
    $begin_time     = $_GPC['begin_time'] ? strtotime($_GPC['begin_time']) :strtotime("-1 day");
    $end_time       = $_GPC['end_time']   ? strtotime($_GPC['end_time'])   :strtotime("+1 day");
    $class_teacher  = D("teacher");
    $teacher_list   = $class_teacher->getTeacherList($school_id);
    //
    $class_teacherScore = C("teacherScore");
    $class_teacherScore->setScoreBase($school_id);
    //
    foreach ($teacher_list as $key => $value) {
        $out_list[$key] = $class_teacherScore->getScore($value['teacher_id'],$begin_time,$end_time);
        $out_list[$key]['teacher_info'] = $value;
    }
	include $this->template('../admin/web_teacher_his_data');
	exit();
