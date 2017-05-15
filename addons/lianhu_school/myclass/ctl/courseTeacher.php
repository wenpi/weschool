<?php 
namespace myclass\ctl;

class courseTeacher extends common{
    public $course_id;

    public function __construct(){
        $this->use_class = D('courseTeacher');
    }
    //获取一个扫码课程的负责的教师
    public function getCourseList(){
        $course_id = $this->course_id;
        $params[":course_id"] = $course_id;
        $re = $this->use_class->getList($params);
        return $re['list'];
    }
    //删除
    public function deleteCourseTeacherList(){
        $course_id = $this->course_id;
        $params["course_id"] = $course_id;
        $this->use_class->delete($params);
    }
    //添加
    public function addList($teacher_ids){
        if(!$teacher_ids){
            return false;
        }
        $in["course_id"] = $this->course_id;
        foreach ($teacher_ids as $key => $value) {
            $in["teacher_id"] = $value;
            $this->use_class->add($in);
        }
    }


}