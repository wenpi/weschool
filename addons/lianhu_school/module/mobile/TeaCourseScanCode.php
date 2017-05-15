<?php
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '课程详情';

    $id           = $_GPC['id'];
    C('courseQrcode')->course_id = $id;
    $course_info = C('courseScan')->edit($id);
    $qrlist      = C('courseQrcode')->createAllQr();
    