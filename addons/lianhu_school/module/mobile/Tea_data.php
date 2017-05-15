<?php
$teacher_info = $this->teacher_mobile_qx();
$student_name = $teacher_info['teacher_realname'];
$page_title   = '我的资料';
$_W['uid']    = $teacher_info['fanid'];
$school_logo  = S("system",'getSetContent',array('school_logo',$this->school_info['school_id']));
$school_logo  = $_W['attachurl'].$school_logo;
$result 	  = pdo_fetch("select tea.* ,users.username,users.uid from {$table_pe}lianhu_teacher tea 
						   left join ".tablename('users')." users on  users.uid=tea.fanid 
						   where tea.teacher_id=:tid",array(":tid"=>$teacher_info['teacher_id']));
if($_GPC['submit']){
	$up['teacher_telphone'] = $_GPC['teacher_telphone'];
	$up['teacher_email'] 	= $_GPC['teacher_email'];
    if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value']){
        $up['teacher_img']  = $this->getWechatMedia($_POST['img_value'],1,false);  
	}
    if(!strstr($_GPC['img_value_qr'],'images')  && $_GPC['img_value_qr']){
        $up['weixin_code']  = $this->getWechatMedia($_POST['img_value_qr'],1,false);  
	}
	$up['teacher_realname'] = $_GPC['teacher_realname'];	
	mc_update($uid,array('nickname'=>$up['teacher_realname']));
    if ($up['teacher_img']){
	    mc_update($uid,array('avatar'=>$_W['attachurl'].$up['teacher_img']));
	}
	D('teacher')->edit(array('teacher_id'=>$teacher_info['teacher_id']),$up);
	$this->myMessage('修改成功',$this->createMobileUrl('tea_data'),'成功');
}
