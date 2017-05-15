<?php 
    $result           = $this->mobile_from_find_student();
    $student_name      = $result['student_name'];
    $page_title        = '退费';
    $class_moneyRecord = C('moneyRecord');
    $class_moneyRecord->student_id = $result['student_id'];
    $list              = $class_moneyRecord->getRebackStudentRecord();
    $class_moneyLimit  = C('moneyLimit');
    foreach ($list as $key => $value) {
        $class_moneyLimit->limit_id = $value['limit_id'];
        $list[$key]['limit_name']   = $class_moneyLimit->limitName(); 
    }
    $list              = arrByYear($list,'addtime');