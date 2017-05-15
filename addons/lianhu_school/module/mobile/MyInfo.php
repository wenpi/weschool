<?php 
$result         =  $this->mobile_from_find_student();
$student_name   = $result['student_name'];
$page_title     = '我的资料';
$my_info = pdo_fetch("select * from ".tablename('mc_members')." where uid=:uid ",array(':uid'=>$uid));
if($_GPC['submit']){
    $up['nickname'] = $_GPC['nickname'];
    $up['mobile']   = $_GPC['mobile'];
    $result = D('mcMembers')->findPhone($up['mobile']);
    if($result && $result['uid']!=$uid){
        $this->myMessage("更新失败该手机号,已被使用",$this->createMobileUrl('myInfo'),'错误');
    }
    pdo_update('mc_members',$up,array('uid'=>$uid) );
    $this->myMessage("更新成功",$this->createMobileUrl('home'),'成功');
}
