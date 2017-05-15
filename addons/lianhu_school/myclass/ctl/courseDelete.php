<?php 
namespace myclass\ctl;

class courseDelete extends common{

    public function __construct(){
        $this->use_class = D('courseDelete');
    }
    public function getList($qrcode_id){
        $this->use_class->each_page = 1000;
        $params[":qrcode_id"] = $qrcode_id;
        $re = $this->use_class->getList($params);
        return $re['list'];
    }    


}