<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '新闻分类'?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php  if($head_controller != 'no') { ?>
       <meta name="viewport" content="user-scalable=no"/>
    <?php  } ?>
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/wap/default/css/css.css">
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>
<body>
<div class="z_main">
  <?php  $class_list = C('articleClass')->getCLassList(false)?>
	<?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
		<div class="bb">
			<a href="javascript:;"><p><?php  echo $row['class_name'];?></p></a>
		</div>
		<ul class="bb-b">
			<?php  if(is_array($row['low'])) { foreach($row['low'] as $val) { ?>
				<a href="<?php  echo $this->createMobileUrl('wapArticle',array("cid"=>$val['class_id'])) ?>">
				<li class="bbb">
					<div style="background-image: url(<?php  echo $_W['attachurl'];?><?php  echo $val['class_img'];?>);width: 436px;height: 236px;" class="background_img">
					</div>
					<p><?php  echo $val['class_name'];?></p>
				</li>			
				</a>
			<?php  } } ?>
		</ul>	
		<div class="kk"></div>
	<?php  } } ?>
</body>
	<?php  $not_hidden='yes';?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
	<script>
		wx.ready(function () {
			wx.onMenuShareTimeline({
				title: '<?php  echo $school_info['school_name'];?>微官网', // 分享标题
				link: '<?php  if($school_info['host_url'] ) { ?><?php  echo $school_info['host_url'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('wapHome',array('school_id'=>$school_info['school_id']))?><?php  } ?>', // 分享链接
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
				link: '<?php  if($school_info['host_url'] ) { ?><?php  echo $school_info['host_url'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('wapHome',array('school_id'=>$school_info['school_id']))?><?php  } ?>', // 分享链接
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
