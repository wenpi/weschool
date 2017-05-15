<?php
namespace myclass\ctl;

class courseStudent extends common{
    public $course_id;

    public function __construct(){
        $this->use_class = D('courseStudent');
    }
    
    public function getCourseList(){
        $params[":course_id"] = $this->course_id;
        $params[":status"]    = 1;
        $this->use_class->each_page = 10000;
        $re                         = $this->use_class->getList($params);
        return $re['list'];
    }
    //add
    public function add($arr){
        $in['student_id'] = $arr['student_id'];
        $in['course_id']  = $arr['course_id'];
        $in['add_num']    = $arr['use_num'];
        $in['admin_uid']  = getDbAdminId();
        D('courseAdd')->add($in);
        $where['student_id'] = $arr['student_id'];
        $where['course_id']  = $arr['course_id'];
        $re = $this->use_class->edit($where);
        if($re){
            $up["use_num"] = $arr['use_num']+$re['use_num'];
            $this->use_class->edit($where,$up);
        }else{
            $this->use_class->add($arr);
        }
    }
    public function change($arr){
        $where['student_id'] = $arr['student_id'];
        $where['course_id']  = $arr['course_id'];
        $re = $this->use_class->edit($where);
        if($re){
            $arr['use_num'] = $arr['use_num']-$re['use_num'];
            $this->add($arr);
        }    
    }
    //get num 
    public function getNum($student_id){
        $where["course_id"] = $this->course_id;
        $where["student_id"]= $student_id;
        $where['status']    = 1;
        $re = $this->use_class->edit($where);
        return $re['use_num'];
    }


}