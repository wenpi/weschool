<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title              = $page_title         = '记录列表';
    $student_id = $_GPC['id'];
    if($student_id){
        $student_info = D('student')->edit(array("student_id"=>$student_id));
        $class_work   = D('work');
        $class_work->each_page = 10000;
        $params[":student_id"] = $student_id;
        $re = $class_work->get(1,$params);
    }
