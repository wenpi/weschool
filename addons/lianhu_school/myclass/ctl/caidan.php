<?php 
namespace myclass\ctl;

class caidan extends common{
    public $class_id;

    public function __construct(){
        $this->use_class = D('caidan');
    }

    public function getOutList($all=true){
        $this->use_class->each_page = 1000;
        $where          = " class_id=:cid ";
        if(!$all){
            $where .= " and status =1 ";
        }
        $params[":cid"] = $this->class_id;
        $re = $this->use_class->getSqlList($params,$where); 
        return $re['list'];       
    }
    //集合输出
    public function getClassListOut($all=true){
        $class_list   = C('caidanClass')->getOutList();
        if($class_list){
            foreach ($class_list as $key => $value) {
                $this->class_id           = $value['class_id'];
                $class_list[$key]['list'] = $this->getOutList($all);
            }
        }       
        return $class_list;
    }

}