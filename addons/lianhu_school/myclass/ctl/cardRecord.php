<?php 
namespace myclass\ctl;

class cardRecord extends common{
    public $card_stop_time = 10;//单位：秒
    public $student_id;
    public $teacher_id;
    public $rfid_value;
    public $class_base;

    public function __construct(){
        $this->use_class = D('cardRecord');
    }
    //获取一个学生上次打卡时间
    public function lastRecord(){
        $begin_time           = time()-$this->card_stop_time;
        $where[':rfid_value'] = $this->rfid_value;
        if($this->student_id){
            $where[":student_id"] = $this->student_id;
        }else{
            $where[":teacher_id"] = $this->teacher_id;
        }
        $where[":add_time"]   = array('>',$begin_time);
        $re = $this->use_class->getList($where);
        if($re['count']>0){
            $out = false;
        }else{
            $out = true;
        }
        return $out;
    }
    //学生最后一次的校车打卡
    public function studentTodayLastSchoolBus(){
        $where[":student_id"] = $this->student_id;
        $re                   = $this->use_class->getList($where);
        if($re['count']>0){
            $out = $re['list'][0];
        }else{
            $out = false;
        }             
        return $out;
    }
    //send 
    public function sendToTeacher($teacher_id,$class_name,$content){
        D("msg")->in_class_base = $this->class_base;
        $title      = '6分钟前至2分钟前本班学生进出详情';
        $mu_info    = D("msg")->decodeMsg1($title,$class_name,'系统',$content,'');
        $openid     = D('teacher')->getTeacherOpenid($teacher_id);
        $this->class_base->sendTplNotice($openid,$mu_info['mu_id'],$mu_info['data']);
    }
    //提醒给5分钟-至10分钟内的到校人
    public function cardSendToTeacher(){
        global $_W;
        $class_where[':student_in_send'] = 1;
        $class_where[":status"]          = 1;
        $class_where[":uniacid"]         = $_W['uniacid'];
        D("classes")->each_page          = 200;
        D("classes")->school_id          = 0;
        $class_re  = D("classes")->getList($class_where);
        $list = $class_re['list'];
        foreach ($list as $key => $value) {
            $content = $this->getStudentClassList($value['class_id']);
            if($content){
                $this->sendToTeacher($value['teacher_id'],$value['class_name'],$content);
            }
        }
    }
    //2分钟-至6分钟
    public function getStudentClassList($class_id){
        $time = time();
        $where[":class_id"] = $class_id;
        $where[":add_time"] = array(" between ".($time-360)." and  ",$time-120);
        $where[":send_to_teacher"] = 0;
        $this->use_class->each_page = 200;
        $this->use_class->school_id = 0;
        $list = $this->use_class->getList($where);
        $list = $list['list'];
        foreach ($list as $key => $value) {
            $student_name = D("student")->getStudentName($value['student_id']);
            $this->use_class->edit(array("record_id"=>$value['record_id']),array('send_to_teacher'=>1));
            if($value['up_low']!=3){
                $status       = $value['up_low'] ==1 ? "进入":"离开";
            }else{
                $status       = '其他';
            }
            $str .= $student_name."在".date("Y-m-d H:i:s",$value['add_time']).$status."\r\n";
            echo $str;
        }
        return $str;
    }

    //取体温的合理平均值
    public function averageTemp($tempArr){
        //过滤零值
        if(!$tempArr){
            return 0;
        }
        foreach ($tempArr as $key => $value) {
            if($value<=0){
                unset($tempArr[$key]);
            }
        }
        $count = count($tempArr);
        //去除最小值,最大值
        $min_value  = 0;
        $max_value  = 0;
         if(!$tempArr){
            return 0;
        }
        foreach ($tempArr as $key => $value) {
            if($count>2){
                if($value<$min_key){
                    $min_value = $value;
                }elseif($value>$max_value){
                    $max_value = $value;
                }
            }
            $all_plus     += $value;
        }
        if($min_value){
            $count--;
            $all_plus -= $min_value;
        }
        if($max_value){
            $count--;
            $all_plus -= $max_value;
        }
        if($count>0){
            return number_format($all_plus/$count,1);
        }else{
            return 0;
        }
    }
    

}