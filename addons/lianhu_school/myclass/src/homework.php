<?php 
namespace myclass\src;
class homework extends common{
    public $day_much;
    public $day_base;
    public $teacher_id      = 'teacher_id';
    public $homework_id     = 'homework_id';
    public $course_id       = 'course_id';
    public $content         = 'content';
    public $status          = 'status';
    public $vocie           = 'vocie';
    public $class_id        = 'class_id';

    public function __construct(){
        $this->setTable('lianhu_homework');
        $this->setGlobal();
    }
    public function setBase($school_id=false){
        if(!$school_id){
            $school_id  = $this->school_id;
        }
        $this->day_much =  S("system",'getSetContent',array('day_homeWork_much',$school_id));
        $this->day_base =  S("system",'getSetContent',array('day_homeWork_base',$school_id));
    }
    //教师时间段内积分数
    public function getTeacherHomeworkJiFen($begin_time,$end_time){
        $list           = $this->getHomeworkList($begin_time,$end_time);
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
    //获取有效的作业记录
    public function getHomeworkList($begin_time,$end_time,$count=false){
        $params[":school_id"]   = $this->school_id;
        $params[":status"]      = 1;
        if($this->teacher_id){
            $params[":teacher_id"]  = $this->teacher_id;
        }
        $where  = S("fun","composeParamsToWhere",array($params) );
        $where .= " and add_time <= :end_time and add_time >= :begin_time ";
        $params[":end_time"]   = $end_time;
        $params[":begin_time"] = $begin_time;
        if($count){
            $list   = pdo_fetchcolumn("select count(add_time) num from ".$this->table." where ".$where." ",$params);
        }else{
            $list   = pdo_fetchall("select * from ".$this->table." where ".$where." ",$params);
        }
        return $list;
    }
    //统计有效的作业条数
    public function getHomeworkCount($begin_time,$end_time){
        $list  = $this->getHomeworkList($begin_time,$end_time,true);
        return $list;
    }    
    public function getPageStudentHomeWork($class_id,$pages){
        $start      = $pages>0 ? $pages : 1;
        $limit_sql  = ($start-1)*$this->each_page.','.$this->each_page;  
        $params[":class_id"] = $class_id;
        $params[":status"]   = 1;
        $where_str           = S("fun","composeParamsToWhere",array($params,'home'));
        $list                = pdo_fetchall("select home.*,tea.teacher_realname,tea.teacher_img   from ".$this->table." home 
                                   left join ".tablename('lianhu_teacher')." tea on tea.teacher_id=home.teacher_id
                                   where ".$where_str." order by home.add_time desc limit ".$limit_sql,$params);  
        return $list;
    }


}