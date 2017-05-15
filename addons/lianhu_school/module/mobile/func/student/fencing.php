<?php 
	$student_info = $this->mobile_from_find_student();
    $title        = '电子学生证';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    //
    if($ac=='list'){
        $list = $class_action->fencingList($card_re['id']);
        if($list){
            $page_title = "电子围栏列表";
        }else{
            $this->myMessage("没有获取成功",$this->createMobileUrl("home"),'错误');
        }
    }
    if(count($list)<50){
        $href = $this->createMobileUrl("funcstudent_fencingAdd");
        $icon = "ion-ios-plus-outline";
    }
    if($ac=='delete' && $_GPC['id']){
        $class_action->deleteFencing($card_re['id'],$_GPC['id']);
        $this->myMessage("删除成功",$this->createMobileUrl("funcstudent_fencing"),'成功');
    }
    $result = $class_action->syncFencing($card_re['id']);