<?php 
	$this->checkAdminWeb();
	$admin_result   = D('admin')->judeAdminType();
    $title          = '系统维护';  
    $left_top     = 'system_set';
    $left_nav     = 'system_update';
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'系统设置'),
        array('fun_str'=>'systemfix','fun_name'=>'系统维护'),
    );
    $top_action = array(
        array('action_name'=>'系统维护','action'=>'systemfix' ),
        array('action_name'=>'系统参数设置','action'=>'systemfix','arr'=>array('ac'=>'system_params_set' ) ),
        array('action_name'=>'学校类型设置','action'=>'systemfix','arr'=>array('ac'=>'school_type_set' ) ),
        array('action_name'=>'调用支付设置','action'=>'setPay' ),
    );
    $page_name    = '调用支付设置';
    $settings = $this->module['config'];
    if (checksubmit()) {
            $params = array();
            $cfg = array(
                'msg'             => $settings['msg'],
                'msg1'            => $settings['msg1'],
                'msg01'           => $settings['msg01'],
                'msg11'           => $settings['msg11'],
                'msg_card'        => $settings['msg_card'],
                'homework_msg'    => $settings['homework_msg'],
                'version'         => $settings['version'],
                'mylovekid'       => $settings['mylovekid'],
                'family_set'      => $settings['family_set'],
                'sms_set'         => $settings['sms_set'],
                'qiniu'           => $settings['qiniu'],
                'qiniu_url'       => $settings['qiniu_url'],
                'qiniu_pipeline'  => $settings['qiniu_pipeline'],
                'qiniu_AccessKey' => $settings['qiniu_AccessKey'],
                'qiniu_SecretKey' => $settings['qiniu_SecretKey'],
                'qiniu_bucket'    => $settings['qiniu_bucket'],
                'jia_passport'    => $settings['jia_passport'],
                'jia_password'    => $settings['jia_password'],
                'admin_openid'    => $settings['admin_openid'],
                'pay_do'          => $_GPC['pay_do'],
                'img_qiniu'       => $settings['img_qiniu'],
                'pay_uniacid'     => $_GPC['pay_uniacid'],
                'follow_code'     => $settings['follow_code'],
                'parent_msg'      => $settings['parent_msg'],
                'teacher_msg'     => $settings['teacher_msg'],
                'school_locus'    => $settings['school_locus'],
                'email_msg'       => $settings['email_msg'],
            );
            if ($this->saveSettings($cfg)) {
                $this->myMessage('设置成功',$this->createWebUrl("SetPay"),'成功');
            }
        }
        $uniacid_list = D('platform')->getAllPlatform();
        include $this->template('../admin/SetPay');
        exit();
  
