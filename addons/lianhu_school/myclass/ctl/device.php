<?php 
namespace myclass\ctl;

class device extends common{
    public $device_openid;

    public function __construct(){
        $this->use_class = D('device');
    }
    //根据设备device_openid查找设备
    public function findDeviceByOpenid(){
        $device_openid           = $this->device_openid;
        $params["device_openid"] = $device_openid;
        $result = $this->use_class->edit($params);
        if($result){
            return $result;
        }else{
            return 0;
        }
    }
    //获取学校现有的校车
    public function getSchoolBusList(){
        $where[':school_id']      = getSchoolId();
        $where[":device_status"]  = 1;
        $where[":device_type"]    = 5;
        $this->use_class->each_page = 2000;
        $re = $this->use_class->getList($where);
        return $re['list'];
    }



}