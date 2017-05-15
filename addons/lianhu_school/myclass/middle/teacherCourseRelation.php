<?php 
namespace myclass\middle;

class teacherCourseRelation extends common{
    public $relation_id;
    public $teacher_id;
    public $course_id;
    public $status;

    public function __construct(){
        $this->__db('jxt_teacher_course_relation');
    }
}