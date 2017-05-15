<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    <li <?php  if($_GPC['do']=="setting" && $code == 'system') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('setting',array('code'=>'system'))?>">参数设置</a>
    </li>
    <li <?php  if($_GPC['do']=="setting" && $code == 'template') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('setting',array('code'=>'template'))?>">模板设置</a>
    </li>
    <li <?php  if($_GPC['do']=="category") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('category')?>">分类设置</a>
    </li>
    <li <?php  if($_GPC['do']=="quickmenu") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('quickmenu')?>">底部菜单设置</a>
    </li>
    <li <?php  if($_GPC['do']=="setting" && $code == 'qiniu') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('setting',array('code'=>'qiniu'))?>">七牛设置</a>
    </li>
    <li <?php  if($_GPC['do']=="setting" && $code == 'pay') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('setting',array('code'=>'pay'))?>">支付设置</a>
    </li>
    <li <?php  if($_GPC['do']=="setting" && $code == 'help') { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('setting',array('code'=>'help'))?>">帮助文案</a>
    </li><!--
    <li <?php  if($_GPC['do']=="advs") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('advs')?>">广告设置</a>
    </li>
    <li <?php  if($_GPC['do']=="delete") { ?>class="active"<?php  } ?>>
        <a href="<?php  echo $this->createWebUrl('delete')?>">清理数据</a>
    </li>-->
</ul>