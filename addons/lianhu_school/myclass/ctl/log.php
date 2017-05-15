<?php
namespace myclass\ctl;

class log {
    public $log_local;


    public function __construct(){
        $file_name  = date("Y-m-d",time()).'.txt';
        $log_local  = MODULE_ROOT.'/log/';
        if(!file_exists($log_local)){
            mkdirs($log_local);
        }
        $this->log_local = $log_local.'.'.$file_name;
    }
    
    public function write($title,$content){
        $handle  = fopen($this->log_local,'a+');
        $content = "[".date("H:i:s")."][".$title."]".$content."\n";
        fwrite($handle,$content);
        fclose($handle);
    }


}