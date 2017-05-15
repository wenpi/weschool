<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info  = $this->teacher_mobile_qx();
    $result        = $this->teacher_standard('no');

    //teacher
    if(  $_GPC['token'] == $_COOKIE['form_token']  ){
        if($_POST['class_list']){
            $in['teacher_id']       = $teacher_info['teacher_id'];
            $in['db_admin_id']      = getDbAdminId();
            $in['activity_name']    = $_GPC['activity_name'];
            $in['activity_address'] = $_GPC['activity_address'];
            $in["class_ids"]        = implode(",",$_POST['class_list']);
            $student_list           = pdo_fetchall("select * from ".tablename("lianhu_student")." where class_id in(".$in["class_ids"].") and status=1  ");				
            foreach ($student_list as $key => $value) {
                $student_ids[] = $value['student_id'];
            }            
            $in["student_ids"]      = implode(',',$student_ids);
            $in['student_teacher']  = 1;
            $in["endtime"]          = time()+60*$_GPC['endtime'];
            D("qdActivity")->add($in);
            $this->myMessage("添加签到活动成功",$this->createMobileUrl("Teaqd"),"成功");
        }else{
            $this->myMessage("请选择参加签到的班级",$this->createMobileUrl("TeaqdAdd"),"错误");
        }

    }

