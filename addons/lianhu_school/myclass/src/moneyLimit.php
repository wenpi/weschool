<?php 
namespace myclass\src;
class moneyLimit extends common{
    public $limit_id     = 'limit_id';
    public $limit_name   = 'limit_name';
    public $limit_module = 'limit_module';
    public $limit_type   = 'limit_type';
    public $limit_much   = 'limit_much';
    public $status       = 'status';
    public $grade_ids    = 'grade_ids';
    public $class_ids    = 'class_ids';
    public $group_id     = 'group_id';
    public $school_limit_type    = 'school_limit_type';

    public function __construct(){
        $this->setTable('lianhu_money_limit');
        $this->setGlobal();        
    }
    //获取一个组有效的
    //不能是关闭
    public function getListByXiao($group_id){
        $where[":group_id"] = $group_id;
        $where[":status"]   = 1;
        $this->each_page    = 1000;
        $list = $this->getList($where);
        return $list['list'];
    }


}