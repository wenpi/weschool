<?php 
$result       = $this->mobile_from_find_student();
$student_name = $result['student_name'];
$page_title   = '发送给校长';
$title        = $student_name.'--'.$page_title;
$do_in        = 1;
if($_GPC['token'] != $_COOKIE['form_token'] && $_GPC['message_title']){
    $do_in = 0;
}
$token                  = $this->class_base->tokenForm();
if($_GPC['message_title'] && $do_in==1 ){
    $title             = $_GPC['message_title'];
    $content           = $_GPC['message_content'];
    $student_id        = $result['student_id'];
    $arr['title']      = $title;
    $arr['student_id'] = $student_id;
    $arr['send_uid']   = $uid;
    $arr['msg_content']= $content;
    $img_arrs          = $_POST['img_value'];
    if($img_arrs){
        foreach ($img_arrs as $key => $value) {
            $img=$this->getWechatMedia($value);
            if($img){
                $img_in[]= $img;
            }else{
                $img_in[]= $up_file_name; 
            }
        }
    }   
    if($img_in){
        $arr['imgs'] = serialize($img_in);                   
    }    

    $mid               = D("message")->addMessage($arr);
    //发送模板消息
    $school_message_admin_id =  S("system",'getSetContent',array('school_message_admin',$this->school_info['school_id']));
    if($school_message_admin_id){
        $db_admin_info       = D('admin')->dbAdminInfo($school_message_admin_id);
        $school_admin_info   = D('schoolAdmin')->edit(array("admin_id"=>$db_admin_info['school_admin_id']));
        if($school_admin_info['mobile_uid']){
           $student_name = $this->studentName($student_id);
           $title        = "校长信箱有新的留言了：".$title;
           D('msg')->in_class_base = $this->class_base;
           $mu_info = D('msg')->emailMsg($title,$student_name,$content);
           $url     = $_W['siteroot'].'app/'.$this->createMobileUrl("schoolAdminEmailInfo",array('sid'=>$_GPC['s_id'],'mid'=>$mid));
           $openid  = S("base",'uid2openid',array($school_admin_info['mobile_uid']));
           $re = $this->class_base->sendTplNotice($openid,$mu_info['mu_id'],$mu_info['data'],$url);
        }
    }
    $this->myMessage("留言成功，请耐心等待学校的回复",$this->createMobileUrl('message'),'成功' );
}
