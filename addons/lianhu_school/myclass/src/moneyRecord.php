<?php 
namespace myclass\src;

class moneyRecord extends common{
    
    public $record_id   = 'record_id';
    public $limit_id    = 'limit_id';
    public $student_id  = 'student_id';
    public $fan_id      = 'fan_id';
    public $uid         = 'uid';
    public $status      = 'status';
    public $limit_much  = 'limit_much';
    public $grade_id    = 'grade_id';
    public $class_id    = 'class_id';
    public $mobile          = 'mobile';
    public $money_info_id   = 'money_info_id';
    
    public function __construct(){
        $this->setTable('lianhu_money_record');
        $this->setGlobal();
    }


}