<?php 
namespace myclass\src;

class block extends common{
    public  $block_id   = 'block_id';
    public  $class_id   = 'class_id';
    public  $block_name = 'block_name';
    public  $block_intro= 'block_intro';
    public  $block_css  = 'block_css';
    public  $block_js   = 'block_js';
    public  $block_html = 'block_html';
    public  $status     = 'status';

    public function __construct(){
        $this->setTable('lianhu_block');
        $this->setGlobal();
    }


}