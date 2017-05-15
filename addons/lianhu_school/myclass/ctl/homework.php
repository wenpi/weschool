<?php
namespace myclass\ctl;

class homework extends common{
    public $class_id;

    public function __construct(){
        $this->use_class = D('homework');
    }
    //根据 sendRrecord 查找 homework
    public function findHomeWork($send_record){
        $where["add_time"] = array(" between ".($send_record['add_time']-2)." and " , $send_record['add_time']+2);
        if($send_record['record_content']){
            $where["content"] = $send_record['record_content'];
        }
         if($send_record['imgs']){
            $where["img"] = $send_record['imgs'];
        }
        if($send_record['voice']){
            $where["voice"] = $send_record['voice'];
        }        
        $where["teacher_id"] = $send_record['teacher_id'];
        $result = $this->use_class->edit($where);
        return $result;
    }
    //根据homework 查找sendrecord
    public function findSendRecord($homework){
        if($homework['content']){
            $where["record_content"] = $homework['content'];
        }
        if($homework['imgs']){
            $where['imgs'] = $homework['imgs'];
        }
        if($homework['voice']){
            $where['voice'] = $homework['voice'];
        }
        $where["teacher_id"] = $homework['teacher_id'];
        $where["add_time"]   = array(" between ".($homework['add_time']-2)." and " , $homework['add_time']+2);
        $result              = D("sendRecord")->edit($where);
        return $result;        
    }


}