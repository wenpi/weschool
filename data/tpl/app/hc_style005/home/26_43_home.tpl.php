<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/snower.css?2014-10-22" media="all" />
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/color_pink.css" />
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/main.css" />
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/common.css" />
<link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/font-awesome.css" />
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/jQuery.js?2014-10-22"></script>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/maivl.js?2014-10-22"></script>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/jquery_min.js"></script>
<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/iscroll.js"></script>
		<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?> <?php  } ?><?php  if(!empty($_W['account']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } ?><?php  if(!empty($_W['page']['sitename'])) { ?> - <?php  echo $_W['page']['sitename'];?><?php  } ?></title>
		<meta name="keywords" content="<?php  if(empty($_W['page']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  } ?><?php  } else { ?><?php  echo $_W['page']['keywords'];?><?php  } ?>" />
		<meta name="description" content="<?php  if(empty($_W['page']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  } ?><?php  } else { ?><?php  echo $_W['page']['description'];?><?php  } ?>" />
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
        <!-- Mobile Devices Support @begin -->
            <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
            <meta content="telephone=no, address=no" name="format-detection">
            <meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <!-- Mobile Devices Support @end -->
            <link rel="stylesheet" type="text/css" href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/weimobfont.css" media="all" />

					 	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
				<?php  echo register_jssdk(false);?>
			<script type="text/javascript">
				wx.ready(function () {
					sharedata = {
						title: "<?php  if(!empty($_W['styles']['title'])) { ?><?php  echo $_W['styles']['title'];?><?php  } else { ?>我发现另一个超级棒的微站！<?php  } ?>",
						desc: "<?php  if(!empty($_W['styles']['desc'])) { ?><?php  echo $_W['styles']['desc'];?><?php  } else { ?>太棒了！有创意！好玩！<?php  } ?>",
						link: "",
						imgUrl: "<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/empty.png<?php  } ?>",
						success: function(){
								 window.location.href="<?php  if(!empty($_W['styles']['url'])) { ?><?php  echo $_W['styles']['url'];?><?php  } else { ?><?php  } ?>";
						},
						cancel: function(){
							// alert("分享失败，可能是网络问题，一会儿再试试？");
						}
					};
					wx.onMenuShareAppMessage(sharedata);
					wx.onMenuShareTimeline(sharedata);
				});

			</script>
    </head>
    <body onselectstart="return true;" ondragstart="return false;">
        	<!--有三个主题css  分别为  theme_orange.css  theme_blue.css  theme_purple.css-->
		<div data-role="container" class="body index">
			<div class="snower">

            <script type="text/javascript">var urls = ['<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/flash8.png']</script>
            <script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/snower1.js"></script>
        </div>				
			<div data-role="widget" data-widget="music" class="music music1 pos_left_top" >
				<a href="javascript:;" id="playbox" class="btn_music" ontouchstart="event.stopPropagation();"></a><audio id="audio" preload="preload" loop="" src="<?php  if(!empty($_W['styles']['mp3'])) { ?><?php  echo $_W['styles']['mp3'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/Kiss The Rain.mp3<?php  } ?>"></audio>
				<link href="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/music1.css" rel="stylesheet" />
				<script src="<?php  echo $_W['siteroot'];?>app/themes/hc_style005/hcc/player1_debug.js" ></script>
				<script>
					playbox.init("playbox");
				</script>
			</div>
					
			<header data-role="header">
				<!-- <img src="imgs/v87_index.png">			
				<div class="tmc"></div>		 -->
				<section id="scroll_pic_view" class="scroll_pic_view">
					<div id="scroll_pic_view_div">
						<ul id="scroll_pic_view_ul">
		<?php  $slides = app_slide(array('multiid'=>$multiid));?>
		<?php  if(is_array($slides)) { foreach($slides as $row) { ?>
							<li>
								<a onclick="return false;">
								<img src="<?php  echo $row['thumb'];?>" />
								</a>
							</li>
							<?php  } } ?>
						</ul>
						<div class="tmc"></div>
					</div>
					<div>
						<ol id="scroll_pic_nav" class="scroll_pic_nav">
							<script>
							 	(function(d, $){
							 		var scrollPicView = d.getElementById("scroll_pic_view"),
								 	scrollPicViewDiv = d.getElementById("scroll_pic_view_div"),
						            lis = scrollPicViewDiv.querySelectorAll("li"),
						            w = scrollPicView.offsetWidth,
						            len = lis.length;
						            for(var i=0; i<len; i++){
						            	lis[i].style.width = w+"px";
						            	if(i == len-1){
						            		scrollPicViewDiv.style.width = w * len + "px";
						            	}
						            }

						            var scroll_pic_view = new iScroll('scroll_pic_view', {
						            	snap: true,
						                momentum: false,
						                hScrollbar: false,
						                useTransition: true,
						                onScrollEnd: function() {
						                	$("#scroll_pic_nav li").removeClass("on").eq(this.currPageX).addClass("on");
						                }
						            });
						            //
								 	var nav_lis = new Array(lis.length);
								 	nav_lis[0] = '<li class="on"></li>';
								 	d.write(nav_lis.join('<li></li>') );
							 	})(document, $);
					        </script>
						</ol>
					</div>
				</section>
			</header>			
			<section data-role="body">
				<ul>
						<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'item' => 'row',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 43,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $row) { $i++; $row['iteration'] = $i; ?>
						<li>
							<a href="<?php  echo $row['url'];?>">
								<span>
			<?php  if(!empty($row['icon'])) { ?>
			<img src="<?php  echo $_W['attachurl'];?><?php  echo $row['icon'];?>" style='height:30px;width:30px;'/>	
			<?php  } else { ?>	
			<div class="list-item" style='height:26px;width:26px;font-size:26pxmargin-top:12px;'>
			<i class="fa <?php  echo $row['css']['icon']['icon'];?>" style="<?php  echo $row['css']['icon']['style'];?>;height:30px;width:30px;"></i>
			</div>
			<?php  } ?>									</span>
								<label><?php  echo $row['name'];?></label>
							</a>
						</li>
						<?php  } } ?>		
				</ul>
			</section>
			<footer data-role="footer">
		<div class="copyright" >
		<?php  if(empty($footer_off)) { ?>

			<div class="text-center footer" style="margin:10px 0; width:100%; text-align:center; word-break:break-all;">

				<?php  if(!empty($_W['page']['footer'])) { ?>

					<?php  echo $_W['page']['footer'];?>

				<?php  } ?>

				&nbsp;&nbsp;<?php  echo $_W['setting']['copyright']['statcode'];?>

			</div>

		<?php  } ?>
		
		</div>						
			</footer>
		</div>

<!--
导航菜单
   后台设置的快捷菜单
-->
							 <!-- 默认-->

	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/animate.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/common.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/app.css" rel="stylesheet">
	<link href="<?php  echo $_W['siteroot'];?>app/<?php  echo str_replace('./', '', url('utility/style'))?>" rel="stylesheet">
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script src="<?php  echo $_W['siteroot'];?>app/resource/js/require.js"></script>
	<script src="<?php  echo $_W['siteroot'];?>app/resource/js/app/config.js"></script>
	<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/resource/js/lib/jquery-1.11.1.min.js"></script>

		<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	<?php  define('HEADER', true);?>
	window.sysinfo = {
<?php  if(!empty($_W['uniacid'])) { ?>
		'uniacid': '<?php  echo $_W['uniacid'];?>',
<?php  } ?>
<?php  if(!empty($_W['acid'])) { ?>
		'acid': '<?php  echo $_W['acid'];?>',
<?php  } ?>
<?php  if(!empty($_W['openid'])) { ?>
		'openid': '<?php  echo $_W['openid'];?>',
<?php  } ?>
<?php  if(!empty($_W['uid'])) { ?>
		'uid': '<?php  echo $_W['uid'];?>',
<?php  } ?>
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
<?php  if(defined('MODULE_URL')) { ?>
		'MODULE_URL': '<?php echo MODULE_URL;?>',
<?php  } ?>
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'}
	};
	
	// jssdk config 对象
	jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || {};
	
	// 是否启用调试
	jssdkconfig.debug = false;
	
	jssdkconfig.jsApiList = [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage',
		'onMenuShareQQ',
		'onMenuShareWeibo',
		'hideMenuItems',
		'showMenuItems',
		'hideAllNonBaseMenuItem',
		'showAllNonBaseMenuItem',
		'translateVoice',
		'startRecord',
		'stopRecord',
		'onRecordEnd',
		'playVoice',
		'pauseVoice',
		'stopVoice',
		'uploadVoice',
		'downloadVoice',
		'chooseImage',
		'previewImage',
		'uploadImage',
		'downloadImage',
		'getNetworkType',
		'openLocation',
		'getLocation',
		'hideOptionMenu',
		'showOptionMenu',
		'closeWindow',
		'scanQRCode',
		'chooseWXPay',
		'openProductSpecificView',
		'addCard',
		'chooseCard',
		'openCard'
	];
	
	</script>
	
	<script>
	function _removeHTMLTag(str) {
		if(typeof str == 'string'){
			str = str.replace(/<script[^>]*?>[\s\S]*?<\/script>/g,'');
			str = str.replace(/<style[^>]*?>[\s\S]*?<\/style>/g,'');
			str = str.replace(/<\/?[^>]*>/g,'');
			str = str.replace(/\s+/g,'');
			str = str.replace(/&nbsp;/ig,'');
		}
		return str;
	}
	</script>
<!-- 默认-->
    	<link href="<?php  echo $_W['siteroot'];?>app/resource/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php  echo $_W['siteroot'];?>app/resource/css/app.css" rel="stylesheet">
		<?php  $site_quickmenu = modulefunc('site', 'site_quickmenu', array (
  'func' => 'site_quickmenu',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 43,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_quickmenu)) { $i=0; foreach($site_quickmenu as $i => $row) { $i++; $row['iteration'] = $i; ?><?php  } } ?>

		<script>require(['bootstrap']);</script>

	</div>

	<style>

		h5{color:#555;}

	</style>

<?php

	$_share['title'] = !empty($_share['title']) ? $_share['title'] : $_W['account']['name'];

	$_share['imgUrl'] = !empty($_share['imgUrl']) ? $_share['imgUrl'] : '';

	if(isset($_share['content'])){

		$_share['desc'] = $_share['content'];

		unset($_share['content']);

	}

	$_share['desc'] = !empty($_share['desc']) ? $_share['desc'] : '';

	$_share['desc'] = preg_replace('/\s/i', '', str_replace('	', '', cutstr(str_replace('&nbsp;', '', ihtmlspecialchars(strip_tags($_share['desc']))), 60)));

	if(empty($_share['link'])) {

		$_share['link'] = '';

		$query_string = $_SERVER['QUERY_STRING'];

		if(!empty($query_string)) {

			parse_str($query_string, $query_arr);

			$query_arr['u'] = $_W['member']['uid'];

			$query_string = http_build_query($query_arr);

			$_share['link'] = $_W['siteroot'].'app/index.php?'. $query_string;

		}

	}

?>

	<script type="text/javascript">

	

	wx.config(jssdkconfig);

	

	var $_share = <?php  echo json_encode($_share);?>;

	

	if(typeof sharedata == 'undefined'){

		sharedata = $_share;

	} else {

		sharedata['title'] = sharedata['title'] || $_share['title'];

		sharedata['desc'] = sharedata['desc'] || $_share['desc'];

		sharedata['link'] = sharedata['link'] || $_share['link'];

		sharedata['imgUrl'] = sharedata['imgUrl'] || $_share['imgUrl'];

	}



	function tomedia(src) {

		if(typeof src != 'string')

			return '';

		if(src.indexOf('http://') == 0 || src.indexOf('https://') == 0) {

			return src;

		} else if(src.indexOf('../addons') == 0 || src.indexOf('../attachment') == 0) {

			src=src.substr(3);

			return window.sysinfo.siteroot + src;

		} else if(src.indexOf('./resource') == 0) {

			src=src.substr(2);

			return window.sysinfo.siteroot + 'app/' + src;

		} else if(src.indexOf('images/') == 0) {

			return window.sysinfo.attachurl+ src;

		}

	}

	

	if(sharedata.imgUrl == ''){

		var _share_img = $('body img:eq(0)').attr("src");

		if(_share_img == ""){

			sharedata['imgUrl'] = window.sysinfo.attachurl + 'images/global/wechat_share.png';

		} else {

			sharedata['imgUrl'] = tomedia(_share_img);

		}

	}

	

	if(sharedata.desc == ''){

		var _share_content = _removeHTMLTag($('body').html());

		if(typeof _share_content == 'string'){

			sharedata.desc = _share_content.replace($_share['title'], '')

		}

	}

	

	wx.ready(function () {

		wx.onMenuShareAppMessage(sharedata);

		wx.onMenuShareTimeline(sharedata);

		wx.onMenuShareQQ(sharedata);

		wx.onMenuShareWeibo(sharedata);

	});

	<?php  if($controller == 'site' && $action == 'site') { ?>

		$('#category_show').click(function(){

			$('.head .order').toggleClass('hide');

			return false;

		});

		//文章点击和分享加积分

		<?php  if(!empty($_GPC['u'])) { ?>

			var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'click', 'u' => $_GPC['u']), true);?>";

			$.post(url, function(dat){});

		<?php  } ?>

		sharedata.success = function(){

			var url = "<?php  echo url('site/site/handsel/', array('id' => $detail['id'], 'action' => 'share'));?>";

			$.post(url, function(dat){});

		}

	<?php  } ?>

	</script>

	<script>

		$(function(){

			if($('.js-quickmenu')!=null && $('.js-quickmenu')!=''){

				var h = $('.js-quickmenu').height()+'px';

				$('body').css("padding-bottom",h);

			}else{

				$('body').css("padding-bottom", "0");

			}

		});

	</script>
				
			
<!--
分享前控制
-->

	</body>

<!-- weixin js sdk end -->
</html>


