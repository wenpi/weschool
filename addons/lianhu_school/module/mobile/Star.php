<?php
    $student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
    $class_star   = D('star');
    $params[":student_id"] = $student_info['student_id'];
    $result       = $class_star->dataList($params);
    $list         = $result['list'];