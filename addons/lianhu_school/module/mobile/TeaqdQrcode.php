<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info = $this->teacher_mobile_qx();
    //
    $params["activity_id"] = $_GPC['id'];
    $params["teacher_id"]  = $teacher_info['teacher_id'];
    $result = D("qdActivity")->edit($params);
    if($result && $result['endtime']>TIMESTAMP ){
        $url = $this->createMobileUrl('scanTeaQd',array('id'=>$result['activity_id']));
        $base_dir      = $this->insertDir();
        $file_name     = $base_dir.time().rand(111111,999999).'.png';
        QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);
        
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
    }elseif($result['endtime']<TIMESTAMP){
        $this->myMessage("该签到活动已经过期!",$this->createMobileUrl("teaqd"),'错误');  
    }else{
        $this->myMessage("未找到改签到活动",$this->createMobileUrl("teaqd"),'错误');
    }
