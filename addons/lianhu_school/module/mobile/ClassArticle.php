<?php 
    $student_info = $this->mobile_from_find_student();
    //添加查看记录
    if($_GPC['record_id']){
         $class_look      = D("look"); 
         $record_re       = D('sendRecord')->dataEdit($_GPC['record_id']);
         $class_look->record_id = $record_re['record_id'];
         $in['look_type']       = $record_re['record_type'];
         $in['student_id']      = $student_info['student_id'];
         $class_look->addLookRecord($in);
    }
    $student_name = $student_info['student_name'];
    $page_title   = '详细内容';
    $id     = $_GPC['id'];
    $info   = C('lianhuLine')->use_class->edit(array('line_id'=>$id));
    C('lianhuLine')->use_class->edit(array('line_id'=>$id),array('line_look'=>$info['line_look']+1));
    $list[0] = $info;
    $list    = C('lianhuLine')->infoToList($list);
    $info    = $list[0];
