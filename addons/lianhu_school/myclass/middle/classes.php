<?php 
namespace myclass\middle;

class classes{
    public $class_id;
    public $school_id;
    public $class_name;
    public $status;

    public function __construct(){
        $this->__db('jxt_class');
    }

}