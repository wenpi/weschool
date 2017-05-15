<?php 
namespace myclass\src;

class inlineStatus extends common{
    public $id = 'id';
    public $mobile_uid = 'mobile_uid';
    public $teacher_id = 'teacher_id';
    public $student_id = 'student_id';
    public $db_admin_id = 'db_admin_id';
    public $last_time   = 'last_time';

    public function __construct(){
        $this->setTable('lianhu_inline_status');
        $this->setGlobal();       
    }
    //补偿教师用户
    public function addTeacher(){
        $in['teacher_id'] = $this->teacher_id;
        $this->dataAdd($in);
    }
    //补偿学生用户
    public function addStudent(){
        $in['student_id'] = $this->student_id;
        $this->dataAdd($in);
    }   
    //补偿系统用户
    public function addSys(){
        $in['db_admin_id'] = $this->db_admin_id;
        $this->dataAdd($in);
    }       
    public function dataAdd($in){
        $in['mobile_uid']  = $this->mobile_uid;
        $in['last_time']   = time();
        $this->add($in);
    }

    
}