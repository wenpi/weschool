<?php 
namespace myclass\ctl;
class common{
    public $use_class;
    public $uniacid;
    public $school_id;
    public $in_class_base;

    public function setGlobal(){
        global $_W;
        $this->uniacid  = $_W['uniacid'];
        $this->school_id= getSchoolId();
    }

}