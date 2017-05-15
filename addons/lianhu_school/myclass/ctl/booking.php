<?php 
namespace myclass\ctl;

class booking extends common{
    
    public function __construct(){
        $this->use_class = D('booking');
    }
    //获取有效期内的可以报名活动列表
    public function getActivityList(){
        $now_time             = time();
        $where[":begin_time"] = array("<=",$now_time);
        $where[":end_time"]   = array(">=",$now_time);
        $where[":status"]     = array("!=",-1);       
        $result               = $this->use_class->getList($where);
        return $result;
    }
    


}