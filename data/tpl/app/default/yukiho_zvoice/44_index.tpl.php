<?php defined('IN_IA') or exit('Access Denied');?><?php  $g_title='解答'?>
<?php  $menu='2'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header1', TEMPLATE_INCLUDEPATH)) : (include template('common/header1', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/menu', TEMPLATE_INCLUDEPATH)) : (include template('common/menu', TEMPLATE_INCLUDEPATH));?>
		<div id="content" class="snap-content">
			<div class="content">
				<div class="portfolio-filter">
					<div class="portfolio-filter-categories">
						<a href="<?php  echo $this->createMobileUrl('index')?>" class="filter-category <?php  if($cid=='0') { ?>selected-filter<?php  } ?>">全部</a>
						<?php  $category = M('category')->getMyList()?>
						<?php  if(is_array($category)) { foreach($category as $c) { ?>
						<a href="<?php  echo $this->createMobileUrl('index',array('cid'=>$c['id']))?>" class="filter-category <?php  if($cid == $c['id']) { ?>selected-filter<?php  } ?>"><?php  echo $c['title'];?></a>
						<?php  } } ?>
					</div>
					<?php  if(!empty($questions['list'])) { ?>
					<div id="questions" class="portfolio-filter-wrapper" style="margin-left:5px;">
						<?php  if(is_array($questions['list'])) { foreach($questions['list'] as $li) { ?>
						<?php  $to_member = M('member')->getInfo($li['to_openid'])?>
						<?php  if(!empty($li['isfree'])) { ?>
						<div class="blog-sidebar-text" onclick="window.location.href='<?php  echo $this->createMobileUrl('question',array('id'=>$li['id']))?>'">
							<?php  $quser = M('member')->getInfo($li['openid'])?>
							<h5 style="font-size:15px;"><?php  echo $li['title'];?></h5>
						</div>
						<div class="container one-third-responsive">
							<?php  $ans = M('answer')->getone(array('question_id'=>$li['id']))?>
							<?php  $user = M('member')->getInfo($ans['openid'])?>
							<p class="user-list-follow">
								<a href="<?php  echo $this->createMobileUrl('tutor',array('openid'=>$to_member['openid']))?>">
									<img src="<?php  echo $to_member['avatar']?>" alt="img">
									<strong><?php  echo $to_member['nickname'];?>
										<em class="split-title"><?php  echo $to_member['tags'];?></em>
									</strong></a> 
									<?php  if($ans['mode']=='0') { ?>
										<a data-id="<?php  echo $ans['id'];?>" data-mode="<?php  echo $ans['mode'];?>"data-timelong="<?php  echo $ans['timelong'];?>" data-question_id="<?php  echo $li['id'];?>" class="listen follow2 button-orange">
											<span class="tip"><?php  echo $this->template['limitFree']?> <?php  echo $ans['timelong'];?>''</span>
										</a>
									<?php  } else { ?>
										<a data-id="<?php  echo $ans['id'];?>" data-mode="<?php  echo $ans['mode'];?>" class="lookup follow2 button-orange">
											<span class="tip"><?php  echo $this->template['limitFree']?></span>
										</a>
									<?php  } ?>
								</p>
							<div class="decoration"></div>
						</div>
						<?php  } else { ?>
						
						<div class="blog-sidebar-text" onclick="window.location.href='<?php  echo $this->createMobileUrl('question',array('id'=>$li['id']))?>'">
							<?php  $quser = M('member')->getInfo($li['openid'])?>
							<h5 style="font-size:15px;"><?php  echo $li['title'];?></h5>
						</div>
						<div class="container one-third-responsive">
							<?php  $ans = M('answer')->getone(array('question_id'=>$li['id']))?>
							<?php  $user = M('member')->getInfo($ans['openid'])?>
							<p class="user-list-follow">
								<a href="<?php  echo $this->createMobileUrl('tutor',array('openid'=>$to_member['openid']))?>">
									<img src="<?php  echo $to_member['avatar']?>" alt="img">
									<strong><?php  echo $to_member['nickname'];?>
										<em class="split-title"><?php  echo $to_member['tags'];?></em>
									</strong></a> 
									<?php  if($ans['mode']=='0') { ?>
										<a data-id="<?php  echo $ans['id'];?>" data-mode="<?php  echo $ans['mode'];?>" data-timelong="<?php  echo $ans['timelong'];?>" data-question_id="<?php  echo $li['id'];?>" class="listen follow2 button-green">
										<?php  $listen_log = M('listen_log')->getOpenid($li['id'],$_W['openid'])?>
										<?php  if(empty($listen_log) || $listen_log['status'] == 0) { ?>
											<?php  if(($li['openid']==$_W['openid'] || $li['to_openid'] == $_W['openid'])) { ?>
											<span class="tip">播放解答 <?php  echo $ans['timelong'];?>''</span>
											<?php  } else { ?>
											<span class="tip"><?php  echo $this->system['listen_price']?>元<?php  echo $this->template['learnName']?> <?php  echo $ans['timelong'];?>''</span>
											<?php  } ?>
										<?php  } else { ?>
											<span>播放解答 <?php  echo $ans['timelong'];?>''</span>
										<?php  } ?></a>
									<?php  } else { ?>
										<a data-id="<?php  echo $ans['id'];?>" data-mode="<?php  echo $ans['mode'];?>" data-question_id="<?php  echo $li['id'];?>" class="lookup follow2 button-blue">
										<?php  $listen_log = M('listen_log')->getOpenid($li['id'],$_W['openid'])?>
										<?php  if(empty($listen_log) || $listen_log['status'] == 0) { ?>
											<?php  if(($li['openid']==$_W['openid'] || $li['to_openid'] == $_W['openid'])) { ?>
											<span class="tip">图文解答</span>
											<?php  } else { ?>
											<span class="tip"><?php  echo $this->system['listen_price']?>元<?php  echo $this->template['learnName']?></span>
											<?php  } ?>
										<?php  } else { ?>
											<span>图文解答</span>
										<?php  } ?></a>
									<?php  } ?>
							</p>
						<div class="decoration"></div>
						</div>
						<?php  } ?>
						<?php  } } ?>
					</div>
					<?php  } else { ?>
					<div class="content" style="margin-top:150px;">
						<div class="show-no-detection device-detected">
							<h5>暂时还没有解答哦</h5>
							<a href="<?php  echo $this->createMobileUrl('find')?>" class="button-small button-orange button-center" style="margin-top:20px;">寻找<?php  echo $this->template['authname']?></a>
						</div>
					</div>
					<?php  } ?>
				</div>
			</div>
		</div>
		<?php  if('1' == $this->system['openSearch']) { ?>
		<div class="footer-menu-controls light-footer-menu" style="-webkit-transform:inherit;">
			<div class="column" style="z-index:9999;">
				<div id="sb-search" class="sb-search">
					<form id="sb-form" action="<?php  echo $this->createMobileUrl('searchq')?>" method="post">
						<input class="sb-search-input" placeholder="搜索题目内容..." type="text" name="key" id="search">
						<input class="sb-search-submit" type="submit">
						<a id="sb-icon-search" class="sb-icon-search footer-menu-open" style="filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.58; opacity: 0.5; transform: translateX(0px); transition: all 250ms ease;"><i class="fa fa-search bg-blue-dark"></i></a>
					</form>
				</div>
			</div>
		</div>
		<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/assets/search/css/component.css">
		<script src="<?php echo MODULE_URL;?>/assets/search/js/classie.js"></script>
		<script src="<?php echo MODULE_URL;?>/assets/search/js/uisearch.js"></script>
		<?php  } ?>
	</div>
	<audio controls="controls" id="player" style="display:none;" autoplay preload="auto"></audio>
	<script src="<?php echo MODULE_URL;?>public/js/loadmore.js"></script>	
	<script>
	<?php  if('1' == $this->system['openSearch']) { ?>
	new UISearch( document.getElementById( 'sb-search' ) );
	<?php  } ?>
    var player = document.getElementById('player');
	
	
	initload("<?php  echo $this->createMobileUrl('index_more',array('cid'=>$cid))?>",callback);
	loadmore("<?php  echo $this->createMobileUrl('index_more',array('cid'=>$cid))?>",callback);
	function callback(html){
		$('#questions').append(html);
	}
	
    function playData(data){
		console.log(data);
        player.src = data.src;
        player.play();
        var timelong = parseInt(data.timelong) * 1000;
		var count = data.timelong;
		var timer = window.setInterval(function(){
			if((count--)>1){
				$(data.target).find('span').html("播放中..."+count+"''");
			}else{
				clearInterval(timer);
				$(data.target).find('span').html("再放一次 "+data.timelong+"''");
			}
		},1000);
		/**
        setTimeout(function(){
			$(data.target).find('span').html("再放一次");
        },timelong);*/
    }
	$("#content").delegate(".lookup","click",function(){
		var dd = {};
        var question_id = $(this).data('question_id');
        var target = $(this);
        if(!question_id){
            warn('question_id为空');
            return '';
        }
        $.get("<?php  echo $this->createMobileUrl('question')?>&id="+question_id,{answer_id:$(this).data('id'),act:'src'},function(data){
            if(data.status == 8){
				dd.status = 2;
                warn(data.message,function(){});
                return '';
            }
            if(data.status == 0){
				target.parent().parent().prev().trigger('click');
                return '';
            }
            wx.ready(function(){
                wx.chooseWXPay({
                    timestamp: data.timeStamp,
                    nonceStr: data.nonceStr,
                    package: data.package,
                    signType: data.signType,
                    paySign: data.paySign,
                    success: function (res) {
                        if(res.errMsg == 'chooseWXPay:ok') {
                            data.act == 'paySuccess';
                            $.post("<?php  echo $this->createMobileUrl('question')?>&id="+question_id,{act:'paySuccess',listen_id:data.listen_id,answer_id:data.answer_id},function(d){
                                if(d.status == 1){
									target.parent().parent().prev().trigger('click');
                                    return '';
                                }else{
									dd.status = 2;
                                    warn('系统错误',2000,'cancel');
                                }
                            },'json');
                        }else{
							dd.status = 2;
                            window.location.href = "<?php  echo $_W['siteurl']?>";
                        }
                    }
                });
            });
        },'json');
    });
	
	$("#content").delegate(".listen","click",function(){
		var dd = {};
        var question_id = $(this).data('question_id');
        var target = $(this)[0];
        var timelong = $(this).data('timelong');
        if(!question_id){
            warn('question_id为空');
            return '';
        }
        $.get("<?php  echo $this->createMobileUrl('question')?>&id="+question_id,{answer_id:$(this).data('id'),act:'src'},function(data){
            if(data.status == 8){
				dd.status = 2;
                warn(data.message,function(){});
                return '';
            }
            if(data.status == 0){
				dd.status = 1;
                dd.target = target;
                dd.src = data.src;
                dd.timelong = timelong;
                return '';
            }
            if(!data.listen_id){
				dd.status = 2;
                warn('listen_id为空');
                return '';
            }
            if(!data.answer_id){
				dd.status = 2;
                warn('answer_id为空');
                return '';
            }
            wx.ready(function(){
                wx.chooseWXPay({
                    timestamp: data.timeStamp,
                    nonceStr: data.nonceStr,
                    package: data.package,
                    signType: data.signType,
                    paySign: data.paySign,
                    success: function (res) {
                        if(res.errMsg == 'chooseWXPay:ok') {
                            data.act == 'paySuccess';
                            $.post("<?php  echo $this->createMobileUrl('question')?>&id="+question_id,{act:'paySuccess',listen_id:data.listen_id,answer_id:data.answer_id},function(d){
                                if(d.status == 1){
									dd.status = 1;
                                    dd.target = target;
                                    dd.src = d.src;
                                    dd.timelong = timelong;
                                    return '';
                                }else{
									dd.status = 2;
                                    warn('系统错误',2000,'cancel');
                                }
                            },'json');
                        }else{
							dd.status = 2;
                            window.location.href = "<?php  echo $_W['siteurl']?>";
                        }
                    }
                });
            });
        },'json');
		$(target).find('span').html("数据搬运中...");
		var timer1 = window.setInterval(function(){
			if(dd.status>0){
				clearInterval(timer1);
				if(dd.status==1){
					playData(dd);
				}else{
					$(target).find('span').html("重试一下");
				}
			}
		},1000);
    });
</script>
</body>