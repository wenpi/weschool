<?php 
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '扫码详情';

    $id           = $_GPC['id'];
    $code_info    = C('courseQrcode')->use_class->edit(array("qrcode_id"=>$id));
    $course_info  = C('courseScan')->edit($code_info['course_id']);
    $code_info    = C('courseQrcode')->use_class->edit(array('qrcode_id'=>$id));
    $scan_list    = C("courseDelete")->getList($id);
    
