<?php 
namespace myclass\ctl;

class eduVideoList extends common{
    public $list_types = array(
        array('type'=>'0','name'=>'流地址','id'=>'m3u8'),
        array('type'=>'1','name'=>'Iframe模式','id'=>"iframe"),
        array('type'=>'2','name'=>'跳转网址格式','id'=>'href'),
    );

    public function __construct(){
        $this->use_class = D('eduVideoList');
    }



}