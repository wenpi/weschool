<?php
    $student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
    $page_title   = '校内位置';
    //最近七天
    $g = 0;
    $in_time = $_GPC['time'] ? $_GPC['time']:time();
    $begin   = $_GPC['time'] ? 0:6;
    for ($i=$begin; $i >=0 ; $i--) { 
            $time_str = $in_time-24*3600*$i;
            $data_list[$g]['date']   = date("m/d",$time_str);
            $data_list[$g]['date_d'] = date("d",$time_str);
            $data_list[$g]['week']   = date("w",$time_str);
            if($data_list[$g]['week']==0)
                $data_list[$g]['week'] = '日';
            if(!$_GPC['week']){
                if($i==0){
                    $data_list[$g]['class']='font_yellow';
                    $data_list[$g]['class_n']='p3';
                    list($get_year,$get_month,$get_day) = explode('-',date("Y-m-d",$time_str) );
                }
            }else{
                if($_GPC['week']== $data_list[$g]['week']){
                    $data_list[$g]['class']='font_yellow';
                    $data_list[$g]['class_n']='p3';
                    list($get_year,$get_month,$get_day) = explode('-',date("Y-m-d",$time_str) );
                }
            }
            $g++;
    }
    $arr                     = array('year'=>$get_year,'month'=>$get_month,'date'=>$get_day);
    $class_locus             = C('locus');
    $class_locus->student_id = $student_info['student_id'];
    $class_locus->year       = $arr['year'];
    $class_locus->month      = $arr['month'];
    $class_locus->date       = $arr['date'];
    $re         = $class_locus->getStudentLocus();
    $locus_list = $class_locus->decodeLocus($re['locus_info']);