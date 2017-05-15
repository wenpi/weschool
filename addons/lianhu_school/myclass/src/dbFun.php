<?php 
namespace myclass\src;

class dbFun {

    public static function composeWhere($params){
        $g = 0;
        $where_str = ' ';
        foreach ($params as  $key=>$value) {
            if(is_array($value)){   
                if($g>0){
                    $where_str .= " and ".$key ." ".$value[0]." ? ";
                }else{
                    $where_str  = $key ." ".$value[0]." ? ";
                }
            }else{
                if($value == 0){
                    $in = 0;
                }else{
                    $in = "?";
                }
                if($g>0){
                    $where_str .=  " and ".$key." =  ".$in;
                }else{
                    $where_str  =  $key."= ".$in;
                }
            }
            $g++;
        }
        return $where_str;
    }
    //组合param 
    public static function composeParams($params){
        foreach ($params as $value) {
            if($value){
                if(is_array($value)){
                    $out[] = $value[1];
                }else{
                    $out[] = $value;
                }
            }
        }
        return $out;
    }
    //组合insert 
    public static function composeInsert($params){
        $g        = 0;
        $in_str   = ' ';
        foreach ($params as $key=>$value) {
            if($g>0){
                $in_str .=  " , ".$key;
            }else{
                $in_str  =  $key;
            }
            $g++;
        }
        return $in_str;
    }
    //组合成values
    public static function composeValues($params){
        $count  = count($params);
        for($i=0;$i<$count;$i++){
            if($i==0){
                $str = ' ? ';
            }else{
                $str.= ' ,? ';
            }
        }
        return $str;
    }
    //组合成update
    public static function composeUpdate($params){
        $g        = 0;
        $up_str   = ' ';
        foreach ($params as $key=>$value) {
            if($g>0){
                $up_str .=  " , ".$key.'= ? ';
            }else{
                $up_str  =  $key.'= ? ';
            }
            $g++;
        }
        return $up_str;        
    }
    
}