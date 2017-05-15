<?php 
$result         = $this->mobile_from_find_student();
$page_title     = '通讯录';
$class_id       = getClassId();
$class_name     = D('classes')->className($class_id);
$student_name   = $result['student_name'];
$teacher_list   = $this->classTeacher($class_id);
//家长列表
D('student')->class_id = $class_id;
$student_list          = D('student')->getClassStudentList();
if($_GPC['search_name']){
    foreach ($teacher_list as $key => $value) {
        if(stripos($value['teacher_realname'],$_GPC['search_name'])===FALSE){
            unset($teacher_list[$key]);
        }
    }

}
foreach ($student_list as $key => $value) {
    if($_GPC['search_name']){
        if(stripos($value['student_name'],$_GPC['search_name'])===FALSE){
            unset($student_list[$key]);
        }
    }
    if($value['student_id']==$result['student_id']){
        unset($student_list[$key]);
    }
}

