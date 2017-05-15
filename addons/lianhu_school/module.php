<?php
/**
 * 家校通模块定义
 *
 * @author zhuhuan
 * @url http://bbs.we7.cc/
 */
require("myclass/autoLoad.php");
class Lianhu_schoolModule extends WeModule {
	public function myMessage($msg,$url,$status){
		if(defined('IN_MOBILE')){
			$template = '../../admin/app_message'; 
        }else{
			$template = '../admin/web_message'; 
        }
		include $this->template($template);	
		exit();
	}
	public function settingsDisplay($settings) {
        exit("不在提供此方法修改系统参数");
        global $_GPC, $_W;
        @session_start();
 		if($_GPC['aw']){
			$aw = 1;
			$left_top     = 'system_set';
			$left_nav     = 'system_parameter';
			$title        = '系统参数';  
			$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'系统设置'),
				array('fun_str'=>'','fun_name'=>'系统参数'),
			);
		}else{
			$aw = 0;
		}
        $config = $settings;
        if (checksubmit()) {
            $params = array();
            $cfg = array(
                'msg'             => $_GPC['msg'],
                'msg1'            => $_GPC['msg1'],
                'msg01'           => $_GPC['msg01'],
                'msg11'           => $_GPC['msg11'],
                'msg_card'        => $_GPC['msg_card'],
                'homework_msg'    => $_GPC['homework_msg'],
                'version'         => $_GPC['version'],
                'mylovekid'       => $_GPC['mylovekid'],
                'family_set'      => $_GPC['family_set'],
                'sms_set'         => $_GPC['sms_set'],
                'qiniu'           => $_GPC['qiniu'],
                'qiniu_url'       => $_GPC['qiniu_url'],
                'qiniu_pipeline'  => $_GPC['qiniu_pipeline'],
                'qiniu_AccessKey' => $_GPC['qiniu_AccessKey'],
                'qiniu_SecretKey' => $_GPC['qiniu_SecretKey'],
                'qiniu_bucket'    => $_GPC['qiniu_bucket'],
                'jia_passport'    => $_GPC['jia_passport'],
                'jia_password'    => $_GPC['jia_password'],
                'admin_openid'    => $_GPC['admin_openid'],
                'pay_do'          => $_GPC['pay_do'],
                'img_qiniu'       => $_GPC['img_qiniu'],
                'pay_uniacid'     => $_GPC['pay_uniacid'],
                'follow_code'     => $_GPC['follow_code'],
                'parent_msg'      => $_GPC['parent_msg'],
                'teacher_msg'     => $_GPC['teacher_msg'],
                'school_locus'    => $_GPC['school_locus'],
                'email_msg'       => $_GPC['email_msg'],
            );
            if ($this->saveSettings($cfg)) {
                $this->myMessage('保存成功', '','成功');
            }
        }
		load()->func('tpl');
        $uniacid_list = D('platform')->getAllPlatform();
        if($_GPC['aw']==1){
		    include $this->template('../admin/web_setting');
        }else{
		    include $this->template('setting');
        }
    }
}