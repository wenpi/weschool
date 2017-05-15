<?php 
namespace myclass\src;

class smsRecord extends common{
    public $phone;
    public $content;
    //public $status; 1=>内容发送；2=》验证码

    public function __construct(){
        $this->setTable('lianhu_sms_record');
        $this->setGlobal();       
    }

    public function findByTime($phone,$content){
        $params["phone"]    = $phone;
        $params["content"]  = $content;
        $params["add_time"] = array(">=",time()-600);
        $params["status"]   = 1;
        $result             = $this->edit($params);
        if(!$result){
            unset($params['add_time']);
            $this->add($params);
        }
        return $result;
    }

    public function findByCode($code){
        $params["content"]  = $code;
        $params["status"]   = 2;
        $params["add_time"] = array(">=",time()-600);//10分钟有效
        $result             = $this->edit($params);
        return $result;
    }

    public function addCode($code,$phone){
        $params["content"] = $code;
        $params["phone"]   = $phone;
        $params["status"]  = 2;
        $result            = $this->add($params);
        return $result;
    }

    

}