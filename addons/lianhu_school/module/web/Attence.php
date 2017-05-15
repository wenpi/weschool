<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'class_manage';
    $left_nav     = 'attence';
    $title        = '考勤管理';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'班级管理'),
            array('fun_str'=>'attence','fun_name'=>'考勤管理'),
    );
    $top_action = array(
            array('action_name'=>'当日数据','action'=>'attence' ),
            array('action_name'=>'历史数据','action'=>'oldAttence' ),
    );
    $page_name    = '当日数据';

    $model   = $_GPC['model'] ? $_GPC['model'] :"grade";
    $result  = $this->student_standard();
	$teacher = $this->teacher_qx('no');
    $class_student              = D("student");
    $class_card                 = D("card");

//年级树-全校
    if($model=='grade'){
        $student_count              = D('student')->getStudentCount();     
    }
//班级树
    if($model=='class'){
        $grade_id                   = $_GPC['gid'];
        $class_student->_set('grade_id',$grade_id);  
        $student_count              = $class_student->getGradeClassStudent();
        $student_count              = $student_count['count'];
        $class_card->_set('where'," grade_id=".$grade_id );
    }
    if($model=='student'){
        $class_id                   = $_GPC['cid'];
        $class_student->_set('class_id',$class_id);  
        $student_count              = $class_student->getGradeClassStudent();
        $student_count              = $student_count['count'];
        $class_card->_set('where'," class_id=".$class_id );
        list($time['year'],$time['month'],$time['day'])=explode('-',date('Y-m-d',time())); 
        foreach ($result as $key => $value) {
             $up  = $class_card->judeStudentRecord($time,$value['student_id'],'in');
             $low = $class_card->judeStudentRecord($time,$value['student_id'],'out');
             $result[$key]['up'] = $up;
             $result[$key]['low'] = $low;
        }
    }
    $pay_card_people_moring     = $class_card->countStudentPlayCard('morning');
    $pay_card_people_afternoon  = $class_card->countStudentPlayCard('afternoon');

    if($model=='someone'){
        $sid = $_GPC['sid'];
        if($_GPC['begin_time'])
            $begin_time = strtotime($_GPC['begin_time']);
        else 
            $begin_time = time()-31*24*3600;
        if($_GPC['end_time']) 
            $end_time = strtotime($_GPC['end_time']);
        else 
            $end_time = time(); 
        $list = $class_card->studentCardList($sid,$begin_time,$end_time);
    }
    $student_count             = $student_count ? $student_count :0;
    $pay_card_people_moring    = $pay_card_people_moring ? $pay_card_people_moring :0;
    $pay_card_people_afternoon = $pay_card_people_afternoon ? $pay_card_people_afternoon :0;
    $now_date = date("m月d日",time());

    include $this->template('../admin/web_attence');
    exit();