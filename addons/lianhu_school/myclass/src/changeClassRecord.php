<?php
namespace myclass\src;
/*
    学生换班记录
*/

class changeClassRecord extends common{

    public $record_id    = 'record_id';
    public $student_id   = 'student_id';
    public $old_class_id = 'old_class_id';
    public $old_grade_class_name = 'old_grade_class_name';
    public $new_class_id = 'new_class_id';

    public function __construct(){
        $this->setGlobal();
        $this->setTable("lianhu_change_class_record");
    }
    public function addRecord($student_id,$old_class_id=0,$new_class_id=0){
        if($old_class_id==0){
            $in['old_grade_class_name'] = '新增';
        }else{
            $class_name = D("classes")->className($old_class_id);
            $grade_name = D("classes")->gradeName($old_class_id);
            $in['old_grade_class_name'] =  $grade_name.'-'.$class_name;
        }
        if($new_class_id==0){
            $in['new_grade_class_name'] = '';
        }else{
            $class_name = D("classes")->className($new_class_id);
            $grade_name = D("classes")->gradeName($new_class_id);
            $in['new_grade_class_name'] =  $grade_name.'-'.$class_name;
        }
        $in["student_id"] = $student_id;
        $in["old_class_id"] = $old_class_id;
        $in['new_class_id'] = $new_class_id;
        return $this->add($in);
    }
    public function getAll($student_id){
        $this->each_page = 1000;
        $where[":student_id"] = $student_id;
        $re = $this->getList($where);
        return $re['list'];
    }

}