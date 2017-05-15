<?php 
    $student_info  = $this->teacher_mobile_qx();
    $student_name  = $student_info['teacher_realname'];
    $page_title    = '我的积分';
    //今年
    if($ac=='list'){
        $begin_time = strtotime(date("Y-01-01",time()));
        $end_time   = time();
    }elseif($ac=='day'){
        $begin_time = strtotime(date("Y-m-d",time()));
        $end_time   = time();
    }elseif($ac=='month'){
        $begin_time = strtotime(date("Y-m-01",time()));
        $end_time   = time();
    }
    $class_teacherScore = C("teacherScore");
    $class_teacherScore->setScoreBase($this->school_info['school_id']);
    
    $teacher_list   = D("teacher")->getTeacherList($this->school_info['school_id']);
    foreach ($teacher_list as $key => $value) {
        $out_list[$key] = $class_teacherScore->getScore($value['teacher_id'],$begin_time,$end_time);
        $out_list[$key]['teacher_info'] = $value;        
    }
    $out_list = sortArr($out_list,"all_num");
    foreach ($out_list as $key => $value) {
        if($value['teacher_info']['teacher_id']==$student_info['teacher_id']){
            $result = $value;
            $sort   = $key+1;
            break;
        }
    }

