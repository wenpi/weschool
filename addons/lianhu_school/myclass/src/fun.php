<?php 
namespace myclass\src;

require_once(IA_ROOT.'/framework/library/qrcode/phpqrcode.php');

class fun{
    //生成随机数字串
    public static function createRandNum($long){
        for($i=0;$i<$long;$i++){
            $str .= rand(0,9);
        }
        return $str;
    }
    //生成二维码
    public static function createQrcode($qrcode_value){
            echo \QRcode::png($qrcode_value,false,'',10,2);
            exit();
    }
    //把时间解析成 
    //['year','month','day','up_low']
    public static function decodeTimeToSlice($in_time=false){
        if(!$in_time){
            $in_time = time();
        }
        list($year,$month,$day,$h) =explode('-', date("Y-m-d-H",$in_time));
        if($h<=12){
            $up_low = 1;
        }else{
            $up_low = 2;
        }
        return array('year'=>$year,'month'=>$month,'day'=>$day,'up_low'=>$up_low);
    }
    //把where查询数组组合成string【and】
    public static function composeParamsToWhere($params,$before=false){
        if(!$params){
            return '';
        }
        foreach ($params as $key => $value) {
            $name    = trim($key,':');
            if($before){
                if(is_array($value)){
                    $strs[]  = $before.'.'.$name.' '.$value['0'].' '.$key;
                }else{
                    $strs[]  = $before.'.'.$name."=".$key;
                }
            }else{
                if(is_array($value)){
                    $strs[]      = $name.' '.$value[0].' '.$key;
                }else{
                    $strs[]      = $name."=".$key;
                }
            }
        }
        return implode(' and ',$strs);
    }
    //检测值是否存在
    //不存在直接报错
    public static function checkValueTrue($value,$name){
        if(!$value)
            message("值".$name."未填写",'referer','error');
    }
    //验证微擎的系统人员密码和提交的密码是否相等
    public static function checkEqPassword($in_password,$system_password,$hash){
        load()->model('user');
        $password = user_hash($in_password, $hash );
        if($password == $system_password )
            $out = true;
        else 
            $out = false;
        return $out;
    } 
    //解析分页参数
    public static function decodePages($now_page=1,$count=0,$every_page=20){
         if($count>0)
            return ceil($count/$every_page);
        $start = ($now_page-1)*$every_page;
        $limit = $start.','.$every_page;  
        return $limit;
    }
    //百度富文本编辑器
    //去除标签
    //限制字数
    public static function formatLimitContent($content,$num=200){
        $content = htmlspecialchars_decode($content);
        $content = strip_tags($content);
        $content = mb_substr($content,0,$num,'utf-8').'...';
        return $content;
    }
    //提取数组的某个key值组成一个数组
    public static function zuHeArr($arr,$in_key){
        $out_arr = array();
        foreach ($arr as $key => $value) {
            foreach ($value as $k => $v) {
                if($in_key == $k)
                    $out_arr[] = $v;               
            }

        }
        return $out_arr;
    }
    #使用七牛后判别是否是七牛
    public static  function imgFrom($imgname,$qiniu_url){
        global $_W;
        if(stristr($imgname,"qiniu")){
             return $qiniu_url.$imgname;
        }else{
            return $_W['attachurl'].$imgname;
        }
    }
    //decode imgs
    //arr 
    public static function decodeImgs($imgs,$qiniu_url){
          foreach ($imgs as $key => $value) {
            if($value){
                    $url[]=self::imgFrom($value,$qiniu_url);
            }
         }
         return $url;
    }
    //判断http || https
    public static function judeHttp(){
        if (stristr($_SERVER['HTTP_REFERER'],'https')) {
            $out = 'https';
        }else{
            $out = 'http';
        }
        return $out;
    }
    public static function fixModuleUrlBug(){
        global $_W;
		$http_type      = self::judeHttp();
		$module_url     = $_W['siteroot'];
		if($http_type == 'https'){
			if(!stristr($module_url,'https')){
				$module_url = str_ireplace('http','https',$module_url);
			}
		}	
       define(MODULE_URL,'../../addons/lianhu_school/');
    }
    //状态输出
    public static function statusTable($status){
        $arr = array(
            '-1' => '删除',
            '0'  => '注销',
            '1'  => '正常',
        );
        return $arr[$status];
    }
    //状态输出框
    public static function statusOut($val=-10){
        $arr = array(
            '1'  => '正常',
            '0'  => '注销',
            '-1' => '删除',
        );
        foreach ($arr as $key => $value) {
            if(  $val == $key){
                $out .= "<option value='{$key}' selected >{$value}</option>";
            }else{
                $out .= "<option value='{$key}'>{$value}</option>";
            }
        }        
        return $out;
    }
}
