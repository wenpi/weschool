<?php 
namespace myclass\src;
class eduVideoList extends common{
    public $class_id         = 'class_id';
    public $list_name        = 'list_name';
    public $list_src         = 'list_src';
    public $list_src_content = 'list_src_content';
    public $list_src_type    = 'list_src_type';
    public $list_img         = 'list_img';
    public $list_min         = 'list_min';
    public $list_intro       = 'list_intro';
    public $list_money       = 'list_money';
    public $limit_display    = 'limit_display';
    public $status           = 'status';

    public function __construct(){
        $this->setTable('lianhu_edu_video_list');
        $this->setGlobal();
    }
    public function dataAdd($arr){
        $arr['add_db_admin_id']      = getDbAdminId();
        return parent::add($arr);
    }
    public function dataEdit($id,$up=false){
        $where["list_id"] = $id;
        $result            = parent::edit($where,$up);
        return $result;
    }
    public function dataList($params,$in_where=false,$pages=1){
      $this->_set('each_page',100000);
      return parent::getList($params,$in_where,$pages);
    }

}