<?php 
namespace myclass\middle;

class grade extends common{
    public $grade_id;
    public $school_id;
    public $grade_name;
    public $status;

    public function __construct(){
        $this->__db('jxt_grade');
    }


}