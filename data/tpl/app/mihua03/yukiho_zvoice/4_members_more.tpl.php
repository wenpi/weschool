<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($members['list'])) { foreach($members['list'] as $member) { ?>
<div class="cat<?php  echo $member['category_id'];?> all-cat gallery-filter-item" style="display: block;width:100%;">
		<p class="user-list-follow">
			<t onclick="window.location.href='<?php  echo $this->createMobileUrl('tutor',array('openid'=>$member['openid']))?>'"  ><img src="<?php  echo $member['avatar']?>" alt="img">
				<strong><?php  echo $member['nickname'];?><?php  echo $page;?>
					<em class="split-title"><?php  echo $member['tags'];?></em>
				</strong>
			</t> 
			<?php  $credit = intval($member['credit'])?>
			<a onclick="window.location.href = '<?php  echo $this->createMobileUrl('making',array('openid'=>$member['openid']))?>'" class="follow button-green"><?php  echo $credit;?>元提问</a>
		</p>
</div>
<div style="margin-bottom:5px;margin-top:10px;" class="decoration"></div>	
<?php  } } ?>