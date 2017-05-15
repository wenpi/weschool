<?php 
namespace myclass\ctl;

class sms extends common{
    public $api_url;
    
    public function __construct(){
        $this->use_class = D('smsRecord');
    }

    public function setApi(){
		$this->api_url = $this->in_class_base->web_config['sms_set'];
    }
    //发送短信
    public function sendSms($phone,$content){
        $result = $this->use_class->findByTime($phone,$content);
        if($result){
            return 'repeat';
        }
        $api_url = $this->api_url;
		if(stripos($api_url,'str=gbk') && $content){
			$content = iconv("UTF-8","gbk//TRANSLIT",$content);
		}
		$api_url = str_replace("CONTENT",$content,$api_url);
		$api_url = str_replace("PHONE",$phone,$api_url);
		$re      = file_get_contents($api_url);
        //添加
        return $re;
    }


}