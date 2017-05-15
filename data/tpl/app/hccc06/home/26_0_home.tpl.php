<?php defined('IN_IA') or exit('Access Denied');?>﻿<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
<head>
<meta charset="utf-8">
<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?> <?php  } ?><?php  if(!empty($_W['account']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } ?><?php  if(!empty($_W['page']['sitename'])) { ?> - <?php  echo $_W['page']['sitename'];?><?php  } ?></title>
<meta name="keywords" content="<?php  if(empty($_W['page']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  } ?><?php  } else { ?><?php  echo $_W['page']['keywords'];?><?php  } ?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- banner -->
		<link href="<?php  echo $_W['siteroot'];?>app/themes/hccc06/banner/css/style.css" rel="stylesheet" type="text/css">
		<script src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/banner/js/jquery.js" language="javascript" type="text/javascript"></script>
		<script language="javascript" type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/banner/js/public.js"></script>
		<script type="text/javascript" src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/banner/js/jquery.SuperSlide.js"></script>

<!-- banner -->
<!--必填-->
<meta property="og:type" content="webpage" />
<meta property="og:url" content="zhuanti/hx2015xmtyx" />
<meta property="og:title" content="<?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?> <?php  } ?><?php  if(!empty($_W['account']['name'])) { ?><?php  echo $_W['account']['name'];?><?php  } ?><?php  if(!empty($_W['page']['sitename'])) { ?> - <?php  echo $_W['page']['sitename'];?><?php  } ?>" />
	<meta name="description" property="og:description" content="<?php  if(empty($_W['page']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  } ?><?php  } else { ?><?php  echo $_W['page']['description'];?><?php  } ?>" />
<!--选填-->
<meta property="og:image" content="<?php  echo $_W['siteroot'];?>app/themes/hccc06/static/img/21530e6f91e2d5fa6dedb14c8a06cac7.png" />
<meta name="weibo:webpage:create_at" content="" />
<meta name="weibo:webpage:update_at" content="" />
<link href="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/public/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/public//css/bootstrap-responsive.min.css">
<script src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/static/js/wb.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    var zt_id = '77';
    var uid = 0;
    var huxiu_hash_code = 'b2534378a0692b07cbb4aa25f148e986';
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/css/css.css?ver=201503111832">
</head>
				 	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
				<?php  echo register_jssdk(false);?>
			<script type="text/javascript">
				wx.ready(function () {
					sharedata = {
						title: "<?php  if(!empty($_W['styles']['title'])) { ?><?php  echo $_W['styles']['title'];?><?php  } else { ?>我发现另一个超级棒的微站！<?php  } ?>",
						desc: "<?php  if(!empty($_W['styles']['desc'])) { ?><?php  echo $_W['styles']['desc'];?><?php  } else { ?>太棒了！有创意！好玩！<?php  } ?>",
						link: "",
						imgUrl: "<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/themes/hc_style014/home/js/empty.png<?php  } ?>",
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
<script type="application/javascript">
   var is_mobile = 0</script>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar btn-collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="btn btn-buy-ticket" href="<?php  if(!empty($_W['styles']['url'])) { ?><?php  echo $_W['styles']['url'];?><?php  } else { ?><?php  } ?>">立即关注</a>
            <a class="brand" href="#"><img src="<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?>" alt="logo.png" /></a>
            <div class="nav-collapse collapse">
                <ul class="nav js-nav">
				
                    <li <?php  if('active') { ?>class="active"<?php  } ?> name="about_meetings"><a href="javascript:void(0);">首页</a></li>
					<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
                    <li class=""<?php  if('active') { ?>class="active"<?php  } ?> name="<?php  echo $nav['name'];?>" ><a href="javascript:void(0);"><?php  echo $nav['name'];?></a></li>
					<?php  } } ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<div  id="about_meetings">
			<div class="mBan2">
			<div id="slideBox" class="slideBox">
				<div class="hd">
					<ul>
			<?php  $slides = app_slide(array('multiid'=>$multiid));?>		
			<?php  if(is_array($slides)) { foreach($slides as $row) { ?>	
					<li></li>
			<?php  } } ?>	
					</ul>
				</div>
				<div class="bd">
					<ul>
							<?php  $slides = app_slide(array('multiid'=>$multiid));?>
							<?php  if(is_array($slides)) { foreach($slides as $row) { ?>
						<li>
						<a href="#">
						<img src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" />
						</a>
						</li>
							<?php  } } ?>	
					</ul>
				</div>
				
			</div>
			
			</div>
			<script language="javascript">
			jQuery(".slideBox").slide({mainCell:".bd ul",effect:"fold",autoPlay:true,trigger:"click"});
			</script>
</div>

		
		
            
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '1',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>

<!-- 企业简介 -->
<div class="section2 js-section" id="<?php  echo $nav['name'];?>">
    <div class="section w980">
        <h2 class="t-line"><span><?php  echo $nav['name'];?></span></h2>
        <ul class="summary">
		<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
		
		<?php  $result = modulefunc('home', 'site_article', array (
  'module' => 'home',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  '' => '',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
		<?php  if(empty($result['list'])) { ?>	还没添加文章哦，赶紧去添加<?php  } ?>	
		<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>

            <li><i class="icon-circle" style="top:25px;"></i>
		
				<?php  echo $row['content'];?>
		
			</li>
		<?php  } } ?>	
        </ul>
    </div>
</div>

<?php  } } ?>
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '2',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
<!-- 案例欣赏-->
<div class="section3  js-section"  id="<?php  echo $nav['name'];?>">
    <h2 class="t-bg-img"><span><?php  echo $nav['name'];?></span></h2>
    <p class="sub-title">（<?php  echo $nav['description'];?>）</p>
    <div class="w980">
        <ul class="guest-box">
		<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
		
		<?php  $result = modulefunc('home', 'site_article', array (
  'module' => 'home',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
		<?php  if(empty($result['list'])) { ?>	<span style="color:#fff;">还没添加文章哦，赶紧去添加</span><?php  } ?>
		<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
            <li>
                    <img class="g-bg" src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/image/bgHead.png" alt="<?php  echo $row['title'];?>" />
                    <img class="g-head" src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" />
                    <div class="g-name"><?php  echo $row['title'];?></div>
                    <div class="g-des"><?php  echo $row['description'];?></div>
				
            </li>
		<?php  } } ?>
		</ul>
        <div class="g-more">更多增加中，敬请期待！</div>
    </div>
</div>
<?php  } } ?>
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '3',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
<!-- 新闻资讯 -->
<div class="section4 w980  js-section clearfix"  id="<?php  echo $nav['name'];?>">
    <h2 class="t-line"><span><?php  echo $nav['name'];?></span></h2>
    <p class="sub-title">（<?php  echo $nav['description'];?>）</p>
    <ul class="vote-box voted-box js-vote-box clearfix" pollid="15">
		<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
		
		<?php  $result = modulefunc('home', 'site_article', array (
  'module' => 'home',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
		<?php  if(empty($result['list'])) { ?>	还没添加文章哦，赶紧去添加<?php  } ?>	
		<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
    <li class="js-item-vote " tid="1475" id="vote_item_1475" url="">
                <a class="v-case-img  js-rater-vote" href="javascript:void(0);">
					<img src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" />
				</a>
                <a class="v-case-t js-rater-vote js-rater-title" href="javascript:void(0);"><?php  echo cutstr($row['title'],39,1);?></a>
                <div class="v-btn-box"></div>
                <div class="js-box-left hidden">

				 <?php  echo $row['content'];?>
				</div>
    </li>
		<?php  } } ?>
	</ul>
</div>
<?php  } } ?>
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '4',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
<!-- 微信功能 -->
<div class="section5  js-section clearfix" id="<?php  echo $nav['name'];?>">
    <h2 class="t-bg-img"><span><?php  echo $nav['name'];?></span></h2>
    <p class="sub-title">（<?php  echo $nav['description'];?>）</p>
    <div class="w980">
        <ul class="rater-box">
		
       
		<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
		
		<?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
		<?php  if(empty($result['list'])) { ?>	<span style="color:#fff;">还没添加文章哦，赶紧去添加</span><?php  } ?>
		<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
				<li>
                    <img class="r-bg" src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/image/rater.png" alt="<?php  echo $row['title'];?>" />
                    <img class="r-head" src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" />
                    <div class="r-name"><?php  echo cutstr($row['title'],15,1);?></div>
                    <div class="r-des"><?php  echo cutstr($row['description'],30,1);?></div>
                     
                </li>
		<?php  } } ?>	
		</ul>
    </div>
</div>
<?php  } } ?>
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '5',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
<div class="section6 js-section" id="<?php  echo $nav['name'];?>">
    <h2 class="t-bg-img"><span><?php  echo $nav['name'];?></span></h2>
	<p class="sub-title">（<?php  echo $nav['description'];?>）</p>
    <div class="w980">
        <div class="partner-box oul-box">
            <ul class="oul">
				<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
				<?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
				<?php  if(empty($result['list'])) { ?>	<span style="color:#fff;">还没添加文章哦，赶紧去添加</span><?php  } ?>
				<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
                <li class="item">
					<a>
						<img src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" />
					</a>
				</li>
				<?php  } } ?>	
			</ul>
        </div>
    </div>
</div>
<?php  } } ?>
<?php  $site_navs = modulefunc('site', 'site_navs', array (
  'func' => 'site_navs',
  'section' => '6',
  'item' => 'nav',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); if(is_array($site_navs)) { $i=0; foreach($site_navs as $i => $nav) { $i++; $nav['iteration'] = $i; ?>
<!-- 联系我们 -->
<div class="section7 js-section" id="<?php  echo $nav['name'];?>">
    <h2 class="t-bg-img"><span><?php  echo $nav['name'];?></span></h2>
    <div class="w980" style="padding-bottom:45px;">
	
        <ul style="padding-bottom:45px;">
				<?php  $min_cid = pdo_fetchcolumn("SELECT id FROM ".tablename('site_category')." WHERE `nid`='$nav[id]'")?>
				<?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'cid' => $min_cid,
  'return' => 'true',
  'assign' => 'result',
  'limit' => '80',
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 26,
  'acid' => 0,
)); ?>
				<?php  if(empty($result['list'])) { ?>	<span style="color:#fff;">还没添加文章哦，赶紧去添加</span><?php  } ?>	
				<?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
            <li style="text-align:left;">
                <i class="icon-circle" style="top:25px;"></i>
				<?php  echo $row['content'];?>
            </li>
			
            <li class="erweima-li" style="margin-top:30px;text-align:left;">
                <div class="erweima-box"><img src="<?php  if(empty($row['thumb'])) { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?><?php  echo $row['thumb'];?>" alt="<?php  echo $row['title'];?>" /></div>
                <div class="contact" style="text-align:center;">扫一扫关注我们</div>
            </li>
				<?php  } } ?>
        </ul>
    </div>
</div>

<?php  } } ?>


<div class="bs-docs-footer footer">
    <div class="footer-nav">
        <div class="container">
            <ul class="about-ul list-inline clearfix">
                <li><a href="<?php  if(!empty($_W['styles']['url1'])) { ?><?php  echo $_W['styles']['url1'];?><?php  } else { ?>#<?php  } ?>" target="_blank"><?php  if(!empty($_W['styles']['lin1'])) { ?><?php  echo $_W['styles']['lin1'];?><?php  } else { ?>友情连接1<?php  } ?></a></li>
                <li><a href="<?php  if(!empty($_W['styles']['url2'])) { ?><?php  echo $_W['styles']['url2'];?><?php  } else { ?>#<?php  } ?>" target="_blank"><?php  if(!empty($_W['styles']['lin2'])) { ?><?php  echo $_W['styles']['lin2'];?><?php  } else { ?>友情连接2<?php  } ?></a></li>
                <li><a href="<?php  if(!empty($_W['styles']['url3'])) { ?><?php  echo $_W['styles']['url3'];?><?php  } else { ?>#<?php  } ?>" target="_blank"><?php  if(!empty($_W['styles']['lin3'])) { ?><?php  echo $_W['styles']['lin3'];?><?php  } else { ?>友情连接3<?php  } ?></a></li>
                <li><a href="<?php  if(!empty($_W['styles']['url4'])) { ?><?php  echo $_W['styles']['url4'];?><?php  } else { ?>#<?php  } ?>" target="_blank"><?php  if(!empty($_W['styles']['lin4'])) { ?><?php  echo $_W['styles']['lin4'];?><?php  } else { ?>友情连接4<?php  } ?></a></li>
            </ul>
        </div>
    </div>
    <div class="container copy-right">
        <span>Copyright © <a href="#"><?php  echo $_W['account']['name'];?></a> （<a href="http://www.miitbeian.gov.cn/" target="_blank"><?php  if(!empty($_W['styles']['beian'])) { ?><?php  echo $_W['styles']['beian'];?><?php  } else { ?>浙备SB9527<?php  } ?></a>)</span>
        <a href="#"><img src="<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } else { ?><?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/em.jpg<?php  } ?>" alt="empty"></a>
    </div>
</div>




<script src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/js/jquery.js"></script>
<script src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/js/bootstrap.min.js"></script>
<script src="<?php  echo $_W['siteroot'];?>app/themes/hccc06/zhuanti/2015/wow/js/script.js?ver=201503111815"></script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256640558'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1256640558' type='text/javascript'%3E%3C/script%3E"));</script></body>
</html>
