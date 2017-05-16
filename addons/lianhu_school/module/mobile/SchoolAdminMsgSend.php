<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title         = '消息发送';
    $grade_list    = D("grade")->gradeClass();
    $class_msg     = D('msg');
    $class_student = D('student');    

    if($_GPC['submit']){
        $class_ids       = $_GPC['class'];
        if($class_ids){
            $class_id_str    = implode(',', $class_ids);
            $student_list    = pdo_fetchall("select * from ".tablename('lianhu_student')." where class_id in({$class_id_str}) and status=1 ");				
            $in['class_ids']       = $class_id_str;
            $in['record_title']    = $_GPC['title'];
            $in['record_intro']    = $_GPC['intro'];
            $in['record_content']  = $_GPC['content'];
            $img_arrs              = $_POST['img_value'];
            if($img_arrs){
                foreach ($img_arrs as $key => $value) {
                    $img=$this->getWechatMedia($value);
                    if($img){
                        $img_in[]= $img;
                    }else{
                        $img_in[]= $up_file_name; 
                    }
                }
            }   
            if($img_in){
                $in['imgs'] = serialize($img_in);                   
            }
            if($_POST['voice_value']){
                $in['voice']   = $this->getWechatMedia($_POST['voice_value'],2,false);               
            }
            foreach ($student_list as $key => $value) {
                $student_ids[] = $value['student_id'];
            }
            $in['student_ids'] = implode(',',$student_ids);
            $record_id         = D('sendRecord')->dataAdd($in);
            unset($in);
            foreach ($student_list as $key => $value) {
                $url = $_W['siteroot'].'app/'.$this->createMobileUrl("sendRecord",array('record_id'=>$record_id,'student_id'=>$value['student_id']) );
                D("sendAlone")->studentAdd($value['student_id'],$record_id);
                #遍历and发送
                if($_GPC['title']){
                    $title = $_GPC['title'];
                    $title = str_ireplace('[学生姓名]',$value['student_name'],$title);
                }else{
                    $title = $value['student_name'].'的家长您好，您有一个班级通知，请查看';
                } 
                $openids    = $class_student->returnEfficeOpenid($value,3);
                $first      = $title;
                $key2       = $school_admin['info']['admin_name'];
                $key4       = $_GPC['intro'];
                $remark     = "点击查看";				
                $class_name = $this->className($value['class_id']);
                $mu_info    = $this->decodeMsg1($first,$class_name,$key2,$key4 ,$remark);     
                $class_msg->msg_student_id = $value['student_id'];
                foreach ($openids as $key => $v) {
                    if($v){
                        $que_num = $class_msg->insertMsgQueueMu($v,$mu_info['data'],$mu_info['mu_id'],$url,$que_num);
                    }
                }         
            }
            D('recordQueue')->add($record_id,$que_num);
            
            $this->myMessage("通知发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("school_home"),'成功');
            // $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createWebUrl('sendToMsg',array('que_num'=>$que_num,'teacher'=>1)),'成功');
         }else{
            $this->myMessage("请选择要发送消息的班级",$this->myMessage("schoolAdminMsgSend"),"错误");
        }
    }