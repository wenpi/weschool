<?php 
namespace myclass\src;

class type{
    //消息类型
    public static function msgType($type){
        switch ($type) {
            case 1:
                return '模板消息';
            case 2:
                return '客服消息';
            case 3:
                return '短信消息';
            default:
                return '无法识别';
        }
    }
    
    
}