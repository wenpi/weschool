<?php 
    $result       = $this->mobile_from_find_student();
    $code_value = $_GPC['value'];
    $re = C('courseQrcode')->getInfo($code_value);
    //
    if($re){
        $where["student_id"] = $result['student_id'];
        $where["course_id"]  = $re['course_id'];
        $where["use_num"]    = array('>',0);
        $renums = C('courseStudent')->use_class->edit($where);
        if($renums){
            C('courseQrcode')->addScan($code_value);
            $in['student_id'] = $result['student_id'];
            $in['course_id']  = $re['course_id'];
            $in['qrcode_id']  = $re['qrcode_id'];
            C('courseDelete')->use_class->add($in);
            $up['use_num']    = $renums['use_num']-1;
            C('courseStudent')->use_class->edit(array('id'=>$renums['id']),$up);
            $this->myMessage('扫码成功，已扣除您一次课时','','成功');

        }else{
            $this->myMessage('您未有有效次数',$this->createMobileUrl('home'),'失败');
        }
    }else{
        $this->myMessage('未找到该二维码',$this->createMobileUrl('home'),'失败');
    }
    exit();