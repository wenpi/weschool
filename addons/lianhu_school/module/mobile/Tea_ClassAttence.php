<?php 
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '班级考勤';
    $class_card   = D('card');
    $class_student= D('student');
    $id           = $_GPC['class_id'];
    $class_student->_set('class_id',$id);
    $student_list = $class_student->getClassStudentList();
    $time_date    = $_GPC['time_date'] ? $_GPC['time_date'] : date("Y-m-d",time());
    $class_card->in_time = strtotime($time_date);
    $time_date    = date("Y-m-d",$class_card->in_time);
    list($get_year,$get_month,$get_day) = explode("-",$time_date);
    $time         = array('year'=>$get_year,'month'=>$get_month,'day'=>$get_day);  
    if($ac=='ajax'){
        $arr['student_id'] = $_GPC['student_id'];
        $arr['up_low']     = $_GPC['typein'];
        $arr['up_low']     = $arr['up_low']=='up'?1:2;
        $arr["add_teacher_id"] = $teacher_info['teacher_id'];
        $arr["teacher_add"]    = 1;
        $arr["play_card_time"] = $class_card->in_time;
        $class_card->addCardRecord($arr);
        outJson(array("errcode"=>0));
    }
    foreach ($student_list as $key => $value) {
            $up    = $class_card->studentRecord($time,$value['student_id'],'in');
            $low   = $class_card->studentRecord($time,$value['student_id'],'out');        
            $other = $class_card->studentRecord($time,$value['student_id'],'other');   
            if($up) {
                if($up[0]['teacher_add']==1){
                    $student_list[$key]['up']    = '教补';
                }else{
                    $student_list[$key]['up']    = date("H:i",$up[0]['play_card_time']);   
                }
            }else{
                $student_list[$key]['up']    = '<span class="add_record" data-type="up" data-id="'.$value['student_id'].'">补</span>';
            }
            if($low){
                if($low[0]['teacher_add']==1){
                    $student_list[$key]['low']    = '教补';
                }else{
                    $student_list[$key]['low']    = date("H:i",$low[0]['play_card_time']);   
                }
            }else{
                $student_list[$key]['low']   = '<span class="add_record"  data-type="low" data-id="'.$value['student_id'].'">补</span>';
            }
            if($other){
                $student_list[$key]['other'] = date("H:i",$other[0]['play_card_time']);   
            }else{
                $student_list[$key]['other'] = '无';
            }
    }