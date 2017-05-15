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
    $line_type    = $school_info['line_type'];
    if($line_type){
        $line_type_cfg=explode("||", $line_type );
        foreach ($line_type_cfg as $key => $value) {
            if($value){
                $line_types[]=$value;
            }
        }
        $_W['line_type']=$line_types;
    }
    if($_GPC['hid']){
        if($this->school_info['mu_str']=='xiaoye'){
            header("Location:".$this->createMobileUrl('homeWork_info',array('id'=>$_GPC['hid'])));    
        }
        $result     = $this->homeWorkInfo($_GPC['hid']);
        $home_work  = 1;
        $intro      = "班级作业";
    }elseif($_GPC['wid']){
        if($this->school_info['mu_str']=='xiaoye'){
            header("Location:".$this->createMobileUrl('record_article',array('wid'=>$_GPC['wid'])));    
        }
        $class_work = D('work');
        $result = $class_work->edit($_GPC['wid']);
        $result = $class_work->addInfoToWork($result);
        $record = 1;
        $page_title  = "学生记录";
    }else{
        $class_name = $student_info['class_name'];
        $line_id    = $_GPC['aid'];
        $result     = pdo_fetch("select line.*,tea.teacher_realname from {$table_pe}lianhu_line line left join {$table_pe}lianhu_teacher tea on tea.teacher_id=line.teacher_id  where line.line_id=:id",array(':id'=>$line_id));
        pdo_update('lianhu_line',array('line_look'=>$result['line_look']+1),array('line_id'=>$line_id));
    }




