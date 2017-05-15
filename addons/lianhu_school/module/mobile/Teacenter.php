<?php
    $adc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($adc,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info = $this->teacher_mobile_qx();
    addgroup($_SESSION['school_name'],$this->AccessToken());

    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '教师中心';
    $class_teacher= D('teacher');
    $result       = $class_teacher->edit(array("teacher_id"=>$teacher_info['teacher_id']));
    $params[":uid"] = $uid;
    $sql            = " uid =:uid ";
    $teacher_list   = $class_teacher->getSqlList($params,$sql);
    $teacher_list   = $teacher_list['list'];
    $class_list     = D('teacher')->getTeacherClass($teacher_info['teacher_id']);
    foreach ($class_list['list'] as $key => $value) {
        $class_s .= $value['class_name'].',';
    }
    $msg_list          = $this->web_msg();
    $class_s = trim($class_s,','); 