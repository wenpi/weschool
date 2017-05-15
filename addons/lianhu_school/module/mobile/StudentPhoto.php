<?php 
	$student_info 	  = $this->mobile_from_find_student();
    $student_name     = $student_info['student_name'];
    $page_title       = "学生相册";   
    $now_class_id   = getClassId();
    $class_info     = D('classes')->edit(array('class_id'=>$now_class_id));
    C('studentPhoto')->student_id = $student_info['student_id'];
    $list             = C('studentPhoto')->getList($_GPC['page']);
    if($ac=='ajax'){
           if($list){
                $template = $this->selectTemplate("student_photo_content");
                include $this->template($template);	               
            }else{
                echo 'all';
            }
            exit();      
    }


