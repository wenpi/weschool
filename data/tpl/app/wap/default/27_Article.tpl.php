<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = $class_info['class_name'].'新闻列表' ?>
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
<script>
        //加载图片
    function displayImage(id_name,img_current){
            var img_urls    = [];
            var img_current = img_current;
            var obj         = $("#"+id_name);
            if(obj.find('img').length>0){
                $.each(obj.find('img'),function(i,e){
                    img_urls.push($(this).attr('src'));
                });
            }
            if(obj.find('.wx_img_list').length>0){
                $.each(obj.find('.wx_img_list'),function(i,e){
                    img_urls.push($(this).attr('data-src'));
                });                
            }
            // img_urls.pop()
            wx.previewImage({
                current: img_current,
                urls: img_urls
            });
    }
    //首页显示切换学生

    function changeDisplay(id_name){
        obj = $("#"+id_name);
        if(obj.attr('data-dis')=='yes'){
            obj.hide();
            obj.attr('data-dis','no');
        }else{
            obj.show();
            obj.attr('data-dis','yes');
        }
    }
</script>
<body>
<div class="z_main">

    <?php  if(is_array($article_list)) { foreach($article_list as $row) { ?>
        <div class="tzz">
                <div class="top">
                    <div class="t-rq">
                        <p><?php  if($row['add_time']) { ?> <?php  echo date("m-d",$row['add_time'])?> <?php  } else { ?><?php  echo date("m-d",$row['addtime'])?><?php  } ?></p>
                    </div>
                        <div class="t-fb">
                            <p style="width: 100%;height: 50px;line-height:50px;font-size:36px;overflow: hidden;white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><?php  echo $row['article_title'];?></p>
                        </div>
                </div>
                    <div class="tz-nr">
                        <a href="<?php  echo $this->createMobileUrl("wapContent",array('aid'=>$row['list_id']));?>">
                            <p class="p"><?php  echo S('fun','formatLimitContent',array($row['article_intro'],50));?>...</p>
                        </a>
                    </div>
                         <?php  if($row['artice_img']) { ?>
                             <img src="<?php  echo $_W['attachurl'];?><?php  echo $row['artice_img'];?>" style="width: 90%;margin:2% 5%;">
                         <?php  } ?>
                    <div class="tz-mm"></div>
           </div>
    <?php  } } ?>
  </div>
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
