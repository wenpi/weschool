<?php 
namespace myclass\src;

class courseQrcode extends common{
    public $course_id = 'course_id';
    public $qrcode_num = 'qrcode_num';
    public $scan_student_num = 'scan_student_num';
    public $qrcode_value = 'qrcode_value';

    public function __construct(){
        $this->setTable('lianhu_course_qrcode');
        $this->setGlobal();
    }

    public function createNextCode($course_id){
        do{
            $qrcode_value = random(20);
            $re = $this->edit(array("qrcode_value"=>$qrcode_value));
        }while($re);
        return $qrcode_value;  
    }


}