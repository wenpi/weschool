<?php 
    $ac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($ac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
	$student_info = $this->mobile_from_find_student();
    $title        = '围栏详情';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    //
    $not_access   = array(
        "我家",
        "学校",
        "危险区",
        "网吧",
        "游戏厅",
    );
    $id   = $_GPC['id']; 
    $info = $class_action->fencingInfo($id,$card_re['id']);
    if($info){
        $desc = explode(",",$info['desc']);
        $page_title = $info['fencingName'].'-详细信息';
        if($_GPC['submit']  && $_GPC['token'] == $_COOKIE['form_token']  ){
            $in['fencing_id']   = $id;
            $in['lat']          = $_GPC['lat'];
            $in['lng']          = $_GPC['lng'];
            $in['fencingName']  = $_GPC['fencingName'];
            $in['radius']       = $_GPC['radius'];
            $in['noticeMan']    = $_GPC['noticeMan'];
            $in['alarmType']    = $_GPC['alarmType'];
            $result = $class_action->updateFencing($in,$card_re['id']);
            if($result['result']['code']==0){
                $this->myMessage("更新围栏成功",$this->createMobileUrl("funcstudent_fencing"),"成功");
            }else{
                $this->myMessage("失败".$result['result']['msg'],$this->createMobileUrl("funcstudent_fencing"),"错误");
            }
        }
    }

