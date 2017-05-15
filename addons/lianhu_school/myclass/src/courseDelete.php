<?php 
namespace myclass\src;

class courseDelete extends common{

    public $student_id = 'student_id';
    public $course_id  = 'course_id';
    public $qrcode_id  = 'qrcode_id';

    public function __construct(){
        $this->setTable('lianhu_course_delete');
        $this->setGlobal();
    }
    

}