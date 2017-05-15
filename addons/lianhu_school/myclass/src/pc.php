<?php 
namespace myclass\src;

class pc{
    public $table;
    public $school_id;
    public $class_wap;
    public $pc_index = array(
        array("key_word"=>'lunbo_img','explain'=>'内容轮播背景大图[1680*820]'),
        array("key_word"=>'lunbo_text','explain'=>'顶部右边轮换内容，不超过4个为宜','info_name'=>'标题1','content'=>'内容1'),
        array("key_word"=>'lunbo_next','explain'=>'内容轮播下面2个文字区','info_name'=>'标题1','content'=>'内容1'),
        array("key_word"=>'middle_one_img','explain'=>'中间区1右边图片【586*698】'),
        array("key_word"=>'middle_one_title','explain'=>'中间区1标题','info_name'=>'中间区1标题'),
        array("key_word"=>'middle_one_list','explain'=>'中间区1内容3个','info_name'=>'中间区1内容','content'=>'内容，内容'),
        array("key_word"=>'middle_two_title','explain'=>'中间区1标题','info_name'=>'中间区2标题','content'=>'内容，内容'),
        array("key_word"=>'middle_two_imgs','explain'=>"官网模板可以展示三张图片【350*260】",'info_name'=>'Lorem ipsum dolor sit amet','content'=>'内容，内容'),
        array("key_word"=>'middle_three_title','explain'=>"底部四张图片标题",'info_name'=>'标题','content'=>'内容，内容'),
        array("key_word"=>'middle_three_imgs','explain'=>"底部四张图片【540*450】",'info_name'=>'标题'),
    );

    public function __construct(){
        $this->table = tablename('lianhu_wap_info');
        $this->school_id =  getSchoolId();
        $this->class_wap = D('wap');
    }
    //新增
    public function add($arr){
        $arr['pc'] = 1;
        $this->class_wap->addInfo($arr);
    }
    //获取导航
    public function getNav(){
        $key_word = 'pc_nav';
        $list     = $this->class_wap->infoGet($key_word,6);
        return $list;
    }
    //新增导航
    public function addNav($arr){
        $arr['key_word'] = 'pc_nav';
        $this->add($arr);
    }
    //编辑获取某个详情

    
}