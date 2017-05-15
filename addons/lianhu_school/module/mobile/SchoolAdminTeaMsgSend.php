<?php 
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    if($ac=='teacher'){
         $teacher_info = $this->teacher_mobile_qx(); 
    }else{
        $school_admin  = D('admin')->mobileValidSchoolAdmin();
        if(!$school_admin){
            header("Location:".$this->createMobileUrl("school_bangding"));
        }
    }
    $title         = '教师消息发送';
    $teacher_list  = D("teacher")->getTeacherList($this->school_info['school_id']);

