<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();

	$student_info = $this->mobile_from_find_student();
    $title        = '卡片状态';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    $page_title   = '查看修改';
    if($ac=='list'){
            $now_local = $class_action->getNewLocation($card_re['id']);
            $result    = $now_local['track'];
            if($result){
                if($result["StaySecond"]){
                    $speed = "静止：".$result["StaySecond"].'秒';
                }else{
                    $speed = '运动';
                }
                $local      = $result["IsGps"] ==1 ? "gps定位":"基站定位";
                $status     = $result["OnlineStatus"]==0 ? "关机了":"电子学生证和平台通讯中";
                $time_date  = date("Y-m-d H:i:s",$result["PositionTime"]/1000);
            }
            //话费
            $huafei_re = $class_action->getHuaFei($card_re['id']);  
            //上课禁用
            $class_action->syncTerminalParam($card_re['id']);
            $ext = $class_action->getTerminalExt($card_re['id']);
    }
    if($ac == 'close'){
        $result = $class_action->takeOff($card_re['id']);
        if($result['result']['code']==0){
            $this->myMessage("请稍等，关机中！",$this->createMobileUrl("funcstudent_status"),"成功");
        }
    }
    if($ac=='studyForbidden'){
            $result              = pdo_fetch("select * from ".tablename("lianhu_set")." where keyword='course_time' and school_id=:school_id order by set_id  desc ",array(":school_id"=>$this->school_info['school_id']));
            $result['content']   = unserialize($result['content']);
            $result['begin_time']= $result['content']['begin_time'];
            $result['end_time']  = $result['content']['end_time'];
            $on_school           = $this->school_info['on_school'];
            for($i=0;$i<7;$i++){
                if($i>=$on_school){
                    $result['begin_time'] = 0;
                }
                for($g=0;$g<8;$g++){
                    if($result['begin_time'][$g]&& $result['end_time'][$g]){
                        $on_begin_end[] = $result['begin_time'][$g].'-'.$result['end_time'][$g];
                    }else{
                        $on_begin_end[] = '00:00-00:00';
                    }
                }
            }

            if($_GPC['studyForbidden']==1){
                $class_action->updateTerminalExt($card_re['id'],$on_begin_end,0);
            }else{
                $class_action->updateTerminalExt($card_re['id'],$on_begin_end,1);
            }
            $this->myMessage("设置成功",$this->createMobileUrl("funcstudent_status"),"成功");
    }



