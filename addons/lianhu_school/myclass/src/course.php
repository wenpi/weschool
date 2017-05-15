<?php 
namespace myclass\src;

class course extends common{
    public $course_id;
    public $course_name;
    public $status;
    public $course_basic;

    public function __construct(){
        $this->setTable('lianhu_course');
        $this->setGlobal();
    }
    public function add($arr){
        $add_id         = parent::add($arr);
        $middle_course  = M('course');
        if($middle_course){
            $arr['school_id'] = $this->school_id;
            $middle_course->action($add_id,$arr);
        } 
        return $add_id;       
    }
    public function edit($where,$up=false){
        $re = parent::edit($where,$up);
        $middle_course = M('course');
        if($middle_course && $up['course_name'] && $re){
            $middle_course->action($re['course_id'],$up);
        } 
        return $re;        
    }
    //获取所有的课程
    public function getCourseList($all=false){
        $this->each_page = 10000;
        $where[":school_id"] = $this->school_id;
        $re              = $this->getList($all);
        $list            = $re['list'];
        return $list;
    }
    //获取所有的基础课程
    public function getAllBasicList(){
        $this->each_page         = 10000;
        $params[":course_basic"] = 1;
        $re   = $this->getList($params);
        $list = $re['list'];
        return $list;        
    }

    public function courseName($course_id){
       $course_name = pdo_fetchcolumn("select course_name from ".$this->table." where course_id=:course_id ",array(':course_id'=>$course_id ));
       return $course_name;
    }
    
    public function courseNameToCourseId($course_name){
       $school_id = getSchoolId();
       $course_id = pdo_fetchcolumn("select course_id from ".$this->table." where course_name=:course_name and school_id=:school_id ",array(':course_name'=>$course_name,':school_id'=>$school_id ));
       return $course_id;       
    }

    


}