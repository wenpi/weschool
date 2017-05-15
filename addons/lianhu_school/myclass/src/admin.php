<?php 
namespace myclass\src;

class admin{
    public $group_type = array('1'=>'教师组','2'=>'学校组','3'=>'家校通管理组');
    public $salt       = 'hjasdf01';
    public $username   = 'jxt_wq_admin';
    public $every_page = 20;
    public function __construct(){
        load()->model('user');
    }
    //独立后台的微擎管理人员的登录
    //独立后台的家校通
    public function systemLogin($passport,$password){
            global $_GPC, $_W;
            $username = trim($passport);
            pdo_query('DELETE FROM '.tablename('users_failed_login'). ' WHERE lastupdate < :timestamp', array(':timestamp' => TIMESTAMP-300));
            $failed   = pdo_get('users_failed_login', array('username' => $username, 'ip' => CLIENT_IP));
            if ($failed['count'] >= 5) {
                return array('errcode'=>1,'msg'=>'输入密码错误次数超过5次，请在5分钟后再登录');
            }
            if(empty($username)) {
                return array('errcode'=>1,'msg'=>'请输入要登录的用户名');
            }
            $member['username'] = $username;
            $member['password'] = $password;
            if(empty($member['password'])) {
                return array('errcode'=>1,'msg'=>'请输入密码');
            }
            if(pdo_fieldexists('lianhu_db_admin','passport')){
                $record     = $this->vaildJiaAdmin($username,$password);
            }
            if(!$record){
                $wq_record  = user_single($member);
            }
            
            if( $record || $wq_record ) {
                if($record['admin_status'] == 0 && $record) {
                    return array('errcode'=>1,'msg'=>'您的账号正在审核或是已经被系统禁止，请联系家校通管理员解决！');
                }
                if($wq_record['status'] == 1 && $wq_record) {
                    return array('errcode'=>1,'msg'=>'您的账号正在审核或是已经被系统禁止，请联系家校通管理员解决！');
                }               
                $founders = explode(',', $_W['config']['setting']['founder']);
                if (!empty($_W['siteclose']) && empty($_W['isfounder'])) {
                    return array('errcode'=>1,'msg'=>'站点已关闭，关闭原因：' . $_W['setting']['copyright']['reason']);
                }
                $cookie                 = array();
                if(!$record){
                    if($wq_record['uid']!=$_W['config']['setting']['founder']){
                        exit("非系统管理员账号和本模块内置账号不能登录");
                    }
                    $record                 = $wq_record;
                    $cookie['uid']          = $record['uid'];
                    $cookie['lastvisit']    = $record['lastvisit'];
                    $cookie['lastip']       = $record['lastip'];
                    isetcookie('_admin_id','',-7 * 86400,'/');
                    isetcookie('_admin_name','',-7 * 86400,'/');
                    isetcookie('_admin_img','',-7 * 86400,'/');
                    isetcookie('_db_group_id','',-7 * 86400,'/');
                    isetcookie('_data_group_id','',-7 * 86400,'/');
                    setTeacherAdmin(0);
                }else{
                    $cookie['uid']          = $record['admin_uid'];
                    isetcookie('_admin_id',   $record['admin_id'], 7 * 86400,'/');
                    isetcookie('_admin_name', $record['admin_name'],7 * 86400,'/');
                    isetcookie('_admin_img',  $record['admin_img'],7 * 86400,'/');
                    isetcookie('_db_group_id',$record['db_group_id'],7 * 86400,'/');
                    if($record['data_group_id']==0){
                        $record['data_group_id'] = "N";
                    }
                    isetcookie('_data_group_id',$record['data_group_id'],7 * 86400,'/');
                    $record                 = $this->getWqAdmin();             
                    $cookie['lastvisit']    = $record['lastvisit'];
                    $cookie['lastip']       = $record['lastip'];
                }
                $cookie['hash']         = md5($record['password'] . $record['salt']);
                $session                = base64_encode(json_encode($cookie));
                isetcookie('__session', $session, !empty($_GPC['rember']) ? 7 * 86400 : 0, true);
                $status                 = array();
                $status['uid']          = $record['uid'];
                $status['lastvisit']    = TIMESTAMP;
                $status['lastip']       = CLIENT_IP;
                user_update($status);
                if ($record['uid'] != $_GPC['__uid']) {
                    isetcookie('__uniacid', '', -7 * 86400);
                    isetcookie('__uid', '', -7 * 86400);
                }
                $list = D('platform')->getAllPlatform();
                setWebLogin($list[0]['uniacid'],$record['uid']);
                pdo_delete('users_failed_login', array('id' => $failed['id']));
                return array('errcode'=>0,'msg'=>'success','uid'=>$record['uid']);
            } else {
                if (empty($failed)) {
                    pdo_insert('users_failed_login', array('ip' => CLIENT_IP, 'username' => $username, 'count' => '1', 'lastupdate' => TIMESTAMP));
                } else {
                    pdo_update('users_failed_login', array('count' => $failed['count'] + 1, 'lastupdate' => TIMESTAMP), array('id' => $failed['id']));
                }
                return array('errcode'=>1,'msg'=>'登录失败，请检查您输入的用户名和密码！');
            }       
    }
    //微擎家校通组
    public function wqGroup($type){
        if(!$type){
            return false;
        }
        $group_type    = $this->group_type[$type];
        $group_info    = pdo_fetch("select * from ".tablename('users_group')." where name='".$group_type."' ");
        if(!$group_info){
            $in['name']     = $group_type;
            $in['package']  = 'N;';
            pdo_insert('users_group',$in);
            $id = pdo_insertid();
        }else{
            $id = $group_info['id'];
        }
        return $id;
    }
    //检测微擎管理人员账号存在不
    public function checkWqPassport($passport){
        $result = pdo_fetch("select * from ".tablename('users')." where username=:username ",array(':username'=>$passport));
        return $result;
    }
    //添加微擎管理人员
    public function addWqAdmin(){
        $salt       = $this->salt;
        $password   = rand(10000, 99999); 
        $password   = user_hash($password,$salt);
        $user_in['groupid'] = $this->wqGroup(3);
        $user_in['username']= $this->username;
        $user_in['password']= $password;       
        $user_in['salt']    = $salt;
        $user_in['status']  = 2;
        $user_in['joindate']= TIMESTAMP;
        pdo_insert('users',$user_in);
        $user_id  = pdo_insertid();
        return $user_id;
    }
    //获取家校通要求的内置的微擎账号
    public function getWqAdmin(){
        $result = $this->checkWqPassport($this->username);
        if(!$result){
            $this->addWqAdmin();
            $result = $this->checkWqPassport($this->username);
        }
        return $result;
    }
    //验证家校通账户
    public function vaildJiaAdmin($passport,$password){
        $result       = $this->getJiaAdmin($passport);
        $in_passwored = user_hash($password,$result['salt']);
        if($result['password']==$in_passwored)
            return $result;
        else 
            return false;
    }
    //通过家校通账号获取信息
    public function getJiaAdmin($passport){
        $params[":passport"] = $passport;
        $where               = S("fun","composeParamsToWhere",array($params));
        $result              = pdo_fetch(" select * from ".tablename('lianhu_db_admin')." where ".$where." ",$params);
        return   $result;
    }
    //添加家校通管理人员
    public function addJiaAdmin($in){
        $wq_admin   = $this->getWqAdmin();
        if(!$in['salt']){
            $salt                        = rand(10000, 99999);
        }else{
            $salt                        = $in['salt'];
        } 
        $admin_in['db_group_id']         = $in['db_group_id'];
        $admin_in['data_group_id']       = $in['data_group_id'];
        $admin_in['admin_uid']           = $wq_admin['uid'];
        $admin_in['school_admin_id']     = $in['school_admin_id']? $in['school_admin_id']:0;
        $admin_in['teacher_id']          = $in['teacher_id']? $in['teacher_id']:0;
        $admin_in['admin_img']           = $in['admin_img'];
        $admin_in['admin_name']          = $in['admin_name'];
        $admin_in['admin_status']        = $in['admin_status']? $in['admin_status']:1;
        $admin_in['passport']            = $in['passport'];
        $admin_in['password']            = user_hash($in['password'],$salt);
        $admin_in['salt']                = $salt;
        pdo_insert('lianhu_db_admin',$admin_in);
        $admin_id  = pdo_insertid();
        return $admin_id;
    }
    public function updateJiaAdmin($admin_id,$field,$content){
        $info = $this->getAdminInfo($admin_id);
        if($info){
            if($field == 'password'){
                $salt       = $info['salt'];
                $content    = user_hash($content,$salt);
            }
            $up[$field] = $content;
            pdo_update('lianhu_db_admin',$up,array('admin_id'=>$admin_id) );
            return true;
        }else{
            return false;
        }
    }
    //判断登录人员的身份
    public function judeAdminType($uid=false){
        global $_W,$_GPC;
        $jia_admin = true;
        if(!$uid){
            $uid    = $_W['uid'];
        }
        $user_info  = user_single($uid);
        if( $user_info['username'] != 'jxt_wq_admin'){
            $jia_admin  = false;
            $out        = array('admin'=>'top','isfounder'=>1);
        }else{
           $admin_id = $_GPC['_admin_id'];
           $result   = $this->getAdminInfo($admin_id);
           //家校通内置账号控制
           if($result){
                setDbAdmin($admin_id);
                if($result['school_admin_id']){
                    $out_re = pdo_fetch("select * from ".tablename('lianhu_school_admin')." where admin_id=:admin_id ",array(":admin_id"=>$result['school_admin_id'])); 
                    isetcookie('__uniacid', $out_re['uniacid'], 7 * 86400);
                    setSchoolAdmin($out_re['school_admin_id']);
                    $out    = array('admin'=>'school','isfounder'=>0,'uniacid'=>$out_re['uniacid'],'info'=>$result);           
                }elseif($result['teacher_id']){
                    $out_re = pdo_fetch("select * from ".tablename('lianhu_teacher')." where teacher_id=:teacher_id ",array(":teacher_id"=>$result['teacher_id'])); 
                    isetcookie('__uniacid', $out_re['uniacid'], 7 * 86400);
                    setTeacherAdmin($out_re['teacher_id']);
                    $out    = array('admin'=>'teacher','isfounder'=>0,'uniacid'=>$out_re['uniacid'],'info'=>$result);           
                }
                if($out_re){
                    setSchoolId($out_re['school_id']);
                    setUniacid($out_re['uniacid']);
                }
           }else{
               $jia_admin = false;
           }
        }
        if(!$jia_admin){
               setDbAdmin(0);
               setTeacherAdmin(0);
        }
        if(!$out){
            $out = array('admin'=>'top','isfounder'=>1,'use_set'=>1,'info'=>$result);
        }else{
            $out['username']   = $user_info['username'];
        }
        return $out;
    }
    //根据绑定的账号查询相应school_admin账户
    public function findSchoolAdminByPassport($passport){
        	$result = $this->getJiaAdmin($passport);
            if(!$result)
                $out       = array("errcode"=>1,'msg'=>'系统中不存在此账号，请重新填写');
            else{
                $school_re = pdo_fetch("select * from  ".tablename("lianhu_school_admin")." where db_admin_id=:db_admin_id  ",array(":db_admin_id"=>$result['admin_id']));
                if(!$school_re){
                    $out       = array("errcode"=>1,'msg'=>'该账号不是学校管理人员账号');
                }
                if($school_re['status']!=1)
                    $out       = array("errcode"=>1,'msg'=>'该学校账户已经关闭');
                else 
                    $out       = array('errcode'=>0,'school_re'=>$school_re,'user'=>$result);
            }
            return $out;
    }
    //验证手机端uid与学校管理员账号的关系
    public function mobileValidSchoolAdmin($uid=false,$no_session=false){
        global $_W;
        if(!$uid){
            $uid = getMemberUid();
        }
        $result  = pdo_fetch("select * from ".tablename("lianhu_school_admin")." where mobile_uid=:uid and status=1 ",array(":uid"=>$uid) ); 
        if($result && !$no_session){
            $class_school            = D('school');
            $class_school->school_id = $result['school_id']; 
            $school_info             = $class_school->getSchoolInfo();
            setSchoolId($school_info['school_id']);
            setSchoolName($school_info['school_name']);
            setDbAdmin($result['db_admin_id']);
            $result['info'] = $this->getAdminInfo($result['db_admin_id']);
        }
        return $result;
    }
    //提交学校账户绑定
    public function mobileBindingSchoolAdmin($mobile_uid,$admin_id){
        $where["admin_id"] = $admin_id;
        $up['mobile_uid']  = $mobile_uid;
        pdo_update("lianhu_school_admin",$up,$where);
     }
     //身份组
     public function getDbGroup($all=false){
        if($all)
            $list = pdo_fetchall("select * from ".tablename('lianhu_db_group')." ");
        else 
            $list = pdo_fetchall("select * from ".tablename('lianhu_db_group')."  where status=1");
        return $list;
     }
     //数据组
     public function getDataGroup($all=false){
        if($all)
            $list = pdo_fetchall("select * from ".tablename('lianhu_data_group')." ");
        else 
            $list = pdo_fetchall("select * from ".tablename('lianhu_data_group')."  where status=1");
        return $list;
     }
     //获取数据组详情
     public function getDataInfo($group_id){
        $where               = "group_id=:group_id";
        $params[":group_id"] = $group_id;
        $result              = pdo_fetch("select * from ".tablename('lianhu_data_group')." where   ".$where,$params);
        if($result['type']=='mp'){
            $group_platform_list = explode(',',$result['data']);
        }elseif($result['type']=='school'){
            $school_list         = explode(',',$result['school_data']);
        }elseif($result['type']=='grade'){
            $grade_list          = explode(',',$result['grade_data']);
        }
        return array('platform_list'=>$group_platform_list,'result'=>$result,'school_list'=>$school_list,'grade_list'=>$grade_list);
     }
    //用户列表
    public function getAdminList($pager=1,$params=false){
        $where    = "admin_status!=10";
        if($params){
            $where_str = S('fun','composeParamsToWhere',array($params));
            $where    .= " and ".$where_str;
        }        
        $pager    = $pager ? $pager:1;
        $start    = ($pager-1)*$this->every_page; 
        $str      = "from ".tablename('lianhu_db_admin')." admin 
                            left join ".tablename('lianhu_db_group')." db_group on admin.db_group_id = db_group.group_id  
                            left join ".tablename('lianhu_data_group')." data_group on admin.data_group_id = data_group.group_id  
                            where ".$where;
        if($params){
            $count = pdo_fetchcolumn("select count(admin.admin_id) num  ".$str,$params);
            $list  = pdo_fetchall("select admin.*,db_group.group_name as db_group_name,data_group.group_name as data_group_name ".$str.' order by admin.admin_id desc limit '.$start.','.$this->every_page.' ',$params);
        }else{
            $count = pdo_fetchcolumn("select count(admin.admin_id) num  ".$str);
            $list  = pdo_fetchall("select admin.*,db_group.group_name as db_group_name,data_group.group_name as data_group_name ".$str.' order by admin.admin_id desc limit '.$start.','.$this->every_page.' ');
        }                
        return array('count'=>$count,'list'=>$list);
    }     
    //获取学校管理
    public function getSchoolAdminList($school_id){
 	    $list = pdo_fetchall("select admin.*,admin.admin_id school_admin_id, db_admin.* from ".tablename('lianhu_school_admin')." admin  
                              left join ".tablename('lianhu_db_admin')." db_admin on db_admin.admin_id = admin.db_admin_id
                              where admin.school_id=:sid ",array(':sid'=>$school_id));       
        return $list;
    }
    //获取这个学校的管理人员
    //教师，学校管理,学校权限组
    public function getSchoolAllAdminList($school_id){
        $teacher_list = D('teacher')->getTeacherList($school_id);
        $teacher_ids  = S("fun","zuHeArr",array($teacher_list,'admin_id') );
        $admin_list   = $this->getSchoolAdminList($school_id);
        $admmin_ids   = S("fun","zuHeArr",array($admin_list,'db_admin_id') );
        if($teacher_ids){
            $teacher_id_str = implode(',',$teacher_ids);
            $arr[]          = $teacher_id_str;
        }
        if($admmin_ids){
            $admin_id_str   = implode(',',$admmin_ids);            
            $arr[]          = $admin_id_str;
        }
        if($arr){
            $id_str         = implode(',',$arr);
            $list           = pdo_fetchall("select * from ".tablename('lianhu_db_admin')." where admin_id in(".$id_str.") ");
        }
        return $list;
    }
    //获取用户信息
    public function getAdminInfo($admin_id){
        $where               = "admin_id=:admin_id";
        $params[":admin_id"] = $admin_id;
        if(pdo_tableexists('lianhu_db_admin')){
            $re = pdo_fetch("select admin.*, db_group.group_name as db_group_name,data_group.group_name as data_group_name 
                            from ".tablename('lianhu_db_admin')." admin 
                            left join ".tablename('users')." user on admin.admin_uid = user.uid  
                            left join ".tablename('lianhu_db_group')." db_group on admin.db_group_id = db_group.group_id  
                            left join ".tablename('lianhu_data_group')." data_group on admin.data_group_id = data_group.group_id  
                            where ".$where,$params);        
        }
        return $re;
    }     
    //删除admin账户
    public function deleteAdmin($admin_id){
        $params["admin_id"] = $admin_id;
        pdo_delete('lianhu_db_admin',$params);
    }
    //删除school_admin账户
    public function deleteSchoolAdmin($admin_id){
        $params["admin_id"] = $admin_id;
        pdo_delete('lianhu_school_admin',$params);
    }
    //删除teacheradmin 
    public function deleteTeacherAdmin($teacher_id){
        $params["teacher_id"] = $teacher_id;
        pdo_delete('lianhu_teacher',$params);
    }
    //db_admin_info 
    public function dbAdminInfo($db_admin_id){
        $params[":admin_id"] = $db_admin_id;
        $where = S("fun",'composeParamsToWhere',array($params));
        $result= pdo_fetch("select * from ".tablename("lianhu_db_admin")."  where ".$where." ",$params);
        return $result;
    }
    
}
