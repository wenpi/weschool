<?php 
$hash_add_str  = 'asdas;#sdf';
$teacher_info  = $this->teacher_mobile_qx();
$signPackage   = $this->getSignPackage();
$class_student = D('student');
$student_re    = pdo_fetch("select * from {$table_pe}lianhu_student where student_id=:id",array(':id'=>$_GPC['sid']));
$hash_str      = sha1(md5($student_re['class_id'].$student_re['grade_id'].$student_re['xuhao'].$hash_add_str));
if($hash_str  != $_GPC['hash'])
    $this->myMessage("学生代码不正确，非法二维码",$this->createMobileUrl('teacenter'),'错误');
$url  = $this->createMobileUrl('studentIn',array('hash'=>$hash_str,'sid'=>$_GPC['sid'],'live_in'=>'in'));
$type = 'live_in=in';
if($_GPC['send']==1){
    $class_card = D("card");
    $class_msg  = D('msg');    
    $acid       = pdo_fetchcolumn("select acid from ".tablename('account')." where uniacid={$_W['uniacid']}");
    
    $in['school_id']   = getSchoolId();
    $in['uniacid']     = $_W['uniacid'];
    $in['teacher_id']  = $_SESSION['teacher_id'];
    $in['addtime']     = TIMESTAMP;
    $in['time_date']   = date("Y-m-d",TIMESTAMP);
    $in['student_id']  = $student_re['student_id'];
    $in['in_type']     = 'in';
    $in['class_id']    = $student_re['class_id'];
    $in['grade_id']    = $student_re['grade_id'];
    pdo_insert('lianhu_student_live',$in);
    $arr['student_id'] = $student_re['student_id'];
    $arr['device_id']  = 0;
    $arr['rfid_value'] = $_SESSION['teacher_id'];
    $arr['img_url']    = '';
    $arr['signTemp']   = 0;
    $arr['play_card_time']   = time();    
    $class_card->addCardRecord($arr);
    $class_msg->in_class_base = $this->class_base;
    $openids = $class_student->returnEfficeOpenid($student_re,3);
    $this->class_base->student_id = $student_re['student_id'];

    foreach ($openids as $key => $value) {
        $first       = $student_re['student_name'].'的家长您好，您的孩子到校啦！';
        $class_name  = $this->className($student_re['class_id']);
        $key2        = $teacher_info['teacher_realname'];
        $key4        = "您的孩子到校啦！";
        $remark      = '';
        $mu_info     = $class_msg->decodeMsg1($first,$class_name,$key2,$key4 ,$remark );
        $this->class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'] );
    }
    $have_send=1;
}