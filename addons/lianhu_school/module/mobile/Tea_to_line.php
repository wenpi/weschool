<?php
    $class_ctl_classes = C('classes'); 
    $teacher_info      = $this->teacher_mobile_qx();
    $list              = D('teacher')->getTeacherClass($teacher_info['teacher_id'],true);
    if($list){
        foreach ($list as $key => $value) {
            if($value['class_id']){
                $list[$key]['grade_name'] = $class_ctl_classes->classGradeName($value['class_id']);
            }
        }
    }