<?php 
namespace myclass\src;
/*
*   用来处理打卡方面的东西
*   zhuhuan 18587190225 / 821880927
*/
class card{
    public $table;
    public $table_no;
    public $uniacid;
    public $school_id;
    public $where;
    public $in_time;

    public function __construct(){
        global $_W;
        $this->table    = tablename("lianhu_card_record");
        $this->table_no ='lianhu_card_record';
        $this->uniacid  = $_W['uniacid'];
        $this->school_id= getSchoolId();
    }
    public function _set($name,$value){
        $this->$name = $value; 
    }
    //设备
    public function deviceInfo($device_id){
        $params[":did"] = $device_id;
        $where          = "device_id =:did";
        $info           = pdo_fetch("select * from ".tablename('lianhu_device')." where ".$where." ",$params);
        return $info;
    }
    //解析打卡时间的上午，下午，异常
    public function decodeCardTimeModel($time){
        $class_attenceTime       = D('attenceTime');
        $params[":time_type"]    = 1;
        $in_result               = $class_attenceTime->dataList($params);
        $in_list                 = $in_result['list'];
        $params[":time_type"]    = 2;
        $out_result              = $class_attenceTime->dataList($params);
        $out_list                = $out_result['list'];
        $hour_min                = date("H:i",$time);
        foreach ($in_list as $key => $value) {
            $in_result = compareHourMin($hour_min,$value['begin_time'],$value['end_time']);
            if($in_result){
                return 1;
            }
        }
         foreach ($out_list as $key => $value) {
            $in_result = compareHourMin($hour_min,$value['begin_time'],$value['end_time']);
            if($in_result){
                return 2;
            }
        }       
        return 3;
    }
    //添加打卡记录
    public function addCardRecord($arr){
        $class_student   = D('student'); 
        $date_arr        = fun::decodeTimeToSlice($arr['play_card_time']);
        if($arr['student_id']){
            $student_info    = $class_student->getStudentInfo($arr['student_id']);
            $in['grade_id']  = $student_info['grade_id'];
            $in['class_id']  = $student_info['class_id'];
            $in['student_id']= $arr['student_id'];
            $in['school_id'] = $student_info['school_id'];
        }else{
            $in['teacher_id']= $arr['teacher_id'];
            $teacher_info    = D('teacher')->edit($in);
            $in['school_id'] = $teacher_info['school_id'];
        }
        setSchoolId($in['school_id']);
        $in['uniacid']   = $this->uniacid;
        $in['year']      = $date_arr['year'];
        $in['month']     = $date_arr['month'];
        $in['day']       = $date_arr['day'];
        if(!$arr['up_low']){
            $in['up_low']    = $this->decodeCardTimeModel($arr['play_card_time']); 
        }else{
            $in['up_low']    = $arr['up_low'];
        }
        $in['add_time']     = time();
        $in['device_id']    = $arr['device_id']?$arr['device_id']:0;
        $in['rfid_value']   = $arr['rfid_value']?$arr['rfid_value']:0;
        $in['img_url']      = $arr['img_url']?$arr['img_url']:'';
        if($arr['img_url2']){
            $in['img_url2'] = $arr['img_url2']?$arr['img_url2']:'';;
        }
        $in['signTemp']        = $arr['signTemp'];
        $in['play_card_time']  = $arr['play_card_time'];
        $in['device_list']     = $arr['device_list'] ?  $arr['device_list']:'';
        $in['add_time_str']    = $arr['add_time_str'] ?  $arr['add_time_str']:'';
        $in['type']            = $arr['type'] ?  $arr['type']:1;
        $in['add_teacher_id']  = $arr['add_teacher_id'] ?  $arr['add_teacher_id']:0;
        $in['teacher_add']     = $arr['teacher_add'] ?  $arr['teacher_add']:0;
        pdo_insert($this->table_no,$in);
        return pdo_insertid();
    }
    //统计打卡人数
    //time_type = [all|morning|afternoon|other]
    public function countStudentPlayCard($time_type,$teacher=false){
        if($this->in_time){
            list($time['year'],$time['month'],$time['day']) = explode('-',date('Y-m-d',$this->in_time ) ); 
        }else{
            list($time['year'],$time['month'],$time['day']) = explode('-',date('Y-m-d',time() ) ); 
        }
        if($teacher){
            $params[":teacher_id"] = array("!=",0);
            $group_str  = 'teacher_id';
            $find["teacher"] = 1;
        }else{
            $group_str  = 'student_id';
            $find["student"] = 1;
        }
        $find['year']  = $params[':year']   = $time['year'];
        $find['month'] = $params[':month']  = $time['month'];
        $find['day']   = $params[":day"]    = $time['day']; 
        $params[':school_id']   = $this->school_id;
        $where  = S("fun",'composeParamsToWhere',array($params) );
        if($time_type == 'morning'){
            $where .= " and up_low = 1";    
            $find['up_low'] = 1;
        }elseif($time_type =='afternoon'){
            $where .= " and up_low = 2 ";    
            $find['up_low'] = 2;
        }elseif($time_type == 'other'){
            $where .= " and up_low = 3 ";    
            $find['up_low'] = 3;
        }
        $oldcount = D("cardCount")->find($find);
        if($this->where){
            $where .= " and ".$this->where;  
        }
        if(isset($oldcount) && $time['year'].$time['month'].$time['day'] != date('Ymd',time())){
            return $oldcount;
        }   
        $list = pdo_fetchall("select student_id,teacher_id from  ".$this->table." where ".$where."  ",$params); 
        $student_arr = array();
        $teacher_arr = array();
        foreach ($list as $key => $value) {
            if($value['student_id']!=0 && !in_array($value['student_id'],$student_arr)){
                $count++;
                $student_arr[] = $value['student_id'];
            }
            if($value['teacher_id']!=0 && !in_array($value['teacher_id'],$teacher_arr)){
                $count++;
                $teacher_arr[] = $value['teacher_id'];
            }
        }

        if($time['year'].$time['month'].$time['day'] != date('Ymd',time())){
            D("cardCount")->dataAdd($count);
        }
        return $count;
    }
    //获取打卡list 
    public function studentCardList($student_id,$begin_time,$end_time){
        $where        = " student_id =:student_id  ";
        $params[':student_id'] = $student_id;  
        $where .= " and add_time > ".$begin_time." and add_time <= ".$end_time." ";    
        $list   = pdo_fetchall(" select * from ".$this->table." where ".$where." order by record_id desc ",$params);
        return $list;
    }
    public function TeacherCardList($tea_id,$begin_time,$end_time){
        $where                  = " teacher_id =:teacher_id  ";
        $params[':teacher_id']  = $tea_id;  
        $where .= " and add_time > ".$begin_time." and add_time <= ".$end_time." ";    
        $list   = pdo_fetchall(" select * from ".$this->table." where ".$where." order by record_id desc ",$params);
        return $list;
    }
    //筛选
    public function getAllCardList($where,$params,$pager,$all=false){
        $every_page = 20;
  		$pager      = $pager ? $pager :1;
		$start      = ($pager-1)*$every_page;
		$limit      = $start.",".$every_page;    
        $where     .= " and school_id=:school_id";
        $params[":school_id"] = getSchoolId();  
        $count      = pdo_fetchcolumn(" select count(record_id) num  from ".$this->table." where ".$where." order by record_id desc ",$params);
        if($all){
            $list   = pdo_fetchall(" select * from ".$this->table." where ".$where." order by record_id desc   " ,$params);
        }else{
            $list   = pdo_fetchall(" select * from ".$this->table." where ".$where." order by record_id desc limit ".$limit ,$params);
        }
        return array('count'=>$count,'list'=>$list);
    }
    //一个学生的上下午是否打卡
    public function studentRecord($time_list,$student_id,$time_type){
        $params[':year']     = $time_list['year'];
        $params[':month']    = $time_list['month'];
        $params[':day']      = $time_list['day'];
        $params[':student_id'] = $student_id;
        if($time_type=='in'){
            $params[":up_low"] = 1;
        }elseif($time_type=='out'){
            $params[":up_low"] = 2;
        }elseif($time_type=='other'){
            $params[":up_low"] = 3;
        }
        $where  = S("fun",'composeParamsToWhere',array($params) );
        $list   = pdo_fetchall("select * from ".$this->table."  where ".$where." order by record_id desc ",$params); 
        return $list;
    }
    //
    public function judeStudentRecord($time_list,$student_id,$time_type){
        $params[':year']     = $time_list['year'];
        $params[':month']    = $time_list['month'];
        $params[':day']      = $time_list['day'];
        $params[':student_id'] = $student_id;
        if($time_type=='in'){
            $params[":up_low"] = 1;
        }elseif($time_type=='out'){
            $params[":up_low"] = 2;
        }elseif($time_type=='other'){
            $params[":up_low"] = 3;
        }
        $where  = S("fun",'composeParamsToWhere',array($params) );
        $re   = pdo_fetch("select day from ".$this->table."  where ".$where." order by record_id desc ",$params); 
        return $re;
    }
    //一个教师上下午是否打卡
    public function teacherRecord($time_list,$teacher_id,$time_type){
        $params[':year']        = $time_list['year'];
        $params[':month']       = $time_list['month'];
        $params[':day']         = $time_list['day'];
        $params[':teacher_id']  = $teacher_id;
        if($time_type=='in'){
            $params[":up_low"] = 1;
        }elseif($time_type=='out'){
            $params[":up_low"] = 2;
        }elseif($time_type=='other'){
            $params[":up_low"] = 3;
        }
        $where  = S("fun",'composeParamsToWhere',array($params) );
        $list   = pdo_fetchall("select * from ".$this->table."  where ".$where." order by record_id desc ",$params); 
        return $list;
    }
}