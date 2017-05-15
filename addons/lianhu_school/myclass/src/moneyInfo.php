<?php 
namespace myclass\src;

class moneyInfo extends common{
    public $id;
    public $from_table;
    public $from_id;
    public $student_id;
    public $money_much;
    public $pay_uid;

    public function __construct(){
        $this->setTable('lianhu_money_info');
        $this->setGlobal();
    }
    

}