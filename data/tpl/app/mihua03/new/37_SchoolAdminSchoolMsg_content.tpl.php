<?php defined('IN_IA') or exit('Access Denied');?>    <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <li class="list-item-new">
            <a class="w-inline-block link-blog-list" href="<?php  echo $this->createMobileUrl("schoolAdminSchoolMsgInfo",array("id"=>$row['msg_id']))?>" data-load="1">
            <div class="image-new" style="background-image: url( <?php  echo $_W['attachurl'];?><?php  echo $row['img'];?>);	background-size: cover;background-position: center;"  ></div>
                <div class="text-new">
                    <h2 class="title-new"><?php  echo $row['msg_title'];?></h2>
                    <p class="description-new"><?php  echo S('fun','formatLimitContent',array($row['msg_content'],50));?>...</p>
                        <?php  if($row['add_time']) { ?> <?php  echo date("m-d",$row['add_time'])?> <?php  } else { ?><?php  echo date("m-d",$row['addtime'])?><?php  } ?>
                    <a class="category-link" href="javascript:;"><?php  echo $row['admin_name'];?></a><a class="category-link" style="background-color: rgba(255,51,51,0.8);color: #fff" href="<?php  echo $this->createMobileUrl("SchoolAdminSchoolMsgInfo",array("id"=>$row['msg_id'],'ac'=>'delete'))?>">删除</a>
                </div>
                </a>
            </li> 
    <?php  } } ?>