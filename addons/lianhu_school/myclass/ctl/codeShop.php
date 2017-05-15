<?php 
namespace myclass\ctl;

class codeShop extends common{
    public function __construct(){
        $this->use_class = D('codeShop');
    }
    public function begin($module_list,$my_ids){
        foreach ($module_list as $key => $value) {
            if(in_array($value['shop_id'],$my_ids)){
                $this->add($value['shop_key']);
            }
        }
    }
    public function add($code_key){
        $re = $this->use_class->getCode($code_key);
        if(!$re){
            $params["code_key"] = $code_key;
            $this->use_class->add($params);
        }
    }

}