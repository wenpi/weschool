<?php 
namespace myclass\ctl;

class module extends common{
    public $ask_yun   = 'shop/getList';
    public $my_module = 'shop/myModule';
    public $token ;
    
    public function __construct(){
        $this->use_class = D('module');
    }
    //获取我已经购买的



}