<?php 
namespace myclass\src;

class video extends common{
    public $video_name      = 'video_name';
    public $video_url       = 'video_url';
    public $begin_time      = 'begin_time';
    public $end_time        = 'end_time';
    public $video_img       = 'video_img';
    public $status          = 'status';
    public $html_content    = 'html_content';
    public $passport        = 'passport';
    public $password        = 'password';
    public $ip_addr         = 'ip_addr';


    public function __construct(){
        $this->setTable('lianhu_video');
        $this->setGlobal();
    }

    
}