<?php 
namespace myclass\ctl;

class cookbook extends common{
    public $day_nums = 21;
    
    public function __construct(){
        $this->use_class = D('cookbook');
    }
    //餐时间段分为三段
    public function timeToThree(){
        $yu       = $this->day_nums%3;
        $day_nums = $this->day_nums-$yu;
        $each     = $day_nums/3;
        for($e =1;$e<=3;$e++){
            $begin = ($e-1)*$each;
            $end   = $e*$each;
            $g     = 0;
            for ($begin; $begin < $end ; $begin++) {
                $begins = $begin-$each; 
                $unix                              = strtotime('+'.$begins.'days');
                $out_times['list'][$e][$g]['date'] = date("Y-m-d",$unix);
                $out_times['list'][$e][$g]['unix'] = strtotime($out_times['list'][$e][$g]['date']); 
                $out_times['list'][$e][$g]['date'] = date("m.d",$unix);
                if($g==0){
                    $out_times['duan'][$e]['begin_date'] = $out_times['list'][$e][$g]['date'];
                    $out_times['duan'][$e]['begin_unix'] = $out_times['list'][$e][$g]['unix'];
                }elseif($g==($each-1)){
                    $out_times['duan'][$e]['end_date']   = $out_times['list'][$e][$g]['date'];
                    $out_times['duan'][$e]['end_unix']   = $out_times['list'][$e][$g]['unix'];
                }
                $g++;     
            }            
        }
        foreach ($out_times['list'] as $key => $value) {
            foreach ($value as $k => $val) {
                $w = date("w",$val['unix']);
                if( $w==0 || $w==6 ){
                    unset($out_times['list'][$key][$k]);
                }
            }
        }
        return $out_times;
    }
    //餐分类
    public function cookbookCLass(){
        $school_id          = getSchoolId();
        $cookbook_class     = S('system','getSetContent',array('cookbook_class',$school_id));
        $cookbook_class     = str_ireplace(' ','',$cookbook_class);
        $cookbook_class_arr = explode('||',$cookbook_class);       
        return $cookbook_class_arr;
    }
    public function getTimeList(){
        $out_times = array();
        for($i=0;$i<$this->day_nums;$i++){
            $out_times[$i]['unix'] = strtotime('+'.$i.'days');
            $out_times[$i]['date'] = date("Y-m-d",$out_times[$i]['unix']);
            $out_times[$i]['unix'] = strtotime($out_times[$i]['date']);
        }
        return $out_times;
    }

    //getcookbook
    public function getCookbook($type,$date){
        $where["class_name"]    = $type;
        $where["use_time"]      = $date;
        $where['xiaoye']        = 1;
        $this->use_class->field_str = '*';
        $result                 = $this->use_class->edit($where);
        return $result;
    }
    public function getCookbookText($type,$date){
        $re = $this->getCookbook($type,$date);
        return $re['cookbooK_breakfast'];
    }
    public function getCookbookImg($type,$date){
        $re = $this->getCookbook($type,$date);
        if($re['imgs']){
            return explode(',',$re['imgs']);
        }
    }    
    //获取今日的伙食
    public function getToday(){
        $time_unix = time();
         $w = date("w",$time_unix);
         if($w==6){
            $begin_time = $time_unix+3600*24*2; 
         }elseif($w==0){
             $begin_time= $time_unix+3600*24;
         }else{
             $begin_time= $time_unix;
         }
         $use_time = strtotime(date("Y-m-d",$begin_time));
         $params[":use_time"] = $use_time;
         $params[":school_id"]= getSchoolId();
         $params[":xiaoye"]   = 1;
         $re = $this->use_class->getList($params);
         return $re['list'];
    }


}