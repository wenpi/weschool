<?php 
namespace myclass\src;
class textLog{
    //写入日志
    public function writeLog($text){
        $text    .= "     [".date("Y-m-d H:i:s",time())."]\r\n";
        $hander   = fopen(IA_ROOT.'/addons/lianhu_school/file/log.txt','a+');						    
        fwrite($hander,$text);
		$result   = fclose($hander);
    }
}