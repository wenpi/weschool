<?php defined('IN_IA') or exit('Access Denied');?><?php  if(S("system",'getSetContent',array('xiaoye_home',$school_id)) ==1 ) { ?> 
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/homeNew', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/homeNew', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/homeOld', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/homeOld', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>