<?php 
    $student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
    $page_title   = '课程详情';
    if($_GPC['id']){
        $result = pdo_fetch("select * from {$table_pe}lianhu_appointment_course where course_id=:aid",array(':aid'=>$_GPC['id']));
    }
