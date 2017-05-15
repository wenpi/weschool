<?php 
namespace myclass\src;
class classStudent extends common {
    public $id          = 'id';
    public $class_id    = 'class_id';
    public $student_id  = 'student_id';

    public function __construct(){
        $this->setTable('lianhu_class_student');
        $this->setGlobal();
    }
     public function dataAdd($in){
        return parent::add($in);
    } 
    public function dataEdit($id,$up=false){
        $where[$this->id]      = $id;
        $result                = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }
    
} 