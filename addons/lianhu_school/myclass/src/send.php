<?php 
namespace myclass\src;

class send{
    public $school_id;
    public $table_name;
    public function __construct(){
        $this->school_id =  getSchoolId();
        $this->table_name = tablename("lianhu_send");
    }
    //统计有效的班级圈条数
    public function getSendCount($begin_time,$end_time){
        $params[":school_id"]   = $this->school_id;
        $params[":send_status"] = 1;
        $where  = S("fun","composeParamsToWhere",array($params) );
        $where .= " and add_time <= :end_time and add_time >= :begin_time ";
        $params[":begin_time"]= $begin_time;
        $params[":end_time"] = $end_time;
        $count = pdo_fetchcolumn("select count(send_id) num from ".$this->table_name." where ".$where." ",$params);
        return $count;
    }
    //最新的十条
    public function getLastSends($page=1,$every_page=20){
       $params[":school_id"]    = $this->school_id;
       $params[":send_status"]  = 1;     
       $where  = S("fun","composeParamsToWhere",array($params) );
       $start  = ($page-1)*$every_page;
       $list   = pdo_fetchall("select * from ".$this->table_name." where ".$where." order by add_time desc limit ".$start.",".$every_page." ",$params);
        $class_student = D("student"); 
        $class_teacher = D("teacher"); 
        $class_base    = D('base');
        $class_classes = D('classes');
        $class_grade   = D('grade');
        foreach ($list as $key=>$value) {
            if($value['student_id']){
                $fanid                        = $class_base->mobileGetFanidByUid($value['send_uid']); 
                $list[$key]['student_info']   = $class_student->getStudentInfo($value['student_id']);
                $list[$key]['relation']       = $class_student->getCLassFirstRelation($fanid,$value['class_id']);
            }else{
            $list[$key]['teacher_result']     = $class_teacher->getTeacherInfo($value['teacher_id']);
            }
            $grade_id                         = $class_classes->getClassGradeId($value['class_id']);
            $grade_info                       = $class_grade->getGradeInfo($grade_id);
            $list[$key]['grade_name']         = $grade_info['grade_name'];
            $list[$key]['class_name']         = $class_classes->className($value['class_id']);
        }
       return $list;
    }
}