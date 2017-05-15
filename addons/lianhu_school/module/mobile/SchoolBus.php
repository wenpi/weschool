<?php
    $in_type            = $this->judePortType();
    $class_cardRecord   = C('cardRecord');
    $class_schoolBus    = C('schoolBus');
    
    if($in_type['type'] == 'student'){
        $student_name   = $in_type['info']['student_name'];
        //最后一次打卡
        $class_cardRecord->student_id = $in_type['info']['student_id'];
        $result         = $class_cardRecord->studentTodayLastSchoolBus();
        if($result){
            $class_schoolBus->device_id = $result['device_id'];
            if($result['add_time']>strtotime(date("Y-m-d",time()).' 12:00')){
                $list = $class_schoolBus->toDaySend();
            }else{
                $list = $class_schoolBus->toDayJoin();
            }
        }else{
            $this->myMessage("抱歉未有上校车记录",$this->createMobileUrl('home'),'提示');
        }
    }else{
        $student_name       = $in_type['info']['teacher_realname'];
    }
    $page_title             = '校车轨迹';
