<?php 
namespace myclass\src;

class schoolAdmin extends common{
    public $admin_id    = 'admin_id';
    public $uid         = 'uid';
    public $status      = 'status';
    public $mobile_uid  = 'mobile_uid';
    public $have_up     = 'have_up';
    public $db_admin_id = 'db_admin_id';

    public function __construct(){
        $this->setTable('lianhu_school_admin');
        $this->setGlobal();        
    }
    //获取opend
    public function getOpenid($admin_id){
        $params["admin_id"] = $admin_id;
        $result = $this->edit($params);
        if($result['mobile_uid']){
            $openid =  S("base",'uid2openid',array($result['mobile_uid']));
            return $openid;
        }
        return false;
    }
    
}