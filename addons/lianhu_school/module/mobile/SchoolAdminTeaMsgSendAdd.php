<?php
    if($ac=='teacher'){
        $teacher_info = $this->teacher_mobile_qx(); 
        $send_name    = $teacher_info['teacher_realname'];
    }else{
        $school_admin  = D('admin')->mobileValidSchoolAdmin();
        if(!$school_admin){
            header("Location:".$this->createMobileUrl("school_bangding"));
        }
        $send_name     = $school_admin['info']['admin_name'];
    }

    $title         = '教师消息发送';
    $class_teacher = D('teacher');

    if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token']  ){
        $have = $_GPC['have'];
        if($have){
            $img_arrs = $_POST['img_value'];
            if($img_arrs){
                foreach ($img_arrs as $key => $value) {
                    $img = $this->getWechatMedia($value);
                    if($img){
                        $img_in[] = $img;
                    }else{
                        $img_in[] = $up_file_name; 
                    }
                }
            }   
            if($img_in){
                $in['imgs'] = serialize($img_in);                   
            }
            if($_POST['voice_value']){
                $in['voice']   = $this->getWechatMedia($_POST['voice_value'],2,false);               
            }
            $in['record_title']    = $_GPC['title'];
            $in['record_intro']    = $_GPC['intro'];
            $in['record_content']  = $_GPC['content'];

            $in['record_type']     = $ac=='teacher' ? 12:13;
            $in['have']            = implode(',',$have);
            $record_id             = D('sendRecord')->dataAdd($in);
            unset($in);
            foreach ($have as $key => $value) {
                if($ac=='teacher'){
                    if($value==$teacher_info['teacher_id']){
                        continue;
                    }
                }
                $record_url = $_W['siteroot'].'app/'.$this->createMobileUrl("TeaSendRecord",array('record_id'=>$record_id,'teacher_id'=>$value ));
                $title      = $_GPC['title'];
                $openid     = $class_teacher->getTeacherOpenid($value);
                $first      = $title;
                $key2       = $send_name;
                $key4       = $_GPC['intro'];
                $remark     = "请点击查看详情";				
                if($openid){
                    $mu_info    = $this->decodeMsg($first,$key2,$key4,$remark);     
                    $que_num    = D("msg")->insertMsgQueueMu($openid,$mu_info['data'],$mu_info['mu_id'],$record_url,$que_num);                   
                }
            }
            D('recordQueue')->add($record_id,$que_num);
            $this->myMessage("通知发布成功,消息将由后台自主发送给教师！",$this->createMobileUrl("schoolAdminTeaMsgSend"),'成功');
         }else{
            $this->myMessage("请选择要发送消息的教师",$this->createMobileUrl("schoolAdminTeaMsgSend"),"错误");
        }
    }else{
        $this->myMessage("非法访问",$this->createMobileUrl("schoolAdminTeaMsgSend"),"错误");
    }