<?php 
namespace myclass\ctl;

class courseClass extends common{

    public function __construct(){
        $this->use_class = D('courseClass');
    }
    public function getUseList(){
        $params[":status"] = 1;
        $this->use_class->each_page = 1000;
        $re = $this->use_class->getList($params);
        return $re['list'];
    }

    public function getAllList(){
        $params[":status"] = array("!=","-1");
        $this->use_class->each_page   = 10000;
        $re = $this->use_class->getList($params);
        return $re['list'];
    }

    public function edit($class_id){
        $where["class_id"] = $class_id;
        $result = $this->use_class->edit($where);
        return $result;
    }
    public function delete($class_id){
        $where["class_id"] = $class_id;
        $up["status"]      = '-1';
        $this->use_class->edit($where,$up);
    }
    public function className($class_id){
        $info = $this->edit($class_id);
        return $info['class_name'];
    }

}