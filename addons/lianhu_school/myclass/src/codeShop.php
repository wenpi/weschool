<?php 
namespace myclass\src;

class codeShop extends common{
    public $code_key;

    public function __construct(){
        $this->setTable('lianhu_code_shop');
        $this->setGlobal();
    }
    public function getCode($code_key){
        $where["code_key"] = $code_key;
        return $this->edit($where);
    }
    

    


}