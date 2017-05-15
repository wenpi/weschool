<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $student_name       = $school_admin['info']['admin_name'];
    $mid           = $_GPC['mid'];
    $class_message = D("message");
    $message_info  = $class_message->getMessageInfo($mid);
    if($ac=='list'){
        $title         = $page_title         = $message_info['title'].'校长信箱';
        $handle_list   = $class_message->getMessageHandle($mid);
    }else{
        $message_id = $mid;
        $content    = $_GPC['content'];
        if(!$message_id ||!$content){
            outJson(array('errcode'=>1,'msg'=>'传递错误'));
        }else{
            $arr['message_id'] = $message_id;
            $arr['admin_uid'] = $uid;
            $arr['send_uid']  = $uid;
            $arr['content']	  = $content;
            $arr['type']      = 1;
            D('message')->addMessageContent($arr);
            outJson(array('errcode'=>0,'msg'=>'success'));
        }
    }



