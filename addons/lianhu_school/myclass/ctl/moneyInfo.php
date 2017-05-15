<?php 
namespace myclass\ctl;

class moneyInfo extends common{
    
    public function __construct(){
        $this->use_class = D('moneyInfo');
    }
    //根据缴费处理
    public function deMoney($money_record_id){
        $money_record_info = D('moneyRecord')->edit(array("record_id"=>$money_record_id));
        if($money_record_info){
            $money_info    = $this->use_class->edit(array('id'=>$money_record_info['money_info_id']));
            if($money_info){
                if($money_info['from_table']=='lianhu_course_scan'){
                    $info = C("courseScan")->edit($money_info['from_id']);
                }
            }
        }
        return $info;
    }
    //独立课程收费
    public function lianhu_course_scan($money_info){
        $course_info       =  C('courseScan')->edit($money_info['from_id']);
        $arr['student_id'] = $money_info['student_id'];
        $arr['course_id']  = $money_info['from_id'];
        $arr['use_num']    = $course_info['nums'];
        C('courseStudent')->add($arr);
    }
    


}