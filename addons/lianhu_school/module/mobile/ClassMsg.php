<?php
    $student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
    $page_title   = '班级公告';

    $line_type_cfg = C('classes')->msgClass($student_info['class_id']);
    foreach ($line_type_cfg as $key => $value) {
        if($value){
            $line_types[]=$value;
        }
    }
    $op       = $op == 'list' ? $line_types[0]:$op;
    $class_id = $student_info['class_id'];
    $type     = array_search($op, $line_types);
    if(!$type){
        $type=0;
    }
    $page     = $_GPC['page'] ? $_GPC['page']:1;
    $class_lianhuLine = C('lianhuLine');
    $class_lianhuLine->class_id = $class_id;
    $class_lianhuLine->line_type= $type;
    $re = $class_lianhuLine->getList($page);
    if($re['count']){
        $list = $class_lianhuLine->infoToList($re['list']);
    }
    if($ac=='ajax'){
            if($list){
                $template = $this->selectTemplate("ClassMsg_content");
                include $this->template($template);	               
            }else{
                echo 'all';
            }
            exit();        
    }
    


