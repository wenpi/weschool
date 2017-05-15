<?php 
	$student_info = $this->mobile_from_find_student();
    $title        = '电子学生证';
    $student_name = $student_info['student_name'];
    $card_re      = Au("studentCard/login")->findByStudent($student_info['student_id']);
    $class_action = Au("studentCard/action");
    if($ac=='list'){
        $href = $this->createMobileUrl("funcstudent_card",array("ac"=>'his'));
        $icon = "ion-map";
        $page_title   =  "孩子位置-点击头像看详情";
        if($card_re){
            $now_local = $class_action->getNewLocation($card_re['id']);
            $result    = $now_local['track'];
            if($result){
                if($result["StaySecond"]){
                    $speed = "静止：".$result["StaySecond"].'秒';
                }else{
                    $speed = '运动';
                }
                $local = $result["IsGps"] ==1 ? "gps定位":"基站定位";
                $status= $result["OnlineStatus"]==0 ? "关机了":"电子学生证和平台通讯中";
                $time_date = date("Y-m-d H:i:s",$result["PositionTime"]/1000);
            }
        }

    }else{
        $href = $this->createMobileUrl("funcstudent_card");
        $icon = "ion-ios-location";
        $time_date = $_GPC['time_date'];
        if($time_date){
            $time_unix = strtotime($time_date);
            $time_date = date("Y-m-d",$time_unix);
            $year      = date("Y",$time_unix);
            if($year<2017){
                $time_date = 0;
            }
            if($time_unix>time()){
                $time_date = 0;
            }
        }
        if(!$time_date){
            $time_date = date("Y-m-d",time());
        }
        $in_time    = strtotime($time_date);
        $page_title =  "孩子运动轨迹[".$time_date."]";
        $list = $class_action->getTimeDateHis($card_re['id'],$time_date);
        if(!$list){
             $now_local = $class_action->getNewLocation($card_re['id']);
             $result   = $now_local['track'];
             $result['Address'] = $result["Address"]."<span style='color:#ff0033'><br>当日无轨迹，展现当前位置!</span>";
             if($result){
                    if($result["StaySecond"]){
                        $speed = "静止：".$$result["StaySecond"].'秒';
                    }else{
                        $speed = '运动';
                    }
                    $local = $result["IsGps"] ==1 ? "gps定位":"基站定位";
                    $status= $result["OnlineStatus"]==0 ? "关机了":"电子学生证和平台通讯中";
                    $time_date = date("Y-m-d H:i:s",$result["PositionTime"]/1000);
                }

        }
    }



    