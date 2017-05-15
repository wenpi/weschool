<?php
namespace myclass\src;

class courseStudent extends common{
    public $student_id;
    public $course_id;
    public $use_num;
    public $status;

    public function __construct(){
        $this->setTable('lianhu_course_student');
        $this->setGlobal();
    }
    

}