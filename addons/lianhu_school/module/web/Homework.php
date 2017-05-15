<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'class_manage';
    $left_nav     = 'homework';
    $title        = '作业管理';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'班级管理'),
        array('fun_str'=>'homework','fun_name'=>'作业管理'),
    );
    $teacher        = $this->teacher_qx('no');
    $model          = $_GPC['model'] ? $_GPC['model'] :"class";
    $cid            = $_GPC['cid'];
    $class_teacher  = D('teacher');
    if($teacher=='teacher'){
        $t_id        = getTeacherId();
        $t_name      = $class_teacher->teacherName($t_id);
        $list_re     = $class_teacher->getTeacherClass($t_id,true);
        $list        = $list_re['list_all'];
        $course_list = $this->teacherCourse($t_id);
    }else{
        $list   =  D('classes')->getThisAdminClassList();
        $t_name = "管理员";
        $course_list = $this->returnAllEfficeCourse();
    }
    if($cid){
        $class = D('classes')->edit(array('class_id'=>$cid));
        if(!$class) 
            $this->myMessage('没有找到此班级',$this->createWebUrl('line',array('aw'=>$aw) ),'错误');
    }
    //发布作业
    if($ac=='new'){
        if($_GPC['submit'] && $_GPC['class_ids'] ){
            if($_GPC['img']){
                $in['img']      = serialize($_GPC['img']);
                $msg_in['imgs'] = $in['img'];                   
            }
            $in['content']   = $_GPC['content'];
            $in['course_id'] = $_GPC['course_id'];
            $in['teacher_id']= $t_id;
            $que_num         = false;
            //消息记录
            $msg_in['record_type']      = 7;
            $msg_in['record_content']   = $_GPC['content'];
            $msg_in['class_ids']        = implode(',',$_GPC['class_ids']);
            $class_id_str               = $msg_in['class_ids'];
            $student_list               = pdo_fetchall("select * from {$table_pe}lianhu_student where class_id in({$class_id_str}) and status=1  ");				
            foreach ($student_list as $key => $value) {
                $student_ids[] = $value['student_id'];
            }
            $msg_in['student_ids']      = implode(',',$student_ids);            
            $class_sendRecord           = D('sendRecord');

            foreach ($_GPC['class_ids'] as $key => $value) {
                if($value){
                        $in['class_id'] = $value;
                        D('homework')->add($in);
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
            $this->myMessage("作业发布成功,消息将由后台自主发送给家长！",$this->createWebUrl("homework"),'成功');
            // $this->myMessage("作业发布成功，进入消息发布通道请勿关闭网页",$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'aw'=>$aw )),'成功');        
        }
        $ac ='list';
    }
    if($ac=='old'){
        if($t_id){
            $params[":teacher_id"] = $t_id;
        }
        $params[":class_id"]    = $cid;
        $params[":status"]      = array("!=",-1);
        $home_re                = D("homework")->getList($params);
        $list                   = $home_re['list'];
    }
    if($ac=='edit'){
        $result = D('homework')->edit(array("homework_id"=>$_GPC['hid']));
        if($result['img']){
            $images = unserialize($result['img']);
            foreach ($images as $key => $value) {
                $images[$key] = $this->imgFrom($value);
            }
        }
        if($_GPC['submit'] && $_GPC['hid'] ){
            if($_GPC['img']){
                $in['img']    =serialize($_GPC['img']);
            }
            $in['content']   = $_GPC['content'];
            $in['status']    = $_GPC['status'];
            $in['course_id'] = $_GPC['course_id'];
            $result          = D('homework')->edit(array("homework_id"=>$_GPC['hid']),$in);
            $this->myMessage("编辑",$this->createWebUrl('homework',array('cid'=>$cid)),'成功');        
        }
    }
    if($ac=='delete'){
        $homework = $this->homeWorkInfo($_GPC['hid']);
        D('homework')->edit(array("homework_id"=>$_GPC['hid']),array("status"=> -1 ) );
        $sendRecord = C("homework")->findSendRecord($homework);
        if($sendRecord){
            D("sendRecord")->deleteSendRecord($sendRecord['record_id']);
        }
        $this->myMessage("该作业删除成功!",$this->createWebUrl('homework',array('cid'=>$cid)),'成功');        
    }
    include $this->template('../admin/web_homework');
    exit();