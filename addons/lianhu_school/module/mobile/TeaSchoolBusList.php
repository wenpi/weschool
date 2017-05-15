<?php 
     $student_info              = $this->teacher_mobile_qx();
     $student_name              = $student_info['teacher_realname'];
     $page_title                = '我校校车列表';
     $device_list               = C('device')->getSchoolBusList();
     