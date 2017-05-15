<?php
    function getImgToUrl($img_value,$class_site){
		if(stristr($img_value,'data:image/')){
            if(stristr($img_value,'data:image/png')){
                $file_name  = rand(1000,9999).time().'.png';
                $file_value = str_ireplace("data:image/png;base64,",'',$img_value);
            }elseif(stristr($img_value,'data:image/jpeg')){
                $file_name  = rand(1000,9999).time().'.jpg';
                $file_value = str_ireplace("data:image/jpeg;base64,",'',$img_value);
            }elseif(stristr($img_value,'data:image/gif')){
                $file_name  = rand(1000,9999).time().'.gif';
                $file_value = str_ireplace("data:image/gif;base64,",'',$img_value);
            }elseif(stristr($img_value,'data:image/bmp')){
                $file_name  = rand(1000,9999).time().'.bmp';
                $file_value = str_ireplace("data:image/bmp;base64,",'',$img_value);
            }
            $file_value = base64_decode($file_value);
            $dir          = $class_site->createSchoolDir();
            $file_name    = $dir.$file_name;
            file_put_contents($file_name,$file_value);
            $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
            return $up_file_name;
        }else{
            return $img_value;
        }
    }
    //upimg
    function upImg($file_name,$old_file=false,$class_site){
        if(!$old_file){
            $old_file   = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
            $file_value = '';
        }else{
            $file_value  = $old_file;
            $old_file    = $class_site->imgFrom($old_file);
        }
        $html = <<<EOF
            <div class="fileinput fileinput-new $file_name" data-provides="fileinput" >
                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="$old_file" alt="" id="$file_name" data-src='$file_value' /> 
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                <div>
                    <span class="btn default btn-file">
                        <span class="fileinput-new">    选择图片 </span>
                        <span class="fileinput-exists"> 替换    </span>
                        <input type='hidden' name="$file_name" value="$file_value">
                        <input type="file" name="..." accept="image/*" > 
                    </span>
                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 移除 </a>
                </div>
            </div>
             <div class="clearfix margin-top-10" style='color:#666;font-size:0.6em'>
                <span class="label label-danger">请注意</span>&nbsp;&nbsp;请将文件控制在3M以内
             </div>
                                                   
            <script>
                $(".$file_name").on('change.bs.fileinput',function(){
                    va = $('.$file_name').find('.fileinput-preview').find('img');
                    if(va.length>0){
                        img_src = va.attr('src');
                        $("input[name='$file_name']").val(img_src);
                    }
                });
                $(".$file_name").on('reset.bs.fileinput',function(){
                    va = $('#$file_name');
                    if(va.length>0){
                        img_src = va.attr('data-src');
                        $("input[name='$file_name']").val(img_src);
                    }
                });
                 $(".$file_name").on('clear.bs.fileinput',function(){
                    va = $('#$file_name');
                    if(va.length>0){
                        img_src = va.attr('data-src');
                        $("input[name='$file_name']").val(img_src);
                    }
                });
            </script>
EOF;
    return $html;
    }

    function statusTable($status){
        $arr = array(
            '-1' => '删除',
            '0'  => '注销',
            '1'  => '正常',
        );
        return $arr[$status];
    }
    function timeToStr($time){
        return date("Y-m-d H:i:s",$time);
    }
  //时间段内天数
  function timeDuanToDate($begin_time){
    $time_duan = time()-$begin_time;
    $end_time  = time();
    for( $i=$begin_time;$i<=$end_time;$i += 24*3600 ){
        $time_date[] = date("Y-m-d",$i);
    }
    return $time_date;
  }
  
  //获取ip
  function toGetIp(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }else{
            $cip = "none";
        }
        return $cip;
    }
//暂停
function slaap($seconds){ 
    $seconds = abs($seconds); 
    if ($seconds < 1){
       usleep($seconds*1000000); 
    }else{
       sleep($seconds); 
    } 
} 

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
function http_post($url,$param,$post_file=false){
 		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		if (is_string($param) || $post_file) {
			$strPOST = $param;
		} else {
			$aPOST = array();
			foreach($param as $key=>$val){
				$aPOST[] = $key."=".urlencode($val);
			}
			$strPOST =  join("&", $aPOST);
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($oCurl, CURLOPT_POST,true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
		$sContent = curl_exec($oCurl);
		$aStatus  = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}       
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
    if($cid){
        $params[":pid"] = $cid;
    }
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
function setWebLogin($uniacid,$uid){
    isetcookie('__uniacid', $uniacid, 7 * 86400,'/');
    isetcookie('__uid', $uid, 7 * 86400,'/');
     if(IMS_VERSION > 0.8){
        isetcookie('uniacid_source', "wxapp", 7 * 86400,'/');
        isetcookie('uniacid', $uniacid, 7 * 86400,'/');
     }else{
        isetcookie('uniacid', $uniacid, -7 * 86400,'/');
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
    $_SESSION['school_name']    = $school_name;
}
function setUniacid($uniacid){
    $_SESSION['uniacid']        = $uniacid;
}
function setClassId($class_id){
    $_SESSION['class_id']       = $class_id;
}
function setTeacherId($teacher_id=0){
    $_SESSION['teacher_id']     = $teacher_id;
}
function setStudentId($student_id=0){
    $_SESSION['student_id']     = $student_id;
}
function setTeacherMobile($status=false){
    $_SESSION['teacher_mobile'] = $status;
}
function setStudentMobile($status=false){
    $_SESSION['student_mobile'] = $status;
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
    return $_SESSION['db_admin_id']?$_SESSION['db_admin_id']:0;
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
    return intval($member_uid);
}
//获取pc端扫码登录fanid
function getMemberFanid(){
    global $_W;
    $member_fanid = $_W['fans']['fanid']? $_W['fans']['fanid']:$_SESSION['member_fanid'];
    return intval($member_fanid);
}
function getClassId(){
   return  $_SESSION['class_id'];
}
//性能检测
function sysPerforms($o=false){
    static $performs_t1,$performs_m1;
    if(!$o){
        $performs_t1=function_exists('microtime') ? microtime() : 0;
        $performs_m1=function_exists('memory_get_usage') ? memory_get_usage() : 0;
        return;
    }
    unset($o);
    $performs_t2=function_exists('microtime') ? microtime() : 0;
    $performs_m2=function_exists('memory_get_usage') ? memory_get_usage() : 0;
    $performs_t1=explode(' ',$performs_t1);
    $performs_t2=explode(' ',$performs_t2);
    $performs_t2=sprintf("%.2fms",($performs_t2[1]+$performs_t2[0]-$performs_t1[1]-$performs_t1[0])*1000);
 
    $performs_m2-=$performs_m1;$performs_m2=($performs_m2<0) ? 0 : $performs_m2;
    $performs_m2=($performs_m2>=1024) ? round($performs_m2/1024,2).'Kb' : $performs_m2.'byte';
 
    unset($performs_t1,$performs_m1);
    return 'Mem:'.$performs_m2.' Time:'.$performs_t2;
}
//读去文件下的根文件夹
function outGenFileList($dir){
     if(is_dir($dir)){
         if ($dh = opendir($dir)) {
             while( ($file = readdir($dh) ) !== false ){
                if((is_dir($dir."/".$file)) && $file!="." && $file!=".." && $file!='assets' && $file!='file'){
                    $out[] = $file;
                }
             }
         }
     }
     return $out;
}
//二维数组按年分级
function arrByYear($arr,$time_field='add_time'){
    $out_arr   = array();
    foreach ($arr as $key => $value) {
        $year = date("Y",$value[$time_field]);
        $out_arr[$year][] = $value; 
    }
    return $out_arr;
}
//富文本编辑器解码成html
//替换字体大小
function  myHtmlspecialchars_decode($content){
    $str     = '/font-size:[\s|\d|.]*px/';
    $num_str = '/\d\d/';
    $content = htmlspecialchars_decode($content);
    preg_match_all($str,$content,$matchs);
    foreach ($matchs[0] as $key => $value) {
        preg_match($num_str,$value,$ma);
        $num = $ma[0];
        if($num){
            $em = ($num/7) .'em';
            $re = "font-size:".$em;
            $content = str_ireplace($value,$re,$content);
        }
    }   
    $content = myHtmlspecialchars_decode_line($content);
    return $content;
}
function  myHtmlspecialchars_decode_line($content){
    $str     = '/line-height:[\s|\d|.]*px/';
    $num_str = '/\d\d/';
    $content = htmlspecialchars_decode($content);
    preg_match_all($str,$content,$matchs);
    foreach ($matchs[0] as $key => $value) {
        preg_match($num_str,$value,$ma);
        $num = $ma[0];
        if($num){
            $em = ($num/14) .'em';
            $re = "line-height:".$em;
            $content = str_ireplace($value,$re,$content);
        }
    }   
    return $content;
}
//处理移动端积木
function decodeWapBlockHtml($in_html){
     $text      = "实例文字内容";
     $img       = "http://zl.loveli.name/attachment/images/56/2017/01/WUM17yj6Ip2uR2o6QtIy7ySzRRr7UQ.jpg";
     $phtml = $in_html ? base64_decode($in_html):'';
     $html  = str_ireplace('{AUI_URL}',MODULE_URL,$phtml);
     $html  = str_ireplace('{$text}',$text,$html);
     $html  = str_ireplace('{$img}',$img,$html);
     return $html;
}
//处理入群组
function addgroup($school_name,$access_token,$openid=false){
    global $_W;
    if(!$openid){
        $openid            = $_W['openid'];
    }
    $class_memberGroup = Au("group/memberGroup");
    if($class_memberGroup){
       $re =  $class_memberGroup->doAction($openid,$school_name,$access_token);
    }
    return $re;
}
// function user_hash($passwordinput, $salt) {
// 	$passwordinput = "{$passwordinput}-{$salt}-5a859c78";
// 	return sha1($passwordinput);
// }
function displayImg($img){
    global $_W;
    $file_root = ATTACHMENT_ROOT.$img;
    if(file_exists($file_root)){
        return $_W['attachurl_local'].$img;
    }else{
        return $_W['attachurl'].$img;
    }
}