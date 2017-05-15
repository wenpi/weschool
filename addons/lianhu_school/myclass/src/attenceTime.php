<?php 
namespace myclass\src;
class attenceTime extends common {
    public $time_id     = 'time_id';
    public $time_type   = 'time_type';
    public $begin_time  = 'begin_time';
    public $end_time    = 'end_time';

    public $type_name   = array(
        1=>'进校',
        2=>'出校',
    ); 
    public function __construct(){
        $this->setTable('lianhu_attence_time');
        $this->setGlobal();
    }
     public function dataAdd($in){
        return parent::add($in);
    }
    public function dataEdit($id,$up=false){
        $where[$this->time_id] = $id;
        $result                = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }


}