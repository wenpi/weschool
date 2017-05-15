<?php 
namespace myclass\ctl;

class api{
    public $api_server = 0;
    public $api_ip     = '';
    public $api_passport = '';
    public $api_password = '';

    public $errcode_1    =  array("errcode"=>1,'msg'=>'未开发API','code'=>'001');
    public $errcode_2    =  array("errcode"=>1,'msg'=>'IP未在允许范围内','code'=>'002');
    public $errcode_3    =  array("errcode"=>1,'msg'=>'API账号或者密码错误','code'=>'003');

    public function __construct(){
        $this->api_server   =  S('base','getKeywordContent',array('api_server',false));
        $this->api_ip       =  S('base','getKeywordContent',array('api_ip',false));
        $this->api_passport =  S('base','getKeywordContent',array('api_passport',false));
        $this->api_password =  S('base','getKeywordContent',array('api_password',false));
    }
    //访问初检
    public function askCheck($api_passport,$api_password){
        if($this->api_server!=1){
            outJson($this->errcode_1);
        }
        $ask_ip = toGetIp();
        if($this->api_ip!="*"){
            if(!$this->api_ip){
                outJson($this->errcode_2);
            }
            $ip_arr = explode(",",$this->api_ip);
            if(!in_array($api_ip,$ip_arr)){
                outJson($this->errcode_2);
            }
        }
        if(!$this->api_passport || !$this->api_password){
                outJson($this->errcode_3);
        }
        if($this->api_passport!=$api_passport || md5($this->api_password)!=$api_password){
                outJson($this->errcode_3);
        }
    }


}