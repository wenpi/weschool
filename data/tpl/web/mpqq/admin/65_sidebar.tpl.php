<?php defined('IN_IA') or exit('Access Denied');?>                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="<?php  echo $this->createWebUrl("adminindex")?>">首页</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <?php  if(is_array($sidebar_list)) { foreach($sidebar_list as $row) { ?>
                            <li>
                                 <a href="<?php  if($row['fun_str'] ) { ?><?php  echo $this->createWebUrl($row['fun_str'] ,array('aw'=>1) )?> <?php  } else { ?>#<?php  } ?> ">
                                    <?php  echo $row['fun_name'];?>
                                </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <?php  } } ?>
                        </ul>
                       <?php  if($left_nav = 'system_index_nav' &&  $school_list  ) { ?>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> 切换学校
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu" style="max-height: 600px; overflow-y: auto">
                                    <?php  if(is_array($school_list)) { foreach($school_list as $row) { ?>
                                        <li>
                                            <a href="<?php  echo $this->createWebUrl('school',array("sid"=>$row['school_id'],'back_url'=>'adminindex','op'=>'select' ) );?>">
                                            <i class="icon-bell"></i> <?php  echo $row['school_name'];?></a>
                                        </li>
                                    <?php  } } ?>
                                </ul>
                            </div>
                        </div>
                     <?php  } ?>
                     <?php  if($top_action) { ?>
                           <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> 操作
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <?php  if(is_array($top_action)) { foreach($top_action as $row) { ?>
                                        <li>
                                            <a href="<?php  if($row['action']) { ?> <?php  echo $this->createWebUrl($row['action'],$row['arr']);?> <?php  } ?>">
                                            <i class="icon-bell"></i> <?php  echo $row['action_name'];?></a>
                                        </li>
                                    <?php  } } ?>
                                </ul>
                            </div>
                        </div>                  
                     <?php  } ?>
                    </div>                   