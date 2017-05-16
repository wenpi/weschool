<?php 
namespace myclass\src;
/*
    教师发送消息通知
    校长发送消息通知
    后台发送消息通知
*/
class sendAlone extends common{
    public $alone_id   = 'alone_id';
    public $student_id = 'student_id';
    public $teacher_id = 'teacher_id';
    public $record_id  = 'record_id';

    public function __construct(){
        $this->setTable('lianhu_send_alone');
        $this->setGlobal();
    }
    
    public function studentAdd($student_id,$record_id){
        $in['student_id'] = $student_id;
        $in['record_id']  = $record_id;
        $id = $this->add($in);
        return $id;
    }
    public function teacherAdd($teacher_id,$record_id){
        $in["teacher_id"] = $teacher_id;
        $in['record_id']  = $record_id;
        $id = $this->add($in);
        return $id;
    }

}