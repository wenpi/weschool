<?php 
namespace myclass\src;

class work{
    public $day_much;
    public $day_base;

    private $table_name;
    private $table;
    public  $school_id;
    public  $each_page  = 20;
    public  $teacher_id = 0;

    public function __construct(){
        $this->table_name = "lianhu_work";
        $this->table      = tablename($this->table_name);
        $this->school_id  = getSchoolId();
    }
    
    public function setBase(){
        $school_id  = $this->school_id;
        $this->day_much =  S("system",'getSetContent',array('day_work_much',$school_id));
        $this->day_base =  S("system",'getSetContent',array('day_work_base',$school_id));
    }

    //原有的记录升级(新账户体系)
    public function workUp(){
        $list  = pdo_fetchAll(" select * from ".$this->table." where have_up = 0 ");
        if($list){
            foreach ($list as $key => $value) {
                $up["wq_admin_uid"] = $value['teacher_id'];
                $up["teacher_id"]   = 0;
                $up["have_up"]      = 1;
                $this->edit($value['work_id'],$up);
            }
        }else{
            return true;
        }
    }
    //新增记录
    public function add($arr){
        global $_W;
        $this->workUp();
        $in['uniacid']          = $_W['uniacid'];
        $in['school_id']        = $this->school_id;
        $in['addtime']         = time();
        $in['teacher_id']      = $_SESSION['teacher_id'] ? $_SESSION['teacher_id']:0;
        $in['db_admin_id']     = $_SESSION['db_admin_id'] ? $_SESSION['db_admin_id']:0;
        $in['wq_admin_uid']    = $_W['uid'] ? $_W['uid']:0;
        $in['have_up']         = 1;
        $in['grade_id']        = $arr['grade_id'];
        $in['class_id']        = $arr['class_id'];
        $in['student_id']      = $arr['student_id'];
        $in['word']            = $arr['word'];
        $in['content']         = $arr['content'];
        $in['jilv_class']      = $arr['jilv_class'];
        $in['img']             = $arr['img'];
        $in['voice']           = $arr['voice'];
        /**
            *放弃此字段 
            $in['course_name']  = '';
        **/
        pdo_insert($this->table_name,$in);
        return pdo_insertid();
    }
    //更新获取记录
    public function edit($record_id,$up=false){
        if($up){
            pdo_update($this->table_name,$up,array("work_id"=>$record_id)); 
        }
        $result = pdo_fetch("select * from ".$this->table." where work_id=:wid ",array(":wid"=>$record_id) );
        return $result;
    }
    public function delete($record_id){
        pdo_delete($this->table_name,array("work_id"=>$record_id));
    }
    //获取记录
    public function get($page,$params=false){
        $params[':school_id']= $this->school_id;
        $page                = $page>1? $page:1;
        $start               = ($page-1)*$this->each_page;
        $limit_sql           = $start.','.$this->each_page;
        $where               = S("fun","composeParamsTowhere",array($params));
        $count               = pdo_fetchcolumn("select count(work_id) num from ".$this->table." where ".$where." ",$params);
        $list                = pdo_fetchall("select * from ".$this->table." where ".$where." order by work_id desc limit  ".$limit_sql,$params);
        return array('count'=>$count,'list'=>$list);
    }
    //单个记录补充信息
    public function addInfoToWork($work_record){
        if($work_record['teacher_id']){
            $info                     = D('teacher')->getTeacherInfo($work_record['teacher_id']);
            $work_record['send_name'] = $info['teacher_realname'];
        }elseif($work_record['db_admin_id']){
            $info                     = D('admin')->getAdminInfo($work_record['db_admin_id']);
            $work_record['send_name'] = $info['admin_name'];
        }elseif($work_record['wq_admin_uid']){
            //兼容以前的账户体系
            $info                     = D('teacher')->getTeacherInfo($work_record['wq_admin_uid']);
            $work_record['send_name'] = $info['teacher_realname'] ? $info['teacher_realname']:"管理员"; 
        }
        //兼容以前的模板
        $work_record['work_id']          = $work_record['work_id'];
        $work_record['teacher_realname'] = $work_record['send_name'];
        $work_record['teacher_name']     = $work_record['send_name'];
        $info                            = D('record')->edit($work_record['jilv_class']);
        $work_record['class_name'] 		 = $info['class_name'];
        return $work_record;
    }

    public function getTeacherWorkJiFen($begin_time,$end_time){
        $list           = $this->getWorkList($begin_time,$end_time);
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
    //获取有效的记录
    public function getWorkList($begin_time,$end_time){
        $params[":school_id"]   = $this->school_id;
        if($this->teacher_id){
            $params[":teacher_id"]  = $this->teacher_id;
        }
        $where  = S("fun","composeParamsToWhere",array($params) );
        $where .= " and addtime <= :end_time and addtime >= :begin_time ";
        $params[":end_time"]   = $end_time;
        $params[":begin_time"] = $begin_time;
        $list                  = pdo_fetchall("select * from ".$this->table." where ".$where." ",$params);
        return $list;
    }

}