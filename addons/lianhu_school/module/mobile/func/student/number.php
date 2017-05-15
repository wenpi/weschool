<?php 
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();

	$student_info = $this->mobile_from_find_student();
    $title        = '电子学生证';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    $page_title   = '亲情号码列表';

    if($_GPC['submit']  && $_GPC['token'] == $_COOKIE['form_token']  ){
            $result = $class_action->fixQinQing($_GPC['userName'],$_GPC['telNumber'],$card_re['id']); 
            if($result['result']['code']==0){
                $this->myMessage("编辑成功",$this->createMobileUrl("funcstudent_number"),"成功");
            }else{
                $this->myMessage("失败".$result['result']['msg'],$this->createMobileUrl("funcstudent_number"),"错误");
            }            
    }
    $list = $class_action->numberList($card_re['id']);
    $list = $list['telBooks'];
    $list = sortArr($list,'Index','min');