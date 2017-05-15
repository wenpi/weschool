<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();

	$student_info = $this->mobile_from_find_student();
    $title        = '远程监控';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    $page_title   = '选择监听的手机号';
    if($ac=='listen'  ){
            $key    = $_GPC['key']+1;
            $result = $class_action->longListen($key,$card_re['id']); 
            if($result['result']['code']==0){
                $this->myMessage("操作成功，请稍等,5分钟内会拨打电话！",$this->createMobileUrl("funcstudent_listen"),"成功");
            }else{
                $this->myMessage("失败".$result['result']['msg'],$this->createMobileUrl("funcstudent_listen"),"错误");
            }            
    }   
    $list = $class_action->numberList($card_re['id']);
    $list = $list['telBooks'];
    $list = sortArr($list,'Index','min');   