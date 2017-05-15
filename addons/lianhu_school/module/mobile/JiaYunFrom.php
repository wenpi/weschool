<?php 
    global $_W;
    $_W['uniacid']      = $_W['uniaccount']['uniacid'];
    $nonce              = $_GPC['nonce'];
    $sign               = $_GPC['sign'];
    $timestamp          = $_GPC['timestr'];
    $class_student      = D('student');
    $class_card         = D('card');
    $class_school       = D('school');
    $class_msg          = D('msg');
    $cclass_cardRecord  = C('cardRecord'); 
    $post_type          = $_GPC['post_type'];
    $class_msg->in_class_base =  $this->class_base;
    
    //电量提醒
    if($_GPC['battery']=='yes'){
        $student_id   = $_GPC['student_id'];
        $battery_num  = $_GPC['battery_num'];
        $bian_hao     = $_GPC['bian_hao'];
        $student_info = $this->getStudentInfo($student_id);
        $openid_arr   = $class_student->returnEfficeOpenid($student_info,3);
        $mu_info      = $class_msg->batteryMsg($student_info['student_name'],$battery_num,$bian_hao);
        foreach ($openid_arr as $key => $openid) {
           $result = $this->class_base->sendTplNotice($openid,$mu_info['mu_id'],$mu_info['data']);   
        }
        exit();
    }

    if($_GPC['__input_json']){
        $_GPC['__input_json'] = urldecode($_GPC['__input_json']);
        $input_json           = base64_decode($_GPC['__input_json']);
        $input_out            = unserialize($input_json);
        $_GPC['__input']      = $input_out;
        $_GPC['type']         = 0;
    }
    
    //接自定义机器
    if($_GPC['define_my_self']){
        $define_my_self           = $_GPC['define_my_self'];
        $define_my_self           = urldecode($define_my_self);
        $list                     = json_decode($define_my_self,true);
        //Au不做验证
        $class_doAction           = Au('jiacard/doAction');
        $class_doAction->get_list = $list;
        $record_ids               = $class_doAction->addRfidRecord();
        
    }elseif(!$_GPC['type'] && $_GPC['__input']){
        $jsondata              = $_GPC['__input'];
        $cclass_youmi          = C("youmi");
        $cclass_youmi->in_word = $jsondata;
        // C('log')->write('youmi远程',json_encode($jsondata));
        $youmi_send            = $cclass_youmi->getOut();
        $out_arr               = $cclass_youmi->out_arr;

        foreach ($out_arr as $key => $value) {
            if($value['uniacid'] != $_W['uniaccount']['uniacid']){
                //不是此公众号,原则上每次只有一个公众号数据传递
                $url             = $_W['siteroot'].'/app/index.php?i='.$value['uniacid'].'&c=entry&do=jiaYunFrom&m=lianhu_school';   
                $data['__input'] = $jsondata;  
                $this->http_post($url,$data);
                unset($cclass_youmi->out_arr[$key]);
            }
        }
        $cclass_youmi->class_base = $this->class_base;
        //发送位置消息
        /*
        if($youmi_send){
            foreach ($youmi_send as $key => $value) {
                $result = $cclass_youmi->sendLocusInfo($value['student_id'],$value['content']);
                var_dump($result);
            }
        }
        */
        $record_ids = $cclass_youmi->addRfidRecord();
    }else{
        $result    = $this->validSign($nonce,$sign,$timestamp);
        if(!$result){
            exit('非法访问');
        }
        //普通考勤机通道
        if($post_type == 'card'){
            if($_GPC['teacher']!=1){
                $student_id         =  $_GPC['student_id'];
                $cclass_cardRecord->student_id = $student_id;
                $arr['student_id']  = $student_id;
            }else{
                $teacher_id         = $_GPC['teacher_id'];
                $cclass_cardRecord->teacher_id = $teacher_id;
                $arr['teacher_id']  = $teacher_id;
            }
            $arr['device_id']    =  $_GPC['device_id'];
            $arr['rfid_value']   =  $_GPC['rfid_value'];
            $time_date           =  $_GPC['time_date'];
            $school_id           =  $_GPC['school_id'];
            $img_url             =  $_GPC['img_url'];
            $signTemp       =  $_GPC['signTemp'];
            $cclass_cardRecord->rfid_value = $arr['rfid_value'];
            $doing          = $cclass_cardRecord->lastRecord();
            $device_info    = D("device")->edit(array("device_id"=>$arr['device_id']));

            if(!$doing && !$device_info['room_controller']){
                exit("设定时间内重复推送！");
            }
            //获取图片到本地
            if($_GPC['img_url']){        
                $base_dir     = $this->insertDir();
                $file_name    = $base_dir.time().rand(111111,999999).'.jpeg';
                $this->getImg($_GPC['img_url'],$file_name);
                $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
                $img_url      = $_W['attachurl_local'].$up_file_name;
            }
            //获取全景图片到本地
            if($_GPC['img_url2']){
                $base_dir     = $this->insertDir();
                $file_name    = $base_dir.time().rand(111111,999999).'.jpeg';
                $this->getImg($_GPC['img_url2'],$file_name);
                $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
                $img_url2     = $_W['attachurl_local'].$up_file_name;               
            }
            $play_card_time         = strtotime($time_date);
            //插入记录
            $arr['img_url']          = $img_url;
            if($img_url2){
                $arr['img_url2']     = $img_url2;
            }
            $arr['signTemp']         = $signTemp;
            $arr['play_card_time']   = $play_card_time;
            $arr['up_low']           = $_GPC['ioflag'];
            //拦截
            if($device_info['room_controller']){
                Au("room/roomCard")->dataAdd($arr);
                exit();
            }
            $record_ids[]            = $class_card->addCardRecord($arr);            
        }
        //讯贞校车
        if($post_type == 'xuzn_schoolbus'){
            $class_schoolBus  = C('schoolBus');
            setSchoolId($_GPC['school_id']);
            $in['device_id'] = $_GPC['device_id'];
            $in['lat']       = $_GPC['lat'];
            $in['lon']       = $_GPC['lon'];
            $baidu_re        = $class_schoolBus->gpsToBaidu($in);
            $in['baidu_lon'] = $baidu_re['lon'];
            $in['baidu_lat'] = $baidu_re['lat'];
            $id              = $class_schoolBus->use_class->add($in);
        }
    }
    var_dump($record_ids);
    if($record_ids){
            foreach ($record_ids as $key => $record_id) {
                $record_re                = D('cardRecord')->edit(array('record_id'=>$record_id));
                $device_id                = $record_re['device_id'];
                $de_info                  = D('device')->edit(array('device_id'=>$device_id));
                $device_name              = $de_info['device_name'];
                //校车设备添加打卡地点
                
                $time_date                = date("Y-m-d H:i:s",$record_re['play_card_time']);
                if($record_re['up_low']==1){
                    $first       =  '到校打卡通知';
                }elseif($record_re['up_low']==2){
                    $first       =  '离校打卡通知';
                }else{
                    $first       =  '异常打卡';
                }
                $key4            =  "打卡机：".$device_name.'；';
                if($signTemp){
                    $remark      =  '体温为：'.$signTemp;
                }else{
                    $remark      = '点击查看详情';
                } 
                $status          = $first;   
                if($record_re['student_id']){
                    $url                     = $_W['siteroot']."app/".D('base')->createMobileUrl('card_record',array('student_id'=>$record_re['student_id'],'time'=>$record_re['play_card_time'] ) );
                    $student_info            = $this->getStudentInfo($record_re['student_id']);
                    setSchoolId($student_info['school_id']);        
                    //获取学生的三个家长openid
                    $openid_arr = $class_student->returnEfficeOpenid($student_info,3);
                    if($openid_arr['f_openid'] || $openid_arr['s_openid'] || $openid_arr['t_openid']){
                        $this->class_base->student_id = $student_info['student_id'];
                        $key2    =  $student_info['student_name'].'在'.$time_date.'打卡';
                        $mu_info = $class_msg->decodeMsgCard($first,$student_info['student_name'],$time_date,$status,$key4.$remark);
                        foreach ($openid_arr as $key => $value) {
                            if($value){
                                $result    =  $this->class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);             
                                var_dump($result);
                            }
                        }
                    }
                }else{
                    $url        = $_W['siteroot']."app/".$this->createMobileUrl('teaCardRecord',array('teacher_id'=>$record_re['teacher_id'],'time'=>$record_re['play_card_time'] ) );
                    $teacher_re = D('teacher')->edit(array('teacher_id'=>$record_re['teacher_id']));
                    setSchoolId($teacher_re['school_id']);
                    $openid = S('base','uid2openid',array($teacher_re['uid']));
                    if($openid){
                        $key2      = $teacher_re['teacher_realname'].'【教师】在'.$time_date.'打卡';
                        $mu_info   = $class_msg->decodeMsgCard($first,$teacher_re['teacher_realname'].'【教师】',$time_date,$status,$key4.$remark);
                        $result    =  $this->class_base->sendTplNotice($openid,$mu_info['mu_id'],$mu_info['data'],$url);             
                        var_dump($result);
                    }
                }

          }
          exit();
    }

    