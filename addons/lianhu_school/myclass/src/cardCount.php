<?php 
namespace myclass\src;

class cardCount extends common{
    public $year;
    public $month;
    public $day;
    public $up_low;
    public $student_id;
    public $teacher_id;

    public $add_in;

    public function __construct(){
        $this->setTable('lianhu_card_count');
        $this->setGlobal();   
    }

    public function find($time_arr){
        $where["year"]   = $time_arr['year'];
        $where["month"]  = $time_arr['month'];
        $where["day"]    = $time_arr['day'];
        $where["up_low"] = $time_arr['up_low'];
        if($time_arr['student']){
            $where["student_id"] = array("!=",0);
        }elseif($time_arr['teacher']){
            $where["teacher_id"] = array("!=",0);
        }

        $where["school_id"] = $this->school_id;
        $this->add_in       = $where;
        $result = $this->edit($where);
        return $result['people_count'];
    }
    
    public function dataAdd($people_count){
        $arr = $this->add_in;
        if($arr['student_id']){
            $arr['student_id'] = 1;
        }
        if($arr['teacher_id']){
            $arr['teacher_id'] = 1;
        }
        $arr["people_count"] = $people_count;
        $this->add($arr);
    }


}