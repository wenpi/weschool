<?php 
    $this->checkFollow();
    $class_student = D('student');
    $hash_add_str  = $class_student->hash_add_str;
    $student_re    = $class_student->getStudentInfo($_GPC['sid']);
    $hash_str      = sha1(md5($student_re['class_id'].$student_re['grade_id'].$student_re['xuhao'].$hash_add_str));
    if($hash_str != $_GPC['hash']){
        $this->myMessage("学生代码不正确，非法二维码",$this->createMobileUrl('home'),'错误');
    }
    $fanid   = getMemberFanid();
    $uid     = getMemberUid();
    $student = $student_re;
    if($student['fanid']==$fanid || $student['fanid1']==$fanid  ||$student['fanid2']==$fanid ){
        $this->myMessage('您已经绑定过此位学生了',$this->createMobileUrl('home'),'错误');
    }
    $class_school = D('school');
    $class_school->school_id = $student['school_id'];
    $school_info 			 = $class_school->getSchoolInfo();
    if($student['fanid']){
        $hi++;
    }
    if($student['fanid1']){
        $hi++;				
    }
    if($student['fanid2']){
        $hi++;
    }
    if($hi >=$school_info['parents'] ){
        $this->myMessage('绑定名额已满，无法再绑定',$this->createMobileUrl('bangding'),'错误');	
    }
    if(!$student['fanid']){
        $ziduan  ='fanid';
        $ziduan2 ='uid';
    }elseif(!$student['fanid1']){
        $ziduan  ='fanid1';
        $ziduan2 ='uid1';
    }elseif(!$student['fanid2']){
        $ziduan  ='fanid2';
        $ziduan2 ='uid2';
    }else{
        $this->myMessage('该学生的三个账号已经被绑定了，无法再绑定',$this->createMobileUrl('bangding'),'错误');	
    }
    $class_student->insertStudentRelation($student['student_id'],'',$fanid);
    // pdo_update('lianhu_student',array($ziduan=>$fanid,$ziduan2=>$uid),array('student_id'=>$student['student_id']));
    D('student')->school_id = $student['school_id'];
    D('student')->edit(array('student_id'=>$student['student_id']),array($ziduan=>$fanid,$ziduan2=>$uid));
    $this->myMessage('绑定成功',$this->createMobileUrl('home'),'成功');
    exit();