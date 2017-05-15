<?php 
namespace myclass\ctl;

class course extends common{
    
    public function __construct(){
        $this->use_class = D('course');
    }
     //获取一个年级所有的课程
    public function getGradeAllCourse($grade_id){
        $where[":grade_id"]     = $grade_id;
        $where[":status"]       = 1;
        D("classes")->each_page = 1000;
        $re   = D("classes")->getList($where);
        $list = $re['list'];
        $new_course_ids = array();

        foreach ($list as $key => $value) {
            $course_ids = unserialize($value['course_ids']);
            if($course_ids){
                foreach ($course_ids as $key => $value) {
                    if($value && !in_array($value,$new_course_ids)){
                        $new_course_ids[] = $value;
                    }
                }
            }
        } 
        //过滤
        foreach ($new_course_ids as $key => $value) {
            $alone_where["course_id"] = $value;
            $result =  $this->use_class->edit($alone_where);
            $course_list[] = $result;
        }
        return $course_list;
    }   
}