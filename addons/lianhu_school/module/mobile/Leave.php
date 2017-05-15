<?php 
$token        = $this->class_base->tokenForm();
$result       = $this->mobile_from_find_student();
$class_msg    = D("msg");
$cclass_leave = C('leave');
$class_msg->in_class_base = $this->class_base;
$student_name             = $result['student_name'];
$page_title               = '请假申请';
$wap_template             = $this->school_info['mu_str'];


if($_GPC['time_date_begin'] && $_GPC['token'] == $_COOKIE['form_token'] ){
      if($wap_template=='xiaoye'){
        if($_GPC['voice_value']){
            $voice = $this->getWechatMedia($_GPC['voice_value'],2,false);
        }else{
           $this->myMessage("请录音一段您的语音",$this->createMobileUrl('leave',array('op'=>'get')),'提示');
        }
      }
      $time_begin    = strtotime($_GPC['time_date_begin']);
      if(!$_GPC['time_date_end']){
           $time_end = $time_begin+3600*24;
      }else{
           $time_end = strtotime($_GPC['time_date_end']);
      }
      if($time_end<$time_begin){
         $this->myMessage("请假的结束时间小于开始时间",$this->createMobileUrl('leave',array('op'=>'get')),'错误');
      }
      $in['leave_voice']    = $voice;
      $in['member_uid']     = $uid;
      $in['student_id']     = $result['student_id'];
      $in['class_id']       = $result['class_id'];
      $in['teacher_id']     = $result['teacher_id'];
      $in['leave_reason']   = $_GPC['leave_reason'];
      $in['time_date_begin']= $time_begin;
      $in['time_date_end']  = $time_end;
      $in['leave_type']     = $_GPC['leave_type'];
      $cclass_leave->add($in);
      $tea_openid = $this->getTeacherOpenid($result['teacher_id']);

      if($tea_openid){
          $first   = "学生的请假申请";
          $key1    = $this->className($result['class_id']);
          if($result['relation']){
              $key2    = $result['student_name']."的".$result['relation'];
          }else{
              $key2    = $result['student_name'];
          }
          $key4    = "【".$cclass_leave->leave_type[$in['leave_type']]."】".$_GPC['leave_reason'];
          $url     = $_W['siteroot'].'app/'.$this->createMobileUrl("tea_leave");
          $mu_info = $class_msg->decodeMsg1($first,$key1,$key2,$key4,$remark);
          $re      = $this->class_base->sendTplNotice($tea_openid,$mu_info['mu_id'],$mu_info['data'],$url);             
      }
      $this->myMessage("提交请假申请成功！",$this->createMobileUrl('home'),'成功');
}

