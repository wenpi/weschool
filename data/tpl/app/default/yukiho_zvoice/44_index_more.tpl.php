<?php defined('IN_IA') or exit('Access Denied');?><?php  if(is_array($questions['list'])) { foreach($questions['list'] as $li) { ?>
<?php  $to_member = M('member')->getInfo($li['to_openid'])?>
<?php  if(!empty($li['isfree'])) { ?>
<div class="blog-sidebar-text" onclick="window.location.href='<?php  echo $this->createMobileUrl('question',array('id'=>$li['id']))?>'">
	<?php  $quser = M('member')->getInfo($li['openid'])?>
	<h5 style="font-size:15px;"><?php  echo $li['title'];?></h5>
</div>
<div class="container one-third-responsive">
	<?php  $answers = M('answer')->getList(1," AND question_id = :question_id",array(':question_id'=>$li['id']),1)?>
	<?php  if(is_array($answers['list'])) { foreach($answers['list'] as $ans) { ?>
	<?php  $user = M('member')->getInfo($ans['openid'])?>
	<p class="user-list-follow">
		<a href="<?php  echo $this->createMobileUrl('tutor',array('openid'=>$to_member['openid']))?>">
			<img src="<?php  echo $to_member['avatar']?>" alt="img">
			<strong><?php  echo $to_member['nickname'];?>
				<em class="split-title"><?php  echo $to_member['tags'];?></em>
			</strong></a> 
			<a data-id="<?php  echo $ans['id'];?>" data-timelong="<?php  echo $ans['timelong'];?>" data-question_id="<?php  echo $li['id'];?>" class="listen follow2 button-orange">
				<span class="tip"><?php  echo $this->template['limitFree']?> <?php  echo $ans['timelong'];?>''</span>
			</a>
	</p>
	<?php  } } ?>
<div class="decoration"></div>
</div>
<?php  } else { ?>

<div class="blog-sidebar-text" onclick="window.location.href='<?php  echo $this->createMobileUrl('question',array('id'=>$li['id']))?>'">
	<?php  $quser = M('member')->getInfo($li['openid'])?>
	<h5 style="font-size:15px;"><?php  echo $li['title'];?></h5>
</div>
<div class="container one-third-responsive">
	<?php  $answers = M('answer')->getList(1," AND question_id = :question_id",array(':question_id'=>$li['id']),1)?>
	<?php  if(is_array($answers['list'])) { foreach($answers['list'] as $ans) { ?>
	<?php  $user = M('member')->getInfo($ans['openid'])?>
	<p class="user-list-follow">
		<a href="<?php  echo $this->createMobileUrl('tutor',array('openid'=>$to_member['openid']))?>">
			<img src="<?php  echo $to_member['avatar']?>" alt="img">
			<strong><?php  echo $to_member['nickname'];?>
				<em class="split-title"><?php  echo $to_member['tags'];?></em>
			</strong></a> 
			<a data-id="<?php  echo $ans['id'];?>" data-timelong="<?php  echo $ans['timelong'];?>" data-question_id="<?php  echo $li['id'];?>" class="listen follow2 button-green">
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
	</p>
	<?php  } } ?>
<div class="decoration"></div>
</div>
<?php  } ?>
<?php  } } ?>