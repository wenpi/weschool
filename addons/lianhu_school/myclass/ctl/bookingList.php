<?php 
namespace myclass\ctl;

class bookingList extends common{
    public $booking_id;

    public function __construct(){
        $this->use_class = D('bookingList');
        $this->setGlobal();
    }
    //获取一个活动的报名列表
    public function getBooKingPeopleList(){
        $booking_id = $this->booking_id;
        $params[':booking_id'] = $booking_id;
        $result     = $this->use_class->dataList($params);
        return $result;
    }
    //获取一个用户的报名列表
    public function getUserBookingList($uid){
        $params[":uid"] = $uid; 
        $result         = $this->use_class->dataList($params);
        return $result;
    }
    //获取用户
    public function getUserLastRecord($uid){
        $params["uid"]       = $uid;
        $params["school_id"] = getSchoolId();
        $result = $this->use_class->edit($params);
        return $result;
    }
    public function getLastById($id){
        $where["list_people_id"] = $id;
        $where["school_id"]      = getSchoolId();
        $result = $this->use_class->edit($where);
        return $result;
    }
}