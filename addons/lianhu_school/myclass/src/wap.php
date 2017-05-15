<?php 
namespace myclass\src;

class wap{
    private $table ;
    public  $school_id;
    public $wap_index;

    public function __construct(){
        $wap_index = array(
            array('name'=>'顶部banner[375*50]','key'=>'top_banner'),
            array('name'=>'中部导航按钮[55*55]','key'=>'middle_button1'),
            array('name'=>'顶部轮播图[640*275]','key'=>'index_img'),
            array('name'=>'四个图片区[94*152]','key'=>'four_button'),
            array('name'=>'图说','key'=>'img_say'),
        );
        $this->wap_index         = $wap_index;
        
        $this->table = tablename('lianhu_wap_info');
        $this->school_id =  getSchoolId();
    }
    //所有的有效的
    public function getAll(){
         $class_base          = D('base');
         $params[":school_id"] = $this->school_id;
         $params[":status"]    = 1;
         $params[":pc"]        = 0;
         $where = S("fun","composeParamsToWhere",array($params) );
         $list  = pdo_fetchAll("select * from ".$this->table." where  ".$where."  order by key_word desc ,sort desc ,info_id desc ",$params); 
         foreach ($list as $key => $value) {
             $list[$key]['out_href'] = $value['fun_name'] ? $class_base->createMobileUrl($value['fun_name'],array('school_id'=>$this->school_id)):$value['info_url'];
         }
         return $list;
    }
    //ID获取
    //参数获取 
    public function infoGet($key_word,$num=1){
         $params[":school_id"] = $this->school_id;
         $params[":key_word"]  = $key_word;
         $params[":status"]    = 1;
         $where = S("fun","composeParamsToWhere",array($params) );
         $list  = pdo_fetchAll("select * from ".$this->table." where ".$where."  order by sort desc ,info_id desc limit 0,".$num." ",$params); 
         return $list;
    }
    //参数设置
    public function addInfo($arr){
        global $_W;
        $in['uniacid']   = $_W['uniacid'];
        $in['school_id'] = $this->school_id;
        $in['key_word']  = $arr['key_word'];
        $in['content']   = $arr['content'];
        $in['sort']      = $arr['sort'];
        $in['info_name'] = $arr['info_name'];
        $in['info_url']  = $arr['info_url'];
        $in['fun_name']  = $arr['fun_name'] ;
        $in['status']    = $arr['status'] ;
        $in['pc']        = $arr['pc'] ?$arr['pc']:0;
        $in['add_time']  = time();
        pdo_insert("lianhu_wap_info",$in);
    }
    //参数编辑
    public function editInfo($info_id,$up){
        $result = pdo_fetch("select * from ".$this->table." where info_id = :id ",array(':id'=>$info_id) );
        if($up)
            pdo_update('lianhu_wap_info',$up,array('info_id'=>$info_id) );
        return $result;
    }

}