<?php
namespace myclass\ctl;

class repair extends common{
    public $class_base;

    public function sendMsg($title,$content,$use_name){
        $class_msg = D('msg');
        $class_msg->in_class_base = $this->class_base;
        $title     = "您好有新的报修：".$title;
        $mu_info   = $class_msg->decodeSchoolMsg($title,$use_name,$content);
        return $mu_info;
    }

}