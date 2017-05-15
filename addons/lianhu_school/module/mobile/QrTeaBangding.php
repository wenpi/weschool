<?php 
    $this->checkFollow();
    $class_student = D('student');
    $class_teacher = D('teacher');
    $id            = $_GPC['sid'];
    $teacher_re    = $class_teacher->getTeacherInfo($id);    
    $hash_str      = sha1(md5($teacher_re['school_id'].$teacher_re['teacher_id'].$class_student->hash_add_str));
    if($hash_str != $_GPC['hash']){
        $this->myMessage("教师代码不正确，非法二维码",'','错误');
    }   
    if($teacher_re['uid']){
        $this->myMessage("该教师已经绑定，如需改绑请前往后台解绑",'','错误');
    }
    $up['uid'] = getMemberUid();
    
    $class_teacher->edit(array('teacher_id'=>$teacher_re['teacher_id']),$up);
    $this->myMessage('绑定成功，跳转至教师个人中心',$this->createMobileUrl('teacenter',array('teacher_id'=>$teacher_re['teacher_id'])),'成功');
    exit();
    