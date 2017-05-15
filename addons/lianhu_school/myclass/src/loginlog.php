<?php
namespace myclass\src;

class loginlog{
    public $table;
    public $uniacid;
    public $school_id;
    public $teacher_id;
    public $day_much;
    public $day_base;    

    public function __construct(){
        $this->table = tablename('lianhu_login_log');
    }
    public function setBase(){
        $school_id      = $this->school_id;
        $this->day_much =   S("system",'getSetContent',array('day_login_much',$school_id));
        $this->day_base =   S("system",'getSetContent',array('day_login_base',$school_id));
    }  
    //获取基数
     public function getTeacherLoginJiFen($begin_time,$end_time){
        $list           = $this->getTeacherLoginList($begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count>$this->day_much){
                $num += $this->day_much;
            }else{
                $num += $count;
            }
        }
        return $num;
    }
    //添加
    public function addLog($in){
        global $_W;
        $school_id = getSchoolId();
        if($school_id)
            $in['school_id'] = $school_id; 
        $in['add_time'] = time();
        $in['uniacid']  = $_W['uniacid'];
        pdo_insert("lianhu_login_log",$in);
    }
    //后台登录日志
    public function addPcLogin(){
        global $_W;
        $in['in_type'] =1;
        $in['web_uid'] =$_W['uid'];
        $this->addLog($in);
    }
    //教师端登录日志
    public function teaLoginLog(){
        global $_W;
        $in['in_type']      = 2;
        $in['mobile_uid']   = getMemberUid();
        $in['teacher_id']   = $_SESSION['teacher_id'];
        $this->addLog($in);
    }
    //学生端登录日志
    public function studentLoginLog($student_id,$class_id){
        global $_W;
        $in['in_type']      = 3;
        $in['mobile_uid']   = getMemberUid();
        $in['student_id']   = $student_id;
        $in['class_id']     = $class_id;
        $this->addLog($in);
    }
    //教师登录日志
    public function getTeacherLoginList($begin_time,$end_time){
        $params[":in_type"]          = 2;
        $params[':teacher_id']       = $this->teacher_id;
        $where  = S("fun","composeParamsToWhere",array($params) );
		$where .= " and add_time <= :end_time and add_time >= :begin_time ";
        $params[":end_time"]        = $end_time;
        $params[":begin_time"]      = $begin_time;
        $list  = pdo_fetchall("select *  from ".tablename('lianhu_login_log')." where ".$where."  ",$params);
        return $list ;       
    }


}