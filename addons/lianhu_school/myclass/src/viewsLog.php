<?php 
namespace myclass\src;

class viewsLog extends common{
    public $id           = 'id';
    public $content_id   = 'content_id';
    public $content_type = 'content_type';
    public $grade_id     = 'grade_id';
    public $class_id     = 'class_id';
    public $student_id   = 'student_id';
    public $uid          = 'uid';

    public function __construct(){
        $this->setTable('lianhu_views_log');
        $this->setGlobal();
    }
    public function dataAdd($arr){
        return parent::add($arr);
    }
    public function dataEdit($id,$up=false){
        $where["id"]       = $id;
        $result            = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params,$in_where=false,$pages=1){
      $this->_set('each_page',100000);
      return parent::getList($params,$in_where,$pages);
    }

}