<?php 
namespace myclass\src;

class deviceHeart extends common{
    public $device_id = 'device_id';

    public function __construct(){
        $this->setTable('lianhu_device_heart');
        $this->setGlobal();
    }
    public function findByDevice($device_id){
        $where["add_time"]  = array(">=",time()-600);
        $where["device_id"] = $device_id;
        $this->field_str    = 'device_id';
        $result = $this->edit($where);
        return $result;
    }


}