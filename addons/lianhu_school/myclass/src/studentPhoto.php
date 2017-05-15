<?php 
namespace myclass\src;

class studentPhoto extends common {
    public $photo_id;
    public $student_id;
    public $photo_list;
    public $title;
    public $content;
    public $status;
    public $db_admin_id;
    public $now_date;

    public function __construct(){
         $this->setTable('lianhu_school_student_photo');
         $this->setGlobal();       
    }
    public function add($arr){
        $arr['now_date'] = date("Y-m-d",time());
        return parent::add($arr);
    }
    public function lineAdd($arr){
        $params["student_id"] = $arr['student_id'];
        $params["now_date"]   = date("Y-m-d",time()); 
        $re = $this->edit($params);
        if($re){
            $up["photo_list"] = $re['photo_list'].','.$arr['photo_list'];
            $this->edit($params,$up);
        }else{
           return  $this->add($arr);
        }
    }

    
}