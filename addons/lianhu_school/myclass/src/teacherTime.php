<?php 
namespace myclass\src;

class teacherTime extends common{
    public $time_id        = 'time_id';
    public $teacher_id     = 'teacher_id';
    public $begin_time     = 'begin_time';
    public $end_time       = 'end_time';
    public $no_date        = 'no_date';

    public function __construct(){
        $this->setTable('lianhu_teacher_times');
        $this->setGlobal();
    }
    
}