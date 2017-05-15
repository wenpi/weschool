<?php 
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }
    $token         = $this->class_base->tokenForm();
    $teacher_info  = $this->teacher_mobile_qx();
    $student_name  = $teacher_info['teacher_realname'];
    $page_title    = '发布作业';
    $_W['uid']     = $teacher_info['fanid'];
    $model         = $_GPC['model'] ? $_GPC['model'] :"class";
    if($model=='class'){
        $result=$this->teacher_standard('no');
    }else{
        $result=$this->student_standard();	
    }
    $class_msg     = D('msg');    
    $class_student = D('student');
    $course_list   = $this->teacherCourse($teacher_info['teacher_id'],1);
    if($ac == 'delete'){
        $homework = $this->homeWorkInfo($_GPC['hid']);
        D('homework')->edit(array("homework_id"=>$_GPC['hid']),array("status"=> -1 ) );
        $sendRecord = C("homework")->findSendRecord($homework);
        if($sendRecord){
            D("sendRecord")->deleteSendRecord($sendRecord['record_id']);
        }
        $this->myMessage("该作业删除成功!",$this->createMobileUrl('tea_homeWork'),'成功');    
    }
    if($_POST['class_list'] && $_GPC['token'] == $_COOKIE['form_token'] ){
        $in['school_id']    = getSchoolId();
        $in['content']      = $_GPC['content'];
        $in['course_id']    = $_GPC['course_id'];
        $in['teacher_id']   = $teacher_info['teacher_id'];
        $in['add_time']     = time();
        $in['uniacid']      = $_W['uniacid'];
        $img_arrs           = $_POST['img_value'];
        if($img_arrs){
            foreach ($img_arrs as $key => $value) {
                $img=$this->getWechatMedia($value);
                if($img) 
                    $img_in[]= $img;
                else 
                    $img_in[]= $up_file_name; 
            }
        }
        if($_POST['voice_value'])
                $voice = $this->getWechatMedia($_POST['voice_value'],2,false);
        if($img_in){
                $in['img']         = serialize($img_in);
                $msg_in['imgs']    = $in['img'];                   
        }
        if($voice){
                $in['voice']       = $voice; 
                $msg_in['voice']   = $in['voice'];                   
        }
        $que_num                   = false;
        $msg_in['record_type']     = 5;
        $msg_in['record_content']  = $_GPC['content'];
        $msg_in['class_ids']       = implode(',',$_POST['class_list']);
        $class_id_str              = $msg_in['class_ids'];
        $student_list              = pdo_fetchall("select * from ".tablename("lianhu_student")." where class_id in({$class_id_str}) and status=1  ");				
        foreach ($student_list as $key => $value) {
            $student_ids[] = $value['student_id'];
        }
        $msg_in['student_ids']      = implode(',',$student_ids);
        $class_sendRecord           = D('sendRecord');

        foreach ($_POST['class_list'] as $key => $value) {
                if($value){
                    $in['class_id'] = $value;
                    pdo_insert('lianhu_homework',$in);
                    $hid            = pdo_insertid();
                    if(!$homework_info){
                            $homework_info             = $this->homeWorkInfo($hid);
                            $msg_in['record_title']    = '';
                            $msg_in['record_intro']    = '课程：'.$homework_info['course_name'].'的作业发布了；';
                            $record_id                 = $class_sendRecord->dataAdd($msg_in);
                            $url                       = $_W['siteroot'].'app/'.$this->createMobileUrl("sendRecord",array('record_id'=>$record_id,'hid'=>$val));
                    }else{
                            $homework_info             = $this->homeWorkInfo($val);
                    }
                    $que_num        = $this->sendClassMsg($hid,$que_num,$url);
                }
            }
            D('recordQueue')->add($record_id,$que_num);
            $this->myMessage("作业发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("teain"),'成功');
            // header("Location:".$this->createMobileUrl('sendToMsg',array('que_num'=>$que_num))); 
            exit();   
    }elseif($_GPC['token']&&$_GPC['submit']){
        $this->myMessage("请选择要发送的班级哦！",$this->createMobileUrl("tea_homeWork"),'错误');
    }
