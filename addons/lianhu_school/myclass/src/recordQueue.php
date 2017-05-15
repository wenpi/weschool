<?php 
namespace myclass\src;

class recordQueue extends common{
    public $record_id;
    public $queue_num;

    public function __construct(){
        $this->setTable('lianhu_record_queue');
        $this->setGlobal();       
    }

    public function add($record_id,$queue_num){
        $in['record_id'] = $record_id;
        $in['queue_num'] = $queue_num;
        return parent::add($in);
    }
    public function findQueueNum($record_id){
        $where["record_id"] = $record_id;
        $result = $this->edit($where);
        return $result['queue_num'];
    }
    //queue_num and openid get teacher_id
    public function findTeahcerId($queue_num,$openid){
        $where["queue_num"] = $queue_num;
        $result     = $this->edit($where);
        $record_id  = $result['record_id'];
        $re_where["record_id"] = $record_id;
        $record_re  = D("sendRecord")->edit($re_where);
        if($record_re['student_teacher']==2){
            $teacher_ids = explode(',',$record_re['teacher_ids']);
            foreach ($teacher_ids as $key => $value) {
                $openid_out = D("teacher")->getTeacherOpenid($value);
                if($openid_out && $openid==$openid_out ){
                    $out[] = $value;
                }
            }
        }
        return $out;
    }
}