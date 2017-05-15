<?php 
namespace myclass\src;

class courseAdd extends common{
    public $student_id = 'student_id';
    public $course_id  = 'course_id';
    public $add_num    = 'add_num';
    public $admin_uid  = 'admin_uid';
    public $status     = 'status';

    public function __construct(){
        $this->setTable('lianhu_course_add');
        $this->setGlobal();
    }
    

}