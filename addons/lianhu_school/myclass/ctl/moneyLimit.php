<?php 
namespace myclass\ctl;
class moneyLimit extends common{
    public $limit_id;

    public $limit_type = array(
        1=>'一次缴费，永远免费',
        2=>'按年',
        3=>'按月'
    );
    public function __construct(){
        $this->use_class = D('moneyLimit');
    }
    //限制名
    public function limitName(){
        $this->use_class->field_str = 'limit_name';
        $where["limit_id"] = $this->limit_id;
        $limit_name = $this->use_class->edit($where);
        return $limit_name['limit_name'];
    }

}