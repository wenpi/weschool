<?php 
namespace myclass\ctl;

class smsRecord extends common{

    
    public function __construct(){
        $this->use_class = D('smsRecord');
    }

    public function createCode($phone){
        do{
            $code = rand(1111,9999);
        }while($result = $this->use_class->findByCode($code));
        $this->use_class->addCode($code,$phone);
        return $code;
    }





}
