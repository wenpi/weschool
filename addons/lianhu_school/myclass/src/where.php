<?php 
namespace myclass\src;

class where{
    public $table_pe;
    //解析年级-》班级-》学生姓名的联级搜索
    public function  decodeGradeClassStudent($table_name){
        global $_GPC;
        $grade_id       = $_GPC['grade_id'];
        $class_id       = $_GPC['class_id'];
        $student_name   = $_GPC['student_name'];
        if($student_name){
            $where[':student_name'] = $student_name;
            $where[":school_id"]    = getSchoolId();
            $student_ids = pdo_fetchall(" select student_id from  ".$this->table_pe."lianhu_student where student_name=:student_name and school_id=:school_id ",$where);         
            if($student_ids){
                $out['where']                 = " {$table_name}.student_id  in (:student_id)";
                foreach ($student_ids as $key => $value) {
                    $ids[]=$value['student_id'];
                }    
                $out['params'][':student_id'] = implode(",",$ids);
                $out['student_name']  = $student_name;
                return $out;
            }
          }
          if($grade_id){
              $out['where']   = " {$table_name}.grade_id =:grade_id";
              $out['params'][":grade_id"] = $grade_id;
              $out['grade_id'] = $grade_id;
          }
           if($class_id){
             if($out['where'])
                  $out['where']   .= " and  {$table_name}.class_id =:class_id";
            else 
                  $out['where']   .= " {$table_name}.class_id =:class_id";
              $out['params'][":class_id"] = $class_id;
              $out['class_id']=$class_id;
          }         
          return $out;
    }
}