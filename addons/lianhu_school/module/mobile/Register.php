<?php 
$ac = $_GPC['ac'];
if($ac=='mobile_code'){
    $mobile = $_GPC['mobile'];
    if(strlen($mobile)==11){
        $result = D("mcMembers")->findPhone($mobile);
        if($result){
            outJson(array("errcode"=>1,'msg'=>'该手机号已经存在'));
        }else{
            $code   =  C('smsRecord')->createCode($mobile);
            $title  =  S('base','getKeywordContent',array('name'));
            $content= "【".$title."】欢迎您注册使用,验证码为【".$code."】"; 
            $this->class_base->sendSmsMsg($mobile,$content);
            outJson(array("errcode"=>0,'msg'=>'ok'));
        }
    }else{
        outJson(array("errcode"=>1,'msg'=>'手机号码错误'));
    }
}
if($_GPC['mobile']){
    $mobile     = $_GPC['mobile'];
    $code       = $_GPC['code'];
    $password1  = $_GPC['password1'];
    $password2  = $_GPC['password2'];
    if($password1!=$password2 || strlen($password1)<6){
        $this->myMessage("两次密码不一，或者密码长度小于6位",$this->createMobileUrl('register'),'错误');
    }
    $result = D('smsRecord')->findByCode($code);
    if($result['phone']!=$mobile){
        $this->myMessage("验证码错误",$this->createMobileUrl('register'),'错误');
    }
    $arr['mobile']   = $mobile;
    $arr['password'] = $password1;
    $arr['nickname'] = $_GPC['name'];
    $uid             = D('mcMembers')->add($arr);
    setMemberUid($uid);
    $this->myMessage("注册成功",$this->createMobileUrl('bangding'),'成功');
}