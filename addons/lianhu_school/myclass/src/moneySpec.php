<?php
namespace myclass\src;

class moneySpec extends common{
    public $limit_id;
    public $student_id;
    public $reduce_money;
    public $status;
    public $db_admin_id;

    public function __construct(){
        $this->setTable('lianhu_money_spec');
        $this->setGlobal();
    }
    public function getAllList(){
        $this->each_page = 10000;
        $where[":limit_id"] = $this->limit_id;
        $where[":status"]   = 1;
        $re = $this->getList($where);
        return $re['list'];
    }

    public function deleteStatus($id){
        $where["id"] = $id;
        $up["status"]= -1;
        $this->edit($where,$up);
    }
    public function getNeedPay($limit_id,$student_id){
        $where["limit_id"] = $limit_id;
        $where["status"]   = 1;       
        $where["student_id"]= $student_id;
        return $this->edit($where);
    }

}