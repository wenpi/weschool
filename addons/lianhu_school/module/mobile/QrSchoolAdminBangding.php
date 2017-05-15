<?php 
    $this->checkFollow();
    $have_school_admin  = D('admin')->mobileValidSchoolAdmin();
    if($have_school_admin){
        $this->myMessage("您已经绑定过管理员，无法再绑定！",'','错误');
    }
    $class_student = D('student');
    $class_admin   = D('schoolAdmin');
    $id            = $_GPC['sid'];
    $teacher_re    = $class_admin->edit(array("admin_id"=>$id));
    $hash_str      = sha1(md5($teacher_re['school_id'].$teacher_re['admin_id'].$class_student->hash_add_str));

    if($hash_str != $_GPC['hash']){
        $this->myMessage("代码不正确，非法二维码",'','错误');
    }   
    if($teacher_re['mobile_uid']){
        $this->myMessage("该管理员已经绑定，如需改绑请前往后台解绑",'','错误');
    }
    $up['mobile_uid'] = getMemberUid();
    $class_admin->edit(array('admin_id'=>$id),$up);
    $this->myMessage('绑定成功，跳转至管理中心',$this->createMobileUrl('school_home'),'成功');
    exit();
    