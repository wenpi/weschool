<?php 
namespace myclass\src;

class qrcode extends common{
    public function __construct(){
        $this->setTable('lianhu_qrcode');
        $this->setGlobal();
    }
    public function dataEdit($code_value,$up=false){
        $where["code_value"] = $code_value;
        $result              = parent::edit($where,$up);
        return $result;
    }
    //生成二维码
    public function dataAdd($web_wap){
        do{
            $code_value = S("fun","createRandNum",array(20));
            $result     = $this->dataEdit($code_value);
        }while($result);
        $in['web_wap']      = $web_wap;
        $in['code_value']   = $code_value;
        parent::add($in);
        return $code_value;
    }

}