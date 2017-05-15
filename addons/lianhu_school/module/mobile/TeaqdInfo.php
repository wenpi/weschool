<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info  = $this->teacher_mobile_qx();
    //
    $params["activity_id"] = $_GPC['id'];
    $params["teacher_id"]  = $teacher_info['teacher_id'];
    $result = D("qdActivity")->edit($params);
    if($result){
        $student_ids  = explode(',',$result['student_ids']);
        $class_ids    = explode(',',$result['class_ids']);
        $where[":activity_id"]   = $result['activity_id'];
        D("qdPerson")->each_page = 100000;
        //所有的
        $scan_re  = D("qdPerson")->getList($where);
        $allcount = count($student_ids);
        D("student")->each_page = 10000;
        foreach ($class_ids as $key => $value) {
            $where[":class_id"] = $value;
            $class_re           = D("qdPerson")->getList($where);
            $class_listre[$value]['scan'] = $class_re['count'];
            $re = D("student")->getList(array(":class_id"=>$value));     
            $class_listre[$value]['all']    = $re['count'];
            $class_listre[$value]['student'] = $re['list'];
            $class_listre[$value]['lv']   = substr( $class_listre[$value]['scan']/$class_listre[$value]['all'],0,2 )."%";
            $class_listre[$value]['info'] = D("classes")->edit(array("class_id"=>$value));
        }
    }else{
        $this->myMessage("未找到改签到活动",$this->createMobileUrl("teaqd"),'错误');
    }
    