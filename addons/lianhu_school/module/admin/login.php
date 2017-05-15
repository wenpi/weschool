<?php 
$title = '管理员登录';
//检测是否独立进入
if(IN_ALONE=='yes'){
    $base_url           = 'check/databaseUp';
    $ver_list           = $this->getAllVersion();
    $params["last_ver"] = $ver_list[0]['version']; 
    $params["uniacid"]  = $_W['uniacid']; 
    $arr         	    = $this->askCenter($base_url,$params);
    if($arr['errcode']==0){
        if($arr['arr']){
            $database_new_version = $arr['arr']['newer_version'];
            $database_much_num    = $arr['arr']['database_much_num'];
            $last_up_info         = $arr['arr']['info'];
        }
    }	
}
//登录操作  
if($_GPC['username']){
    $result = D('admin')->systemLogin($_GPC['username'],$_GPC['password']);    
    if($result['errcode']==1){
        if($_GPC['pc']){
            outJson(array('errcode'=>1,'msg'=>$result['msg']));
        }else{
            $this->myMessage($result['msg'],referer(),'错误');
        }
    }elseif($result['errcode']==0) {
        $admin_info = D('admin')->judeAdminType($result['uid']);
        $middle_url = M('url');
        if($middle_url && $_GPC['pc'] && $admin_info['admin']=='teacher'){
            $to_url = $middle_url->pwToTeacherPc();
            outJson(array('errcode'=>0,'url'=>$to_url));
        }
        if(!$to_url){
            $this->myMessage('登录成功', $_W['siteroot'].'web/'.$this->createWebUrl('adminloginCheck'),'成功');
        }
    }
}
