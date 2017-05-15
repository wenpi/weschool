<?php defined('IN_IA') or exit('Access Denied');?>    <nav class="cd-nav-container" id="cd-nav" style='z-index:1000'>
		<ul class="cd-nav">
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li data-menu="<?php  echo $row;?>" class="<?php  if($op==$row) { ?>cd-selected<?php  } ?>" style="<?php  if($class_id==$row['class_id']) { ?>background-color:#009ffb; <?php  } else { ?>background-color:#fff;<?php  } ?>" >
                    <a href="<?php  echo $this->createMobileUrl('record',array('op'=>$row['class_id']));?>">
                      
                        <em  style="<?php  if($class_id==$row['class_id']) { ?>color:#fff;<?php  } else { ?>color:#009ffb;<?php  } ?>"><?php  echo $row['class_name'];?></em>
                    </a>
                </li>
            <?php  } } ?>
		</ul> 
	</nav>
    <div class="cd-overlay">
    </div>
