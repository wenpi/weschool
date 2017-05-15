<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">

    <li <?php  if($_GPC['do']=="member") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('member')?>">会员管理</a>
    </li>
    <li <?php  if($_GPC['do']=="verify") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('verify',array('status'=>'1'))?>">认证审核</a>
    </li>
    <?php  if(!empty($to_openid)) { ?>
    <li <?php  if($_GPC['do']=="follow") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('follow',array('to_openid'=>$to_openid))?>">收听列表</a>
    </li>
    <?php  } ?>
    <li <?php  if($_GPC['do']=="question") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('question')?>">问题管理</a>
    </li>
    <li <?php  if($_GPC['do']=="answer") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('answer')?>">回答管理</a>
    </li>
    <?php  if(!empty($question_id)) { ?>
    <li <?php  if($_GPC['do']=="listen_log") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('listen_log',array('question_id'=>$question_id))?>">偷听记录</a>
    </li>
    <?php  } ?>
    <li <?php  if($_GPC['do']=="paylog") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('paylog')?>">支付记录</a>
    </li>
    <li <?php  if($_GPC['do']=="finish_paylog") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('finish_paylog')?>">打款操作</a>
    </li>
</ul>