<?php 
namespace myclass\src;

class time{
    public $year;
    public $month;

    public $week_num = array(
        '1'=>'一',
        '2'=>'二',
        '3'=>'三',
        '4'=>'四',
        '5'=>'五',
        '6'=>'六',
        '0'=>'日',
    );
    
    public function getWeekChina($in){
        return $this->week_num[$in];
    }
    //最近十周
    //周一到周日
    public static function getLastWeeks(){
        for($i=6;$i>=1;$i--){
            $times[$i]['begin'] =  date("Y/m/d",strtotime("-".$i." week Monday"));
            $g = $i-1;
            $times[$i]['end']   =  date("Y/m/d",strtotime("-".$g." week Sunday"));
        }
        return $times;
    }
    //最近七天
    public static function getLastDays(){
        $time = time();
        for($i=6;$i>=0;$i--){
            $times[$i] = date("Y/m/d",strtotime("-".$i." days"));
        }
        return $times;
    }
    //起始17年
    //最近年份列表
    public static function getYearList(){
        $begin_year = '2017';
        $begin_time = strtotime($begin_year.'-01-01');
        $now_year   = date("Y");
        $count      = $now_year-$begin_year;
        if($count>0){
            for ($i=0; $i <= $count ; $i++) { 
                $year       = $begin_year+$i;
                $out_list[] = strtotime($year);
            }
        }else{
            $out_list[] = $begin_time;
        }
        return $out_list;
    }

}