<?php 
namespace myclass\src;

class articleClass extends common{
    public $class_id    = 'class_id';
    public $grade_id    = 'grade_id';
    public $class_name  = 'class_name';
    public $class_img   = 'class_img';
    public $class_sort  = 'class_sort';
    public $status      = 'status';
    public $type        = 'type';
    public $pid         = 'pid';

    public function __construct(){
        $this->setTable('lianhu_article_class');
        $this->setGlobal();
    }

    public function dataEdit($id,$up=false){
        $where["class_id"] = $id;
        $result            = parent::edit($where,$up);
        return $result;
    }
    
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }    
    

}