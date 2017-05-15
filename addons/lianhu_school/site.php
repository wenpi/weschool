<?php
/**
 * 家校通模块微站定义
 * @author zhuhuan
 * @url http://bbs.jiaxt.cn/
 */
// ini_set("display_errors",1);
// error_reporting(E_ALL^E_NOTICE);
defined('IN_IA') || exit('Access Denied');
require('money.php');
require("myclass/autoLoad.php");
include('qiniu/autoload.php');
use Qiniu\Auth as QiniuAuth;
use Qiniu\Storage\UploadManager as QiniuUploadManager; 
//开始运行时间
if(function_exists('sysPerforms')){
	sysPerforms();
}
class Lianhu_schoolModuleSite extends WeModuleSite {
	public $ac;
	public $op;
    public $where_uniacid_school;
    public $table_pe;
    public $jia_yun 	  = "http://api.loveli.name/public/index.php/";
    public $device_up_yun = "http://newapi.loveli.name/public/index.php/";
	
	public $class_base;
	public $school_info;
	public $msg_student_id;
	public $img_types = array('png','jpeg','jpg','gif','bmp');
	public $appointment_limit = array(
				'全校',
				'年级限制',
				'班级限制',
			);

	public function __construct(){
		global $_W ,$_GPC;
		@session_start();
        //注册表前缀
		$this->buildSetting();
        $table_pe = tablename('lianhu');
        $table_pe = trim($table_pe,'`');
        $table_pe = str_ireplace('lianhu','',$table_pe); 
        $this->table_pe=$table_pe;
        //加载微擎函数   
		load()->func('tpl');
		load()->func('file');
		load()->model('mc');
		$this->ac = $_GPC['ac'] ? $_GPC['ac']:'list';
		$this->op = $_GPC['op'] ? $_GPC['op']:'list';
        //多个公众号下的多个学校的防串联机制
		//多校判断机制
		setUniacid($_W['uniacid']);
		$school_id 	= getSchoolId();
		if($school_id){
			$have_success = $this->registerSchoolInfo($school_id);
			if(!$have_success){
				$school_id = 0;
			}
		}	
		if(!$school_id){
			if($_COOKIE['school_id']){
				$have_success = $this->registerSchoolInfo($_COOKIE['school_id']);			
				if(!$have_success){
					setcookie('school_id',0,-1000,'/');
					$school_id = 0;
				}else{
					$school_id = 1;
				}
			}
			//如果cookie也无效的话
			if($school_id==0){
				$list = S("school","getSchoolByUniacid",array($_W['uniacid']));
				if(count($list)==1){
					$this->registerSchoolInfo($list[0]['school_id']);			
				}else{
					$this->registerSchoolInfo(0);
				}
			}
		}
	}
	//注册学校信息
	public function registerSchoolInfo($school_id){
		global $_W;
		$class_school 			   = D('school');
		$class_school ->school_id  = $school_id;
		$result 	               = $class_school->getSchoolInfo();
		if($result['uniacid'] == $_W['uniacid']){
			$_SESSION['school_name'] = $result['school_name'];
			setSchoolId($result['school_id']);
			$this->school_info =  $result;
			$this->where_uniacid_school = " uniacid=".$_W['uniacid']." and status !=-1 and school_id=".$result['school_id']." ";                
			return true;			
		}else{
			$_SESSION['school_name'] = '';
			setSchoolId(0);
			$this->school_info='';
			return false;
		}
	}
	//注册class_base 
	public function  registerClassBase(){
		global $_W,$_GPC;
		$class_base 			 = D('base');
		$class_base ->web_w 	 = $_W;
		$class_base ->web_gpc    = $_GPC;
		$class_base ->table_pe   = $this->table_pe;
		$class_base ->web_config = $this->module['config'];
		$school_id 				 = getSchoolId();
		if($school_id){
			$class_base->school_id   = $school_id;
		}
		$this->class_base 		 = $class_base;
	}
	//统一的金额验证机制
	public function moneyLimit($function_name){
		global $_W,$_GPC;
		if($function_name == "Give_money"){
			return false;
		}
		$class_money = new money($function_name);
		$not_need_to = $class_money->money_judge();
		if(!$not_need_to){
			$url 	 = $this->createMobileUrl("give_money",array("limit_module"=>$function_name));
			header("Location:".$url);
			exit();
		}			
		return false;
	}
	public function __call($function_name,$args){
        // $this->getJiaToken();
		if(strstr($function_name, 'doWebAdmin') ){
			$fname=str_ireplace('doWebAdmin','',$function_name);
			$this->__adminWeb($fname);
		}elseif(strstr($function_name,'doWebFunc')){
			$fname=str_ireplace('doWebFunc','',$function_name);
			$this->__funcWeb($fname);
		}elseif(strstr($function_name, 'doWeb')){
			//微擎后台
			$fname=str_ireplace('doWeb','',$function_name);
			$this->__web($fname);
		}elseif(strstr($function_name, 'doMobileIm')){
			//IM
			$fname = str_ireplace('doMobileIm','',$function_name);
			$this->__ImMobile($fname);			
		}elseif(strstr($function_name, 'doMobileWap')){
			//微官网等
			$fname = str_ireplace('doMobileWap','',$function_name);
			$this->__adminMobileWap($fname);
		}elseif(strstr($function_name, 'doMobilePc')){
			//pc官网
			$fname = str_ireplace('doMobilePc','',$function_name);
			$this->__adminMobilePC($fname);			
		}elseif(strstr($function_name, 'doMobileAdmin')){
			//独立后台
			$fname=str_ireplace('doMobileAdmin','',$function_name);
			$this->__adminMobile($fname);
		}elseif(strstr($function_name, 'doMobileFunc')){
			//模块控制
			$fname=str_ireplace('doMobileFunc','',$function_name);
			$this->__FuncMobile($fname);			
		}elseif(strstr($function_name, 'doMobile')){
			//前端
			$fname=str_ireplace('doMobile','',$function_name);
			$this->__mobile($fname);
		}
	}
    #解析判断前端模板
    public function selectTemplate($module){
		global $_GPC;
		$old_module = $module;
        $school_id = getSchoolId();
        $mu_str    = '';
        if($school_id){
            $mu_str  = pdo_fetchcolumn("select mu_str from ".tablename('lianhu_school')." where school_id=:sid",array(':sid'=>$school_id));
			$mu_name = $mu_str;
		}
		// if($_SESSION['teacher_mobile'] && !in_array($module,array('TeaChat','TeaCardRecord',"ChatMessage")) ){
		// 		$mu_name = $mu_str ='new';
		// }
        if($mu_str){
            $mu_str = "../{$mu_str}/";
            if(!file_exists(MODULE_ROOT."/template/{$mu_name}/".$module.'.html')){
             	$mu_str = false;            
			}
        }
		if(!$mu_str){
			$mu_name = $mu_str = 'new';
            $mu_str  = "../{$mu_str}/";
            if(!file_exists(MODULE_ROOT."/template/{$mu_name}/".$module.'.html') ){
					$module = lcfirst($module);
					if(!file_exists(MODULE_ROOT."/template/{$mu_name}/".$module.'.html') ){
						$mu_str = '';
						$module = $old_module;
					}
			}
		}
        $out = $mu_str.$module;
        return $out;
    }
	//微官网
	public function __adminMobileWap($module){
		global $_GPC,$_W;
		$class_school = D('school');
		if($_GPC['school_id']){
			$school_id 			   = $_GPC['school_id'];
			setSchoolId($school_id);
		}else{
			$school_id 			   = getSchoolId();
		}
		if(!$school_id){
			//如果再没有学校信息，就去扫码关注里搜索
			$find['uniacid']   = $_W['uniacid'];
			$find["openid"]    = $_W['openid'];
			$result 	= D('careChannelLog')->edit($find);
			if($result){
				setSchoolId($result['school_id']);
				$school_id = $result['school_id'];
			}
		}
		//注册学校信息
		$class_school->school_id = $school_id;
		$school_info 			 = $class_school->getSchoolInfo();
		require('module/wap/'.$module.'.php');
		$teamplate_file = S("system",'getSchoolWapTemplate',array($school_id));
		if($_GPC['tem']){
			$teamplate_file = $_GPC['tem'];
		}
		$signPackage = $this->getSignPackage();
		$template 	 = '../../wap/'.$teamplate_file.'/'.$module; //从tempalte/mobile下的相对路径
		include $this->template($template);	
		exit();
	}
	//pc官网
	public function __adminMobilePc($module){
		global $_GPC,$_W;
		$class_school = D('school');
		if($_GPC['school_id']){
			$school_id 			   = $_GPC['school_id'];
			setSchoolId($school_id);
		}else{
			$school_id 			   = getSchoolId();
		}
		//注册学校信息
		$class_school->school_id = $school_id;
		$school_info 			 = $class_school->getSchoolInfo();
		require('module/pc/'.$module.'.php');
		$teamplate_file = S("system",'getSchoolPcTemplate',array($school_id));
		$template = '../../web/'.$teamplate_file.'/'.$module; //从tempalte/mobile下的相对路径
		include $this->template($template);	
		exit();
	}
	//Im处理
	//只做ajax
	public function __ImMobile($module){
		global $_GPC,$_W;
		if($_GPC['school_id']){
			setSchoolId($_GPC['school_id']);
		}
		require('module/im/'.$module.'.php');
		exit();
	}
	//自带消息提示
	public function myMessage($msg,$url=false,$status=false){
		global $_W;
		$config = $this->module['config'];
		if(defined('IN_MOBILE'))
			$template = '../../admin/app_message'; 
		else
			$template = '../admin/web_message'; //从tempalte/
		include $this->template($template);	
		exit();
	}
	public function __mobile($module){
		global $_GPC,$_W;
        $table_pe = $this->table_pe;
		$uid      = $this->register_member();
		$this->registerClassBase();
        $ac 	 = $this->ac;
		$op 	 = $this->op;
		$total   = 10;
		$pagesize= 20;
		$page    = $_GPC['page']?$_GPC['page']:1;
		$page    = (int)$page;
		$start_num = ($page-1)*$pagesize;
		$sql_limit = "limit {$start_num},{$pagesize} ";
        if(!file_exists(MODULE_ROOT.'/module/mobile/'.$module.'.php')){
            header('Location:'.$this->createMobileUrl('home'));
		}
		if($_SESSION['student_mobile'] && ($_GPC['in_type'] !='as_teacher' || $_GPC['in_type']=='as_student' )){
			$moneyresult = $this->moneyLimit($module);
			if($moneyresult){
				return true;
			}
		}
		require('module/mobile/'.$module.'.php');
		$pager       = pagination($total,$page,$pagesize);
		$signPackage = $this->getSignPackage();
		$template    = $this->selectTemplate($module);
		include $this->template($template);			
	}
	public function __FuncMobile($module){
		global $_GPC,$_W;
		list($file,$func) = explode('_',$module);
		$uid      = $this->register_member();
		$this->registerClassBase();
        $ac 	 = $this->ac;
		$op 	 = $this->op;
		$file_local = MODULE_ROOT.'/module/mobile/func/'.$file.'/'.$func.'.php';	
        if(!file_exists($file_local)){
            header('Location:'.$this->createMobileUrl('home'));
		}
		require($file_local);
		$signPackage = $this->getSignPackage();
		$template    = $this->selectTemplate($module);
		include $this->template($template);			
	}

	//后台pc入口
	public function __web($module){
		global $_GPC,$_W;
        $table_pe = $this->table_pe;
        $this->modelBeginSet($module);   
		$this->registerClassBase();
		$ac = $this->ac;
		$op = $this->op;
		$total   	= 10;
		$pagesize   = 20;
		$page 		= $_GPC['page']?$_GPC['page']:1;
		$page 		= (int)$page;
		$start_num  = ($page-1)*$pagesize;
		$sql_limit  = "limit {$start_num},{$pagesize} ";
		$jia_admin_id = getDbAdminId();
		$use_school_id  = getSchoolId();
		require('module/web/'.$module.'.php');
		$pager 		  = pagination($total,$page,$pagesize);
		include $this->template($module);
	}	
	public function __funcWeb($module){
		global $_GPC,$_W;
		list($file,$func) = explode('_',$module);
        $this->modelBeginSet($module);   
		$this->registerClassBase();
		$ac 		= $this->ac;
		$op 		= $this->op;
		$total   	= 10;
		$pagesize   = 20;
		$page 		= $_GPC['page']?$_GPC['page']:1;
		$page 		= (int)$page;
		$start_num  = ($page-1)*$pagesize;
		$sql_limit  	= "limit {$start_num},{$pagesize} ";
		$jia_admin_id   = getDbAdminId();
		$use_school_id  = getSchoolId();
		require('module/func/'.$file.'/'.$func.'.php');
		$pager 		  = pagination($total,$page,$pagesize);
		
	}
	public function __adminMobile($module){
		global $_GPC,$_W;
		load()->model('user');
		require('module/admin/'.$module.'.php');
		$template = '../../admin/'.$module; //从tempalte/mobile下的相对路径
		include $this->template($template);	
	}
	public function __adminWeb($module){
		global $_GPC,$_W;
		load()->model('user');
		require('module/admin/'.$module.'.php');
		$template = '../admin/web_'.$module; //从tempalte/
		include $this->template($template);	
		exit();
	}
	public function doMobileUploadvd(){
		global $_W ,$_GPC;
		if($_FILES){
			if($_FILES['file']){
				if($_FILES['file']['error']!=0){
					echo json_encode(array('status'=>1,'msg'=>'上传失败'));
				}else{
					$file_types = explode('/',$_FILES['file']['type']);
					$file_types[1] = $file_types[1]=='quicktime' ? 'mp4':$file_types[1];
					$filename 	= time().rand(111111,999999).'.'.$file_types[1];
					$file_local = MODULE_ROOT.'/video/'.$_W['uniacid'].'/'.date('Y/m/');

					if(!file_exists($file_local)){
						mkdirs($file_local);
					}
					$filename = $file_local.$filename;
					load()->func('file');
					move_uploaded_file($_FILES['file']['tmp_name'],$filename);
					if (!in_array($file_types[1],array('mp4'))) {
						file_remote_upload($filename);
					}
					echo json_encode(array('status'=>2,'filename'=>$filename));
				}
			}else{
				echo json_encode(array('status'=>1,'msg'=>'上传失败'));
			}
		}else{
			echo json_encode(array('status'=>1,'msg'=>'上传失败'));
		}
	}

	/*
	* 移动端
	* 不受openid控制
	*/
	//接收家云服务器传递过来的
	public function doMobileJiaYunFrom(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/JiaYunFrom.php");
	}
	//定时器
	public function doMobileCrontab(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/Crontab.php");
		exit();
	}
	//build setting
	public function buildSetting(){
		global $_W;
		$mymodules = pdo_fetch("SELECT  `settings` FROM " . tablename('uni_account_modules') . " WHERE uniacid = '{$_W['uniacid']}' AND `module`='lianhu_school' ORDER BY enabled DESC", array(), 'module');
		$this->module['config'] = iunserializer($mymodules['settings']);
	}
	public function doWebWqsystemParams(){
		global $_W,$_GPC;
		$left_top     = 'system_set';
		$left_nav     = 'system_parameter';
		$title        = '系统参数';  
		$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'系统设置'),
				array('fun_str'=>'','fun_name'=>'系统参数'),
		);
		$settings = $this->module['config'];
        if (checksubmit()) {
            $params = array();
            $cfg = array(
                'msg'             => $_GPC['msg'],
                'msg1'            => $_GPC['msg1'],
                'msg01'           => $_GPC['msg01'],
                'msg11'           => $_GPC['msg11'],
                'msg_card'        => $_GPC['msg_card'],
                'homework_msg'    => $_GPC['homework_msg'],
                'version'         => $_GPC['version'],
                'mylovekid'       => $_GPC['mylovekid'],
                'family_set'      => $_GPC['family_set'],
                'sms_set'         => $_GPC['sms_set'],
                'qiniu'           => $_GPC['qiniu'],
                'qiniu_url'       => $_GPC['qiniu_url'],
                'qiniu_pipeline'  => $_GPC['qiniu_pipeline'],
                'qiniu_AccessKey' => $_GPC['qiniu_AccessKey'],
                'qiniu_SecretKey' => $_GPC['qiniu_SecretKey'],
                'qiniu_bucket'    => $_GPC['qiniu_bucket'],
                'jia_passport'    => $_GPC['jia_passport'],
                'jia_password'    => $_GPC['jia_password'],
                'admin_openid'    => $_GPC['admin_openid'],
                'pay_do'          => $settings['pay_do'],
                'img_qiniu'       => $_GPC['img_qiniu'],
                'pay_uniacid'     => $settings['pay_uniacid'],
                'follow_code'     => $_GPC['follow_code'],
                'parent_msg'      => $_GPC['parent_msg'],
                'teacher_msg'     => $_GPC['teacher_msg'],
                'school_locus'    => $_GPC['school_locus'],
                'email_msg'       => $_GPC['email_msg'],
                'battery_num'	  => $_GPC['battery_num'],
            );
			$params["keyword"] = 'api_server';
			$data["content"]   = $_GPC["api_server"];
			S("base","saveKeywordContent",array($params,$data));
			
			$params["keyword"] = 'api_ip';
			$data["content"]   = $_GPC["api_ip"];
			S("base","saveKeywordContent",array($params,$data));
			
			$params["keyword"] = 'api_passport';
			$data["content"]   = $_GPC["api_passport"];
			S("base","saveKeywordContent",array($params,$data));
			
			$params["keyword"] = 'api_password';
			$data["content"]   = $_GPC["api_password"];
			S("base","saveKeywordContent",array($params,$data));

			$params["keyword"] = 'web_admin_theme';
			$data["content"]   = $_GPC["web_admin_theme"];
			S("base","saveKeywordContent",array($params,$data));
            if ($this->saveSettings($cfg)) {
                $this->myMessage('保存成功',$this->createWebUrl("WqsystemParams"),'成功');
            }
        }		
		$uniacid_list = D('platform')->getAllPlatform();
		include $this->template('../admin/web_setting');
		exit();
	}
	//返回对称加密的access_token
	public function doMobileGetToken(){
		global $_W,$_GPC;
		$token =  $this->AccessToken();
		// define('MCRKEY','qweq@78weqw');
		// $en = MT('mcrypt','encrypt',array($token));
		if($_GPC['pd']=='zhh45kl'){
			echo $token;
		}else{
			echo 'no';
		}
		exit();
	}	
	//插入硬件对接库
	public function doMobileInsertIntoJiaCardLog(){
		global $_W,$_GPC;
		C("api")->askCheck($_POST['passport'],$_POST['password']);
		$g = 0;
		//写入参数
		$data = json_decode($_POST['data'],true);
		foreach ($data as $key => $value) {
			$in['card_id'] 	 = (string)$value['card_id'];
			$in['device_id'] = (string)$value['device_id'];
			$in['status'] 	 = 1;
			$in['img'] 		 = (string)$value['img'];
			$in['img1'] 	 = (string)$value['img1'];
			$in['temp'] 	 = (string)$value['temp'];
			$re = Au("jiacard/cardLog")->add($in);
			if($re){
				$g++;
			}
		}
		$arr = array("errcode"=>0,'msg'=>$g);
		outJson($arr);
	}
	//生成移动端扫码登录二维码
	public function doMobileLoginCode(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/LoginCode.php");
	}

	//手机号注册
	public function doMobileRegister(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/Register.php");		
		$template = $this->selectTemplate('Register');
	    include $this->template($template);		
	}
	//手机号登录
	public function doMobileLogin(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/Login.php");		
		$template = $this->selectTemplate('Login');
	    include $this->template($template);		
	}
	//找回密码
	public function doMobileFindPass(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/FindPass.php");		
		$template = $this->selectTemplate('FindPass');
	    include $this->template($template);		
	}
	public function doMobileQrimg(){
		global $_W,$_GPC;
		$this->registerClassBase();
		require("module/mobile/Qrimg.php");		
	}
	//检验后台登录人员
	public function checkAdminWeb($check=true){
		global $_W;
		$uid = $_W['uid'];
		if($uid != $_W['config']['setting']['founder']){
			$wq_admin = D("admin")->getWqAdmin();
			if($uid!=$wq_admin['uid']){
				$this->myMessage("非系统管理员账号和本模块内置账号不能登录",$_W['siteroot'].'app/'.$this->createMobileUrl("adminlogin"),'错误' );
			}
		}
		if(!$uid){
			$this->myMessage("请先登录",$_W['siteroot'].'app/'.$this->createMobileUrl("adminlogin"),'错误' );
		}
	}
    #获取正在后台操作的人员
    public function getWebAdminName(){
		global $_W,$_GPC;
		$uid = $_W['uid'];
        if($_GPC['_admin_name']){
			 $admin_name = $_GPC['_admin_name'];
		}else{
             $admin_name = '管理员';
		}
        return $admin_name;
    }
    #模块初始化的流程控制
    public function modelBeginSet($module){
        global $_W,$_GPC;
        $school = S("school","getSchoolByUniacid",array($_W['uniacid']));
        if(!$school){
			$this->myMessage('请先设置一个有效地学校',$this->createWebUrl('school_new'),'错误');
		}
		$school_id  = getSchoolId();
        if($school_id){
            $config   				 = $this->module['config'];
            $need_session_arr   	 = array(
				array('am_much','上午上课数'),
				array('pm_much','下午上课数'),
				array('on_school','在校天数')
			);
            foreach ($need_session_arr as $value) {
                if(!$this->school_info[$value[0]] ){
					$this->myMessage('学校参数里有参数未设置;关键词为：'.$value[0].'；名称为：'.$value[1],$this->createWebUrl('school',array('sid'=>$school_id,'aw'=>1,'op'=>'edit') ),'错误');
				} 
            }
            if($module =='Grade'){
				return true;          
			} 
            $grade 	   = pdo_fetch("select * from ".tablename('lianhu_grade')." where status=1 and school_id=:sid",array(":sid"=>$school_id));            
            if(!$grade){
				$this->myMessage('请先设置一个有效的年级',$this->createWebUrl('grade',array('aw'=>1)),'错误');         
			} 
			if($module =='Class'){
				return true;  
			} 
            $class = pdo_fetch("select * from ".tablename('lianhu_class')." where status=1 and school_id=:sid",array(":sid"=>$school_id));
            if(!$class){
				$this->myMessage('请先设置一个有效的班级',$this->createWebUrl('Class',array('aw'=>1)),'错误');        
			}
			if( $module =='Course'){
				return true;  
			}
            $course = pdo_fetch("select * from ".tablename('lianhu_course')." where school_id=:sid",array(":sid"=>$school_id));
            if(!$course){
				$this->myMessage('请先设置一个有效的课程',$this->createWebUrl('course',array('aw'=>1)),'错误');                                  
			} 
        }else{
            $this->myMessage("请先选择登陆的学校",$this->createWebUrl('adminindex'),'错误'); 
		}
    } 
    //判断一个老师是否是班主任
    public function classHead($teacher_id){
        $list = pdo_fetchall("select * from ".tablename('lianhu_class')." where teacher_id=:tid and status=1  ",array(':tid'=>$teacher_id));
        if(!$list){
			return false;
		}
        return $list;
    }
	//获取一个学校班级圈审核设置
    public function getSchoolLineStatus(){
		$school_id   = getSchoolId();
		$line_status = pdo_fetchcolumn("select line_status from  ".tablename('lianhu_school')." where  school_id=:sid",array(":sid"=>$school_id));
		return $line_status;
	}
    #返回教师的课程
    public function teacherCourse($teacher_id,$world=false){
        $result  	 = pdo_fetch("select * from ".$this->table_pe."lianhu_teacher where teacher_id=:tid",array(':tid'=>$teacher_id));
        if(!$result['course_id']){
             return false;
		}
        $course_list = pdo_fetchall("select * from ".$this->table_pe."lianhu_course where course_id in ({$result['course_id']})  ");
        if($world =='echo'){
            foreach ($course_list as  $value) {
                $str.=$value['course_name'].',';
            }
            $str=trim($str,',');
            return $str;
        }
        return $course_list;
    }
    #返回所有的有效课程
    public function returnAllEfficeCourse(){
        $list = D('course')->getCourseList();
        return $list;
    }
    #操作一个二维数组
    public function echoArrOne($arr,$name){
        foreach($arr as $val){
            $str .= $val[$name].',';
        }
        $str = trim($str,',');
        return $str;
    }    
    #获取一个年级命名
    public function gradeName($grade_id){
        if(empty($grade_id)){
			return false;
		} 
        return pdo_fetchcolumn("select grade_name from ".$this->table_pe."lianhu_grade where grade_id=:gid",array(':gid'=>$grade_id));
    }
    #获取一个班级命名
    public function className($class_id){
        if(empty($class_id)){
			return false;
		} 
        return pdo_fetchcolumn("select class_name from ".$this->table_pe."lianhu_class where class_id=:cid  ",array(':cid'=>$class_id) );
    }
    public function classStatus($class_id){
        if(empty($class_id)){
			return false;
		} 
        return pdo_fetchcolumn("select status from ".$this->table_pe."lianhu_class where class_id=:cid  ",array(':cid'=>$class_id) );
    }	
	#获取一个班级的年级命名
    public function classGradeName($class_id){
        if(empty($class_id)){
			return false;
		} 
        $grade_id = pdo_fetchcolumn("select grade_id from ".$this->table_pe."lianhu_class where class_id=:cid ",array(':cid'=>$class_id) );
    	return $this->gradeName($grade_id);
	}	
	#获取学生的详细信息
	public function getStudentInfo($student_id){
        return pdo_fetch("select * from ".$this->table_pe."lianhu_student where student_id=:sid ",array(":sid"=>$student_id));
	}
    #获取一个学生名
    public function studentName($student_id){
        return pdo_fetchcolumn("select student_name from ".$this->table_pe."lianhu_student where student_id=:sid ",array(":sid"=>$student_id));
    }
    #获取一个用户的昵称
    public function memberNickName($uid){
        return pdo_fetchcolumn("select nickname from ".tablename('mc_members')." where uid=:uid ",array(":uid"=>$uid));
    }
    #获取一个教师的名字
    public function teacherName($tid){
        if(!$tid){
            return false;
		}
        return pdo_fetchcolumn("select teacher_realname from ".$this->table_pe."lianhu_teacher where teacher_id=:tid ",array(":tid"=>$tid));
    }   
    #判断一个用户有没有赞
    public function zanLine($send_id){
         $uid 	= getMemberUid();
         $count = pdo_fetchcolumn("select count(*) from ".$this->table_pe."lianhu_send_like where uid=:uid and send_id=:send_id ",array(':uid'=>$uid,':send_id'=>$send_id));
         return $count;
    }
    #获取记录的详细
    public function jiLvClassInfo($class_id){
        $info   = pdo_fetch("select * from ".$this->table_pe."lianhu_jilv_class where class_id=:cid ",array(':cid'=>$class_id));
        return $info;
    }
	//根据教师的id获取教师的openid
	public function getTeacherOpenid($teacher_id){
		$uid = pdo_fetchcolumn("select uid from ".$this->table_pe."lianhu_teacher where teacher_id=:tid ",array(":tid"=>$teacher_id) );
		if($uid){
			$openid = $this->getOpenidByUid($uid);
		}
		return $openid;							
	}
	//根据UId获取当前的openid
	public function getOpenidByUid($uid){
		 global  $_W;
		 $openid = pdo_fetchcolumn("select openid from  ".tablename("mc_mapping_fans")."  where uid=:uid and acid=:acid and uniacid=:uniacid"
									,array(":uid"=>$uid,':acid'=>$_W['acid'],':uniacid'=>$_W['uniacid']) );
		 return $openid;
	}
    #根据班级和父母的uid
    #七牛处理
    #调用七牛处理
    // if($img)
    // $in['img']= $img;
    public function upToQiniu($imgname){
			$imginfo   = explode('.',$imgname);
			$img_type  = end($imginfo);
			$img_to_up = $this->module['config']['img_qiniu'];		
			if(!$img_to_up && in_array($img_type,$this->img_types) ){
				return false;
			}	
            $accessKey = $this->module['config']['qiniu_AccessKey'];
            $secretKey = $this->module['config']['qiniu_SecretKey'];
            $auth      = new QiniuAuth($accessKey, $secretKey);
            $bucket    = $this->module['config']['qiniu_bucket'];
            $token     = $auth->uploadToken($bucket);
            $filePath  = ATTACHMENT_ROOT.$imgname;
            if(!file_exists($filePath)){
				return false;
			}
            $key       = "qiniu".$imgname;
            $uploadMgr = new QiniuUploadManager();
            $arr       = $uploadMgr->putFile($token, $key, $filePath);
			list($ret, $err) = $arr;
            if ($err !== null){
				$content = json_encode($arr).serialize($err);
				D('textLog')->writeLog($content);
                return false;
			 }else{
                return $key;
			 }
    }
    #使用七牛后判别是否是七牛
    public function imgFrom($imgname){
        global $_W;
		if(stristr($imgname,'http')){
			return $imgname;
		}
        if(stristr($imgname,"qiniu")){
             $url =  trim($this->module['config']['qiniu_url'],'/').'/'.$imgname;
        }else{
			 $url = displayImg($imgname);
        }
		return $url;
    }
    #微信js处理
	public function getSignPackage() {
		global $_W;
        load()->classs('weixin.account');
        $weixin      = new WeiXinAccount( $_W['account']);
		$appid       = $_W['account']['key'];
		$protocol    = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url         = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$jsapiTicket = $weixin->getJsApiTicket();
        $timestamp   = $_W['account']['jssdkconfig']['timestamp'];
		$nonceStr    = $_W['account']['jssdkconfig']['nonceStr'];
		$string      = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
		$signature   =sha1($string);
		$signPackage  = array("appId" => $appid,"nonceStr" => $nonceStr, "timestamp" => $timestamp,
                               "url" => $url   ,"signature" => $signature,"rawString" => $string);
		return $signPackage;
	}
    #获取access_token
    public function AccessToken(){
        global $_W;
        $acid 	= $_W['acid'];
        load()->classs('weixin.account');
        $accObj = WeixinAccount::create($acid);
        $access_token = $accObj->fetch_token();
        return $access_token;
    }
	
	#独立课程调用支付
	public function doMobileAloneCoursePay(){
        global $_W,$_GPC;
		$result 	  = $this->mobile_from_find_student();
		$course_id 	 = $_GPC['course_id'];
		$course_info = C('courseScan')->edit($course_id);
		C('courseStudent')->course_id = $course_id;
		$have_in 					  = count(C('courseStudent')->getCourseList());
		if($course_info && $course_info['buy_end'] > TIMESTAMP && $course_info['max_student_num'] >= $have_in){
			$arr['from_table'] = 'lianhu_course_scan';
			$arr['from_id']    = $course_id;
			$arr['money_much'] = $course_info['price'];
			$arr['student_id'] = $result['student_id'];
			$arr['pay_uid']    = getMemberUid();
			$money_info_id 	   = D('moneyInfo')->add($arr);

			$in['limit_id']  = 0;
			$in['limit_much']= $course_info['price'];
			$in['student_id']= $result['student_id'];
			$in['fan_id']    = 0;
			$in['addtime']   = TIMESTAMP;
			$in['status']    = 0;
			$in['class_id']  = $result['class_id'];
			$in['grade_id']  = $result['grade_id'];
			$in['mobile'] 	 = $result['parent_phone'];			
			$in['money_info_id'] 	 = $money_info_id;			
			$order_id 		 		 = D("moneyRecord")->add($in);
			$params = array(
				'tid' 		=> $order_id,
				'ordersn' 	=> "MMD".$insert_id,
				'title' 	=> $course_info['course_name'].'报名缴费',
				'fee' 		=> $course_info['price'],
				'user' 		=> getMemberUid(),
			);
			$this->topay($params);
		}
		exit();
	}
    #去支付
    public function topay($params){
        global $_W;
        $config = $this->module['config'];
        if($config['pay_do']==1){
            header("Location:{$_W['siteroot']}app/index.php?i={$config['pay_uniacid']}&c=entry&do=topay&m=lianhu_school&from_uniacid={$_W['uniacid']}&order_id={$params['tid']}&limit_name={$params['title']}");
        }
        $this->pay($params);
    }
    #支付
    public function doMobileTopay(){
        global $_GPC;
        $from_uniacid= $_GPC['from_uniacid'];
        $order_id    = $_GPC['order_id'];
        $limit_name  = $_GPC['limit_name'];
		$uid 		 = getMemberUid();
        $order_re    = pdo_fetch("select * from ".$this->table_pe."lianhu_money_record where record_id=:rid",array(':rid'=>$order_id));
 		$params=array(
				'tid'       => $order_id,
				'ordersn'   =>"MMD".$order_id,
				'title'     => $limit_name ,
				'fee'       =>$order_re['limit_much'],
				'user'      =>$uid,
		);       
        $this->pay($params);
    }
	public function doWebSchool(){
		global $_GPC,$_W;
		require 'module/web/School.php';
		include $this->template('school');
	}
	public function doWebSchool_new(){
		global $_GPC,$_W;
		require 'module/web/School_new.php';
	}	
	public function doWebSystemfix(){
		global $_GPC,$_W;
		$ac = $this->ac;
		$op = $this->op;
		$this->registerClassBase();
		require 'module/web/Systemfix.php';
		include $this->template('Systemfix');
	}
	public function doWebNoBeginAjax(){
		global $_GPC,$_W;
		$ac = $this->ac;
		$op = $this->op;
		$this->registerClassBase();
		require 'module/web/NoBeginAjax.php';
		exit();		
	}
	public function getWeixinToken() {
		global $_W;
		$acid = pdo_fetchcolumn("select acid from ".tablename('account')." where uniacid ={$_W['uniacid']} ");
		if($acid){
			$access_token = $this->AccessToken();
			return $access_token;
		}else{
			exit('升级中。。。');
		}
	}    
	public function sendcustomMsg($from_user, $msg) {
		$access_token = $this->getWeixinToken();
		$url          = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$msg          = str_replace('"', '\\"', $msg);
		$post         = '{"touser":"' . $from_user . '","msgtype":"text","text":{"content":"' . $msg . '"}}';
		$this->curlPost($url, $post);
	}
	public function curlPost($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$info = curl_exec($ch);
		curl_close($ch);
		return $info;
	} 
	private function curlGet($url){
		$oCurl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($oCurl, CURLOPT_SSLVERSION, 1); //CURL_SSLVERSION_TLSv1
		}
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
		$sContent = curl_exec($oCurl);
		$aStatus  = curl_getinfo($oCurl);
		curl_close($oCurl);
		if(intval($aStatus["http_code"])==200){
			return $sContent;
		}else{
			return false;
		}
	}
	/*
	*@通过curl方式获取指定的图片到本地
	*@ 完整的图片地址
	*@ 要存储的文件名
	*/
    function getImg($url = "", $filename = "")
    {
        //去除URL连接上面可能的引号
        //$url = preg_replace( '/(?:^['"]+|['"/]+$)/', '', $url );
        $hander = curl_init();
        $fp 	= fopen($filename,'wb');
        curl_setopt($hander,CURLOPT_URL,$url);
        curl_setopt($hander,CURLOPT_FILE,$fp);
        curl_setopt($hander,CURLOPT_HEADER,0);
        curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
        //curl_setopt($hander,CURLOPT_RETURNTRANSFER,false);//以数据流的方式返回数据,当为false是直接显示出来
        curl_setopt($hander,CURLOPT_TIMEOUT,60);
        curl_exec($hander);
		// $content = file_get_contents($url);
        // C('log')->write("获取微信图片",$content);
		curl_close($hander);
        fclose($fp);
        Return true;
    }
    #发送短信
    public function sendSms($parent_phone){
        $class_money = new money('sms');
		$not_need_to = $class_money->judeSmsMoney($parent_phone); 
        if($not_need_to){
            return $parent_phone;
        }else{
            return false;
        }
    }
    #发送客服消息
    public function toSendCustomNotice($openid,$title,$content,$url){
        $send_text .= "您好，您有一个学校通知\r\n";
        $send_text .= "标题：{$title}\r\n";
        $send_text .= "时间：".date("Y-m-d H:i:s",time() )."\r\n";
        $send_text .= "内容：{$content}\r\n";
        $send_text .= "<a href=\"".$url."\">点此查看详情  </a>";
        $this->sendcustomMsg($openid,$send_text);
    }
    #获取课程名字
    public function courseName($course_id){
        $course_name = pdo_fetchcolumn("select course_name from ".$this->table_pe."lianhu_course where course_id=:cid ",array(":cid"=>$course_id) );
        return $course_name;
    }
    #更具class_id 获取此班级所有的详细教师
    public function classTeacher($class_id){
		$class_id 	 = intval($class_id);
		$other_where = " and ".$this->where_uniacid_school;
		//中间，结束，开始，等于
		$where_like  = " ( teacher_other_power like '%,".$class_id.",%' or teacher_other_power like '%,".$class_id."'  or teacher_other_power like '".$class_id.",%' or teacher_other_power = ".$class_id.")";
        $result      = pdo_fetchall("select * from ".$this->table_pe."lianhu_teacher where  status=1  {$other_where} and {$where_like} ");    
        return $result;   
    }
    #更具class_id 和课程名获取授课老师
    public function classCourse($class_id,$course_name){
		$other_where = " and ".$this->where_uniacid_school; 
        $course_id   = pdo_fetchcolumn("select course_id from ".$this->table_pe."lianhu_course where course_name=:name {$other_where}",array(':name'=>$course_name));
        if(!$course_id){
			return 'no';
		}
        $teacher_name=pdo_fetchcolumn("select teacher_realname from ".$this->table_pe."lianhu_teacher where 
                    course_id=:cid and teacher_other_power like :power limit 1",array(':cid'=>$course_id,':power'=>"%{$class_id}%"));
        return $teacher_name;
    }
    #根据class_id和课程获取所有可以授课的老师
    public function classCouldCourse($class_id,$course_id){
		$school_id = getSchoolId();
		if(!$course_id){
            return 'no';
		}
         $teacher_list=pdo_fetchall("select * from ".$this->table_pe."lianhu_teacher where 
                   (course_id ={$course_id} or course_id like '{$course_id},%' or course_id like '%,{$course_id},%' or course_id like '%,{$course_id}') 
                   and teacher_other_power like :power ",array(':power'=>"%{$class_id}%"));               
		 return $teacher_list;
    }
    #移动端 判断教师还是家长
    public function judePortType(){
		global $_W,$_GPC;
        if($_SESSION['student_mobile'] && $_GPC['in_type'] !='as_teacher' || $_GPC['in_type']=='as_student' ){
             $student_info = $this->mobile_from_find_student();
             return array('type'=>'student','info'=>$student_info);     
        }
        if($_SESSION['teacher_mobile'] || $_GPC['in_type'] =='as_teacher'){
            $teacher_re = $this->teacher_mobile_qx(true);
            return array('type'=>'teacher','info'=>$teacher_re);
        }
		//后台
		if($_W['uid']){
            return array('type'=>'admin');
		}
    }
    #通过uid查找教师
    #后台
	public function WebFindTeacherInfo($ziduan=''){
		$class_teacher = D('teacher'); 
		$t_id   	   = getTeacherId();
		if($t_id){
			$t_info    = $class_teacher->getTeacherInfo(); 
			if($ziduan){
				return $t_info[$ziduan];
			}else{
				return $t_info;
			}
		}
	}
 	#通过uid查找教师
    #前台	
    public function findTeacherInfoByMobileUid($uid){
		$result=pdo_fetch("select * from ".$this->table_pe."lianhu_teacher where  uid=:uid ",array(':uid'=>$uid));
		return $result;
	}
	#删除教师的课程
	public function delete_course_teacher($cid,$model){
		if($model=='all'){
			$school_uniacid = $this->where_uniacid_school;
			$list=pdo_fetchall("select * from ".$this->table_pe."lianhu_teacher where  {$school_uniacid} ");
		}else{
			$list=pdo_fetch("select * from ".$this->table_pe."lianhu_teacher where teacher_id=:teacher_id",array(':teacher_id'=>$model));
		}	
		foreach ($list as $value) {
			if($value['course_id']==$cid){
				$up['course_id']='';
				pdo_update('lianhu_teacher',$up,array('teacher_id'=>$value['teacher_id']));
			}else{
				continue;
			}
		}
	}
    #添加班级的课程
	public function add_course_class($cid,$model){
		if($model=='all'){
			$school_uniacid=$this->where_uniacid_school;
			$list=pdo_fetchall("select * from ".$this->table_pe."lianhu_class where status=1 and {$school_uniacid} ");
		}else{
			$list=pdo_fetch("select * from ".$this->table_pe."lianhu_class where class_id=:cid",array(':cid'=>$model));
		}
		foreach ($list as $value) {
			if($value['course_ids']){
				$class_course_id_arr=unserialize($value['course_ids']);
				$d=false;
				foreach ($class_course_id_arr as  $v) {
					if($v==$cid){
						$d=true;
						break;
					}
				}
				if(!$d){
					array_push($class_course_id_arr, $cid);
				}
			}else{
				$class_course_id_arr[0]=$cid;
			}
			$up['course_ids']=serialize($class_course_id_arr);
			pdo_update('lianhu_class',$up,array('class_id'=>$value['class_id']));
		}
	}
	public function delete_course_class($cid,$model){
		if($model=='all'){
			$school_uniacid = $this->where_uniacid_school;
			$list 			= pdo_fetchall("select * from ".$this->table_pe."lianhu_class where status=1 and {$school_uniacid}  ");
		}else{
			$list 			= pdo_fetch("select * from ".$this->table_pe."lianhu_class where class_id=:cid",array(':cid'=>$model));
		}
		foreach ($list as  $value) {
			if($value['course_ids']){
				$class_course_id_arr = unserialize($value['course_ids']);
				foreach ($class_course_id_arr as $k => $v) {
					if($v==$cid){
						unset($class_course_id_arr[$k]);
						break;
					}
				}
			}else{
				continue;
			}
			$up['course_ids'] = serialize($class_course_id_arr);
			pdo_update('lianhu_class',$up,array('class_id'=>$value['class_id']));			
		}		
	}
	public function student_standard($grade=''){
		global $_GPC;
		$class_student 		= D('student');
		$class_ctl_classes  = C('classes');
		load()->func('tpl');
		if($grade == 'no'){
			$model    =$_GPC['model']  ? $_GPC['model'] :"class";
			$quanxian =$this->teacher_standard($grade);
		}else{
			$model    =$_GPC['model']  ? $_GPC['model'] :"grade";
			$quanxian =$this->teacher_standard();
			$grade_id =$_GPC['gid']   ? $_GPC['gid'] :0;
		}
		if($model=='someone'){
			$student_id      = intval($_GPC['sid']);
			if(!$student_id){
				 $this->myMessage('非法访问，没有学生id','','错误');
			}
			$student_result  = $class_student->getStudentInfo($student_id);
			if(!$student_result){
				$this->myMessage('没有查到此学生','','错误');
			}
			$result          = $student_result;
		}elseif($model=='student'){
			$class_id=intval($_GPC['cid']);	
			$ff=false;
			foreach ($quanxian as $key => $value) {
				foreach ($value as $k => $val) {
					if($val==$class_id){
						$ff=true;
						break;
					}
				}
			}
			if($ff==false){
				$this->myMessage('没有访问此班级的权限','','错误');
			}
			if(!$class_id){
				$this->myMessage('非法访问，没有班级id','','错误');
			}
			$class_result   = D('classes')->className($class_id);
			if(!$class_result){
				$this->myMessage('没有查到此班级','','错误');
			}
			$class_ctl_classes->class_id = $class_id;
			$student_list   			 = $class_ctl_classes->getClassStudent();
			$result 					 = $student_list;
		}elseif($model=='grade'){
			foreach ($quanxian as $key => $value) {
				$grades[]=$key;
			}
			$result=$grades;
		}elseif($model=='class'){
			if($grade)
				$class_s=$quanxian;
		    else
				$class_s=$quanxian[$grade_id];
			if(!$class_s){$this->myMessage('非法访问','','错误');}
			$result=$class_s;
		}
		return $result;
	}
	public function teacher_standard($model=''){
		$do = $this->teacher_qx('no');
		if($do!='teacher'){
			$class_all 		= D('classes')->getThisAdminClassList();
			return $this->juhe_class($class_all);
		}
		$tid = getTeacherId();
		if( $tid ){
			$teacher_result   = pdo_fetch("select * from ".$this->table_pe."lianhu_teacher where teacher_id=:teacher_id ",array(':teacher_id'=> $tid ));
			if($teacher_result['status']==0){
				$this->myMessage('该教师账号已经在家校通注销，不能登陆','','错误');
			}
			if(empty($teacher_result['teacher_other_power'])){
				$this->myMessage('该账号没有管理权限，因此没有访问的必要','','错误');
			}
			$class_s  = explode(',', $teacher_result['teacher_other_power']);
			//检测班级的有效性
			foreach( $class_s as  $v){
				$class_status = $this->classStatus($v);
				if($class_status==1){
					$class_list[]=$v;
				}
			}
			if($model=='no'){
				return $class_list;
			}
			return $this->juhe_class($class_list);
		}
	}
 	#班主任和管理员
	#返回班级列表  课程 
    # 后台端
	public function teacher_main($all_teacher=false){
		global $_W;
		$teacher   = $this->teacher_qx('no');
		$school_id = getSchoolId();
		if($teacher=='teacher'){
			$uid=$_W['uid'];
			$t_id   =   getTeacherId();
			$list=pdo_fetchall("select class.*,grade.grade_name from ".$this->table_pe."lianhu_class class 
                         left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id  
                         where class.status=1 and class.teacher_id={$t_id}");
		    if($all_teacher){
                $class_ids=pdo_fetchcolumn("select teacher_other_power from  ".$this->table_pe."lianhu_teacher where teacher_id=:tid ",array(':tid'=>$t_id) );
                if($class_ids){
                    $cid_arr   =explode(',',$class_ids);
                    $class_ids =implode(',',$cid_arr);
                    $list=pdo_fetchall("select class.*, grade.grade_name from ".$this->table_pe."lianhu_class class 
                                        left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id  
                                        where class.status=1 and class.class_id in ({$class_ids})" );
                  }
            }
        }else{
			$school_uniacid_class=" and class.uniacid={$_W['uniacid']} and class.school_id={$school_id} ";
			$list = pdo_fetchall("select class.*, grade.grade_name from ".$this->table_pe."lianhu_class class 
                                left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id  
                                where class.status=1 {$school_uniacid_class} ");
		}	
		if(!$list){
			$this->myMessage("您既不是班主任，也不是管理员，无法进入",'','error');
		}	
		return $list;
	}
	public function teacher_class_list(){
		#返回老师和管理员的班级列表
	}

    #管理员教师权限验证q
    #modle=no 返回是否是老师
	public function teacher_qx($model=''){
		global $_W,$_GPC;
		$db_admin_id = getDbAdminId();
		if($db_admin_id){
			$admin_info = D('admin')->getAdminInfo($db_admin_id);
		}
		$teacher_id = getTeacherId();
		if($admin_info['teahcer_id'] || $teacher_id){
			if($model=='no'){
				$school_id = pdo_fetchcolumn("select school_id from ".$this->table_pe."lianhu_teacher where teacher_id=:tid",array(":tid"=>$teacher_id));
				setSchoolId($school_id);
				return 'teacher';
			}else{
				$this->myMessage('只有管理员才能访问','','错误');
			}
		}else{
			$school_id = getSchoolId();
			#管理员情况下自动选择
			if(!$school_id){
				if($_COOKIE['school_id']){
					setSchoolId($_COOKIE['school_id']);
				}else{
					$school_id=pdo_fetchcolumn("select school_id from ".$this->table_pe."lianhu_school where status=1 limit 1");
					setSchoolId($school_id);
				}
			}
			return 'admin';
		}
	}
	public function juhe_class($class_s){
		$quanxian=array(array());
			foreach ($class_s as $key => $value) {
				if(is_array($value)){$value=$value['class_id'];}
				if($value){
					$grade_id=pdo_fetchcolumn("select grade_id from ".$this->table_pe."lianhu_class where class_id=".$value);
					if($quanxian[$grade_id]){
						array_push($quanxian[$grade_id], $value);
					}else{
						$quanxian[$grade_id][0]=$value;
					}
				}
			}
			foreach ($quanxian as $key => $value) {
				if(!$value){
					unset($quanxian[$key]);
				}
			}
			return $quanxian;		
	}
	public function result_result($row,$model,$where,$url){
		if($model=='grade'){
			$gid=intval($row);
			if($where=='name'){ 
				echo pdo_fetchcolumn("select grade_name from ".$this->table_pe."lianhu_grade where grade_id={$gid} ");
			}
			if($where=='url'){
				if($url=='tea_jinbu_record' || $url=='tea_error_record' || $url=='tea_work_record' || $url=='teaStudentPhoto' ){
					echo $this->createMobileUrl($url,array('model'=>'class','gid'=>$gid));
				}elseif($url=='msg'|| $url=='test' || $url=='score_list' || $url=='studentPhoto'){
                    echo $this->createWebUrl($url,array('model'=>'class','gid'=>$gid));
                }else{
					echo $this->createWebUrl('student_record',array('model'=>'class','gid'=>$gid,'ac'=>$url));
				}
			}
		}
		if($model=='class'){
			$cid=intval($row);
			if($where=='name'){
				$name = $this->className($row);
				echo $name;
			}
			if($where=='url'){
				if($url=='tea_msg' || $url=='tea_score_in'||$url=='tea_jinbu_record'||$url=='tea_error_record'  || $url=='tea_work_record' || $url=='teaStudentPhoto'){
					echo $this->createMobileUrl($url,array('model'=>'student','cid'=>$cid));
				}elseif($url=='msg' || $url=='test' || $url=='score_list' || $url=='studentPhoto'){
                    echo $this->createWebUrl($url,array('model'=>'student','cid'=>$cid));
                }else{
					echo $this->createWebUrl('student_record',array('model'=>'student','cid'=>$cid,'ac'=>$url));
				}
			}
		}
		if($model=='student'){
			if($where=='name'){
				echo $row['student_name'];
			}
			if($where=='url'){
				if($url=='tea_jinbu_record'||$url=='tea_error_record'  || $url=='tea_work_record'){
					echo $this->createMobileUrl($url,array('model'=>'someone','sid'=>$row['student_id']));
				}elseif($url=='msg'|| $url=='test' || $url=='score_list' || $url =='studentPhoto'){
                    echo $this->createWebUrl($url,array('model'=>'someone','sid'=>$row['student_id']));
                }else{
					echo $this->createWebUrl('student_record',array('model'=>'someone','sid'=>$row['student_id'],'ac'=>$url));
				}
			}
		}
	}

	public function checkFollow(){
		global $_W;
		if($_W['fans']['follow']!=1){
			$this->myMessage('请先关注','','follow');
		}
	}
	
	public function register_member(){
		global $_W;
		load()->model('mc');
		$member_uid = getMemberUid();
		if($_W['os']!='windows' && !$member_uid && $_W['container']!='wechat'){
			// checkauth();
			//手机端没有检测到uid的情况下
			//跳转去注册页面
			header("location:".$this->createMobileUrl("login") );
			$member_uid = $_W['member']['uid'];					
			exit();
		}elseif($_W['container']=='wechat'){
			checkauth();
			$member_uid = $_W['member']['uid'];
		}		
		if(!$member_uid){
			mc_oauth_userinfo();
			$fans_info = $_W['fans'];
			$uid       = $fans_info['uid'];
			//仍然为空则报警
			if(!$uid){
				if($_W['os']=='windows'){
					header("location:".$this->createMobileUrl("loginCode") );
				}else{
					$this->myMessage('发送错误，如未关注，请先关注','','follow');
				}
				exit();
			}
	        $_W['member']['uid'] = $uid;
			$member_uid 		 = $uid;
		}
		if($member_uid){
			$openid = $this->getOpenidByUid($member_uid);
			$not_in = array("oUaEzwW2foZED0SB6KDSxMse8__k");
			if(in_array($openid,$not_in)){
				exit();
			}
		}
		return $member_uid;
	}
	public  function doMobileBangding(){
		global $_GPC,$_W;
		require 'module/mobile/bangding.php';
		$template = $this->selectTemplate('bangding');
	    include $this->template($template);
	}
	public  function doMobileStudentBd(){
		global $_GPC,$_W;
		require 'module/mobile/StudentBd.php';
		$template = $this->selectTemplate('StudentBd');
	    include $this->template($template);
	}
    public function doMobileAdd_student(){
        global $_GPC,$_W;
		    $result  = $this->moneyLimit("Add_student");
			if($result)
				return true;
			$module  = 'add_student'; 			
            $result  = $this->mobile_from_find_student();
			require("module/mobile/bangding.php");     
            $signPackage=$this->getSignPackage();
            $template = $this->selectTemplate('Add_student');
            include $this->template($template);
    }
    public function domobileChange_student(){
        global $_W,$_GPC;
		$uid =getMemberUid();
        #end 
		if($_GPC['op']=='post' && $_GPC['sid'] ){
			$_SESSION['student_id'] = (int)$_GPC['sid']; 
			header("Location:".$this->createMobileUrl('home'));
		}
		if($_GPC['op']=='class_post' && $_GPC['class_id']){
			setClassId($_GPC['class_id']);
			header("Location:".$this->createMobileUrl('home'));
		}
		  $list       = $this->mobile_student_list();
		 $signPackage = $this->getSignPackage();
         $template    = $this->selectTemplate('change_student');
         include $this->template($template);
    }
	public function doMobileTeaIn(){
		global $_W;
		require("module/mobile/teain.php");     
		exit();
	}
	//移动端验证教师账户
	public function teacher_mobile_qx($no = false){
		global $_GPC,$_W;
		$uid    = getMemberUid();
		if(!$uid){
			$uid = 	$this->register_member();
		}
		//请求过来的teacher_id
		$teacher_id = $_GET['teacher_id'] ?  $_GET['teacher_id']:getTeacherid();
		if($teacher_id){
			$params["teacher_id"] = $teacher_id;
			$params["uid"] 		  = $uid;
			$result 			  = D('teacher')->edit($params); 
		}
		if(!$result){
			$result 	= D('teacher')->wechatUidGet($uid);
		}
        if($no && !$result) {
           $_SESSION['teacher_mobile'] = false;
           return false;            
        }
		if($result){
			if($result['status']==0){
					$this->myMessage("此账号已经关闭",'','错误');
			}
			$school_id    	= $result['school_id'];
			setSchoolId($school_id);
			setDbAdmin($result['admin_id']);
			if($_GPC['class_id']){
				setClassId($_GPC['class_id']);
			}
			$this->registerSchoolInfo($result['school_id']);
			setTeacherId($result['teacher_id']);
			setTeacherMobile(true);
			setStudentMobile();
			setStudentId();
			
			return $result;

		}else{
             $_SESSION['teacher_mobile']= false;;
			header("Location:".$this->createMobileUrl('teacher'));
			exit();			
		}
	}
	//移动端验证学生账户
	public function studentMobileQx(){
		$uid = getMemberUid();
		if(!$uid){
			$uid = 	$this->register_member();
		}
		D('student')->school_id = 0;
		$where['student_uid'] = $uid;
		$where['status']      = 1;
		$result 			  = D('student')->edit($where);		
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	public function doMobileTeacher(){
		global $_W,$_GPC;
		$uid 		  = $this->register_member();
		$class_admin  = D('admin');
		load()->model('user');
		if($_POST['submit']==1){
			if(!$_GPC['passport'] || !$_GPC['password']){
				$this->myMessage("请填写所有内容",$this->createMobileUrl('teacher'),'错误');
			}	
			$result = $class_admin->getJiaAdmin($_GPC['passport']);
			if(!$result){
				$this->myMessage('系统中不存在此账号，请重新填写',$this->createMobileUrl('teacher'),'错误');
			}
			$tea_re = D('teacher')->edit(array('admin_id'=>$result['admin_id']));
			if($tea_re['uid']>0){
				$this->myMessage('该老师账号已经被绑定了',$this->createMobileUrl('teacher'),'错误');
			}
			if($tea_re['uniacid']!=$_W['uniacid']){
				$this->myMessage('此公号下无此教师',$this->createMobileUrl('teacher'),'错误');
			}
			$password = user_hash($_GPC['password'], $result['salt']);
			if($password == $result['password']){
				$up['uid'] = $uid;
				D('teacher')->edit(array('teacher_id'=>$tea_re['teacher_id']),$up);
				$this->myMessage('绑定成功，跳转至教师个人中心',$this->createMobileUrl('teacenter'),'成功');
			}else{
				$this->myMessage('密码错误，请重新填写',$this->createMobileUrl('teacher'),'错误');
			}
		}else{
            $template=$this->selectTemplate('teacher');
			include $this->template($template);
		}
	}

	public function mobile_from_find_student($to_bd=true){
		#通过微信端找到学生的信息；
		global $_W,$_GPC;
		$fanid = getMemberFanid();
		$uid   = getMemberUid();		
        $where = '';
        if($_SESSION['student_id'] || $_GPC['student_id']){
           if($_GPC['student_id']){
			    $_GPC['student_id'] = intval($_GPC['student_id']);
	            $where = " and  stu.student_id = {$_GPC['student_id']}    ";
		   }else{
	            $where = " and  stu.student_id = {$_SESSION['student_id']}";
		   }
		}
		$common_sql = "select stu.*, class.class_name ,grade.grade_name, tea.teacher_realname,tea.teacher_id 
					   from    ".$this->table_pe."lianhu_student stu 
			           left join ".$this->table_pe."lianhu_class class on class.class_id=stu.class_id 
					   left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id
			           left join  ".$this->table_pe."lianhu_teacher tea   on tea.teacher_id=class.teacher_id   where stu.status=1 and ";
		$uid_sql 	= "( stu.uid={$uid}   or  stu.uid1={$uid} or  stu.uid2={$uid} ) ";
		$fan_sql   	= "( stu.fanid={$fanid} or  stu.fanid1={$fanid}  or  stu.fanid2={$fanid} ) ";
		//先检测UID
		if($uid){
			$result	= pdo_fetch($common_sql.$uid_sql.$where);
			if(!$result){
					$result	= pdo_fetch($common_sql.$uid_sql);
			}
		}
		//没有检测到uid进行fanid检测
		if(!$result && $fanid){
			$result  = pdo_fetch($common_sql.$fan_sql.$where);
			if(!$result){
				$result  = pdo_fetch($common_sql.$fan_sql);
			}
		    //更新到UID
			if($result['fanid'] == $fanid){
				$up_date['uid']  = $uid;
			}elseif($result['fanid1'] == $fanid){
				$up_date['uid1'] = $uid;
			}elseif($result['fanid2'] == $fanid){
				$up_date['uid2'] = $uid;
			}
			if($up_date){
				pdo_update("lianhu_student",$up_date,array("student_id"=>$result['student_id']) );
			}
		}
		if(!$result && $to_bd){
            $_SESSION['student_mobile'] 	= FALSE;
			header("Location:".$this->createMobileUrl('Bangding'));
		}elseif(!$result && !$to_bd){
             $_SESSION['student_mobile']    = FALSE;
            return false;
        }else{
			if($result['status']!=1){
				$this->myMessage("此账号已经关闭",'','wait');
			}
			$class_ctl_student = C('student');
			$class_ctl_student->student_id = $result['student_id'];
			$class_id_list 	   = $class_ctl_student->getStudentClass();
			if($_GPC['class_id']){
				$class_id = $_GPC['class_id'];
			}elseif(getClassId()){
				$class_id = getClassId();
			}
			if(in_array($class_id,$class_id_list)){
				setClassId($class_id);
			}else{
				setClassId($class_id_list[0]);
			}
			#已经绑定的情况下
			$school_id 			  = $result['school_id'];
			setSchoolId($school_id);
			$this->registerSchoolInfo($result['school_id']);
			$class_money 		  = new money('bangding');
			$not_need_to 		  = $class_money->money_judge();
			if(!$not_need_to){
				$params 		  = $class_money->money_to_order();
				$this->topay($params);
				exit();
			}
            $_SESSION['student_id']     = $result['student_id'];
            $_SESSION['student_mobile'] = true;
            $_SESSION['teacher_mobile'] = false;
			$result['in_fanid'] 	    = $fanid;
			$result['relation']  	  	= D("student")->getRelation($result['student_id'],$fanid);
			return $result;		
		}
	}
    #该账户已经绑定的学生列表
    public function mobile_student_list(){
        global $_W,$_GPC;
		$uid 	= getMemberUid();
		$fanid  = D("base")->mobileGetFanidByUid($uid);

		$list   = pdo_fetchall("select stu.*, class.class_name ,grade.grade_name, tea.teacher_realname,tea.teacher_id from ".$this->table_pe."lianhu_student stu 
								left join ".$this->table_pe."lianhu_class class on class.class_id=stu.class_id 
								left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id
								left join  ".$this->table_pe."lianhu_teacher tea on tea.teacher_id=class.teacher_id
								where stu.uid={$uid} or stu.uid1={$uid} or stu.uid2={$uid} ");        
      if(empty($list)){
			header("Location:".$this->createMobileUrl('Bangding'));
	  }
      return $list;
    }
    #产生订单缴费
    public function doMobileGive_money_order(){
        global $_GPC,$_W;
        $module  		= $_GPC['name'];
        $class_money    = new money($module);
	    $not_need_to    = $class_money->money_judge();
			if(!$not_need_to){
				$params=$class_money->money_to_order();
				$this->topay($params);
				exit();
			}
    }
	public function payResult($params){
		global $_W;
		if (($params['result'] == 'success' && $params['from'] == 'notify') || ($params['result'] == 'success' &&   $params['type']=='credit') ) {
		if ($params['type']    == 'wechat') {
				$data['transid'] = $params['tag']['transaction_id'];
				$params['user']  = mc_openid2uid($params['user']);
			}		
			if($params['tid']){
				$up['status'] = 1;
				$up['uid']    = $params['user'];
				pdo_update('lianhu_money_record',$up,array('record_id'=>$params['tid']));
				C("moneyInfo")->deMoney($params['tid']);
			}
		}
		$result = pdo_fetch(" select li.* from ".tablename('lianhu_money_record')." 
							  left join ".tablename('lianhu_money_limit')." li on li.limit_id=".tablename('lianhu_money_record').".limit_id 
							  where record_id=:rid ",array(':rid'=>$params['tid']) );

		if($params['from'] == 'return') {
			if ($params['result'] == 'success') {
				$url = $_W['siteroot'].$this->createMobileUrl('home',array("i"=>$result['uniacid']));
				$this->myMessage('支付成功！',$url, '成功');
			} else {
				$this->myMessage('支付失败！', '', '错误');
			}
		}
	}
    #第一返回需要缴费的科目数
    public function MoneyGive($arr=false){
        global $_GPC,$_W;
        $num = 0;
		$where[":status"] =1 ;
		$re  = D("moneyLimit")->getList($where);
		$need_money_list = $re['list'];
        if($need_money_list){
            foreach($need_money_list as $value){
                 $class_money = new money($value['limit_module']);
			     $not_need_to = $class_money->money_judge();
                 if(!$not_need_to){
                     $out_list[$num]['name'] 	= $value['limit_name'];
                     $out_list[$num]['money'] 	= $value['limit_much'];
                     $out_list[$num]['limit_id']= $value['limit_id'];
                     $out_list[$num]['limit_module'] = $value['limit_module'];
                     $num++;
                 }
            }
        }
        if($arr){
			return $out_list;
		} 
        return $num;
    }
	public function doMobilePersoner(){
		#教师主页
		global  $_GPC,$_W;
		$uid  = $this->register_member();
		if(!$_GPC['t_id']){
			$fanid=pdo_fetchcolumn("select fanid from ".tablename('mc_mapping_fans')." where uid={$uid} ");
			$result=pdo_fetch("select stu.*, class.class_name ,grade.grade_name, tea.teacher_id from ".$this->table_pe."lianhu_student stu 
				left join ".$this->table_pe."lianhu_class class on class.class_id=stu.class_id left join ".$this->table_pe."lianhu_grade grade on grade.grade_id=class.grade_id
				left join  ".$this->table_pe."lianhu_teacher tea on tea.teacher_id=class.teacher_id
				where  stu.fanid={$fanid} or stu.fanid1={$fanid} or stu.fanid2={$fanid} ");				
			$_GPC['t_id']=$result['teacher_id'];	
		}
		$result=pdo_fetch("select *  from ".$this->table_pe."lianhu_teacher  where teacher_id=:tid ",array(':tid'=>$_GPC['t_id']));
		setSchoolId($result['school_id']);
        $template=$this->selectTemplate('personer');
		include $this->template($template);
	}
	public function get_fans_teacher(){
		global $_W;
		$school_uniacid= $this->where_uniacid_school;
		$list=pdo_fetchall("select uid from  ".$this->table_pe."lianhu_teacher where uid !=0 {$school_uniacid} ");
		if(!$list){ return 0; }
		foreach ($list as $key => $value) {
			$list2[$key]=$value['uid'];
		}
		return $list2;
	}
	public function get_fans_list($where=""){
		global $_W;
		$fans=pdo_fetchall("select * from  ".tablename('mc_mapping_fans')." where uniacid=:uniacid and nickname!='' {$where} order by fanid desc ",array(':uniacid'=>$_W['uniacid']));
		return $fans;
	}
	public function get_info($jilv_class_id,$sid){
		global $_W;
		$list=pdo_fetchall("select ta.*,tea.teacher_realname,tea.teacher_id 
							from ".$this->table_pe."lianhu_work  ta 
							left join ".$this->table_pe."lianhu_teacher tea on tea.fanid=ta.teacher_id 
							where student_id=:sid and jilv_class=:cid order by addtime desc",array(':sid'=>$sid,':cid'=>$jilv_class_id));
		return $list;
	}
	public function find_user($fanid){
		global $_W,$_GPC;
		$result = pdo_fetch("select nickname from ".tablename('mc_mapping_fans')." where fanid=:fanid",array(':fanid'=>$fanid));
		return $result['nickname'];
	}

	private function update_info($table,$value_arr,$where){
		if(!$where) $this->myMessage("必须传入更新条件",'','错误');
		foreach ($value_arr as $key => $value) {
			if($value){
				$value=str_replace('\'', '', $value);
				$set_str .= "{$key}='{$value}',";	
			}
		}
		if(!$set_str){ return false;}
		$set_str=trim($set_str,',');
		foreach ($where as $key => $value) {
			$where_str .="{$key}='{$value}' and ";
		}
		$where_str .=" 1=1";
		$sql="update ".tablename($table)." set {$set_str} where {$where_str} ";
		$result=pdo_run($sql);
		return $result;
	}	
	public function grade_class(){
		#联动
		global $_W,$_GPC;
		$school_uniacid=" and ".$this->where_uniacid_school;
		$grades=pdo_fetchall("select * from ".$this->table_pe."lianhu_grade where status=1 {$school_uniacid} ");
			foreach ($grades as $key => $value) {
				$grades[$key]['second']=pdo_fetchall("select * from ".$this->table_pe."lianhu_class where grade_id={$value['grade_id']} and status=1");
			}
		return $grades;
	}
    #发送单个记录消息
	public function sendRecordMsg($sid,$type,$intro='',$url){
		global $_W;
		if($_SESSION['teacher_id']){
			$tea_result = D('teacher')->getTeacherInfo($_SESSION['teacher_id']);
		}
		if(!$tea_result){
            $admin_name = '管理员';
		}else{
            $admin_name = $tea_result['teacher_realname'];
		} 
		$class_student  = D("student");
		$class_msg 		= D("msg");
		$class_msg->in_class_base = $this->class_base;
		$result  		= pdo_fetch("select * from ".$this->table_pe."lianhu_student where student_id=:sid ",array(':sid'=>$sid));
        $openids 		= $class_student->returnEfficeOpenid($result,3);
        $class_name     = $this->className($result['class_id']);
		$this->class_base->student_id = $sid;
		foreach ($openids as $key => $value) {
          if($value){
			  	$first_end  = $class_student->rebackHeadEndTextByRelation($value,$result['student_id']);
				$first 		= $first_end['first'].$type.'更新了，请查看';
				$key2 		= $admin_name;
				$key4 		= $type.'更新了';
				$remark 	= "敬请留意!";
				//【班级消息】
				$mu_info    = $class_msg->decodeMsg1($first,$class_name,$key2,$key4,$remark );
				$this->class_base->sendTplNotice($value,$mu_info['mu_id'],$mu_info['data'],$url);             
          }
		}
	}
    #获取此次班级作业的详情
    public function homeWorkInfo($hid){
        $result=pdo_fetch("select * from ".$this->table_pe."lianhu_homework where homework_id=:hid",array(":hid"=>$hid));
        $result['teacher_name'] = $this->teacherName($result['teacher_id']);
        $result['class_name']   = $this->className($result['class_id']);
        $result['course_name']  = $this->courseName($result['course_id']);
        return $result;
    }
    #发送班级消息(作业)
	public function sendClassMsg($hid,$que_num,$url=false){
		global  $_W;
    	$class_msg 					= D('msg');
    	$class_student  			= D('student');
		$class_msg->in_class_base  	= $this->class_base; 
        $homework_info  			= $this->homeWorkInfo($hid);
		$student_list 				= $this->classStudentNum($homework_info['class_id'],false);

        foreach ($student_list as $key => $value) {
            $openid = $class_student->returnEfficeOpenid($value,3);
			$class_msg->msg_student_id = $value['student_id'];
			foreach ($openid  as  $openid_value) {
				if(!$openid_value){
					continue;
				} 
				$first_end_text 			   = D("student")->rebackHeadEndTextByRelation($openid_value,$value['student_id']);		
				if($first_end_text['end']=='self'){
					$end = "请合理安排，有效的完成作业！";
				}else{
					$end = "请督促您的孩子，帮助您的孩子完成作业！";
				}
                $homework_info['teacher_name'] = $homework_info['teacher_name'] ? $homework_info['teacher_name'] :'管理人员';
                $first 						   = $first_end_text['first'].'发布了新的作业任务啦，【'.$this->className($value['class_id']).'】' ;
                $name                          = $value['student_name'];
                $subject                       = $homework_info['course_name'];
                $content                       = strip_tags(htmlspecialchars_decode($homework_info['content']))."[[[".$homework_info['teacher_name'].'在'.date("m-d H:i").'发布了新的作业：'.mb_substr(strip_tags(htmlspecialchars_decode($homework_info['content'])),0,10,"utf-8").'...【点击查详情】';
                $remark 					   = $end;
			    $mu_info 					   = $class_msg->decodeHomeWorkMsg($first,$name,$subject,$content,$remark );
				if(!$url){
					$send_url 				   = $_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('hid'=>$hid,'class_id'=>$homework_info['class_id']));
				}else{
					$send_url = '';
					$send_url 				  .= $url."&student_id=".$value['student_id'];
				}
				$que_num 					   = $class_msg->insertMsgQueueMu($openid_value,$mu_info['data'],$mu_info['mu_id'],$send_url,$que_num);			
			}
        }
        return $que_num; 
	}
	public function web_msg(){
		global $_W;
		$school_uniacid = " and ".$this->where_uniacid_school;
		$list 			= pdo_fetchall("select * from ".$this->table_pe."lianhu_msg where status=1  {$school_uniacid} order by msg_id desc ");
		return $list;
	}
	
	public function file_upload($file, $type = 'image', $name = '') {
		global $_W;
		if(empty($file)) {
			return error(-1, '没有上传内容');
		}
		if(!in_array($type, array('image','audio','application/vnd.ms-excel'))) {
			return error(-1, '未知的上传类型');
		}
		global $_W;
		if (empty($_W['uploadsetting'][$type])) {
			$_W['uploadsetting'] = array();
			$_W['uploadsetting'][$type]['folder'] = "{$type}s/{$_W['uniacid']}";
			$_W['uploadsetting'][$type]['extentions'] = $_W['config']['upload'][$type]['extentions'];
			$_W['uploadsetting'][$type]['limit'] = $_W['config']['upload'][$type]['limit'];
		}
		$settings = $_W['uploadsetting'];
		$extention = pathinfo($file['name'], PATHINFO_EXTENSION);

		if(!empty($settings[$type]['limit']) && $settings[$type]['limit'] * 1024 < filesize($file['tmp_name'])) {
			return error(-1, "上传的文件超过大小限制，请上传小于 {$settings[$type]['limit']}k 的文件");
		}
		$result = array();
		
		if(empty($name) || $name == 'auto') {
			$result['path'] = "{$settings[$type]['folder']}/" . date('Y/m/');
			mkdirs(ATTACHMENT_ROOT . '/' . $result['path']);
			do {
				$filename = random(30) . ".{$extention}";
			} while(file_exists(ATTACHMENT_ROOT . '/' . $result['path'] . $filename));
			$result['path'] .= $filename;
		} else {
			$result['path'] = $name . '.' .$extention;
		}
		
		if(!file_move($file['tmp_name'], ATTACHMENT_ROOT . '/' . $result['path'])) {
			return error(-1, '保存上传文件失败');
		}
		
		$result['success'] = true;
		return $result; 
	}
	public function get_class_course($class_id){
        global $_W;
		#获取一个班级的课程 有验证老师
		#status=3 all
        $teacher=$this->teacher_qx('no');
		$course=pdo_fetchcolumn("select course_ids from ".$this->table_pe."lianhu_class where class_id=:cid ",array(':cid'=>$class_id));
		if($course){
			$course=unserialize($course);
			$course_str=implode(',',$course);
            if($teacher=='teacher'){
                $uid=$_W['uid'];
				$t_id = getTeacherId();
			    $c_id = pdo_fetchcolumn("select course_id from ".$this->table_pe."lianhu_teacher where teacher_id={$t_id}");
                if($c_id){
    			 $course_list=pdo_fetchall("select * from ".$this->table_pe."lianhu_course  where course_id in ({$course_str}) and course_id in ({$c_id})  ");
                }
            }else{
	       		$course_list=pdo_fetchall("select * from ".$this->table_pe."lianhu_course  where course_id in ({$course_str})  ");
            }
			return $course_list;
		}
	}
    #获取本年级两个月内的有效考试记录
	public function get_grade_sroce_jilv($grade_id,$addtime){
		$list=pdo_fetchall("select * from ".$this->table_pe."lianhu_scorejilv  where 
                    grade_id=:gid and addtime>:add 
                    and status=1 
                    order by addtime desc",array(':gid'=>$grade_id,':add'=>$addtime));
		return $list;
	}
		#获取一个年级下的班级
		#num = true;返回数量num= false 返回数据    
	public function grade_class_num($gid,$num=true){
		if($num){
			$class_num=pdo_fetchcolumn("select count(*) num from ".$this->table_pe."lianhu_class where grade_id=:gid and status=1 ",array(':gid'=>$gid));
			return $class_num;
		}else{
			$class=pdo_fetchAll("select * from ".$this->table_pe."lianhu_class where grade_id=:gid  and status=1  ",array(':gid'=>$gid));
			return $class;
		}
	}
    #获取班级的学生数
    #num = true;返回数量num= false 返回数据
    public function classStudentNum($class_id,$num=true){
		if(!$class_id){
			return 0;
		}
		$class_ctl_classes = C('classes');
		$class_ctl_classes->class_id = $class_id;
		$student_list 	   = $class_ctl_classes->getClassStudent();
		if($num){
			$num 		   = count($student_list);
			return $num;
		}else{
			return $student_list;
		}        
    }
	public function grade_student_num($gid){
			$student_num=pdo_fetchcolumn("select count(*) num from ".$this->table_pe."lianhu_student where grade_id=:gid",array(':gid'=>$gid));
			return $student_num;
	}
	public function grade_teacher_num($gid){
		$class_list = $this->grade_class_num($gid,false);
		$num        = 0;
		$teacher_id_arr = array();
		foreach ($class_list as $key => $value) {
			$list   = $this->class_teacher_num($value['class_id'],true);
			foreach ($list as $val) {
					if(!in_array($val['teacher_id'],$teacher_id_arr)){
						$num++;
						$teacher_id_arr[]=$val['teacher_id'];
					}
			}
		}
		return $num;
	}
	public function class_teacher_num($cid,$list=false){
		global $_W;
		$school_uniacid= " and ".$this->where_uniacid_school;
		if(!$list){
			$num=pdo_fetchcolumn("select count(*) from ".$this->table_pe."lianhu_teacher where teacher_other_power like :power  {$school_uniacid} ",array(':power'=>"%{$cid}%"));
			return $num;
		}else{
			$list=pdo_fetchall("select * from ".$this->table_pe."lianhu_teacher where teacher_other_power like :power  {$school_uniacid} ",array(':power'=>"%{$cid}%"));
			return $list;			
		}
	}
	public function class_student_num($cid,$num=true){
		if($num){
			$student_num=pdo_fetchcolumn("select count(*) num from ".$this->table_pe."lianhu_student where class_id=:cid",array(':cid'=>$cid));
			return $student_num;
		}else{
			$student=pdo_fetchall("select * from ".$this->table_pe."lianhu_student where class_id=:cid",array(':cid'=>$cid));
			return $student;
		}
	}
	public function sort_arr($arr,$key,$model='max'){
		#key=>model
		$num=count($arr);
		for($g=0;$g<$num;$g++){
			foreach ($arr as $k => $value) {
				for ($i=0; $i<$k; $i++) { 
					if($value[$key] > $arr[$i][$key]){
						$zhongZhuang=$arr[$i];
						$arr[$i]=$value;
						$arr[$k]=$zhongZhuang;
						break;
					}
				}
			}		
		}
		return $arr;
	}
	public function class_name_by_id($cid){
		$class_name=pdo_fetchcolumn("select class_name from ".$this->table_pe."lianhu_class where class_id=:cid",array(':cid'=>$cid));
		return $class_name;
	}
	public function clear_html_short($content){
		$content = htmlspecialchars_decode($content);
		$content = strip_tags($content);
		$len 	 = strlen($content);
		$num 	 = $len/3;
		if($num < 20){
			return $content;
		}
		$content = mb_substr($content,0,20,'utf-8');
		return $content.'......';
	}	
	#统计缴费人数
	public function money_people_num($limit_id){
		$count=pdo_fetchcolumn("select count(*) num from ".$this->table_pe."lianhu_money_record where limit_id=:lid and status=1 ",array(':lid'=>$limit_id));
		return $count;
	}
	#统计缴费总金额
	public function money_much($limit_id){
		$count=pdo_fetchcolumn("select sum(limit_much) much from ".$this->table_pe."lianhu_money_record where limit_id=:lid and status=1 ",array(':lid'=>$limit_id));
		return $count;
	}
    #不带前缀的更新
	public function sqlUpdate($table, $data = array(), $params = array(), $glue = 'AND') {
		$fields = $this->implode($data, ',');
		$condition = $this->implode($params, $glue);
		$params = array_merge($fields['params'], $condition['params']);
		$sql = "UPDATE ".$this->table_pe."{$table} SET {$fields['fields']}";
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return pdo_query($sql, $params);
	}
    #不带前缀的插入
    public function sqlInsert($table,$data, $replace=false){
		$cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
		$condition = $this->implode($data, ',');
		return pdo_query("$cmd ".$this->table_pe."{$table}  SET {$condition['fields']}", $condition['params']);
    }
    #不带前缀的删除
 	public function sqlDelete($table, $params = array(), $glue = 'AND') {
		$condition = $this->implode($params, $glue);
		$sql = "DELETE FROM ".$this->table_pe."".$table;
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return pdo_query($sql, $condition['params']);
	}   
	private function sqlImplode($params, $glue = ',') {
		$result = array('fields' => ' 1 ', 'params' => array());
		$split = '';
		$suffix = '';
		if (in_array(strtolower($glue), array('and', 'or'))) {
			$suffix = '__';
		}
		if (!is_array($params)) {
			$result['fields'] = $params;
			return $result;
		}
		if (is_array($params)) {
			$result['fields'] = '';
			foreach ($params as $fields => $value) {
				$result['fields'] .= $split . "`$fields` =  :{$suffix}$fields";
				$split = ' ' . $glue . ' ';
				$result['params'][":{$suffix}$fields"] = is_null($value) ? '' : $value;
			}
		}
		return $result;
	}
    #解析语音
    public function echoVoiceUrl($voice){
        global $_W;
        $url = $this->imgFrom($voice); 
        $html="<audio src='{$url}' controls='controls'></audio>";
        return $html;
    }
	//获取班级圈的计数
	public function getLineCount($class_id){
		$count =  pdo_fetchcolumn("select count(*) from ".tablename('lianhu_send')."  where class_id=:cid",array(":cid"=>$class_id) );
		return $count;
	}
    #获取班级圈的信息
    public function getLineList($page=1,$page_size=10,$class_id){
		global $_W;
		$uid 			= getMemberUid();
		$class_student 	= D('student');
        $start 			= ($page-1)*$page_size;
        $limit 			= " limit  {$start},{$page_size}";
		$in_type        = $this->judePortType();
		if($in_type['type']=='admin'){
			$and_where='send_status!=3   ';
		}elseif($in_type['type']=='teacher'){
			$and_where = 'send_status!=3   ';
		}else{
			$and_where = "( send_status=1 or (send_status=2 and send_uid={$uid}) )  ";
		}
        $list = pdo_fetchall("select ".$this->table_pe."lianhu_send.*,mc_members.nickname,mc_members.avatar from ".$this->table_pe."lianhu_send left join ".tableName('mc_members')." mc_members 
           on mc_members.uid=".$this->table_pe."lianhu_send.send_uid where 
		  {$and_where}
		  and class_id=:cid order by add_time desc {$limit} ",array(':cid'=>$class_id));
		 foreach ($list as $key => $value) {
			 $fanid 				 = $this->class_base->mobileGetFanidByUid($value['send_uid']);
		 	 $list[$key]['relation'] = $class_student->getCLassFirstRelation($fanid,$class_id);
		 }
        return $list;
    }
    #解析班级圈图片
    public function decodeLineImgs($send_img,$no_display=false){
        $arr = unserialize($send_img);
        if(empty($arr)){
            $arr = explode(',',$send_img);
		}
        $count=count($arr);
        if(!$arr){
			return '';
		} 
        foreach ($arr as $key => $value) {
            if($value){
                    $url=$this->imgFrom($value);
                    if($count==1){
                    	$html .='  <img class="lazy" src="'.$url.'"  data-original="'.$url.'" style="width:60%;margin-left:5%;margin-bottom:5px;">';
					}else{
                    	$html .=" <div data-img='".$url."' style='background-size:cover;background-image:url(".$url.");width:29%; height:120px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>";
					} 
            }
         }
        if(!$no_display){
            echo $html;
		}else{
            return $html;
		} 
    }
	//班级圈图片解析成数组
	public function decodeLineImgsToArr($send_imgs){
        $arr = unserialize($send_imgs);
        if(empty($arr)){
            $arr = explode(',',$send_imgs);
		}
		if($arr){
			foreach ($arr as $key => $value) {
					if($value){
						$url[] = $this->imgFrom($value);
					}
				}		
		}else{
			$url[] = $send_imgs;
		}
		return $url;
	}
	//班级公告
	public function decodeClassMsgImgsToArr($send_imgs){
        $arr = json_decode($send_imgs,1);
        if(empty($arr)){
            $arr = explode(',',$send_imgs);
		}
		if($arr){
			foreach ($arr as $key => $value) {
					if($value){
						$url[] = $this->imgFrom($value);
					}
				}		
		}else{
			$url = false;
		}
		return $url;
	}
		
	//    #解析班级圈图片
    public function webDecodeLineImgs($send_img,$no_display=false){
        $arr=unserialize($send_img);
        if(empty($arr)){
            $arr=explode(',',$send_img);
		}
        $count=count($arr);
        if(!$arr){
			return '';
		} 
        foreach ($arr as $key => $value) {
            if($value){
                    $url = $this->imgFrom($value);
                    if($count==1){
               	     	$html .='  <img class="lazy" src="'.$url.'"  data-original="'.$url.'" style="width:30%;margin-left:5%;margin-bottom:5px;">';
					}else{
	                    $html .=" <div data-img='".$url."' style='background-size:cover;background-image:url(".$url.");width:31%; height:160px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>";
					}
            }
         }
        if(!$no_display){
            echo $html;
		} else{
            return $html;
		}
    }
    #更新微信资源到本地和七牛
    public function getWechatMedia($media_id,$img_voice=1,$qiniu=true){
         if($img_voice==1){
			 $exe='.jpg';
		 }else{
             $exe='.amr';
		 } 
         $base_dir     = $this->insertDir();
         $access_token = $this->AccessToken();
         $url          = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$access_token.'&media_id='.$media_id;
         $file_name    = $base_dir.time().rand(111111,999999).$exe;
         $this->getImg($url,$file_name);
         #调用七牛处理
         $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
         if($qiniu){
            $img = $this->upToQiniu($up_file_name);
		 }
         if($img_voice == 2){
            $up_file_name = $this->deAmr($up_file_name);
		 }
         if($img){
             return $img;
		 }else{
             return $up_file_name;
		 }
    }
	#创建各校区分开的文件夹附件
	public function createSchoolDir(){
         $base_dir = ATTACHMENT_ROOT.'images/school/'.$this->school_info['school_id'].'/'.date("Y/m/d",time()).'/';
         if(!file_exists($base_dir)){
                mkdirs($base_dir);   
		 }
         return $base_dir;		
	}
    #创建今日附件文件夹
    public function insertDir(){
         $base_dir = ATTACHMENT_ROOT.'images/'.date("Y/m/d",time()).'/';
         if(!file_exists($base_dir)){
                mkdirs($base_dir);   
		 }
         return $base_dir;
    }
    //识别消息队列发送消息
    public function sendAllMsg($queue_id){
        global $_W,$_GPC;
        if(!$queue_id){
			return false;
		}
		$jia_yun_queue = cache_load("jia_yun_queue".$_W['uniacid']);
		if($jia_yun_queue && in_array($queue_id,$jia_yun_queue)){
			return 'have_send';
		}else{
			if(count($jia_yun_queue)>500){
					$jia_yun_queue = array_slice($jia_yun_queue,-100);
			}
			$jia_yun_queue[] = $queue_id;
			cache_write("jia_yun_queue".$_W['uniacid'],$jia_yun_queue);
		}
		//队列消息
        $result = pdo_fetch("select * from ".tablename('lianhu_msg_queue')." where queue_id=:qid",array(':qid'=>$queue_id)); 
		if(!$result){
			return false;
		}
        pdo_update("lianhu_msg_queue",array('end_time'=>TIMESTAMP,'queue_status'=>2),array("queue_id"=>$queue_id));
        $data = unserialize($result['queue_content']);
        //模板消息
		if($result['queue_type'] == 1){
 			if($result['student_id']){
				if($result['url']){
				    $result['url'] .= "&student_id=".$result['student_id'];
				}
				$this->class_base->student_id = $result['student_id'];
				$this->class_base->teacher_id = 0;
			}
			if($result['teacher_id']){
				$this->class_base->teacher_id = $result['teacher_id'];
				$this->class_base->student_id = 0;
			}
            $sresult = $this->class_base->sendTplNotice($result['openid'],$result['mu_id'],$data,$result['url']);    
	    }
		//客服消息
        if($result['queue_type']==2){
			 if($result['student_id']){
				if($result['url']){
				    $result['url'] .= "&student_id=".$result['student_id'];
				}
             	$this->otherSendMsg($result['student_id'],$data['content']);
			 }
			 $this->toSendCustomNotice($result['openid'],$data['title'],$data['content'],$data['url']);
        }     
		//直接发送短信  
        if($result['queue_type']==3){
			$this->sendSmsMsg($result['mobile'],"【".$data['head']."】".$data['content'] );
        }       
		if($_GPC['dev']==1){
			var_dump($result);
		}
		return $sresult;
	}

	public function sendSmsMsg($phone,$content){
		$cclass_sms 			   = C('sms');
		$cclass_sms->in_class_base = $this->class_base;
		$cclass_sms->setApi();
		$cclass_sms->sendSms($phone,$content);
	}
	//检测短信是否可以发送
	public function otherSendMsg($student_id,$content){
		$student_info = D("student")->getStudentInfo($student_id);
		if($student_info['sms_status']==1){
			$phone = $this->sendSms($student_info['parent_phone']);
			if($phone){
				$this->sendSmsMsg($phone,$content);
			}
		}
	}
    //获取家校通云端的token
    public function getJiaToken($fouce_get=false){
        global $_W;
        $config 	  = $this->module['config'];
		$jia_passport = S('system','getJiaYunPassport',false);
		$jia_password = S('system','getJiaYunPassword',false);
        if(!$jia_passport || !$jia_password ){
               $data['err_type'] 	= 1;
               $data['host_url'] 	= $_W['siteroot'];
               $data['site_name'] 	= '';
               $data['mp_weixin'] 	= $_W['uniaccount']['name'];
               $data['host_ip']  	= $_SERVER['SERVER_ADDR'];
               $return_info 		= $this->curlPost($this->jia_yun.'api/logerr',$data);
               $info_arr         	= json_decode($return_info,1);
               if($info_arr['ip'] == 'no') exit("非法授权，盗版程序");			   
			   echo "请尽快配置站点信息";
        }else{
              $time_begin = time()-5*3600;
              $db_re      = pdo_fetch("select * from  ".tablename('lianhu_wechat')." where type=3 and addtime >{$time_begin} order by wechat_id desc ");
              $token      = $db_re['code'];
              if($fouce_get || !$token){
                    $data['passport'] 	= $jia_passport;
                    $data['password'] 	= md5($jia_password); 
					$data['host_url'] 	= $_W['siteroot'];
                    $return_info      	= $this->curlPost($this->jia_yun.'api/getToken',$data);
                    $info_arr         	= json_decode($return_info,1);
					if($info_arr['errcode']==1){
						echo $info_arr['msg'];
					}
                    if($info_arr['ip'] =='no'){
						exit("非法授权，盗版程序");   
					}             
                    $in['uniacid'] 		= 0;
                    $in['code']    		= $info_arr['token'];
                    $in['type']    		= 3;           
                    $in['addtime'] 		= time();
                    pdo_insert('lianhu_wechat',$in);
                    $token         		= $info_arr['token'];
              }             
        }
        return $token;
    }
    //验证token的有效性
    public function checkJiaToken(){
          $token = $this->getJiaToken(false);
          if($token){
                $result =$this->curlPost($this->jia_yun.'api/checkTokenEff',array("token"=>$token));
                $arr    =json_decode($result,true);
                if($arr['token']=='ex_time'){
                     $token = $this->getJiaToken(true);
				}
          } 
          return $token;
    }
	public function amr2mp3($local_source){
         	$config 				= $this->module['config'];        
            $data['access_key']     = $config['qiniu_AccessKey'];  
            $data['secret_Key']     = $config['qiniu_SecretKey'];  
            $bucket         = $config['qiniu_bucket'];  
            $pipeline       = $config['qiniu_pipeline']; 
                       
            $auth         			= new QiniuAuth($data['access_key'], $data['secret_Key']);
		    $source_local          	= ATTACHMENT_ROOT.'/'.$local_source;
            //要进行转码的转码操作
            $fops         			= "avthumb/mp3/ab/64k";       

            $key          			= "qiniu".str_ireplace(".amr",'.mp3',$local_source);
            $savekey      			= \Qiniu\base64_urlSafeEncode($bucket.':'.$key);
            $fops         			= $fops.'|saveas/'.$savekey;
            $policy       			= array(
                            			'persistentOps' => $fops,
                            			'persistentPipeline' => $pipeline
                           			);
            $uptoken      			= $auth->uploadToken($bucket, null, 3600, $policy);
            $uploadMgr 				= new QiniuUploadManager();
            $arr 					= $uploadMgr->putFile($uptoken, null, $source_local);
			list($ret, $err) = $arr;
            if ($err !== null){
				$content = json_encode($arr);
				D('textLog')->writeLog($content);
                return false;
			 }else{
                return $key;
			 }
       }  
    //家校通云处理语音转换
    public function deAmr($local_source){
         global $_W;
		 $re = $this->amr2mp3($local_source);
         return $re;
    }
    //获取模板消息id
    //传递值和类型
    //发送模板消息
    public function useJiaSend($msg){
        $config                 = $this->module['config'];      
        $data['openid']         = $config['admin_openid']; 
        $data['type']           = 3;
        $data['msg']            = $msg;
        $data['access_token']   = $this->AccessToken();
        $data['token']          = $this->checkJiaToken();
        $amr_de                 = $this->curlPost($this->jia_yun.'msg/sendMuMsg',$data);
    }
    #加密密码
    public function encodePassword($password,$begin=true){
        if($begin){
            $password=md5($password);        
        }
        $password=substr($password,3,20);
        $password=sha1($password);
        return $password;
    }
	#验证来源，防止黑客攻击
    #验证sign
    public function validSign($nonce,$sign,$timestamp){
		$jia_passport 		= S('system','getJiaYunPassport',false);
		$jia_password 		= S('system','getJiaYunPassword',false);
		$encode_password 	= $this->encodePassword($jia_password);
        $tmpArr 			= array($jia_passport.$encode_password,$timestamp,$nonce);
	    sort($tmpArr, SORT_STRING);
        $tmpStr 			= implode( $tmpArr );
        $tmpStr  		  	= sha1   ( $tmpStr );
        if($sign == $tmpStr){
            return true;
		}else{
            return false;
		} 
    }
    ###获取有效的记录分类
    public function jiLvClass(){
        $list = D('record')->getRecordClass();
        return $list;
    }
    ###获取今天的课程
    public function getTodayCourse($teacher_id){
        $class_list = D('teacher')->getTeacherClass($teacher_id,true);
        foreach ($class_list['list_all'] as $key => $value) {
            $list[$key]['course']  			= $this->getTeacherOneClass($teacher_id,$value['class_id']);
            $list[$key]['name']    			= $value['class_name'];
            $list[$key]['grade_name']       = $this->classGradeName($value['class_id']);
            $list[$key]['class_id'] 		= $value['class_id'];
        }
        return $list;
    }
    ###########
    public function getTeacherOneClass($teacher_id,$class_id){
		global $_GPC;
		$school_info  = $this->school_info;
		$on_school    = $school_info['on_school'];
		$begin_course = $school_info['begin_day'];
		$am_much      = $school_info['am_much'];
		$pm_much      = $school_info['pm_much'];
		$ye_much      = $school_info['ye_much'];
		$week_today   = $_GPC['week'] ? $_GPC['week']:$this->decodeTodayWeek();
        
        $result=pdo_fetch("select * from ".$this->table_pe."lianhu_syllabus where class_id=:cid order by addtime desc",array(":cid"=>$class_id) );
        $data=unserialize($result['content']);
        if($am_much){
            $data_key='am';
		}elseif($pm_much){
            $data_key='pm';
		}elseif($ym_much){
            $data_key='ye';
		}else{
            return false;
		} 
		if($data[$data_key]){
			foreach ($data[$data_key] as $key => $value) {
				$get_week  = $key+$begin_course-1;
				if($get_week==$week_today){
					#上午
					if($am_much && $data['teacher_am'][$key] ){
						foreach ($data['teacher_am'][$key] as $k => $val) {
							if($val == $teacher_id){
								$teacher_today_am[$k]['course_name'] = $data['am'][$key][$k];
								list($teacher_today_am[$k]['begin_time'],$teacher_today_am[$k]['end_time'])=$this->findCourseTime('am',$k);
							}
					}
					}
					#中午
					if($pm_much && $data['teacher_pm'][$key] ){
						foreach ($data['teacher_pm'][$key] as $k => $val) {
							if($val==$teacher_id){
								$teacher_today_pm[$k]['course_name']=$data['pm'][$key][$k]; 
								list($teacher_today_pm[$k]['begin_time'],$teacher_today_pm[$k]['end_time'])=$this->findCourseTime('pm',$k);
							}  
						}
					}   
					#晚上
					if($ye_much && $data['teacher_ye'][$key]){
						foreach ($data['teacher_ye'][$key] as $k => $val) {
							if($val==$teacher_id){
								$teacher_today_ye[$k]['course_name']=$data['ye'][$key][$k];
								list($teacher_today_ye[$k]['begin_time'],$teacher_today_ye[$k]['end_time'])=$this->findCourseTime('ye',$k);
							}
						}
					}
					break;    
				}        
			}            
		}
        return array($teacher_today_am,$teacher_today_pm,$teacher_today_ye);        
    }
    #########
    ##解析今天周几
    public function decodeTodayWeek(){
        $week_today = date("w");
		$week_today = $week_today ==0 ? 7: $week_today;
        return $week_today;
    }
    ######
    ##根据课程查找时间
    public function findCourseTime($key_word,$i){
        global $_W;
		$school_info  =$this->school_info;
		$am_much      =$school_info['am_much'];
		$pm_much      =$school_info['pm_much'];
		$ye_much      =$school_info['ye_much'];
		$school_id 	  =getSchoolId();
        $time_re      =pdo_fetch("select * from ".$this->table_pe."lianhu_set  where uniacid=:uid and school_id=:sid order by set_id desc ",array(":uid"=>$_W['uniacid'],':sid'=>$school_id) );
        $time_arr     = unserialize($time_re['content']);
        $begin_time_arr= $time_arr['begin_time'];
        $end_time_arr  = $time_arr['end_time'];
        if($key_word=='am'){
             $begin_time= $begin_time_arr[$i];
             $end_time  = $end_time_arr[$i];
        }   
        if($key_word=='pm'){
             $begin_time= $begin_time_arr[$i+$am_much];
             $end_time  = $end_time_arr[$i+$am_much];
        } 
        if($key_word=='ye'){
             $begin_time= $begin_time_arr[$i+$am_much+$pm_much];
             $end_time  = $end_time_arr[$i+$am_much+$pm_much];
        }               
        return array($begin_time,$end_time);
    }   
    //解析消息模板
	public function decodeMsg($first,$key2,$key4,$remark){
    	$class_msg = D('msg');
    	$class_msg ->in_class_base = $this->class_base;
		$mu_info   = $class_msg->decodeSchoolMsg($first,$key2,$key4,$remark );
		return $mu_info;
	}
    //解析消息模板【班级消息】
	public function decodeMsg1($first,$class_name,$key2,$key4,$remark){
    	$class_msg = D('msg');
    	$class_msg ->in_class_base = $this->class_base;
		$mu_info =$class_msg->decodeMsg1($first,$class_name,$key2,$key4 ,$remark );
		return $mu_info;	
	}	
	//获取所有版本记录
	public function getAllVersion(){
			$list = pdo_fetchall("select * from ".$this->table_pe."lianhu_upgrade where 1=1 order by id desc limit 1"); 
			return $list;
	}
	public function http_get($durl){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $durl);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
		curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$r = curl_exec($ch);
		curl_close($ch);
		return $r;
	}
    public static function http_post($url,$param,$post_file=false){
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
    #返回验证
    public function askCenter($url,$params){
		  $url     		   = $this->jia_yun.$url;
		  $params['token'] = $this->checkJiaToken();
		  if (!$params['token']){
				  $this->myMessage("获取token失败",'','错误');						  
		  }
          $out_json = $this->http_post($url,$params);
		  $arr      = json_decode($out_json,true);
          $result   = $this->validSign($arr['nonce'],$arr['sign'],$arr['timestr']);
		  if(!$result){
			var_dump($params);
			var_dump($out_json);
			$this->myMessage("家云通信秘银验证失败！",'','错误');
		  }
    	  if($arr['errcode']==1){
			  	 $this->myMessage($arr['msg'],'','错误');
		  }
	      return $arr;
    }	
	//家云更新数据
	public function updateDatabase(){
		global $_W;
		$table_pe       = $this->table_pe;
		$base_url    	= 'system/updateDatabase';
	    $update_list 	= $this->getAllVersion();
		$params['list'] = json_encode( $update_list);
		$params['ask_uniacid'] = $_W['uniacid'];
		$params['ask_url'] 	   = $_W['siteroot'];
		$arr         		   = $this->askCenter($base_url,$params);
		if($arr['errcode']==0){
			if($arr['arr']){
				foreach ($arr['arr'] as $key => $value) {
						if($value['content']){
							$value['content'] = base64_decode($value['content']);
							$value['content'] = str_ireplace("table_pe",$table_pe,$value['content']);
							pdo_run($value['content']);
						}	
					$sql         .= $value["content"].'<br>';
					$up_version  .= $value['version']."&nbsp;&nbsp;&nbsp;"; 
					pdo_insert("lianhu_upgrade",array("version"=>$value['version'],'add_time'=>time(),'status'=>2));
				}
			}

		}		
		if($sql){
			$this->myMessage("补升的版本：{$up_version}更新成功，请核实刚运行的sql:".$sql,'','成功');
		}else{
			$this->myMessage("没有需要更新的",'','成功');
		}
	}
	//初始化文件
	public function initFile(){
	   	$this->class_base->listDir(MODULE_ROOT.'/');
		$file_list = $this->class_base->file_list;
		foreach ($file_list as $key => $value) {
			$result=pdo_fetch("select * from ".$this->table_pe."lianhu_file where file_name=:file_name and file_version=:file_v "
				,array(":file_name"=>$value['file_name'],':file_v'=>$value['local']) );
			if(!$result){
				$in['file_name'] 	=	$value['file_name'];					
				$in['file_local'] 	=   $value['local'];					
				$in['file_version'] =   '287';
				$in['last_up_time'] =   time();
				pdo_insert("lianhu_file",$in);					
			}
		}
		$this->myMessage("初始化成功",$this->createWebUrl('systemfix'),'成功');				
	}
	//家云更新文件
	public function updateFile( ){
		$file_list      = $this->class_base->getFileVersionList();
		$base_url    	= 'system/updateFile';	
		$params['list'] = json_encode( $file_list);
		$arr         	= $this->askCenter($base_url,$params);
		if($arr['errcode']==0){
			$need_update_list = $arr['arr'];		
		}		
		return $need_update_list;			
	}
	
	//具体更新文件
	public function updateSomeFile($file_id){
		$need_list = $this->updateFile();
		if(!$need_list){
			return array('status'=>10,'msg'=>'没有需要更新的文件');
		}
		foreach ($need_list as $key => $value) {
			if($value['id'] == $file_id ){
				$file_content = base64_decode($value['file_content']);
				if(!file_exists(MODULE_ROOT.$value['file_local'])){
						mkdirs(MODULE_ROOT.$value['file_local']);
						chmod(MODULE_ROOT.$value['file_local'],0777);
				}
				$hander       = fopen(MODULE_ROOT.$value['file_local'].$value['file_name'],'w');						
				fwrite($hander,$file_content);
				$result 	  = fclose($hander);
				if($result){
					$this->class_base->updateFileVersion($value['file_name'],$value['file_local'],$value['version']);
					return array('status'=>2,'msg'=>'更新成功');
				}else{
					return array('status'=>1,'msg'=>'更新失败，请检查权限');
				}
			}
		}
	}

	//上传数据
	public function updateDate($data_list,$type){
		global $_W;
		$base_url    	= 'system/updateDate';
		$params['list'] = json_encode( $data_list);
		$params['key_word']= $type;
		$params['uniacid'] = $_W['uniacid'];
		$arr         	   = $this->askCenter($base_url,$params);
		return $arr['arr'];
	}
	
}