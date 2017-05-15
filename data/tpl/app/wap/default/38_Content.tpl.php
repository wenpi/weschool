<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = $title;?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />  
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>
<style>
	@charset "utf-8";
* {
	list-style: none;
	margin: 0;
	padding: 0px;
	text-decoration: none;
	-webkit-appearance: none;
}
 a,img,button,input,textarea{-webkit-tap-highlight-color:rgba(255,255,255,0);}
.tx-t{width:96%;margin-left:2%;border-bottom: 2px #e5e5e5 solid;}
.tx-t p1{width: 95%; float:left; font-size: 1.2rem; line-height: 2rem; color: #000000;margin-top: 10px;}
.tx-t p2{float: left;font-size:0.8rem; color: #999999;margin-top: 10px;}
.tx-m{margin:0 4%; margin-top: 10px;}
.z_main {
	overflow: hidden;
	margin: 0 auto;
	-webkit-appearance: none;
}
.caidan ul {
	width: 100%;
	bottom: 0px;
	z-index: 1;
	overflow: hidden;
	position: fixed;
	margin: 0 auto;
	background: #fafafa;
	border-top: 1px solid #e5e5e5;
}
.caidan ul li {
	text-align: center;
	width: 25%;
	float: left;
	margin-top: 5px;
}
.caidan ul li img {
	width:45%;
}


</style>
<body>
<div class="z_main" >
	<div class="tx-t">
		<p1><?php  echo $result['article_title'];?></p1>
	   <p2>发布时间：</p2><p2><?php  echo date("Y-m-d",$result['add_time'])?></p2>
	   <div style="clear:both"></div>
	</div>
	<div class="tx-m" id = 'html_content'>
        	<?php  echo htmlspecialchars_decode($result['article_content']);?>
	</div>
</div>
</body>
	<?php  $not_hidden='yes';?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
	<script>
		wx.ready(function () {
			wx.onMenuShareTimeline({
				title: '<?php  echo $school_info['school_name'];?>微官网', // 分享标题
				link: ' <?php  echo $_W['siteurl'];?> ', // 分享链接
				imgUrl: '<?php  echo $_W['attachurl'];?><?php  echo $img_list[0]['content'];?>', // 分享图标
				success: function () { 
					// 用户确认分享后执行的回调函数
				},
				cancel: function () { 
					// 用户取消分享后执行的回调函数
				}
			});
			wx.onMenuShareAppMessage({
				title: '<?php  echo $school_info['school_name'];?>微官网', // 分享标题
				desc: '<?php  echo S("system",'getSetContent',array('school_info_intro',$this->school_info['school_id']) )?>', // 分享描述
				link: '<?php  echo $_W['siteurl'];?>', // 分享链接
				imgUrl: '<?php  echo $_W['attachurl'];?><?php  echo $img_list[0]['content'];?>', // 分享图标
				type: 'link', // 分享类型,music、video或link，不填默认为link
				dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
				success: function () { 
					// 用户确认分享后执行的回调函数
				},
				cancel: function () { 
					// 用户取消分享后执行的回调函数
				}
			});			
		});
		wx.error(function(res){
			// config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
			// alert("js权限获取错误，请设置，或者刷新页面重试");    
		});
	</script>
</html>

