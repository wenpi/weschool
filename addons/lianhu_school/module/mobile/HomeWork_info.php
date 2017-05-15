<?php 
    $result         = $this->mobile_from_find_student();
    $student_name   = $result['student_name'];
    $page_title     = "作业详情";
    $id             = $_GPC['id'];
    $class_homework = D('homework');
    $where          = array('homework_id'=>$id);
    $re             = $class_homework->edit($where);
    if($re['teacher_id']){
        $re['teacher_realname'] = D('teacher')->teacherName($re['teacher_id']);
    }
    

