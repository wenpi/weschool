<?php
namespace myclass\src;

class device extends common{

   public $device_type = array(
       1=>'迅贞刷卡考勤机',
       2=>'瑞楠科技类考勤机',
       4=>'瑞楠科技类远程考勤机[只需设备id和设备名]',
       5=>'迅贞校车设备[只需设备id和设备名]',
       6=>'中安科技闸机[只需设备id和设备名]',
       7=>'电子学生证读头',
   );

   public $display_type =  array(
       1=>array('img_ad_name','img_ads','template_device','video_url'),
       2=>array('img_ad_name','img_ads','video_name','video_url'),
       4=>array('on_school_gate'),
       5=>array(''),
       6=>array(''),
       7=>array('on_school_gate'),
   );

   public function __construct(){
        $this->setTable('lianhu_device');
        $this->setGlobal();
    }

    public function dataAdd($arr){
        return $this->add($arr);
    }    
    public function dataEdit($id,$up=false){
        $where["device_id"] = $id;
        $result             = $this->edit($where,$up);
        return $result;
    }   
    public function dataList($params){
      $this->each_page = 10000;
      return $this->getList($params);
    }

}