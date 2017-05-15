<?php 
if($_GPC['student_id']){
    $in_type['type'] = 'student';
    $in_type['info'] = $this->mobile_from_find_student();
}else{
    $in_type            = $this->judePortType();
}
if($in_type['type']=='student'){
    $student_name       = $in_type['info']['student_name'];
    //添加查看记录
    if($_GPC['record_id']){
         $class_look      = D("look"); 
         $record_re       = D('sendRecord')->dataEdit($_GPC['record_id']);
         $class_look->record_id = $record_re['record_id'];
         $in['look_type']       = $record_re['record_type'];
         $in['student_id']      = $in_type['info']['student_id'];
         $class_look->addLookRecord($in);
    }
}else{
    $student_name       = $in_type['info']['teacher_realname'];
}

$page_title             = '学校公告';
$msg_id                 = $_GPC['id'];
$result                 = D('notice')->getNoticeInfo($msg_id);
if($result['db_admin_id']){
    $admin_info = D('admin')->getAdminInfo($result['db_admin_id']);
    $admin_name = $admin_info['admin_name'];
}else{
    $admin_name = '管理员';
}
$this->registerSchoolInfo($result['school_id']);