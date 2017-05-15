<?php 
namespace myclass\ctl;

class lianhuLine extends common{
    public $class_id;
    public $line_type;

    public function __construct(){
        $this->use_class = D('lianhuLine');
    }
    public function getList($page=1){
        $this->use_class->each_page = 10;
        $params[":class_id"] = $this->class_id;
        $params[":line_type"]= $this->line_type;
        $re = $this->use_class->getList($params,false,$page);
        return $re;
    }
    public function infoToList($list){
        foreach ($list as $key => $value) {
            $list[$key]['time_date'] = date("m-d H:i",$value['addtime']);
            if($value['teacher_id']){
                $list[$key]['teacher_realname'] = D('teacher')->teacherName($value['teacher_id']);
            }
            $list[$key]['teacher_realname'] = $list[$key]['teacher_realname']? $list[$key]['teacher_realname']:'管理员';
            $list[$key]['teacher_img']          = D('teacher')->teacherImg($value['teacher_id']); 
        }
        return $list;
    }
    //获取该班级的最后一个公告
    public function lastLine($class_id){
        $params["class_id"] = $class_id;
        $params["status"]   = 1;
        $result = $this->use_class->edit($params);        
        return $result;
    }
}