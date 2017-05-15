<?php
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }
    $token          = $this->class_base->tokenForm();

    $teacher_info   = $this->teacher_mobile_qx(); 
    $class_student  = D('student');
    $class_id       = $_GPC['id'];
    $class_re       = D("classes")->edit(array("class_id"=>$class_id));
    $teacher_list   = C("teacher")->getClassTeacherList($class_id);
    $class_list     = D('record')->getRecordClass();
    $class_work     = D("work");
    $in     = false;
    foreach ($teacher_list as $key => $value) {
        if($value['teacher_id']==$teacher_info['teacher_id']){
            $in=true;
        }
    }
    if(!$in){
        $this->myMessage("只有授课老师才可以点评本班级哦",$this->createMobileUrl('teain'),'错误');
    }
    // 
    if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token'] ){
        $in = array();
        if(!$_GPC['studentIds']){
            $this->myMessage("请至少勾选一个学生哦！",$this->createMobileUrl('teaWorkRecordStudent',array("id"=>$class_id)),'错误');
        }
        if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value']){
            $in['img']          = $this->getWechatMedia($_POST['img_value'],1,true); 
        }
        if($_POST['voice_value']){
            $in['voice']        = $this->getWechatMedia($_POST['voice_value'],2,false);
        }
        $in['class_id']     = $class_re['class_id'];
        $in['grade_id']     = $class_re['grade_id'];
        $in['word']         = $_GPC['word'];
        $in['content']      = $_GPC['content'];
        $in['jilv_class']   = $_GPC['jilv_class'];

        foreach ($_GPC['studentIds'] as $key => $value) {
            $in['student_id']   = $value;
            $in_id 				= $class_work->add($in);
            $this->sendRecordMsg($in['student_id'],'记录','',$_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('wid'=>$in_id )) );
        }
        $this->myMessage('新增记录成功',$this->createMobileUrl('tea_work_record'),'成功');
    }    
    C("classes")->class_id = $class_id;
    $student_list = C("classes")->getClassStudent();