<?php 
namespace myclass\src;
class content{
    //解析消息发送的内容
    public static function msgContent($content,$type){
            $content = unserialize($content);
            if($type == 1){
                $out['title']  = $content['first']['value']; 
                $out['name']   = $content['keyword2']['value']; 
                $out['content']   = $content['keyword4']['value']; 
            }        
            if($type == 2){
                $out['title'] = $content['title'];
                $out['content'] = $content['content'] ;
            }
            if($type==3){
                $out['title'] = $content['head'];
                $out['content'] = $content['content'] ;              
            }
           return $out;
    }
    
    
}