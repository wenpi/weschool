<?php 
namespace myclass\src;

class article extends common{
    public $school_id;
    public $teacher_id;
    public $day_much;
    public $day_base;
    public $class_type;

    public $type= array(
        'public'=>'公共',
        'teacher'=>'教师限制',
        'student'=>'学生限制',
    );

    public function __construct(){
        $this->setTable("lianhu_article_class");
        $this->setGlobal();
    }
    public function setBase(){
        $school_id  = $this->school_id;
        $this->day_much =   S("system",'getSetContent',array('day_article_much',$school_id));
        $this->day_base =   S("system",'getSetContent',array('day_article_base',$school_id));
    }    
    //获取基数
     public function getTeacherLineJiFen($begin_time,$end_time){
        $list           = $this->getArticleList($begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count>$this->day_much){
                $num += $this->day_much;
            }else{
                $num += $count;
            }
        }
        return $num;
    }  
    //所有的文章分类
    public function getClassList($all=true,$limit=100,$type=false,$params=false){
        global $_W;
        $params[":school_id"] = $this->school_id;
        if($all==false){
            $params[":status"] = 1;
        }else{
            $params[":status"] = array("!=",-1);
        }
        if($this->class_type){
            $params[":class_type"]=$this->class_type;
        }
        if($type){
            $params[":type"]=$type;
        }
        $where = S("fun","composeParamsToWhere",array($params));
        foreach ($params as $key => $value) {
            if(is_array($value)){
                $params[$key] = $value[1];
            }
        }
        $list  = pdo_fetchall("select * from ".$this->table." where ".$where." order by class_sort desc ,add_time desc limit 0,".$limit." ",$params);
        return $list;
    }
    //新增文章分类
    public function addClass($arr){
        global $_W;
        $in['uniacid']  = $_W['uniacid'];
        $in['school_id']= $this->school_id;
        $in['class_name'] = $arr['class_name'];
        $in['class_img']  = $arr['class_img'];
        $in['class_sort'] = $arr['class_sort'];
        $in['status']     = $arr['status'];
        $in['add_time']   = time();;
        $in['class_type'] = $arr['class_type']?$arr['class_type']:'public' ;
        if($arr['class_type']=='student'){
            if($arr['grade_id'])
                $in['grade_id'] = $arr['grade_id'];
        }
        $in['type']       = $arr['type'] ? $arr['type'] :1;
        $in['pid']        = $arr['pid'] ? $arr['pid'] :0;
        pdo_insert("lianhu_article_class",$in);
        $class_id = pdo_insertid();
        return $class_id;
    }
    //编辑文章分类
    public function editClass($class_id,$up=false){
        $class_re = pdo_fetch("select * from ".$this->table." where class_id=:cid ",array(":cid"=>$class_id) );
        if($up){
            pdo_update("lianhu_article_class",$up,array("class_id"=>$class_id));
        }
        return $class_re;
    }
    //分类名
    public function className($class_id){
        $info = $this->editClass($class_id);
        return $info['class_name'];
    }
    //添加文章
    public function addArticle($arr){
        global $_W;
        $in['uniacid']          = $_W['uniacid'];
        $in['school_id']        = $this->school_id;
        $in['class_id']         = $arr['class_id'];
        $in['article_title']    = $arr['article_title'];
        $in['artice_img']       = $arr['artice_img'];
        $in['article_intro']    = $arr['article_intro'];
        $in['article_content']  = $arr['article_content'];
        $in['has_red']          = $arr['has_red'];
        $in['class_sort']       = $arr['class_sort'];
        $in['status']           = $arr['status'];
        $in['admin_uid']        = $_W['uid'];
        $in['add_time']         = time();
        pdo_insert("lianhu_article_list",$in);
        $list_id = pdo_insertid();
        return $list_id;       
    }
    //编辑文章
    public function editArticle($list_id,$up=false){
        $class_re = pdo_fetch("select * from ".tablename('lianhu_article_list')." where list_id=:list_id ",array(":list_id"=>$list_id) );
        if($up){
            pdo_update("lianhu_article_list",$up,array("list_id"=>$list_id));
        }
        return $class_re;
    }
    public function editClassArticle($class_id,$up=false){
        $class_re = pdo_fetch("select * from ".tablename('lianhu_article_list')." where class_id=:class_id ",array(":class_id"=>$class_id) );
        if($up){
            pdo_update("lianhu_article_list",$up,array("class_id"=>$class_id));
        }
        return $class_re;
    }
    //删除文章
    public function deleteArticle($id){
        $where["list_id"]   = $id;
        $where["school_id"] = getSchoolId();
        pdo_delete('lianhu_article_list',$where);
    }
    //有效的文章列表
    public function getArticleList($begin_time,$end_time){
        $params[':school_id']        = $this->school_id;
        $params[':status']           = 1;
        if($this->teacher_id)
            $params[':teacher_id']        = $this->teacher_id;
        $where  = S("fun","composeParamsToWhere",array($params) );
		$where .= " and add_time <= :end_time and add_time >= :begin_time ";
        $params[":end_time"]        = $end_time;
        $params[":begin_time"]      = $begin_time;
        $list  = pdo_fetchall("select *  from ".tablename('lianhu_article_list')." where ".$where."  ",$params);
        return $list ;
    }
    //有效的文章发布量
    public function getArticleCount($begin_time,$end_time){
        $list   = $this->getArticleList($begin_time,$end_time);
        $count  = count($list);
        return $count;
    }


}