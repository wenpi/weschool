<?php 
namespace myclass\ctl;

class youmi {
    public $in_word;
    public $out_arr;
    public $class_base;
    public $duan_time = 60;
    public $youmi_types  = array(
        0=>'进入',
        1=>'离开',
        2=>'进入（卡电量低）',
        3=>'离开（卡电量低）',
        4=>'内部',
        5=>'外部',
        6=>'内部（卡电量低）',
        7=>'外部（卡电量低）',
        8=>'路径不确定',
        9=>'路径不确定（卡电量低）',
    ); 
    public function searchInfo($school_id){
        //1小时
        $begin_time           = time()-3600;
        $params[":school_id"] = $school_id;
        $in_num     = pdo_fetchcolumn("select count(record_id) num from ".tablename("lianhu_card_record")." where up_low=1 and add_time > ".$begin_time." and school_id = :school_id ",$params);
        $out_num    = pdo_fetchcolumn("select count(record_id) num from ".tablename("lianhu_card_record")." where up_low=2 and add_time > ".$begin_time." and school_id = :school_id ",$params);
        if($in_num>$out_num){
            return 1;
        }elseif($in_num<$out_num){
            return 2;
        }
    }
    //获取进出数据
    public function getOut(){
        global $_W;
        $cclass_device  = C('device');
        $cclass_student = C('student');
        $class_locus    = D('locus');
        $word           = $this->in_word;
        $g              = 0;
        $b              = 0;

        foreach ($word as $key => $value) {
            if(isset($value['strDevId'])){
                $cclass_device->device_openid = $value['strDevId'];
                $re                           = $cclass_device->findDeviceByOpenid();
                $_W['uniacid']                = $re['uniaicd'];
                if($re){
                    setSchoolId($re['school_id']);
                    $student_info              = $cclass_student->findStudentBySidArfid($re['school_id'],$value['strTagId']);
                    if(in_array($value['ioFlag'],array(4,5,6,7,8,9))){
                        $nums   = $this->searchInfo($re['school_id']);                   
                        if($nums==1){
                            $value['ioFlag'] = 0;
                        }elseif($nums==2){
                            $value['ioFlag'] = 1;
                        }else{
                            continue;
                        }
                    }
                    if($re['on_school_gate'] == 1){
                        $out_arr[$g]['school_id']  = $re['school_id'];
                        $out_arr[$g]['uniacid']    = $re['uniacid'];
                        $out_arr[$g]['device_name']= $re['device_name'];
                        $out_arr[$g]['device_id']  = $re['device_id'];
                        $out_arr[$g]['student_id'] = $student_info['student_id'];
                        $out_arr[$g]['rfid']       = $value['strTagId'];
                        $out_arr[$g]['time']       = $value['ioTime'];
                        $out_arr[$g]['ioFlag']     = $value['ioFlag'];
                        $g++;
                    }
                    $arr["student_id"]  = $student_info['student_id'];
                    $arr['device_name'] = $re['device_name'].$this->youmi_types[$value['ioFlag']];
                    $re                 = $class_locus->action($arr);

                    if((time()-$re['last_time']) > $this->duan_time){
                        $youmi_send[$b]['content']   = $arr['device_name'];
                        $youmi_send[$b]['student_id']= $arr['student_id'];
                        $b++;
                    }

                }
            }
        }
        $this->out_arr = $out_arr;
        return $youmi_send;
    }
    //添加打卡记录
    public function addRfidRecord(){
        $class_card    = D('card');
        $out_arr       = $this->out_arr;
        foreach ($out_arr as $key => $value) {
            if(!$value){
                continue;
            }
            $ioFlag = $value['ioFlag'];
            if($ioFlag==1 || $ioFlag== 3){
                $ioFlag =2;
            }elseif($ioFlag==0 || $ioFlag==2){
                $ioFlag =1;
            }
            $in['student_id']     = $value['student_id'];
            $in['device_id']      = $value['device_id'];
            $in['rfid_value']     = $value['rfid'];
            $in['img_url']        = '';
            $in['play_card_time'] = strtotime($value['time']);
            $in['up_low']         = $ioFlag;
            $record_id            = $class_card->addCardRecord($in);
            $record_ids[]         = $record_id;
        }
        return $record_ids;
    }
    //发送位置消息
    public function sendLocusInfo($student_id,$info){
        global $_W;
        $class_msg                = D('msg');
        $class_msg->in_class_base =  $this->class_base;
        $student_info  = D('student')->getStudentInfo($student_id);
        $openid_arr    = D('student')->returnEfficeOpenid($student_info,3);
        $key1          = $student_info['student_name'];
        $key2          = $info;
        $mu_info       = $class_msg->decodeSchoolLocus($key1,$key2);
        $url           = $_W['siteroot']."app/".D('base')->createMobileUrl('locusRecord',array('student_id'=>$record_re['student_id'] ));
        foreach ($openid_arr as $key => $value) {
            if($value){
                $out[] =  D('base')->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);             
            }
        }        
        return $out;
    }

}