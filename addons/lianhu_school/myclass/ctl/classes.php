<?php 
namespace myclass\ctl;
class classes extends common{
    public $class_classes;
    public $class_student;
    public $class_classStudent;
    public $class_id;
    public $school_id;

    public function __construct(){
        $this->class_classes        = D('classes');
        $this->class_student        = D('student');
        $this->class_classStudent   = D('classStudent');
        $this->setGlobal();
    }
    //   获取该学校的班级列表
    public function getSchoolClass(){
        $where[":status"]    = 1;
        $this->class_classes->each_page = 10000;
        $class_list          =$this->class_classes->getList($where);
        return $class_list;
    }
    //获取副班级有效的学生
    public function getFuClassStudent(){
        $class_student      = $this->class_student;
        $class_classStudent = $this->class_classStudent;
        $where[":class_id"] = $this->class_id;
        $result             = $class_classStudent->dataList($where);
        $list               = $result['list'];
        if($list){
            $g = 0;
            foreach ($list as $key => $value) {
                if($value['student_id']){
                    $info = $class_student->getStudentInfo($value['student_id']);
                    if($info['status']){
                        $out[$g] = $info;
                        $g++; 
                    }
                }
            }
            return $out;            
        }
        return false;
    }
    //班级下所有的有效的学生
    public function getClassStudent(){
        $class_student = $this->class_student;
        $class_student->_set('class_id',$this->class_id);
        $student_list  = $class_student->getClassStudentList();
        //副班级
        if(D('school')->getSchoolParams('much_class')){
            $fu_student_list         = $this->getFuClassStudent();
            if($fu_student_list){
                $fu_student_list     = deleteArrRepeat($student_list,$fu_student_list,'student_id');
                if($student_list){
                    $student_list    = array_merge($student_list,$fu_student_list);
                }else{
                    $student_list    = $fu_student_list;
                }
            }
        }
        return $student_list;
    }
    //给班级id列表赋值
    public function findInfoForClassList($class_id_list){
       $class_classes = $this->class_classes;
       if($class_id_list){
            foreach ($class_id_list as $key => $value) {
                $info[$key] = $class_classes->edit(array('class_id'=>$value));
            }
        }
        return $info;
    }
	#获取一个班级的年级命名
    public function classGradeName($class_id){
        if(empty($class_id)){
			return false;
		} 
        $class_info = $this->class_classes->edit(array('class_id'=>$class_id));
        $grade_info = D('grade')->getGradeInfo($class_info['grade_id']);
    	return $grade_info['grade_name'];
	}
    //该班级的班级公告分类
    public function msgClass($class_id){
        $class_info = $this->class_classes->edit(array('class_id'=>$class_id));
        if(!$class_info['msg_class']){
            $msg_class =  D('school')->getSchoolInfo('line_type');
        }else{
            $msg_class = $class_info['msg_class'];
        }
        if($msg_class){
            return  explode("||", $msg_class );
        }
    }

}