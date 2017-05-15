<?php
    $student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
    $page_title   = '打卡记录';
    if($_GPC['time_date']){
        $use_time = strtotime($_GPC['time_date']);
    }else{
        $use_time = time();
    }
    $in_time  = $_GPC['time'] ? $_GPC['time']:$use_time;
    $begin    = $_GPC['time'] ? 0:6;
    $out_time = C("week")->timeToWeek($in_time);
    
    list($get_year,$get_month,$get_day) = explode('-',date("Y-m-d",$in_time) );
    
    $arr          = array('year'=>$get_year,'month'=>$get_month,'day'=>$get_day);
    $class_card   = D('card');
    $in_result    = $class_card->studentRecord($arr,$student_info['student_id'],'in');
    $out_result   = $class_card->studentRecord($arr,$student_info['student_id'],'out');
    $other_result = $class_card->studentRecord($arr,$student_info['student_id'],'other');
    //遍历加 体温，算出平均体温
    $g = 0;
    if($in_result){
        foreach ($in_result as $key => $value) {
            $sign_temp[$g] = $value['signTemp'];
            $list[$g]        = $value;
            $g++;
        }
    }
    if($out_result){
        foreach ($out_result as $key => $value) {
            $sign_temp[$g] = $value['signTemp'];
            $list[$g]        = $value;
            $g++;
        }
    }
    if($other_result){
        foreach ($other_result as $key => $value) {
            $sign_temp[$g] = $value['signTemp'];
            $list[$g]          = $value;
            $g++;
        }
    }
    //排序
    $list = sortArr($list,'add_time','max');
    $sign_average_temp = C('cardRecord')->averageTemp($sign_temp);
