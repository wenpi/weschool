<?php 
namespace myclass\src;

class careChannelLog extends common{

    public $log_id;
    public $channel_id;
    public $openid;

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_care_channel_log');
    }  
    

}