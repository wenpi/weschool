<?php 
    $result       = $this->mobile_from_find_student();
    $student_name = $result['student_name'];
    $page_title   = '课程详情';
    $result       = C('courseScan')->edit($_GPC['course_id']);
