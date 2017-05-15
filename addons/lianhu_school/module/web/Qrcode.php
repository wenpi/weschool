<?php 
$op           = $_GPC['op'];
if($ac=='course_scan'){
    $class_course = D('course');
    $id	          = $_GPC['id'];        
    $position = $_GPC['position'];
    if($position=='have'){
        $qrcode_value = $class_course->getThisCode($id);
    }else{
        $qrcode_value = $class_course->createNextCode($id);
    } 
    S('fun','createQrcode',array($qrcode_value));
    exit();
}
if($op=='student_live_student' || $op=='student_bd_student'){
    $class_student = D('student');
    $id            = $_GPC['id'];
    $student_re    = $class_student->getStudentInfo($id);
    $hash_str      = sha1(md5($student_re['class_id'].$student_re['grade_id'].$student_re['xuhao'].$class_student->hash_add_str));
    if($op=='student_live_student'){
        $url       = $this->createMobileUrl('studentlLive',array('hash'=>$hash_str,'sid'=>$id));
    }
    if($op=='student_bd_student'){
        $url       = $this->createMobileUrl('qrBangding',array('hash'=>$hash_str,'sid'=>$id));
    }
    $base_dir      = $this->insertDir();
    $file_name     = $base_dir.time().rand(111111,999999).'.png';
    if($_GPC['print_code']==1){
        echo QRcode::png($_W['siteroot'].'app/'.$url,false,'',10,2);
    }else{
    	echo QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        echo "<img src='{$_W['siteroot']}/attachment/{$up_file_name}' >";
    }
}
if($op=='teacher_bd_qr'){
    $class_student = D('student');
    $class_teacher = D('teacher');
    $id            = $_GPC['id'];
    $teacher_re    = $class_teacher->getTeacherInfo($id);
    $hash_str      = sha1(md5($teacher_re['school_id'].$teacher_re['teacher_id'].$class_student->hash_add_str));
    $url           = $this->createMobileUrl('qrTeaBangding',array('hash'=>$hash_str,'sid'=>$id));
    $base_dir      = $this->insertDir();
    $file_name     = $base_dir.time().rand(111111,999999).'.png';
    if($_GPC['print_code']==1){
        echo QRcode::png($_W['siteroot'].'app/'.$url,false,'',10,2);
    }else{
    	echo QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        echo "<img src='{$_W['siteroot']}/attachment/{$up_file_name}' >";
    }
}
if($op=='school_admin_bd'){
    $class_student = D('student');
    $class_admin   = D('schoolAdmin');
    $id            = $_GPC['id'];
    $teacher_re    = $class_admin->edit(array("admin_id"=>$id));
    $hash_str      = sha1(md5($teacher_re['school_id'].$teacher_re['admin_id'].$class_student->hash_add_str));
    $url           = $this->createMobileUrl('qrSchoolAdminBangding',array('hash'=>$hash_str,'sid'=>$id));
    $base_dir      = $this->insertDir();
    $file_name     = $base_dir.time().rand(111111,999999).'.png';
    if($_GPC['print_code']==1){
        echo QRcode::png($_W['siteroot'].'app/'.$url,false,'',10,2);
    }else{
    	echo QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        echo "<img src='{$_W['siteroot']}/attachment/{$up_file_name}' >";
    } 
}
exit();