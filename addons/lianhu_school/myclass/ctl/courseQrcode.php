<?php
namespace myclass\ctl;

class courseQrcode extends common{
    public $course_id;
    public function __construct(){
        $this->use_class = D('courseQrcode');
    }
    
    public function createAllQr(){
        $course_id   = $this->course_id;
        $course_info = C('courseScan')->edit($course_id);
        for($i=1;$i<=$course_info['nums'];$i++){
            $re = $this->findQr($i);
            if(!$re){
                $qrcode_value = $this->use_class->createNextCode($course_id);
                $in['course_id']    = $course_id;
                $in['qrcode_value'] = $qrcode_value;
                $in['qrcode_num']   = $i;
                $this->use_class->add($in);
                $re = $this->findQr($i);
            }
            $out[] = $re;
        }
        return $out;
    }

    public function findQr($num){
        $params["qrcode_num"] = $num;
        $params["course_id"]  = $this->course_id;
        $re = $this->use_class->edit($params);
        return $re;
    }

    public function getInfo($qrcode_value){
        $params["qrcode_value"] = $qrcode_value;
        $re = $this->use_class->edit($params);
        return $re;
    }
    public function addScan($qrcode_value){
         $params["qrcode_value"] = $qrcode_value;
        $re = $this->getInfo($qrcode_value);
        $up['scan_student_num'] = ++$re['scan_student_num'];
        $this->use_class->edit($params,$up);
    }



}