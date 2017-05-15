<?php
namespace myclass\ctl;

class blockClass extends common{
    
    public function __construct(){
        $this->use_class = D('blockClass');
    }
    //获取非删除分类
    public function getOutList(){
        $this->use_class->each_page = 1000;
        $where = ' status != :status';
        $params[":status"] = '-1';
        $re    = $this->use_class->getSqlList($params,$where); 
        return $re['list'];
    }


}