<?php 
namespace myclass\ctl;

class moneyRecord extends common{
    public $student_id;

    public function __construct(){
        $this->use_class = D('moneyRecord');
    }
    //改学生的缴费列表
    public function getStudentRecord(){
        $this->use_class->each_page = 100000;
        $params[":student_id"] = $this->student_id;
        $params[":status"]     = 1;
        $re   = $this->use_class->getList($params);
        $list = $re['list'];
        return $list;
    }
    public function getRebackStudentRecord(){
        $this->use_class->each_page = 100000;
        $params[":student_id"] = $this->student_id;
        $params[":status"]     = 10;
        $re   = $this->use_class->getList($params);
        $list = $re['list'];
        return $list;       
    }


}