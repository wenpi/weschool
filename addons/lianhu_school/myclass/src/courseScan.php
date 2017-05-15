<?php 
namespace myclass\src;

class courseScan extends common{
    public $course_name    = 'course_name';
    public $course_contet  = 'course_contet';
    public $buy_url        = 'buy_url';
    public $status         = 'status';
    public $nums           = 'nums';
    public $class_id       = 'class_id';
    public $img            = 'img';
    public $buy_end            = 'buy_end';
    public $max_student_num    = 'max_student_num';
    public $price              = 'price';

    public function __construct(){
        $this->setTable('lianhu_course_scan');
        $this->setGlobal();
    }
    
}