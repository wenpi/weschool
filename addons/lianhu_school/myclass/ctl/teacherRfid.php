<?php
namespace myclass\ctl;

class teacherRfid {
    public $tea_class = array(
        'class_id'=>'tea_class',
        'class_name'=>'教师考勤',
    );

    //构造教师成为一种类似学生的列表
    public function getTeacherList(){
        D('teacher')->each_page = 100000;
        $re  = D('teacher')->getList(false); 
        $teacher_list = $re['list'];
        return $teacher_list;
    }
    
}