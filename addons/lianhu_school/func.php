<?php 
//二维数组中，根据某个值排序
function sortArr($arr,$key,$model='max'){
 	$num = count($arr);
	for($g=0;$g<$num;$g++){
		foreach ($arr as $k => $value) {
			for ($i=0; $i<$k; $i++) { 
				if($value[$key] > $arr[$i][$key]){
					$zhongZhuang = $arr[$i];
					$arr[$i]     = $value;
					$arr[$k]     = $zhongZhuang;
					break;
				}
			}
		}		
	}
	if($model=='min'){
        $f=0;
        for($g=$num-1;$g>=0;$g--){
            $new_arr[$f]=$arr[$g];
            $f++;
        }
	   $arr = $new_arr;
    }
	return $arr;   
}
//数组比较去重
//arr1 做主要，去除arr2的重复
function deleteArrRepeat($arr1,$arr2,$key){
    $arr1_key = S("fun","zuHeArr",array($arr1,'student_id'));
    foreach ($arr2 as  $k=>$value) {
        if(in_array($value[$key],$arr1_key)){
            unset($arr2[$k]);
        }
    }
    return $arr2;
}
//学校年级班级联动
function schoolGradeClass(){
    $school_info    = D("school")->getSchoolInfo();
    $class_grade    = D('grade');
    $class_classes  = D("classes");
    $class_grade->school_id = $school_info['school_id'];
    $grade_list     = $class_grade->getSchoolList();
    foreach ($grade_list as $key => $value) {
        $class_classes -> grade_id = $value['grade_id'];
        $grade_list[$key]['class'] = $class_classes->getClassList(); 
    }
    $school_info['grade'] = $grade_list;
    return $school_info;
}
//调用独立后台的模板
function adminTemplate($template){
    include_once(MODULE_ROOT.'/admin/'.$template.'.html');
}
//wap的信息
function wapInfo($key_word,$num){
    global $_W;
    $list =D('wap')->infoGet($key_word,$num);
    foreach ($list  as $key => $result) {
        if($result['fun_name']){
            $url = $_W['siteroot'].'app/index.php?i='.$_W['uniacid'].'&c=entry&do='.$result['fun_name'].'&m=lianhu_school';
        }else{
            $url = $result['info_url'];
        }
        $list[$key]['url'] = $url;        
    }
    if($num==1)
        $list= $list[0];
    return $list;
}
//wap_article_class
function wapArticleClass($num,$type,$cid=false){
    $class_article = D('article');
    $class_article->class_type='public';
    if($cid)
        $params[":pid"] = $cid;
    $list = $class_article->getClassList(false,$num,$type,$params);
    return $list;
}
function wapArticleClassInfo($class_id){
    $result = D('article')->editClass($class_id);
    return $result;
}
//wap_article_list 
function wapArticleList($class_id,$num){
    $params[":class_id"]     = $class_id;
    $params[":status"]       = 1;
    $where = S("fun","composeParamsToWhere",array($params));
    $list  = pdo_fetchall("select *  from ".tablename('lianhu_article_list')." where ".$where." order by class_sort desc,add_time desc limit 0,".$num." ",$params);
    return $list;
}
function wapArticleInfo($list_id){
    $result = D('article')->editArticle($list_id);
    return $result;
}
//json 返回
function outJson($arr){
    if($arr)
        echo json_encode($arr);    
    exit();
}
//没存在返回style='display:none'
function checkLeft($act,$act_list){
    if($act_list){
        if(!in_array($act,$act_list) ){
            echo "style='display:none'";
        }
    }
}
    //接收新增，更新参数
function getNewUpdateData($in_data,$class_in){
        $in = array();
        foreach ($in_data as $key => $value) {
            if($class_in->$key){
                $in[$key] = $value;
           }
       }
       return $in;       
}
//比较小时分钟
function compareHourMin($in_time,$begin_time,$end_time){
    $begin_time     = str_ireplace(':','',$begin_time);
    $end_time       = str_ireplace(':','',$end_time);
    $in_time        = str_ireplace(':','',$in_time);
    if($in_time >= $begin_time && $in_time <= $end_time){
        return true;
    }
}
/*
*设置参数状态
*/
//设置学生手机端的班级

function setSchoolId($school_id){
    $_SESSION['school_id']      = $school_id;
}
function setSchoolName($school_name){
    $_SESSION['school_name']     = $school_name;
}
function setUniacid($uniacid){
    $_SESSION['uniacid']        = $uniacid;
}
function setClassId($class_id){
    $_SESSION['class_id']      = $class_id;
}
/*
*设置各种管理员的状态
*/
function setMemberUid($uid){
    $_SESSION['member_uid'] = $uid;
}
function setMemberFanid($uid){
    $_SESSION['member_fanid'] = $uid;
}
function setTeacherAdmin($t_id){
    $_SESSION['student_id']      = 0;
    $_SESSION['school_admin_id'] = 0;
    $_SESSION['teacher_id']      = $t_id;
}
function setSchoolAdmin($school_admin_id){
    $_SESSION['student_id']      = 0;
    $_SESSION['teacher_id']      = 0;   
    $_SESSION['school_admin_id'] = $school_admin_id;
}
function setDbAdmin($db_admin_id){
    $_SESSION['db_admin_id'] = $db_admin_id;
}
//获取当前管理者的id
//必须调用此函数获取，方便负载均衡
function getDbAdminId(){
    global $_GPC;
    return $_GPC['_admin_id']?$_GPC['_admin_id']:0;
}
//获取当前的教师id
function getTeacherId(){
    return $_SESSION['teacher_id']?$_SESSION['teacher_id']:0;
}
//获取当前的x学校id
function getSchoolId(){
    global $_GPC;
    if($_GPC['school_id']){
        $_SESSION['school_id'] = $_GPC['school_id'];
    }
    return $_SESSION['school_id'];
}
//获取pc端扫码登录uid
function getMemberUid(){
    global $_W;
    $member_uid = $_W['member']['uid']? $_W['member']['uid']:$_SESSION['member_uid'];
    return $member_uid;
}
//获取pc端扫码登录fanid
function getMemberFanid(){
    global $_W;
    $member_fanid = $_W['fans']['fanid']? $_W['fans']['fanid']:$_SESSION['member_fanid'];
    return $member_fanid;
}
function getClassId(){
   return  $_SESSION['class_id'];
}