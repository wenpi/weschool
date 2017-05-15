<?php 
namespace myclass\src;
class eduVideoClass extends common{
    public function __construct(){
        $this->setTable('lianhu_edu_video_class');
        $this->setGlobal();
    }
    public function dataAdd($arr){
        $in['class_name']       = $arr['class_name'];
        $in['class_img']        = $arr['class_img'];
        $in['pid']              = $arr['pid'];
        $in['sort']             = $arr['sort'];  
        $in['class_level']      = $arr['class_level'];
        $in['limit_display']    = $arr['limit_display'];
        if($in['limit_display']==1){
            $in['limit_content'] = implode(',',$arr['limit_content']);
        }
        $in['status']           = $arr['status'];
        return parent::add($in);
    }
    public function dataEdit($id,$up=false){
        $where["class_id"] = $id;
        if($up['limit_display']==1){
            $up['limit_content'] = implode(',',$up['limit_content']);
        }
        $result            = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }
    //分类名
    public function className($class_id){
        $result = $this->dataEdit($class_id);
        return $result['class_name'];
    }
    
}
