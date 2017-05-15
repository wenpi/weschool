<?php 

    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name        = $school_admin['info']['admin_name'];
    $title               = '教师积分详情';
    //今年
    if($ac=='list'){
        $begin_time = strtotime(date("Y-m-01",time()));
        $end_time   = time();
        $page_title = "本月教师积分列表";
    }elseif($ac=='day'){
        $begin_time = strtotime(date("Y-m-d",time()));
        $end_time   = time();
        $page_title = "今日教师积分列表";
    }elseif($ac=='year'){
        $begin_time = strtotime(date("Y-01-01",time()));
        $end_time   = time();
        $page_title = "今年教师积分列表";
    }    
    $class_teacherScore = C("teacherScore");
    $class_teacherScore->setScoreBase($this->school_info['school_id']);
    $teacher_list       = D("teacher")->getTeacherList($this->school_info['school_id']);
    foreach ($teacher_list as $key => $value) {
        $out_list[$key] = $class_teacherScore->getScore($value['teacher_id'],$begin_time,$end_time);
        $out_list[$key]['teacher_info'] = $value;        
    }
    //排名
    $out_list = sortArr($out_list,"all_num");
    