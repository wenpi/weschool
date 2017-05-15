<?php 
//控制器
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
$simple_title       = "学生绑定率";
$title              = $_SESSION['school_name'].'-'.$simple_title;
if(!$have_school_admin)
    header("Location:".$this->createMobileUrl("school_bangding"));
//主体
$grade_id           = $_GPC['grade_id'];
$class_id           = $_GPC['class_id'];
$class_student      = D("student");
if($grade_id)
    $class_student->_set('grade_id',$grade_id);
if($class_id)
    $class_student->_set('class_id',$class_id);
$result             = $class_student->getGradeClassStudent();
if($result['count'])
    $lv         = $result['bangding_count']/$result['count'] ;
else 
    $lv         = 0;
$lv = intval($lv*100)/100;
$not_lv         = 1-$lv;
$student_list   = $result['list'];
$info           = $result;
include $this->template("school/student");
exit();