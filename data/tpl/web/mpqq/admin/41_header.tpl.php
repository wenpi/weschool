<?php defined('IN_IA') or exit('Access Denied');?>        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <?php  if($left_nav !='change_weixin') { ?>
                <div class="page-logo">
                    <a href="<?php  echo $this->createWebUrl("adminloginCheck")?>">
                        <img  src="<?php  echo $_W['attachurl'];?><?php  echo S('base','getKeywordContent',array('logo'))?>" style="    height: 30px; width: 150px;position: relative;top: -10px;" alt="logo" class="logo-default" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                <?php  } ?>
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                 <?php  if($left_nav !='change_weixin') { ?>
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
                        <div class="input-group">
                            <!--<input type="text" class="form-control" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>-->
                        </div>
                    </form>
                    <?php  } ?>
                    <!--顶部菜单栏-->
                    <div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
                            <ul class="nav navbar-nav">
                                <?php  if(is_array($top_action)) { foreach($top_action as $row) { ?>
                                    <li class="classic-menu-dropdown  <?php  if($page_name == $row['action_name']) { ?> active <?php  } ?> " >
                                        <a href="<?php  echo $this->createWebUrl($row['action'],$row['arr']);?>">  <?php  echo $row['action_name'];?>
                                            <span class="selected"> </span>
                                        </a>
                                    </li>
                                <?php  } } ?>
                            </ul>
                    </div>
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!--<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 未完成</span> 任务</h3>
                                        <a href="page_user_profile_1.html">查看全部</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">查看</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span>有新家长绑定 </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-default"> 4 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>你有
                                            <span class="bold">7个新的</span> 消息</h3>
                                        <a href="app_inbox.html">查看全部</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="<?php echo MODULE_URL;?>/assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> 朱欢 </span>
                                                        <span class="time"> 刚刚 </span>
                                                    </span>
                                                    <span class="message"> 查看全部... </span>
                                                </a>
                                            </li>
     

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-calendar"></i>
                                    <span class="badge badge-default"> 3 </span>
                                </a>
                                <ul class="dropdown-menu extended tasks">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 未完成</span> 任务</h3>
                                        <a href="app_todo.html">查看</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">新版本 v1.2 </span>
                                                        <span class="percent">30%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <?php  if($_GPC['_admin_img']) { ?><img alt="" class="img-circle" src="<?php  echo $_W['attachurl'];?><?php  echo $_GPC['_admin_img'];?>" /> <?php  } ?>
                                    
                                    <span class="username username-hide-on-mobile"><?php  if($_GPC['_admin_name']) { ?><?php  echo $_GPC['_admin_name'];?> <?php  } else { ?><?php  echo $_W['username'];?> <?php  } ?></span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php  echo $_W['siteroot'];?>/web/<?php  echo $this->createWebUrl("myCenter")?>">
                                            <i class="icon-user"></i> 个人中心 </a>
                                    </li>
                                    <!--
                                    <li>
                                        <a href="#">
                                            <i class="icon-calendar"></i>我的日历 </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-envelope-open"></i> 站内信
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-rocket"></i> 我的任务
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-lock"></i> 锁屏 </a>
                                    </li>-->
                                    <li>
                                        <a href="<?php  echo $_W['siteroot'];?>/app/<?php  echo $this->createMobileUrl("adminlogin")?>">
                                            <i class="icon-key"></i> 退出 </a>
                                    </li>
                                    <?php  if($_W['uniaccount']['name'] ) { ?>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-key"></i> <?php  echo $_W['uniaccount']['name'];?> </a>
                                        </li>
                                    <?php  } ?>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i>
                            </li>-->
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>