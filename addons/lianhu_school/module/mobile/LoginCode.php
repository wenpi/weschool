<?php 
/*
*移动端登录二维码
*/  
    $class_qrcode = D('qrcode');
    if($_GPC['ac']!='check'){
        $title        = "扫码登录";
        $code_value   = $class_qrcode->dataAdd(2);
        $before_url   =  $_W['siteroot'].'app/'.$this->createMobileUrl('webLogin').'&code_value='.$code_value;
        $base_dir     = $this->insertDir();
        $file_name    = $base_dir.time().rand(111111,999999).'.png';
        QRcode::png($before_url,$file_name,'',10,2);
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        $img_url      = $_W['siteroot'].'/attachment/'.$up_file_name;
        include $this->template('../../admin/mobile/login_code');
        exit();
    }else{
        $code_value['code_value'] = $_GPC['code_value'];
        $result                   = $class_qrcode->edit($code_value);
        if($result['scan_uid']){
            $fanid = S("base","openi2fanid",array($result['scan_openid']));
            setMemberUid($result['scan_uid']);
            setMemberFanid($fanid);
            $middle_url = M('url');
            $arr['errcode'] = 0;
            $arr['url']     =  $_W['siteroot'].'app/'.$this->createMobileUrl('home');
            if($middle_url && $_GPC['pc']){
                $re = $middle_url->toTeacherPc();
                $arr['url'] = $re['url'];
            }
            outJson($arr);
        }
    }
