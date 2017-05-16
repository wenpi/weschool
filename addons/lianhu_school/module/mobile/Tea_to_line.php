<?php
    $class_ctl_classes = C('classes'); 
    $teacher_info      = $this->teacher_mobile_qx();
    $student_name      = $teacher_info['student_name'];
    $page_title        = '班级圈';
    $list              = D('teacher')->getTeacherClass($teacher_info['teacher_id'],true);
    if($list){
        foreach ($list as $key => $value) {
            if($value['class_id']){
                $list[$key]['grade_name'] = $class_ctl_classes->classGradeName($value['class_id']);
            }
        }
    }