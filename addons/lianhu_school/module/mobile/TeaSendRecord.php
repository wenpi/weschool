<?php 
     $student_info              = $this->teacher_mobile_qx();
     $student_name              = $student_info['teacher_realname'];
     $page_title                = '消息内容';
     $record_id                 = $_GPC['record_id'];
     if($record_id){
         $class_look            = D("look"); 
         $record_re             = D('sendRecord')->dataEdit($record_id);
         $class_look->record_id = $record_re['record_id'];
         $in['look_type']       = $record_re['record_type'];
         $in['student_id']      = 0;
         $in['teacher_id']      = $student_info['teacher_id'];
         $class_look->addLookRecord($in);
         $id                    = $record_id;
     }
	$signPackage = $this->getSignPackage();
	$template    = $this->selectTemplate("SendRecord");
	include $this->template($template);	
    exit();     
