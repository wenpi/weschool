<?php 
namespace myclass\ctl;

class teacher extends common{
    
    public function __construct(){
        $this->use_class = D('teacher');
    }
    //获取一个班级登记在册的有效的教师列表
    public function getClassTeacherList($class_id){
        $c_id = $class_id; 
        $sql  = " status = :status and  (teacher_other_power like '".$c_id.",%' || teacher_other_power = '".$c_id."' || teacher_other_power like '%,".$c_id.",%' || teacher_other_power like '%,".$c_id."'  ) ";
        $this->use_class->each_page   = 10000;
        $params[":status"] = 1;
        $re                = $this->use_class->getSqlList($params,$sql);
        return $re['list'];
    }
    //获取该学校的所有教师
    public function getAllList(){
        $this->use_class->each_page = 10000;
        $where[":status"]           = 1;
        $re = $this->use_class->getList($where);
        return $re['list'];
    }


}