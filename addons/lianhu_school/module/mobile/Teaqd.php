<?php
    $dac = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($dac,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info = $this->teacher_mobile_qx();
    //
    $page = $_GPC['page'] ? $_GPC['apge'] :1;
    $page = intval($page);
    $list = C("qdActivity")->teacherList($teacher_info['teacher_id'],$page);
    if($ac=='ajax'){
        if(!$list){
            echo 'done';
        }else{
            $template = $this->selectTemplate("Teaqd_content");
            include $this->template($template);	
        }
        exit();
    }
