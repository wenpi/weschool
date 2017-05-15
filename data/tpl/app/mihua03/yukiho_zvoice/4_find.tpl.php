<?php defined('IN_IA') or exit('Access Denied');?><?php  $g_title='寻找'.$this->template['authname']?>
<?php  $menu='3'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header1', TEMPLATE_INCLUDEPATH)) : (include template('common/header1', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/menu', TEMPLATE_INCLUDEPATH)) : (include template('common/menu', TEMPLATE_INCLUDEPATH));?>
		<div id="content" class="snap-content">
			<div class="content">
				<div class="portfolio-filter">
					<div class="portfolio-filter-categories">
						<a href="<?php  echo $this->createMobileUrl('find')?>" class="filter-category <?php  if($cid=='0') { ?>selected-filter<?php  } ?>">推荐</a>
						<?php  $category = M('category')->getMyList()?>
						<?php  if(is_array($category)) { foreach($category as $c) { ?>
						<a href="<?php  echo $this->createMobileUrl('find',array('cid'=>$c['id']))?>" class="filter-category <?php  if($cid == $c['id']) { ?>selected-filter<?php  } ?>"><?php  echo $c['title'];?></a>
						<?php  } } ?>
					</div>
					<div class="clear"></div>
					<div id="members" class="portfolio-filter-wrapper" style="background-color:#fff;margin-left:5px;">
						
						<?php  if(is_array($members['list'])) { foreach($members['list'] as $member) { ?>
						<div class="cat<?php  echo $member['category_id'];?> all-cat gallery-filter-item" style="display: block;width:100%;">
								<p class="user-list-follow">
									<t onclick="window.location.href='<?php  echo $this->createMobileUrl('tutor',array('openid'=>$member['openid']))?>'"  ><img src="<?php  echo $member['avatar']?>" alt="img">
										<strong><?php  echo $member['nickname'];?>
											<em class="split-title"><?php  echo $member['tags'];?></em>
										</strong>
									</t> 
									<?php  $credit = intval($member['credit'])?>
									<a onclick="window.location.href = '<?php  echo $this->createMobileUrl('making',array('openid'=>$member['openid']))?>'" class="follow button-green"><?php  echo $credit;?>元提问</a>
								</p>
						</div>
						<div style="margin-bottom:5px;margin-top:10px;" class="decoration"></div>	
						<?php  } } ?>
					</div>
				</div>
			</div>
		</div>
		<?php  if('1' == $this->system['openSearch']) { ?>
		<div class="footer-menu-controls light-footer-menu" style="-webkit-transform:inherit;">
			<div class="column" style="z-index:9999;">
				<div id="sb-search" class="sb-search">
					<form id="sb-form" action="<?php  echo $this->createMobileUrl('searchm')?>" method="post">
						<input class="sb-search-input" placeholder="搜索<?php  echo $this->template['authname']?>名称..." type="text" name="key" id="search">
						<input class="sb-search-submit" type="submit">
						<a id="sb-icon-search" class="sb-icon-search footer-menu-open" style="filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.58; opacity: 0.5; transform: translateX(0px); transition: all 250ms ease;"><i class="fa fa-search bg-blue-dark"></i></a>
					</form>
				</div>
			</div>
		</div>
		<?php  } ?>
	</div>
	<?php  if('1' == $this->system['openSearch']) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/assets/search/css/component.css">
	<script src="<?php echo MODULE_URL;?>/assets/search/js/classie.js"></script>
	<script src="<?php echo MODULE_URL;?>/assets/search/js/uisearch.js"></script>
	<script>
	new UISearch(document.getElementById( 'sb-search' ));
	</script>
	<?php  } ?>
	<script src="<?php echo MODULE_URL;?>public/js/loadmore.js"></script>	
	<script>	
	initload("<?php  echo $this->createMobileUrl('find_more',array('cid'=>$cid))?>",callback);
	loadmore("<?php  echo $this->createMobileUrl('find_more',array('cid'=>$cid))?>",callback);
	function callback(html){
		$('#members').append(html);
	}
	</script>
</body>