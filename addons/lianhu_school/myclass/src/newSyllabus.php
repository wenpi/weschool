<?php 
namespace myclass\src;

class newSyllabus extends common{
    public $syllabus_id    = 'syllabus_id';
    public $class_id       = 'class_id';
    public $teacher_id     = 'teacher_id';
    public $course_id      = 'course_id';
    public $course_special = 'course_special';
    public $tea_room_id    = 'tea_room_id';
    public $week_sort      = 'week_sort';
    public $day_sort       = 'day_sort';
    public $status         = 'status';
    public $url            = 'url';

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_new_syllabus');
    }
    //获取一个教师
    public function getTeacherSyllabus($teacher_id,$week){
        $where[":teacher_id"] = $teacher_id;
        $where[":week_sort"]  = $week;
        $this->each_page      = 1000;
        $re = $this->getList($where);
        return $re['list'];
    }

    public function getClassSyllabusInfo($class_id,$week,$day_sort){
        $where["class_id"]  = $class_id;
        $where["week_sort"] = $week;
        $where["day_sort"]  = $day_sort;
        $result             = $this->edit($where);
        return $result;
    }
    public function getClassSyllabus($class_id,$week_sort=false){
        $where[":class_id"] = $class_id;
        $where[":status"]   = 1;
        if(!$week_sort){
            $where[":week_sort"] = $week_sort;
        }
        $this->each_page    = 1000;
        $re = $this->getList($where);
        return $re['list'];
    }
    //旧数据到新表
    public function oldToNew($school_info){
        $result = $this->edit(array("syllabus_id"=>array(">",0)));
        if($result){
            return false;
        }
        $where[":school_id"] = getSchoolId();
        $table_name = tablename("lianhu_syllabus");
        $list       = pdo_fetchall("select * from ( select * from ".$table_name." where school_id=:school_id  order by addtime desc ) ".$table_name." group by class_id ",$where);
        foreach ($list as $key => $value) {
            $content = unserialize($value['content']);
            $this->decodeContent($school_info,$value['class_id'],$value['url'],$content);
        }
    }
    //解析content 
    public function decodeContent($school_info,$class_id,$url,$content){
            $on_school    = $school_info['on_school'];
            $begin_day    = $school_info['begin_day'];
            $am_much      = $school_info['am_much'];
            $pm_much      = $school_info['pm_much'];
            $ye_much      = $school_info['ye_much'];
            $base_in['class_id'] = $class_id;
            if($url){
                $base_in['url'] = $url;
                $this->add($base_in);
                return false;
            }
            foreach ($content['am'] as $k => $v) {
                $base_in["week_sort"] = $begin_day+$k-1;
                foreach ($v as $g => $row) {
                    $in = $base_in;
                    $in['day_sort'] = $g;
                    if($row=='放学'|| $row=='休息'){
                        $in['course_special'] = 2;
                    }elseif($row=='自习'){
                        $in['course_special'] = 1;
                    }else{
                        $in['course_id']    = D("course")->courseNameToCourseId($row);
                    }
                    $in['teacher_id']   = $content['teacher_am'][$k][$g];
                    $this->add($in);
                }
                foreach ($content['pm'][$k] as $g => $row) {
                    $in = $base_in;
                    $in['day_sort']     = $g+$am_much;
                    if($row=='放学'|| $row=='休息'){
                        $in['course_special'] = 2;
                    }elseif($row=='自习'){
                        $in['course_special'] = 1;
                    }else{
                        $in['course_id']    = D("course")->courseNameToCourseId($row);
                    }
                    $in['teacher_id']   = $content['teacher_pm'][$k][$g];
                    $this->add($in);                  
                }
                foreach ($content['ye'][$k] as $g => $row) {
                    $in = $base_in;
                    $in['day_sort']     = $g+$am_much+$pm_much;
                    if($row=='放学'|| $row=='休息'){
                        $in['course_special'] = 2;
                    }elseif($row=='自习'){
                        $in['course_special'] = 1;
                    }else{
                        $in['course_id']    = D("course")->courseNameToCourseId($row);
                    }
                    $in['teacher_id']   = $content['teacher_ye'][$k][$g];
                    $this->add($in);                  
                }                
            }
    }

}