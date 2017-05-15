<?php 
namespace myclass\middle;

class teacher extends common{
    public $teacher_id;
    public $school_id;
    public $teacher_name;
    public $teacher_img;
    public $status;

    public function __construct(){
        $this->__db('jxt_course');
    }
    
}