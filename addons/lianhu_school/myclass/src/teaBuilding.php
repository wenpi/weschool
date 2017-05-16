<?php 
namespace myclass\src;

class teaBuilding extends common{
    public $building_id   = 'building_id';
    public $building_name = 'building_name';
    public $status        = 'status';

    public function __construct(){
        $this->setGlobal();
        $this->setTable('lianhu_tea_building');
    }
    public function getBuildNum($building_id){
        $this->field_str = "building_name";
        $re = $this->edit(array("building_id"=>$building_id));
        return $re['building_name'];
    }
    

}