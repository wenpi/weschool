<?php 
//控制器
$class_admin        = D('admin');
$have_school_admin  = $class_admin->mobileValidSchoolAdmin();
$simple_title       = "我的信息";
$title              = $_SESSION['school_name'].'-'.$simple_title;
if(!$have_school_admin)
    header("Location:".$this->createMobileUrl("school_bangding"));
$my_info            = pdo_fetch("select * from ".tablename('mc_members')." where uid=:uid ",array(':uid'=>$uid));
if($_GPC["submit"]){
        if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value'])
                $up['avatar'] = $_W['attachurl_local'].$this->getWechatMedia($_POST['img_value'],1,false); 
         
	$up['nickname'] = $_GPC['full-name'];				
	$up['email']    = $_GPC['email'];	        
	$up['mobile']   = $_GPC['mobile'];	        
	mc_update($uid,$up);
    $this->myMessage("更新成功",$this->createMobileUrl("school_info"),'成功');
}
$signPackage        = $this->getSignPackage();
include $this->template("school/info");
exit();