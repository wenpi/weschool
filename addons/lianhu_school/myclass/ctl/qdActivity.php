<?php 
namespace myclass\ctl;

class qdActivity extends common{
    
    public function __construct(){
        $this->use_class = D("qdActivity");
    }
    //获取教师创建的列表
    public function teacherList($teacher_id,$pages=1){
        $params[":teacher_id"] = $teacher_id;
        $re = $this->use_class->getList($params,false,$pages);
        return $re['list'];
    }



}