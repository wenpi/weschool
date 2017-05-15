<?php defined('IN_IA') or exit('Access Denied');?>﻿<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .table {
    table-layout: fixed !important;
}
.nav-width li.active {
    margin-right: 00px;}
.nav-width li.normal {
    margin-right: 0px}
</style>

<header>

<a href="<?php  echo url('account/display');?>" class="header_l"><h1 class="logo">微信号营销致力成为微信·互联综合解决方案服务商！</h1></a>
<?php  if(!empty($_W['uniacid']) && !defined('IN_MESSAGE')) { ?>
<ul class="header_nav">
     
            <li><a href="<?php  echo url('home/welcome/platform');?>" target="_blank"><i class="fa fa-share"></i>&nbsp;&nbsp;继续管理公众号（<?php  echo $_W['account']['name'];?>）</a></li>   
</ul>
<?php  } ?>
    <div class="header_r">
    <ul class="nav navbar-nav navbar-right">

    <li class="dropdown topbar-notice"><a type="button" data-toggle="dropdown"><i class="fa fa-bell"></i> 
<span class="badge" id="notice-total">0</span></a>
<div class="dropdown-menu" aria-labelledby="dLabel">
<div class="topbar-notice-panel">
<div class="topbar-notice-arrow"></div>
<div class="topbar-notice-head"><span>系统公告</span> 
</div>
<div class="topbar-notice-body"><ul id="notice-container"></ul></div>
<button class="btn btn-primary btn-square btn-block" onclick = " window.location.href='<?php  echo url('article/notice-show/list');?>'; ">更多公告</button>
</div></div></li>
  <li class="dropdown dropdown-user">
<a href="javascript:;" class="dropdown-toggle hover-initialized header_avatar" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

            <img class="avatar" src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" onerror="this.src='resource/images/gw-wx.gif'" alt="<?php  echo $_W['account']['name'];?>" >
            <strong class="header_name"><?php  if($_W['account']['name'] == null ) { ?> 请选择公众号<?php  } ?>
            <?php  echo $_W['account']['name'];?></strong>
                   
</a>
<ul class="dropdown-menu dropdown-menu-default">
 <li class="dropdown-header"></i><?php  echo $_W['user']['username'];?> (<?php  if($_W['role'] == 'founder') { ?>系统管理员<?php  } else if($_W['role'] == 'manager') { ?>公众号管理员<?php  } else { ?>公众号操作员<?php  } ?>) </li>
 <?php  if($_W['role'] != 'operator') { ?>
 <li class="divider"></li>
                        <li><a href="<?php  echo url('account/post', array('uniacid' => $_W['uniacid']));?>" target="_blank"><i class="fa fa-weixin fa-fw"></i> 编辑公众号资料</a></li>
                        <?php  } ?>
                        <li><a href="<?php  echo url('account/display');?>" target="_blank"><i class="fa fa-cogs fa-fw"></i> 管理其它公众号</a></li>
                        <li><a href="<?php  echo url('utility/emulator');?>" target="_blank"><i class="fa fa-mobile fa-fw"></i> 模拟测试</a></li>
<li class="divider"></li>
                <li><a href="<?php  echo url('user/profile/profile');?>"><i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;修改密码</a></li>
                <li><a href="<?php  echo url('user/profile/base');?>"><i class="fa fa-user fa-fw"></i>&nbsp;个人信息</a></li>
<?php  if($_W['role'] == 'founder') { ?>
                <li class="divider"></li>
                <li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-sitemap fa-fw"></i>&nbsp;系统选项</a></li>
                <li><a href="<?php  echo url('system/welcome');?>" target="_blank"><i class="fa fa-cloud-download fa-fw"></i>&nbsp;自动更新</a></li>
                <li><a href="<?php  echo url('system/updatecache');?>" target="_blank"><i class="fa fa-refresh fa-fw"></i>&nbsp;更新缓存</a></li>
                
                        <?php  } ?>
        
</ul>

</li>
  <li id="logout">
            <a href="<?php  echo url('user/logout');?>" class="header_icon" title="注销">
                <i class="icon icon_logout"></i>
            </a>
        </li>
</ul>

    </div>
</header>


<div class="main">

    <!-- 主内容 -->
    <section>
        <div class="section_main">
            <div class="section_auto">
               <div class="ui_tab_contents">
                 <div class="notice_body">

            	<?php  if(defined('IN_MESSAGE')) { ?>
		<div>
			<div class="jumbotron clearfix alert alert-<?php  echo $label;?>">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
						<i class="fa fa-5x fa-<?php  if($label=='success') { ?>check-circle<?php  } ?><?php  if($label=='danger') { ?>times-circle<?php  } ?><?php  if($label=='info') { ?>info-circle<?php  } ?><?php  if($label=='warning') { ?>exclamation-triangle<?php  } ?>"></i>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
						<?php  if(is_array($msg)) { ?>
							<h2>MYSQL 错误：</h2>
							<p><?php  echo cutstr($msg['sql'], 300, 1);?></p>
							<p><b><?php  echo $msg['error']['0'];?> <?php  echo $msg['error']['1'];?>：</b><?php  echo $msg['error']['2'];?></p>
						<?php  } else { ?>
						<h2><?php  echo $caption;?></h2>
						<p><?php  echo $msg;?></p>
						<?php  } ?>
						<?php  if($redirect) { ?>
						<p><a href="<?php  echo $redirect;?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a></p>
						<script type="text/javascript">
							setTimeout(function () {
								location.href = "<?php  echo $redirect;?>";
							}, 3000);
						</script>
						<?php  } else { ?>
							<p>[<a href="javascript:history.go(-1);" class="alert-link">点击这里返回上一页</a>] &nbsp; [<a href="./?refresh" class="alert-link">首页</a>]</p>
						<?php  } ?>
					</div>
				</div>
			</div>
		<?php  } else { ?>
		<div class="well">
		<?php  } ?>
		<script>
	require(['jquery'],function($){
		var h = document.documentElement.clientHeight;
		$(".gw-container").css('min-height',h);
	});
</script>


  