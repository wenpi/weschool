<?php 	
    $teacher_web = $_GPC['teacher_web'];
    //新的后台只允许 1.站长；2.校长；3.教师；4.家校通登记在录人员
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    if(!$teacher_web){
        $left_top     = 'class_manage';
        $left_nav     = 'class_msg';
        $title        = '消息发送回复分析';  
        $we7_js       = 'no';
        $sidebar_list = array(
                array('fun_str'=>'','fun_name'=>'班级管理'),
                array('fun_str'=>'msg','fun_name'=>'消息发送'),
                array('fun_str'=>'','fun_name'=>'消息发送回复分析'),
        );
        $top_action = array(
                array('action_name'=>'消息发送','action'=>'msg','arr'=>array('aw'=>1) ),
                array('action_name'=>'消息发送记录','action'=>'msg','arr'=>array('aw'=>1,'op'=>'msg_record') ),
        );
    }else{
			$left_top     = 'school_msg';
			$left_nav     = 'teacher_msg';
			$title        = '通知教师';  
			$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'学校信息'),
				array('fun_str'=>'teacherMsg','fun_name'=>'通知教师'),
			);
			$top_action = array(
				array('action_name'=>'新增发送','action'=>'teacherMsg','arr'=>array('ac'=>'list','aw'=>1) ),
			    array('action_name'=>'消息发送记录','action'=>'teacherMsg','arr'=>array('aw'=>1,'op'=>'msg_record') ),
			);        
    }

    $class_sendRecord  = D('sendRecord');
    $class_look        = D('look');
    $class_student     = D('student');
    $class_teacher     = D('teacher');
    $rid               = $_GPC['rid'];
    $class_look->record_id = $rid;
    $record_re             = $class_sendRecord->dataEdit($rid);
    if(!$teacher_web){
        $student_arr = explode(',',$record_re['student_ids']);
    }else{
        $student_arr = explode(',',$record_re['teacher_ids']);
    } 
    $send_num       = count($student_arr); 
    //发送统计
    $look_num_info  = $class_look->recordLookNum();
    $reply_num_info = $class_look->recordReplyNum();
    //呈现列表
    foreach($student_arr as $key=>$student_id){
        $student_info               = $teacher_web==1 ? $class_teacher->getTeacherInfo($student_id):$class_student->getStudentInfo($student_id);
        $look_info                  = $teacher_web==1 ? $class_look->teacherHaveLook($student_id):$class_look->studentHaveLook($student_id);
        $list[$key]['student_name'] = $teacher_web==1 ? $student_info['teacher_realname']:$student_info['student_name'];
        $list[$key]['status']       = $look_info ? " <span class='label label-sm label-success'>已查看</span>":"未查看";
        $list[$key]['add_time']     = $look_info['add_time'] ? date("Y-m-d H:i:s",$look_info['add_time']):"未有查看时间";
        $list[$key]['look_id']      = $look_info['look_id'];
        if($look_info['images']!='0' || $look_info['content']!='0' || $look_info['voice']!='0'){
             $list[$key]['look_content'] = true;
        }
        $list[$key]['student_id']   = $teacher_web==1?$look_info['teacher_id']:$look_info['student_id'];
    }
    include $this->template('../admin/web_msg_reply');
    exit();