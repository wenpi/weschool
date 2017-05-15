<?php 
/*
* 沟通表
*/
namespace myclass\src;

class chatMessage extends uniacidCommon{
   private $field_sql = "(
                            id              int(11) unsigned auto_increment,
                            uniacid         int(11) unsigned default 0,
                            school_id       int(11) unsigned default 0,
                            mobile_uid      int(11) unsigned default 0 comment '手机端uid',
                            db_admin_id     int(11) unsigned default 0 comment '家校通管理用户id',
                            school_admin_id int(11) unsigned default 0 comment '学校管理员id',
                            teacher_id      int(11) unsigned default 0 comment '教师id',
                            grade_id        int(11) unsigned default 0 comment '年级id',
                            class_id        int(11) unsigned default 0 comment '班级id',
                            student_id      int(11) unsigned default 0 comment '学生id',
                            
                            to_db_admin_id      int(11) unsigned default 0 ,
                            to_school_admin_id  int(11) unsigned default 0 ,
                            to_teacher_id       int(11) unsigned default 0 ,
                            to_student_id       int(11) unsigned default 0 ,
                            content         text  ,
                            status          tinyint(1) unsigned default 1,
                            add_time        int(11) unsigned default 0,
                            primary key(id) 
                        )engine=innodb charset=utf8;";    

    public $id                  = 'id';
    public $mobile_uid          = 'mobile_uid';
    public $db_admin_id         = 'db_admin_id';
    public $school_admin_id     = 'school_admin_id';
    public $teacher_id          = 'teacher_id';
    public $grade_id            = 'grade_id';
    public $class_id            = 'class_id';
    public $student_id          = 'student_id';
    public $to_db_admin_id      = 'to_db_admin_id';
    public $to_school_admin_id  = 'to_school_admin_id';
    public $to_teacher_id       = 'to_teacher_id';
    public $to_student_id       = 'to_student_id';
    public $content             = 'content';
    public $status              = 'status';

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_chat_message');
        if(!pdo_tableexists($this->table_name)){
            $sql = "create table ".$this->table."   ".$this->field_sql;
            pdo_run($sql);
        }
    }   
    




}