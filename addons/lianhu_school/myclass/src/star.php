<?php 
namespace myclass\src;
class star extends common{
    public function __construct(){
        $this->setTable('lianhu_student_star');
        $this->setGlobal();
    }
    public function dataAdd($arr){
        $in['grade_id']       = $arr['grade_id'];
        $in['class_id']       = $arr['class_id'];
        $in['student_id']     = $arr['student_id'];
        $in['teacher_id']     = $arr['teacher_id'];
        $in['star_num']       = $arr['star_num'];
        $in['star_title']     = $arr['star_title'];
        return parent::add($in);
    }
    public function dataEdit($id,$up=false){
        $where["star_id"] = $id;
        $result            = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }
}
