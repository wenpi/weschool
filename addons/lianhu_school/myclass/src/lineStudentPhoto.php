<?php 
namespace myclass\src;

class lineStudentPhoto extends common{
    public $id;
    public $student_id;
    public $pic_url;   

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_line_student_photo');       
    }
    public function getEdit($student_id,$pic_url){
        $this->field_str = 'add_time';
        $re = $this->edit(array("student_id"=>$student_id,'pic_url'=>$pic_url));
        return $re;
    }



}