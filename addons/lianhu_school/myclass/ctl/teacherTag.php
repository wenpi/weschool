<?php
namespace myclass\ctl;

class teacherTag extends common{

    public function __construct(){
        $this->use_class = D("teacherTag");
    }
    
    public function echoTeacherTag($tags){
        if($tags){
            $where_sql      = " tag_id in (".$tags.") ";
            $this->use_class->each_page = 10000;
            $re = $this->use_class->getSqlList($param,$where_sql);
            $list = $re['list'];
            if($list){
                foreach ($list as $key => $value) {
                    $out_tag .= $value['tag_name'].',';
                }
            }
        }else{
            $out_tag = '';
        }
        return $out_tag;
    }
    public function getList(){
        $this->use_class->each_page = 100000;
        $re = $this->use_class->getList(false);        
        return $re;
    }
}