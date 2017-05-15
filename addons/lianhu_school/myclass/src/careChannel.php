<?php 
namespace myclass\src;

class careChannel extends common{

    public $channel_id;
    public $ticket;

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_care_channel');
    }  
    

}