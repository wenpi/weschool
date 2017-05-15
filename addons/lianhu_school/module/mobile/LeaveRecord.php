<?php 
$result       = $this->mobile_from_find_student();
$student_name = $result['student_name'];
$page_title   = '请假记录';
$class_leave  = D("leave");
$cclass_leave = C("leave");
$list         = $class_leave->getStudentLeaveList($result['student_id']);
