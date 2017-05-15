<?php
		$teacher_info = $this->teacher_mobile_qx(); 
        $teacher_name = $teacher_info['teacher_realname'];
        $page_title   = '打卡记录';
        //最近七天
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
        //开始记录查找
        $class_card   = D('card');
        $in_result    = $class_card->teacherRecord($arr,$teacher_info['teacher_id'],'in');
        $out_result   = $class_card->teacherRecord($arr,$teacher_info['teacher_id'],'out');
        $other_result = $class_card->teacherRecord($arr,$teacher_info['teacher_id'],'other');
        //遍历加看体温
        $g = 0;
        if($in_result){
            foreach ($in_result as $key => $value) {
                $sign_temp[$g++] = $value['signTemp'];
                $g++;
            }
        }
        if($out_result){
            foreach ($out_result as $key => $value) {
                $sign_temp[$g++] = $value['signTemp'];
                $g++;
            }
        }
        if($other_result){
            foreach ($other_result as $key => $value) {
                $sign_temp[$g++] = $value['signTemp'];
                $g++;
            }
        }
        $sign_average_temp = C('cardRecord')->averageTemp($sign_temp);
        