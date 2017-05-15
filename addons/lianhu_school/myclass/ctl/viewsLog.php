<?php 
namespace myclass\ctl;

class viewsLog{
    public $class_viewsLog;
    public $class_student;
    public $class_classes;
    public $class_grade;

    public $content_id;
    public $content_type = array(
        'video_look'
    );

    public function __construct(){
        $this->class_viewsLog = D('viewsLog');
    }
    public function beginClass(){
        $this->class_student = D('student');
        $this->class_classes = D('classes');
        $this->class_grade   = D('grade');
    }
    //新增
    public function add($student_id,$content_type){
        $student_info       = D('student')->getStudentInfo($student_id);
        $in['content_id']   = $this->content_id;
        $in['content_type'] = $content_type;
        $in['student_id']   = $student_id;
        $in['grade_id']     = $student_info['grade_id'];
        $in['class_id']     = $student_info['class_id'];
        $in['uid']          = getMemberUid();
        return $this->class_viewsLog->dataAdd($in);
    }
    //解析查看记录成详细
    public function decodeOutInfo($record){
        $student_info = $this->class_student->getStudentInfo($record['student_id']);
        $class_name   = $this->class_classes->className($record['class_id']);
        $grade_info   = $this->class_grade->getGradeInfo($record['grade_id']);
        $record['student_name'] = $student_info['student_name'];
        $record['class_name']   = $class_name;
        $record['grade_name']   = $grade_info['grade_name'];
        return $record;
    }


}