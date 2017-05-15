<?php 
     $student_info  = $this->teacher_mobile_qx();
     $student_name  = $student_info['teacher_realname'];
     $device_id     = $_GPC['id'];
     if($device_id){
         $device_info   = C('device')->use_class->edit(array('device_id'=>$device_id,'school_id'=>$this->school_info['school_id']));
         if(!$device_info){
             exit();
         }
     }
     $page_title      = $device_info['device_name'].'今日行驶轨迹';
     $class_schoolBus = C('schoolBus');
     $class_schoolBus->device_id  = $device_id;
     $class_schoolBus->begin_time = strtotime(date("Y-m-d",time())) ;
     $class_schoolBus->end_time   = $class_schoolBus->begin_time+3600*24;
     $list           = $class_schoolBus->timeOrbit();
     

