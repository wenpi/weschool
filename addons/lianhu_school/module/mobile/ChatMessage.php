<?php
    $in_type            = $this->judePortType();
    $class_inlineStatus = C('inlineStatus');

    if($in_type['type']=='student'){
        $student_name           = $in_type['info']['student_name'];
        $in_arr['student_id']   = $in_type['info']['student_id'];
        $in_arr['grade_id']     = $in_type['info']['grade_id'];
        $in_arr['class_id']     = $in_type['info']['class_id'];
        $fanid                  = getMemberFanid();
        $relation               = D('student')->getRelation($in_type['info']['student_id'],$fanid);
        $class_inlineStatus->student_id = $in_type['info']['student_id'];
        $class_inlineStatus->upStudentInline();
    }else{
        $student_name           = $in_type['info']['teacher_realname'];
        $in_arr['teacher_id']   = $in_type['info']['teacher_id'];
        $in_arr['grade_id']     = $student_info['grade_id'];
        $in_arr['class_id']     = $student_info['class_id']; 
        $class_inlineStatus->teacher_id = $in_type['info']['teacher_id'];
        $class_inlineStatus->upTeacherInline();
    }
    if($_GPC['t_id']){
        $in_arr['to_teacher_id']= $_GPC['t_id'];
    }elseif($_GPC['s_id']){
        $student_info           = D('student')->getStudentInfo($_GPC['s_id']);
        $in_arr['to_student_id']= $student_info['student_id'];
    }elseif($_GPC['o_id']){
        if($in_type['type']=='student'){
            $in_arr['to_student_id']= $_GPC['o_id'];
        }else{
            $in_arr['to_teacher_id']= $_GPC['o_id'];
        }
    }
    $title              = $student_name.'-沟通-'.$this->school_info['school_name'];
    $class_chatMessage  = C('chatMessage');

    if($_GPC['ajax'] == 'add'){
        $class_msg   = D('msg');
        $class_msg->in_class_base = $this->class_base;
        //添加
        if($_GPC['voice_value']){
            $voice      = $this->getWechatMedia($_GPC['voice_value'],2,false);
            $content    = $class_chatMessage->voice_str.$voice;
        }elseif($_GPC['img_value']){
            $img        = $this->getWechatMedia($_GPC['img_value']);
            $content    = $class_chatMessage->img_str.$img;
        }elseif($_GPC['text']){
            $text       = $_GPC['text'];
            $content    = $class_chatMessage->text_str.$text;
        }
        $in_arr['content'] = $content;
        $class_chatMessage->dataAdd($in_arr);

        if($in_type['type']=='student'){
            if($_GPC['t_id']){
                $inline_status     = $class_inlineStatus->judeInline(array('teacher_id'=>$_GPC['t_id']));
                $tea_openid    = $this->getTeacherOpenid($_GPC['t_id']);
                if($tea_openid  && !$inline_status){
                    $keyword1 = $student_name.'['.$relation.']';
                    $keyword3 = "请点击查看详情";
                    $mu_info  = $class_msg->decodeParentMsg($keyword1,$keyword3,'');
                    $url      = $_W['siteroot'].'app/'.$this->createMobileUrl("chatMessage",array('type'=>'student','in_type'=>'as_teacher','s_id'=>$in_type['info']['student_id'],'teacher_id'=>$_GPC['t_id']));
                    $re       = $this->class_base->sendTplNotice($tea_openid,$mu_info['mu_id'],$mu_info['data'],$url);
                }
            }elseif($_GPC['o_id']){
                //家长对家长
                $inline_status = $class_inlineStatus->judeInline(array('student_id'=>$_GPC['o_id']));
                $student_info  = D('student')->getStudentInfo($_GPC['o_id']);
                $openids       = D('student')->returnEfficeOpenid($student_info,3);
                if($openids  && $openids['f_openid']!='sms' && !$inline_status ){
                    $keyword1 = $student_name.'['.$relation.']';
                    $keyword3 = '请点击查看详情';
                    $mu_info  = $class_msg->decodeParentMsg($keyword1,$keyword3,'');

                    $url      = $_W['siteroot'].'app/'.$this->createMobileUrl("chatMessage",array('type'=>'student','student_id'=>$_GPC['o_id'],'in_type'=>'as_student','o_id'=>$in_type['info']['student_id']));
                    foreach ($openids as $key => $value) {
                        $re       = $this->class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);
                    }
                }

            }
        }else{
            if($_GPC['s_id']){
                $inline_status  = $class_inlineStatus->judeInline(array('student_id'=>$_GPC['s_id']));
                $openids = D('student')->returnEfficeOpenid($student_info,3);
                if($openids  && $openids['f_openid']!='sms' && !$inline_status ){
                    $keyword1 = $in_type['info']['teacher_realname'];
                    $keyword3 = '请点击查看详情';
                    $mu_info  = $class_msg->decodeTeacherMsg($keyword1,$keyword3,'');
                    $url      = $_W['siteroot'].'app/'.$this->createMobileUrl("chatMessage",array('type'=>'teacher','student_id'=>$_GPC['s_id'],'in_type'=>'as_student','t_id'=>$in_type['info']['teacher_id']));
                    foreach ($openids as $key => $value) {
                        $re       = $this->class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);
                    }
                }
            }elseif($_GPC['o_id']){
                $inline_status     = $class_inlineStatus->judeInline(array('teacher_id'=>$_GPC['o_id']));
                $tea_openid    = $this->getTeacherOpenid($_GPC['o_id']);
                if($tea_openid  && !$inline_status){
                    $keyword1 = $in_type['info']['teacher_realname'];
                    $keyword3 = "请点击查看详情";
                    $mu_info  = $class_msg->decodeTeacherMsg($keyword1,$keyword3,'');
                    $url      = $_W['siteroot'].'app/'.$this->createMobileUrl("chatMessage",array('type'=>'teacher','in_type'=>'as_teacher','o_id'=>$in_type['info']['teacher_id'],'teacher_id'=>$_GPC['oid'] ));
                    $re       = $this->class_base->sendTplNotice($tea_openid,$mu_info['mu_id'],$mu_info['data'],$url);
                }
            }
        }
        var_dump($re);
        exit();
    }else{
        if($_GPC['pager']){
            $pager = $_GPC['pager'];
        }else{
            $pager = 1;
        }
        //学生对教师
        if($_GPC['type'] =='teacher' && $_GPC['t_id']){
            $student_id  = $in_type['info']['student_id'];
            $teacher_id  = $_GPC['t_id'];
            $student_name= $in_type['info']['student_name'];
            $teacher_name= D('teacher')->teacherName($teacher_id);
            $main        = 'student';
            $head_title  = $teacher_name;
        //教师对学生
        }elseif($_GPC['type'] =='student' && $_GPC['s_id']){
            $student_id  = $_GPC['s_id'];
            $teacher_id  = $in_type['info']['teacher_id'];
            $student_name= $student_info['student_name'];
            $teacher_name= $in_type['info']['teacher_realname'];
            $main        = 'teacher';
            $head_title  = $student_name;
        //学生对学生
        }elseif($_GPC['type'] =='student' && $_GPC['in_type']=='as_student'){
            $student_id     = $in_type['info']['student_id'];
            $to_student_id  = $_GPC['o_id'];
            $student_name   = $in_type['info']['student_name'];
            $to_student_name= $this->studentName($to_student_id);
            $main           = 'student';
            $head_title     = $to_student_name;
            $to_student_img = C('student')->studentImg($to_student_id);
        //教师对教师
        }elseif($_GPC['type'] =='teacher' && $_GPC['in_type']=='as_teacher'){
            $teacher_id  = $in_type['info']['teacher_id'];
            $teacher_name= $in_type['info']['teacher_realname'];
            $to_teacher_id      = $_GPC['o_id'];
            $to_teacher_name    = $this->teacherName($to_teacher_id);
            $main        = 'teacher';
            $head_title  = $to_teacher_name;
            $to_teacher_img = D('teacher')->teacherImg($to_teacher_id);
        }
        $class_chatMessage->student_id = $student_id;
        $class_chatMessage->teacher_id = $teacher_id;
        $class_chatMessage->to_id      = $_GPC['o_id'];

        if($_GPC['ajax']=='new_list'){
            $list = $class_chatMessage->getHistoryList($pager,$_GPC['new_id']);
        }else{
            $list = $class_chatMessage->getHistoryList($pager);
        }
        $teacher_img = D('teacher')->teacherImg($teacher_id);
        $student_img = C('student')->studentImg($student_id);

        foreach ($list as $key => $value) {
            $out_list[$key] = $class_chatMessage->decodeLine($value,$main);
        }
        $new_id    = $out_list[0]['id'];
    }
    if($_GPC['ajax']=='list'){
        if(!$out_list){
            echo 'done';
        }else{
            $template = $this->selectTemplate("ChatMessage_content");
            include $this->template($template);	
        }
        exit();          
    }
    if($_GPC['ajax']=='new_list'){
        if(!$out_list){
            echo 'done';
        }else{
            isetcookie('new_id', $new_id, 7 * 86400);
            $template = $this->selectTemplate("ChatMessage_content");
            include $this->template($template);	
        }
        exit();     
    }
     isetcookie('new_id', $new_id, 7 * 86400);
