<?php 
namespace myclass\src;

class qdActivity extends common{
    public $activity_id;
    public $teacher_id;
    public $db_admin_id;
    public $activity_name;
    public $activity_address;
    public $class_ids;
    public $student_ids;
    public $department_ids;
    public $teacher_ids;
    public $student_teacher;
    public $status;
    public $endtime;

    public function __construct(){
        $this->setGlobal();
        $this->setTable("lianhu_qd_activity");
    }
    

}