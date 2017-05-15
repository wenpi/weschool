<?php
    $ac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($ac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();

	$student_info = $this->mobile_from_find_student();
    $title        = '电子学生证';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    $now_local = $class_action->getNewLocation($card_re['id']);
    $result    = $now_local['track'];
    if($_GPC['submit']  && $_GPC['token'] == $_COOKIE['form_token']  ){
            $in['lat']          = $_GPC['lat'];
            $in['lng']          = $_GPC['lng'];
            $in['fencingName']  = $_GPC['fencingName'];
            $in['radius']       = $_GPC['radius'];
            $in['noticeMan']    = $_GPC['noticeMan'];
            $in['alarmType']    = $_GPC['alarmType'];
            $result = $class_action->addFencing($in,$card_re['id']);
            if($result['result']['code']==0){
                $class_action->syncFencing($card_re['id']);
                $this->myMessage("新增围栏成功",$this->createMobileUrl("funcstudent_fencing"),"成功");
            }else{
                $this->myMessage("失败".$result['result']['msg'],$this->createMobileUrl("funcstudent_fencing"),"错误");
            }            
    }
