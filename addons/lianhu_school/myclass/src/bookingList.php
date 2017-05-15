<?php 
namespace myclass\src;

class bookingList extends common{
    public $list_id         = 'list_id';
    public $booking_id      = 'booking_id';
    public $uid             = 'uid';
    public $my_name         = 'my_name';
    public $list_content    = 'list_content';
    public $do_content      = 'do_content';//到校执行
    public $do_time         = 'do_time';   //到校执行时间
    public $db_admin_id     = 'db_admin_id';//到校执行id
    public $re_content      = 're_content';
    public $re_time         = 're_time';
    public $list_name       = 'list_name';
    public $list_people_id  = 'list_people_id';
    public $list_parent_id  = 'list_parent_id';
    public $list_phone      = 'list_phone';
    public $list_sex        = 'list_sex';
    public $list_huji       = 'list_huji';
    public $list_address    = 'list_address';
    public $list_old_school = 'list_old_school';
    public $list_live       = 'list_live';
    public $list_time       = 'list_time';
    public $list_imgs       = 'list_imgs';
    public $birthday        = 'birthday';
    public $pass_status     = 'pass_status';
    public $localphone      = 'localphone';
    public $nation          = 'nation';

    public function __construct(){
        $this->setTable('lianhu_booking_list');
        $this->setGlobal();        
    }
    public function dataAdd($arr){
        return parent::add($arr);
    }
    public function dataEdit($id,$up=false){
        $where["list_id"]    = $id;
        $result              = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params){
      $this->_set('each_page',100000);
      return parent::getList($params);
    }

}
