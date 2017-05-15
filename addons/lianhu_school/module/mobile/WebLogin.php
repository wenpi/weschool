<?php 
    $up['scan_uid']    = $uid;
    $up['scan_time']   = time();
    $up['scan_status'] = 1;
    $up['scan_openid'] = $_W['openid'];
    $class_qrcode      = D('qrcode');
    $result     = $class_qrcode->dataEdit($_GPC['code_value'],$up);
    $this->myMessage("登录成功",'','success');
    exit();

