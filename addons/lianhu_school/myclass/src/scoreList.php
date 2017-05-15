<?php 
namespace myclass\src;
class scoreList extends common{
    public $scorelist_id = 'scorelist_id';
    public $course_name  = 'course_name';
    public $course_id    = 'course_id';
    public $teacher_name = 'teacher_name';
    public $teacher_id   = 'teacher_id';
    public $class_name   = 'class_name';
    public $class_id     = 'class_id';
    public $student_name = 'student_name';
    public $student_id   = 'student_id';
    public $score        = 'score';
    public $ji_lv_id     = 'ji_lv_id';
    public $uid          = 'uid';
    public $grade_id     = 'grade_id';

    public function __construct(){
        $this->setTable('lianhu_scorelist');
        $this->setGlobal();
    }   
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }
    //个人成绩总和
    public function sumScore(){ 
        $params[":ji_lv_id"]    = $this->ji_lv_id;
        $params[":student_id"]  = $this->student_id;
        $where_str              = S("fun","composeParamsToWhere",array($params));
		$all_score              = pdo_fetchcolumn("select sum(score) num from ".$this->table." where  ".$where_str,$params);
        return $all_score;
    }
    //所有排名
    public function getAllSumScore(){
        $params[":ji_lv_id"]    = $this->ji_lv_id;
        $where_str              = S("fun","composeParamsToWhere",array($params));
        $paiming                = pdo_fetchall("select student_id ,sum(score) num from ".$this->table." where ".$where_str." group by student_id order by num desc ",$params);
        return $paiming;
    }    
    //获取一个考试一个科目的分
    public function getCourseScore(){
        $params[":course_id"]   = $this->course_id;
        $params[":ji_lv_id"]    = $this->ji_lv_id;
        $this->each_page        = 100000;
        $re = $this->getList($params);
        return $re;
    }
}