<?php 
namespace myclass\src;

class courseTeacher extends common{
    public $course_id  = 'course_id';
    public $teacher_id = 'teacher_id';

    public function __construct(){
        $this->setTable('lianhu_course_teacher');
        $this->setGlobal();
    }
    

}