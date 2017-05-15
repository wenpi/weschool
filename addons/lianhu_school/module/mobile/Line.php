<?php
#教师或者学生家长
    $in_type    = $this->judePortType();
    if(empty($in_type)){
        $this->myMessage('您还未绑定',$this->createMobileUrl('home'),'错误');
    }
    if($in_type['type']=='teacher'){
        $student_name = $in_type['info']['teacher_realname'];
    }else{
        $student_name = $in_type['info']['student_name'];
    }
    
    $now_class_id   = getClassId();
    $class_id       = $now_class_id;
    $class_info     = D('classes')->edit(array('class_id'=>$now_class_id));
    $class_name     = $class_info['class_name'];
    $page_title     = $class_name.'班级圈';
    $class_student  = D('student');
    
    if($ac=='line_all'){
        $page           = $_GPC['page'];     
        $list           = $this->getLineList($page,10,$now_class_id);
    }else{
        $list           = $this->getLineList(1,10,$now_class_id);
    }
    foreach($list as $key=>$row){
            if($row['student_send']==1  && $row['student_id']==0 ){
                $fanid          = $this->class_base->mobileGetFanidByUid($row['send_uid']);
                $teacher_result = $this->findTeacherInfoByMobileUid($row['send_uid']);
                $student_id     = $class_student->getStudentIdByFanid($fanid,$class_id);
                $student_info   = $class_student->getStudentInfo($student_id);
            }elseif($row['student_send']==1 && $row['student_id']>0 ){
                 unset($teacher_result);
                 $student_info  = $class_student->getStudentInfo($row['student_id']);
            }elseif($row['student_send']==0 && $row['teacher_id']>0){
                $teacher_result = D('teacher')->getTeacherInfo($row['teacher_id']);
            }
            if($teacher_result){
                $list[$key]['member_img'] = D('teacher')->teacherImg($teacher_result['teacher_id']);
                $list[$key]['member_name']= $teacher_result['teacher_realname'];
                $list[$key]['member_name_other'] = '教师';
            }else{
                $list[$key]['member_img']        = $_W['attachurl'].$student_info['student_img'];
                $list[$key]['member_name']       = $student_info['student_name'];
                $list[$key]['member_name_other'] = $row['relation'];
            }
    }
    if($ac=='line_all'){
            if($list){
                $template = $this->selectTemplate("line_content");
                include $this->template($template);	               
            }else{
                echo 'all';
            }
            exit();
    }






