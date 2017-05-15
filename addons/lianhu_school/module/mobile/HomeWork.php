<?php 
    $result         = $this->mobile_from_find_student();
    $student_name   = $result['student_name'];
    $class_homework = D('homework');
    $now_class_id   = getClassId();
    $class_name     = D('classes')->className($now_class_id);
    $page_title     = $class_name."家庭作业";
    $page           = $_GPC['page'] ? $_GPC['page']:1;
    $class_homework->each_page = 5;
    $list           = $class_homework->getPageStudentHomeWork($now_class_id,$page);
    if($ac=='ajax'){
        if(!$list){
            exit('yes');
        }else{
            $template = $this->selectTemplate("HomeWork_ajax");
            include $this->template($template);	
            exit();
        }
    }