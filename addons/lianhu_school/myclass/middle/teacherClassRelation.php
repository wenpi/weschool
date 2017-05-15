<?php 
namespace myclass\middle;

class teacherClassRelation extends common{
    public $relation_id;
    public $teacher_id;
    public $class_id;
    public $major;
    public $status;

    public function __construct(){
        $this->__db('jxt_teacher_class_relation');
    }
}