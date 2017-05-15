<?php 
namespace myclass\ctl;

class schoolBus extends common{
    public $device_id;
    public $begin_time;
    public $end_time;
    public $baidu_url = 'http://api.map.baidu.com/geoconv/v1/';
    public $ask_key   = '52c98799d98f668ebe11f46d655abd82';

    public function __construct(){
        $this->use_class = D('schoolBus');
    }
    //gps to 百度坐标
    public function gpsToBaidu($in){
        $gps      = "?coords=".$in['lon'].",".$in['lat']."";
        $ask_url  = $this->baidu_url.$gps.'&from=1&to=5&ak='.$this->ask_key;
        $content  = file_get_contents($ask_url);
        $arr      = json_decode($content,1);
        if($arr['status']==0){
            $out['lon'] = $arr['result'][0]['x'];
            $out['lat'] = $arr['result'][0]['y'];
        }else{
            $out        = $in;
        }
        return $out;
    }
    //坐标 to 地名
    //等待高德ditu 
    public function baiduGpsToAddress(){

    }
    //今天的行驶轨迹:送
    public function toDaySend(){
        $begin_time       = strtotime(date("Y-m-d 12:00",time()));
        $end_time         = $begin_time+3600*12;
        $this->begin_time = $begin_time;
        $this->end_time   = $end_time;
        $list             = $this->timeOrbit();
        return $list;       
    }
    //今日的行驶轨迹：接
    public function toDayJoin(){
        $begin_time       = strtotime(date("Y-m-d",time()));
        $end_time         = $begin_time+3600*12;
        $this->begin_time = $begin_time;
        $this->end_time   = $end_time;
        $list             = $this->timeOrbit();
        return $list;
    }
    //按时间的搜索行驶轨迹
    public function timeOrbit(){
        $params[":device_id"] = $this->device_id;
        $where_sql            = " add_time >= ".$this->begin_time." and add_time <= ".$this->end_time."   ";
        $re                   = $this->use_class->getList($params,$where_sql);
        foreach ($re['list'] as $key => $value) {
            if(intval($value['lat'])==0 && intval($value['lon'])==0){
                unset($re['list'][$key]);
            }
        }
        return $re['list'];
    }
    //校车：根据打卡的时间和校车id获取gps
    public function getCardGps($time,$device_id){
        $params[":begin_time"] = $time-10;
        $params[":end_time"]   = $time+10;
        $params[":device_id"]  = $device_id;
        $sql = " add_time <= :end_time and add_time>=:begin_time and device_id=:device_id ";
        $re  = $this->use_class->getSqlList($params,$sql);
        return $re['list'][0];
    }




}