<?php 
namespace myclass\ctl;

class eduVideoClass extends common{
    public $class_id;

    public function __construct(){
        $this->use_class = D('eduVideoClass');
    }
    //一个二级分类的总查看数
    public function getClassViews(){
        $class_videoList    = C('eduVideoList');
        $where[":class_id"] = $this->class_id;
        $sql                = " select sum(views) all_num  from ".$class_videoList->use_class->table." where class_id=:class_id ";
        $all_num            = pdo_fetchcolumn($sql,$where);
        return $all_num;
    }


}