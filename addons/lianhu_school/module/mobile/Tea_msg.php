<?php
    $teacher_info = $this->teacher_mobile_qx();
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '消息发送';
    $token        = $this->class_base->tokenForm();
    $admin_name = $teacher_info['teacher_realname'];
    $_W['uid']  = $teacher_info['fanid'];
    $model      = $_GPC['model'] ? $_GPC['model'] :"class";
    if($model=='class'){
        $result = $this->teacher_standard('no');
    }else{
        $result = $this->student_standard();		
    }
    $class_msg                  = D('msg');
    $class_student              = D('student');    
    $class_sendRecord           = D('sendRecord');

    if( ($_GPC['submit_weixin'] || $_GPC['submit_kf'])  && $_GPC['token'] == $_COOKIE['form_token']  ){
                $have      = $_POST['have'];
                if(!$_GPC['intro']){
                    $this->myMessage('请填写内容','','错误');
                }
                if(!$have){
                    $this->myMessage('请选择用户或者群组','','错误');	
                } 
                foreach ($have as $key => $value) {
                    $have[$key] = intval($value);
                }		
                if($model=='class'){
                    $class_id_str    = implode(',', $have);
                    $student_list    = pdo_fetchall("select * from {$table_pe}lianhu_student where class_id in({$class_id_str}) and status=1 ");				
                    $in['class_ids'] = $class_id_str;
                }
                if($model=='student'){
                    $student_id_str = implode(',', $have);
                    $student_list   = pdo_fetchall("select * from {$table_pe}lianhu_student where student_id in({$student_id_str}) and status=1 ");	
                }
                $que_num=false;
                if($_GPC['submit_weixin']=='提交'){
                    $in['record_type']     = 4;
                    $in['record_title']    = $_GPC['title'];
                    $in['record_intro']    = $_GPC['intro'];
                    $in['record_content']  = $_GPC['content'];
                    //语音
                    $img_arrs              = $_POST['img_value'];
                    if($img_arrs){
                        foreach ($img_arrs as $key => $value) {
                            $img=$this->getWechatMedia($value);
                            if($img) 
                                $img_in[]= $img;
                            else 
                                $img_in[]= $up_file_name; 
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
                    $record_id         = $class_sendRecord->dataAdd($in);
                    unset($in);
                    foreach ($student_list as $key => $value) {
                        $url       = $_W['siteroot'].'app/'.$this->createMobileUrl("sendRecord",array('record_id'=>$record_id) )."&".'student_id='.$value['student_id'];
                        #遍历and发送
                        if($_GPC['title']){
                            $title = $_GPC['title'];
                            $title = str_ireplace('[学生姓名]',$value['student_name'],$title);
                        }else{
                            $title = $value['student_name'].'的家长您好，您有一个班级通知，请查看';
                        } 
                        $openids    = $class_student->returnEfficeOpenid($value,3);
                        $first      = $title;
                        $key2       = $admin_name; 
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
                }
                D('recordQueue')->add($record_id,$que_num);
                $this->myMessage("通知发布成功,消息将由后台自主发送给家长！",$this->createMobileUrl("teain"),'成功');
                // $this->myMessage('添加成功，跳转往发送页面，请勿关闭',$this->createMobileUrl('sendToMsg',array('que_num'=>$que_num)),'成功');
  }	