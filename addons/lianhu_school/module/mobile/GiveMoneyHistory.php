<?php 
    $result         = $this->mobile_from_find_student();
    $student_name   = $result['student_name'];
    $page_title     = '缴费历史';
    $class_moneyRecord = C('moneyRecord');
    $class_moneyRecord->student_id = $result['student_id'];
    $list              = $class_moneyRecord->getStudentRecord();
    $class_moneyLimit  = C('moneyLimit');

    foreach ($list as $key => $value) {
        if($value['limit_id']){
            $class_moneyLimit->limit_id = $value['limit_id'];
            $list[$key]['limit_name']   = $class_moneyLimit->limitName(); 
        }else{
            $info = C("moneyInfo")->deMoney($value['record_id']);
            $list[$key]['limit_name']   = $info['course_name'];
        }

    }
    $list              = arrByYear($list,'addtime');

