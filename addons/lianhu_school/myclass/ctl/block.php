<?php
namespace myclass\ctl;

class block extends common{
    public $class_id;

    public function __construct(){
        $this->use_class = D('block'); 
    }

    //获取分类下的积木列表
    public function getOutList(){
        $this->use_class->each_page = 1000;
        $where  = " class_id=:cid ";
        $params[":cid"] = $this->class_id;
        $re = $this->use_class->getSqlList($params,$where); 
        return $re['list'];
    }

}
