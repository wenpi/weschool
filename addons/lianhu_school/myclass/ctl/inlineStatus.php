<?php 
namespace myclass\ctl;

class inlineStatus extends common{
    public $teacher_id;
    public $student_id;
    public $db_admin_id;
    public $lose_time = 60;

    public function __construct(){
        $this->use_class = D('inlineStatus');
        $this->use_class->mobile_uid = getMemberUid();
    }
    public function judeInline($where){
        $re  = $this->use_class->edit($where);
        $out = false;
        if($re){
            if( (time()-$re['last_time']) < $this->lose_time ){
                $out = true;
            }
        }
        return $out;
    }
    //增加教师在线
    public function upTeacherInline(){
        $where["teacher_id"] = $this->teacher_id;
        $this->up($where,'teacher');
    }
    //增加学生在线
    public function upStudentInline(){
        $where["student_id"] = $this->student_id;
        $this->up($where,'student');
    }
    //增加管理人员在线
    public function upSysInline(){
        $where["db_admin_id"] = $this->db_admin_id;
        $this->up($where,'db_admin');
    }
    public function up($where,$type){
        $re = $this->use_class->edit($where);
        if(!$re){
            if($type=='teacher'){
                $this->use_class->teacher_id = $where['teacher_id'];
                $this->use_class->addTeacher();
            }
             if($type=='student'){
                $this->use_class->student_id = $where['student_id'];
                $this->use_class->addStudent();
            }          
            if($type=='db_admin'){
                $this->use_class->db_admin_id = $where['db_admin_id'];
                $this->use_class->addSys();               
            } 
        }else{
            $up['last_time'] = time();
            $this->use_class->edit(array('id'=>$re['id']),$up);
        }
    }

}