<?php
        $teacher_info   = $this->teacher_mobile_qx();
        $student_name   = $teacher_info['teacher_realname'];
        $_W['uid'] 	= $teacher_info['fanid'];
        $class_student  = D('student');
        $class_list     = D("teacher")->getTeacherClass($teacher_info['teacher_id']);
        $class_list     = $class_list['list'];
        if(empty($class_list)){
                $this->myMessage('您不是班主任，无法使用此功能',$this->createMobileUrl('teacenter') );
        }

        if($_GPC['send_leave'] && $_GPC['cid']){
                $class_student->class_id = $_GPC['cid'];
                $student_list  = $class_student->getClassStudentList();
                $i             = 0;
                $que_num       = FALSE;
                $class_msg     = D('msg');
                $class_msg ->in_class_base = $this->class_base;
                foreach ($student_list as $key => $value) {
                        #遍历and发送
                        $openids    = $class_student->returnEfficeOpenid($value,3);
                        $class_name = $this->className($value['class_id']);
                        $key2       = $teacher_info['teacher_realname'];
                        $key4       = "放学通知";
                        $remark     = "请督促您的孩子按时完成作业，祝您孩子学习进步！";
                        $class_msg->msg_student_id = $value['student_id'];
                        foreach ($openids as $key => $v) {
                                if($v){
                                        $first_end  = $class_student->rebackHeadEndTextByRelation($v,$value['student_id']);
                                        $first      = $first_end['first']."请您注意，学校放学了";
                                        $mu_info    = $class_msg->decodeMsg1($first,$class_name,$key2,$key4,$remark);
                                        $que_num    = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],false,$que_num);
                                }  
                        }    							
                }
                $this->myMessage("放学通知发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("teain"),'成功');
                exit();
        }

        