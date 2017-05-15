<?php defined('IN_IA') or exit('Access Denied');?>          <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="dpl">
                    <div class="WX"> <a href="<?php  echo $this->createMobileUrl('classArticle',array('id'=>$row['line_id']));?>">
                        <div  style="width:60px;height: 60px;border-radius: 50%;  background-image: url(<?php  echo D('teacher')->teacherImg($row['teacher_id']);?>)" class="background_img"></div>
                    </a></div>

                    <div class="WZ" >
                        <a href="<?php  echo $this->createMobileUrl('classArticle',array('id'=>$row['line_id']));?>" >
                            <p><span class="W-1"><?php  echo $row['line_title'];?></span>
                            <span class="W-2">(<?php  echo $row['time_date'];?>)</span>
                        </p>
                            <p class="W-3"><?php  echo $this->clear_html_short($row['line_content']);?>......</p>
                        </a>
                    </div>
                </li>
            <?php  } } ?> 