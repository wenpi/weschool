<?php 
namespace myclass\src;

class qdPerson extends common{
    public $activity_id;
    public $student_id;
    public $teacher_id;
    public $mobile_uid;
    public $class_id;
    
    public function __construct(){
        $this->setGlobal();
        $this->setTable("lianhu_qd_person");        
    }
    

}