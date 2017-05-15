<?php 
namespace myclass\ctl;

class video extends common{

    public function __construct(){
        $this->use_class = D('video');
    }
    //学校的所有的视频
    public function getVideoList(){
        $this->use_class->each_page  = 10000;
        $re               = $this->use_class->getList(false);
        $list = $re['list'];
        return $list;
    }

}