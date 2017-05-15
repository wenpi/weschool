<?php 
    setMemberUid(0);
    if($_GPC['mobile'] && $_GPC['password']){    
        $result = D('mcMembers')->check($_GPC['mobile'],$_GPC['password']);
        if($result){
            setMemberUid($result['uid']);
            $this->myMessage("登录成功",$this->createMobileUrl('home'),'成功');
        }else{
            $this->myMessage("账号或密码错误",$this->createMobileUrl('login'),'错误');
        }
    }
