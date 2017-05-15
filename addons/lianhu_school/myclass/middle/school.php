<?php
namespace myclass\middle;

class school extends common{
    public $school_id   = 'school_id';
    public $school_name = 'school_name';
    public $status      = 'status';

    public function __construct(){
        $this->__db('jxt_school');
    }
    


}