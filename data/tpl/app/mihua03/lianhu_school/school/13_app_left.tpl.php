<?php defined('IN_IA') or exit('Access Denied');?> <nav class="w-nav-menu nav-menu bg-gradient" role="navigation">
            <div class="nav-menu-header">
              <div class="logo"><?php  echo $_SESSION['school_name'];?></div>
            </div>
            <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("school_home")?>" data-load="1">
              <div class="icon-list-menu">
                <div class="icon ion-ios-home-outline"></div>
              </div>
              <div class="nav-menu-titles">首页</div>
            </a>
            <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("school_notice")?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="ion-ios-star"></div>
                  </div>
                  <div class="nav-menu-titles">学校公告</div>
             </a>
            <div class="w-dropdown dropdown-container" data-delay="0">
              <div class="w-dropdown-toggle w-clearfix nav-menu-link dropdown">
                <div class="icon-list-menu">
                  <div class="icon ion-arrow-graph-up-right"></div>
                </div>
                <div class="nav-menu-titles">工作考核</div>
                <div class="w-icon-dropdown-toggle dropdown-icon"></div>
              </div>
              <nav class="w-dropdown-list drop-down-list">
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_student');?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-android-contacts"></div>
                  </div>
                  <div class="nav-menu-titles">学生绑定率</div>
                </a>

                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_class');?> data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-ios-color-filter-outline"></div>
                  </div>
                  <div class="nav-menu-titles">班级动态</div>
                </a>
                
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_student');?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-ios-infinite-outline"></div>
                  </div>
                  <div class="nav-menu-titles">教师考核</div>
                </a>
              
              </nav>
            </div>
            <!--<a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_calender');?>" data-load="1">
              <div class="icon-list-menu">
                <div class="icon ion-ios-calendar-outline"></div>
              </div>
              <div class="nav-menu-titles">日历</div>
            </a>-->
            <div class="w-dropdown dropdown-container" data-delay="0">
              <div class="w-dropdown-toggle w-clearfix nav-menu-link dropdown">
                <div class="icon-list-menu">
                  <div class="icon ion-chatbubbles"></div>
                </div>
                <div class="nav-menu-titles">沟通</div>
                <div class="w-icon-dropdown-toggle dropdown-icon"></div>
              </div>
              <nav class="w-dropdown-list drop-down-list">
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_student');?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-ios-chatbubble"></div>
                  </div>
                  <div class="nav-menu-titles">云信</div>
                  <div class="nav-menu-text-right">3</div>
                </a>
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_student');?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-person-stalker"></div>
                  </div>
                  <div class="nav-menu-titles">通讯录</div>
                </a>                
              </nav>
            </div>
            <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_video');?>" data-load="1">
              <div class="icon-list-menu">
                <div class="icon ion-ios-film-outline"></div>
              </div>
              <div class="nav-menu-titles">教室监控</div>
            </a>
            <!--<a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_student');?>" data-load="1">
                  <div class="icon-list-menu">
                    <div class="icon ion-ios-list-outline"></div>
                  </div>
                  <div class="nav-menu-titles">计划任务</div>
                  <div class="nav-menu-text-right">8</div>
             </a>-->
            <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  if($this->school_info['host_url'] ) { ?><?php  echo $this->school_info['host_url'];?><?php  } else { ?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=wapHome&m=lianhu_school <?php  } ?> " data-load="1">
              <div class="icon-list-menu">
                <div class="icon ion-ios-paper-outline"></div>
              </div>
              <div class="nav-menu-titles">微官网</div>
            </a>

            <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('school_info');?>" data-load="1">
              <div class="icon-list-menu">
                <div class="icon ion-ios-person-outline"></div>
              </div>
              <div class="nav-menu-titles">我的信息</div>
            </a>
  
            <div class="separator-bottom"></div>
            <div class="separator-bottom"></div>
            <div class="separator-bottom"></div>
          </nav>           