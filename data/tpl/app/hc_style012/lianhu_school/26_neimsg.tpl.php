<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/new/main.css?2014-05-21" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/new/dialog.css?2014-05-21" media="all" />
<link href="<?php echo MODULE_URL;?>/style/new/xin_v3.s.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<title>学校公告</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
</head>
<body onselectstart="return true;" ondragstart="return false;">
	
		<div class="container exchange ">
			<div class="body">
				<ul class="list_exchange" >
					<?php  if(!$list) { ?>
						<li data-card >
						<header>
							<ul class="tbox">
								<li>
									<h5>没有新的消息</h5>
									<p> </p>
								</li>
							</ul>
						</header>
						<section>
							<div>
								<figure>
										没有新的消息
								</figure>
							</div>
						</section>
						<footer>
							<dl class="box">
							</dl>
						</footer>
					</li>
					<?php  } ?>
					<?php  if(is_array($list)) { foreach($list as $item) { ?>
						<li data-card >
						<header>
							<ul class="tbox">
								<li>
									<h5><?php  echo $item['msg_title'];?></h5>
									<p>发布时间<?php  echo date("Y-m-d H:i:s",$item['addtime']);?> </p>
								</li>
							</ul>
						</header>
						<section>
							<div>
								<figure>
										<?php  echo htmlspecialchars_decode($item['msg_content']);?>
								</figure>
							</div>
						</section>
						<footer>
							<dl class="box">
							</dl>
						</footer>
					</li>
				 <?php  } } ?>
				</ul>
			</div>
</div>
<?php  if($_SESSION['teacher_id']) { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer_tea', TEMPLATE_INCLUDEPATH)) : (include template('footer_tea', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</body>
</html>