<?php 
namespace myclass\src;

class teaRoom extends common{
    public $room_id         = 'room_id';
    public $tea_building_id = 'tea_building_id';
    public $room_num        = 'room_num';
    public $status          = 'status';

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_tea_room');
    }
    public function getRoomList($all){
        if($all){
            $where[":status"] = array("!=","-1");
        }else{
            $where[":status"] = 1;
        }
        $this->each_page = 10000;
        $re     = $this->getList($where);
        $list   = $re['list'];
        $class_building     = D("teaBuilding");
        foreach ($list as $key => $value) {
            $list[$key]["building_name"] = $class_building->getBuildNum($value['tea_building_id']);
        }
        return $list;
    }

}