<?php 
namespace myclass\src;

class moneyGroup extends common{
    public $group_id;
    public $group_name;
    public $status;

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_money_group');
    }

    //
    public function allUseList(){
        $params[":status"] = 1;
        $this->each_page  = 1000;
        $re = $this->getList($params);
        return $re['list'];
    }
    //groupname
    public function groupName($group_id){
        $where["group_id"] = $group_id;
        $this->field_str   = 'group_name';
        $result = $this->edit($where);
        return $result['group_name'];
    }

}