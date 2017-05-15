<?php 
    $this->checkAdminWeb();
    $class_admin  = D('admin');
    $admin_result = $class_admin->judeAdminType();
    if($admin_result['admin'] == 'top'){
        $school_list =  S('school','getSchoolByUniacid',array($_W['uniacid']) );
        if($_GPC['_data_group_id']){
            //过滤掉没有权限的学校
            $data_group = D('power')->getDataInfo($_GPC['_data_group_id']);
            if($data_group['school']){
                foreach ($school_list as $key => $value) {
                    if(!in_array($value['school_id'],$data_group['school'])){
                        unset($school_list[$key]);
                    }    
                }
            }
        }
    }
    $left_top     = 'system_index';
    $left_nav     = 'system_index_nav';
    $title        = '后台首页';  
    $sidebar_list = array(
        array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
    );
    $school_id      = getSchoolId();

    $grade_count    = S("grade","gradeCount",array($school_id));
    $class_count    = D('classes')->getClassCount();
    $teacher_count  = D('teacher')->getTeacherCount($school_id);
    $student_count  = D('student')->getStudentCount();
    $times          = S("time","getLastWeeks",array() );
    $class_send     = D("send");
    $class_homework = D("homework");
    $class_homework->teacher_id  = 0;

    foreach ($times as $key => $value) {
            $begin_time = strtotime($value['begin']);
            $end_time   = strtotime($value['end']);
            $send_date[$key]['time']      = $value;
            $send_date[$key]['count']     = $class_send->getSendCount($begin_time,$end_time);
            $homework_date[$key]['time']  = $value;
            $homework_date[$key]['count'] = $class_homework->getHomeworkCount($begin_time,$end_time);          
     }
    $last_sends    = $class_send->getLastSends();
    //在校人数
    $class_card    = D('card');
    $day_times     = S("time","getLastDays",array());

    foreach ($day_times as $key => $value) {
        $in_time        = strtotime($value);
        $class_card     -> _set('in_time',$in_time);
        $out_list[$key]['count'] = $class_card->countStudentPlayCard("morning");
        $out_list[$key]['time']  = $value;
    }