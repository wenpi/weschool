<?php 
namespace myclass\ctl;

class courseScan extends common{
    public $class_id;
    public $status=0;
    public $search_name;


    public function __construct(){
        $this->use_class = D('courseScan');
    }

    public function getList($page=1){
        if($this->class_id){
            $params[":class_id"] = $this->class_id;
        }
        if($this->status){
            $status = $this->status == 10 ? 0:$this->status;
            $params[":status"]      = $status;
        }else{
            $params[":status"]      = array("!=","-1");
        }
        if($this->search_name){
            $params[":course_name"] = array("like","%".$this->search_name."%");
        }
        $re = $this->use_class->getList($params,false,$page);
        foreach ($re['list'] as $key => $value) {
            $re['list'][$key]['class_name'] = C('courseClass')->className($value['class_id']);
        }
        return $re;
    }
    //编辑
    public function edit($course_id){
        $where["course_id"] = $course_id;
        $re = $this->use_class->edit($where);
        return $re;
    }
    //删除
    public function delete($course_id){
        $where["course_id"] = $course_id;
        $up["status"]       = -1;
        $re = $this->use_class->edit($where,$up);
        return $re;
    }
    //独立课程的Info记录
    public function moneyInfoList($course_id){
        $params[":from_id"]     = $course_id;
        $params[":from_table"]  = "lianhu_course_scan";
        D("moneyInfo")->each_page = 100000;
        $re   = D("moneyInfo")->getList($params);
        $list = $re['list'];
        return $list;
    }
    //独立课程的结算记录
    public function moneyEndList($course_id){
        $info_list = $this->moneyInfoList($course_id);
        if(!$info_list){
            return false;
        }
        foreach ($info_list as $key => $value) {
            $where["money_info_id"] = $value['id'];
            $re     = D("moneyRecord")->edit($where);
            $re['student_name'] = D("student")->getStudentName($re['student_id']);
            $re['grade_info']   = D("grade")->getGradeInfo($re['grade_id']);
            $re['class_name']   = D("classes")->className($re['class_id']);
            $list[] = $re;
        }
        return $list;
    }

}