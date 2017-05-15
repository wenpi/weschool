<?php 
	$student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
	$class_name   = $student_info['class_name'];
    $class_record = D('record');
    $class_work   = D('work');
    $page_title   = '学生记录';
    $list         = $class_record->getRecordClass();

	$class_id     = $_GPC['op']?$_GPC['op']:1;
    $in_class_id  = $class_id-1;
    foreach ($list as $key => $value) {
        if($key==$in_class_id){
            $class_id = $value['class_id'];
        }
    }
    
    $info         = $class_record->edit($class_id);

    $params[":student_id"] = $student_info['student_id'];
    $params[":jilv_class"] = $class_id;
    $class_work->each_page = 100000;
    $work_re               = $class_work->get(1,$params);
    $jilv_list             = $work_re['list'];
    
    foreach ($jilv_list as $key => $value) {
        $jilv_list[$key]   = $class_work->addInfoToWork($value); 
    }