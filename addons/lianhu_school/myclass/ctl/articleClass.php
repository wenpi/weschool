<?php 
namespace myclass\ctl;

class articleClass extends common{

    public function __construct(){
        $this->use_class = D('articleClass');
    }
    //获取一级二级分类
    public function getCLassList(){
        $params[":status"] = 1;
        $params[":type"]   = 1;
        $top_list          = $this->use_class->dataList($params);
        $top_list          = $top_list['list'];
        $top_list          = sortArr($top_list,'class_sort','max');
        foreach ($top_list as $key => $value) {
            $params[":type"]        = 2;
            $params[":pid"]         = $value['class_id'];
            $result                 = $this->use_class->dataList($params); 
            $top_list[$key]['low']  = $result['list'];
        }

        return $top_list;
    }




}