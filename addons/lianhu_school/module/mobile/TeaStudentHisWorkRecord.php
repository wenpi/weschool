<?php 
    $teacher_info = $this->teacher_mobile_qx(); 
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '记录历史';
    $class_work   = D('work');
    if($ac=='delete'){
        $class_work->delete($_GPC['id']);
    }
    $class_work->each_page = 100000;
    $params[":student_id"] = $_GPC['sid'];
    $work_re 		 	   = $class_work->get(1,$params);
    $list 				   = $work_re['list'];
    if($list){
        foreach ($list as $key => $value) {
            $list[$key] = $class_work->addInfoToWork($value);
        }
    }
