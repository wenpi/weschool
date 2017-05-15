<?php 
namespace myclass\src;

class mobileCode extends common{
    public $code_id     = 'code_id';
    public $code_value  = 'code_value';
    public $have_use    = 'have_use';
    public $mobile      = 'mobile';

    public function __construct(){
        $this->setTable('lianhu_mobile_code');
        $this->setGlobal();        
    }    
    



}