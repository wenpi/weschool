<?php 
namespace myclass\middle;

class student extends common{
    public $student_id;
    public $school_id;
    public $grade_id;
    public $class_id;
    public $student_name;
    public $student_img;
    public $status;

    public function __construct(){
        $this->__db('jxt_student');
    }
    

}