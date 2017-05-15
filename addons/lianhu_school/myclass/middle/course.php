<?php 
namespace myclass\middle;

class course extends common{
    public $course_id;
    public $school_id;
    public $course_name;
    public $status;

    public function __construct(){
        $this->__db('jxt_course');
    }

}