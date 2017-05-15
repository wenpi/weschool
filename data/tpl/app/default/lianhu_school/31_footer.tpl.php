<?php defined('IN_IA') or exit('Access Denied');?><style type="text/css">
*{margin:0;padding:0;}
a,img{border:0;}

#menu{position:fixed;bottom:0px;width:100%;height:50px;line-height:50px;z-index:999;background:url(<?php echo MODULE_URL;?>template/mobile/style/menubg.png) repeat-x;}
#menu ul{margin:0 auto;list-style-type:none;width:100%;max-width:500px;height:100%;}
#menu ul li{float:left;width:33.3%;height:100%;text-align:center;position:relative;font-size:14px;}
#menu ul li .menu_li{position:absolute;top:0px;left:0px;z-index:900;width:100%;height:100%;color:#454545;background:url(./themes/default/site/img/menubg.png) repeat-x;}
#menu ul li .line{position:absolute;top:0px;right:0px;z-index:900;}
#menu ul li span{position:absolute;bottom:-400px;left:50%;width:104px;margin-left:-52px;margin-bottom:2px;height:auto;text-align:center;z-index:900;}
#menu ul li span div{position:absolute;top:0px;left:0px;}
#menu ul li span a{float:left;width:100%;height:44px;line-height:44px;color:#454545;text-decoration:none;position: relative;z-index: 999; }
#menu img{
vertical-align: middle;
}
</style>
<div id="menu">
	<ul>

		<li>
			<div class="menu_li"><img src="<?php echo MODULE_URL;?>template/mobile/style/coin.png" width="10" /> <a href="<?php  echo $this->school_info['host_url'];?>"  >微官网</a></div>
			<img class="line" src="<?php echo MODULE_URL;?>template/mobile/style/line.png" width="1"/>	
			<span> </span>
		</li>
		<li>
			<div class="menu_li"><img src="<?php echo MODULE_URL;?>template/mobile/style/coin.png" width="10" /> <a href="<?php  echo $_W['siteroot'];?>app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=line&m=lianhu_school"  >班级圈</a></div>
			<img class="line" src="<?php echo MODULE_URL;?>template/mobile/style/line.png" width="1"/>	
			<span></span>
		</li>
		<li>
			<div class="menu_li"><img src="<?php echo MODULE_URL;?>template/mobile/style/coin.png" width="10" />学生中心</div>
			<img class="line" src="<?php echo MODULE_URL;?>template/mobile/style/line.png" width="1"/>	
			<span>
				<img src="<?php echo MODULE_URL;?>template/mobile/style/navbg6.png" width="100%"/>
			<div>
						<a href="<?php  echo $this->createMobileUrl('applist')?>"style="padding:4px 0 0 0 ;">预约项目</a>
						<a href="<?php  echo $this->createMobileUrl('score')?>">考试成绩</a>		
						<a href="<?php  echo $this->createMobileUrl('syllabus')?>">课程表</a>	
						<a href="<?php  echo $this->createMobileUrl('Record',array('op'=>'1'))?>">学生记录</a>
						<a href="<?php  echo $this->createMobileUrl('neimsg')?>">学校公告</a>
						<a href="<?php  echo $this->createMobileUrl('home')?>" >首页</a>
			</div>
			</span>
		</li>
	</ul>
</div>

<script type="text/javascript">
window.onload = function(){
	$('#menu ul li').each(function(j){
		$('#menu ul li').eq(j).removeClass("on");
		$('#menu ul li span').eq(j).animate({bottom:-$('#menu ul li span').eq(j).height()},100);
	});
}

$('#menu ul li').each(function(i){
	$(this).click(function(){
		if($(this).attr("class")!="on"){
			$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
			$('#menu ul .on').removeClass("on");
			$(this).addClass("on");
			$('#menu ul li span').eq(i).animate({bottom:55},200);
			$('.footer_front').show();
		}else{
			$('#menu ul li span').eq(i).animate({bottom:-$('#menu ul li span').eq(i).height()},200);
			$(this).removeClass("on");
			$('.footer_front').hide();
		}
	});
});

$('.footer_front').click(function(){
	$('#menu ul .on span').animate({bottom:-$('#menu ul .on span').height()},200);
	$('#menu ul .on').removeClass("on");
	$(this).hide();
});
</script>