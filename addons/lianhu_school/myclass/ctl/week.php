<?php 
namespace myclass\ctl;

class week {
    public $weeks = array(
        '0'=>'日',
        '1'=>'一',
        '2'=>'二',
        '3'=>'三',
        '4'=>'四',
        '5'=>'五',
        '6'=>'六',
    );
    public $date_num = array(
        '1'=>'一',
        '2'=>'二',
        '3'=>'三',
        '4'=>'四',
        '5'=>'五',
        '6'=>'六',
        '7'=>'七',
        '8'=>'八',
        '9'=>'九',
        '10'=>'十',
        '11'=>'十一',
        '12'=>'十二',
    );
    public $today_week;
    
    //今天周几
    public function __construct(){
        $week  = date("w"); 
        $week  = $week==0?7:$week;
        $this->today_week= $week;
    }
    //该学校上课的周
    public function inSchoolWeeks($on_school,$begin){
        global $_GPC;
        $week 	  = $_GPC['week'];
        $now_week = $week ? $week :$this->today_week;
        $g = 1;
        while($g <= $on_school){
                if($begin){
                    $begin_week = $begin+$g-1;
                }else{	
                    $begin_week = $g;
                }
                if($now_week==$begin_week){
                    $have_week = true;
                }
                $out_weeks[] = $begin_week;
                $g++;
        }
        return array('weeks'=>$out_weeks,'have_week'=>$have_week,'now_week'=>$now_week);
    }
    public function timeToWeek($time){
       $n =  date("w",$time);
       $g=0;
       for($i=0;$i<$n;$i++){
           $out_time[$g]['week'] = $this->weeks[$i];
           $out_time[$g]['time'] = $time-($n-$i)*24*3600;
           $g++;
       }
       for($w=$n;$w<=6;$w++){
           $out_time[$g]['week'] = $this->weeks[$w];
           $out_time[$g]['time'] = $time+($w-$n)*24*3600;
           $g++;
       }
       return $out_time;
    }

}