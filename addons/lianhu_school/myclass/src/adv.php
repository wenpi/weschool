<?php 
namespace myclass\src;
class adv{
    private $table;
    public $school_id;
    private $key_word_list = array(
        array('家长中心顶部背景图[980*426]','student_top_img'),
        array('教师中心顶部背景图[640*275]','teacher_top_img'),
        array('管理中心顶部背景图[640*275]','adminSchool_top_img'),
        array('教师端绑定logo【公众号】[244*227]','teacher_bd_logo'),
        array('管理端端绑定logo【公众号】[200*200]','admin_bd_logo'),
        array('后台登录界面logo【公众号】[244*227]','web_login_logo'),
    );

    public function __construct(){
        $this->table = tablename("lianhu_adv");
    }
    //检验、完善
    public function InKeyWord(){
        global $_W;
        $key_word_list = $this->key_word_list;
        foreach($key_word_list as $row){
            $params[':adv_keyword'] = $row[1];
            $params[':school_id']   = getSchoolId();
            $where  = S('fun','composeParamsToWhere',array($params));    
            $result = pdo_fetch("select * from ".$this->table." where ".$where." ",$params); 
            if(!$result){
                $in['uniacid']      = $_W['uniacid'];
                $in['school_id']    = getSchoolId();
                $in['adv_keyword']  = $row[1];
                $in['adv_title']    = $row[0];
                $in['add_time']     = time();
                $in['status']       = 1;
                pdo_insert('lianhu_adv',$in);
            }
        }
    }
    //获取list
    public function getAdvList(){
        $school_id            = $this->school_id;
        $params[':school_id'] = $school_id;
        $list      = pdo_fetchall("select * from ".$this->table."  where school_id = :school_id ",$params); 
        return $list;
    }
    //获取信息
    public function getAdvInfo($adv_id){
        $params[':adv_id'] = $adv_id;
        $result            = pdo_fetch("select * from ".$this->table."  where adv_id=:adv_id ",$params);
        return $result;
    }
    //获取keyword信息
     public function getAdvInfoKeyWord($key_word){
        $params[':adv_keyword'] = $key_word;
        $params[":school_id"]   = getSchoolId();
        $result                 = pdo_fetch("select * from ".$this->table."  where adv_keyword=:adv_keyword and school_id=:school_id ",$params);
        return $result['adv_content'];
    }   
     //获取keyword信息
     public function getUniacidAdvInfoKeyWord($key_word){
        global $_W;
        $params[':adv_keyword'] = $key_word;
        $params[":uniacid"]     = $_W['uniacid'];

        $result                 = pdo_fetch("select * from ".$this->table."  where adv_keyword=:adv_keyword and uniacid=:uniacid ",$params);
        return $result['adv_content'];
    }  
}
