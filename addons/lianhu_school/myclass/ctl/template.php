<?php 
namespace myclass\ctl;

class template{

    //本地可以使用的手机端模板
    public function mobileTemplates(){
        $local      = MODULE_ROOT."/template/";
        $file_list  = outGenFileList($local);
        return $file_list;
    }
    //微官网模板
    public function wapTemplates(){
        $local      = MODULE_ROOT."/wap/";
        $file_list  = outGenFileList($local);
        return $file_list;
    }
    //官网模板
    public function webTemplate(){
        $local      = MODULE_ROOT."/web/";
        $file_list  = outGenFileList($local);
        return $file_list;        
    }

}