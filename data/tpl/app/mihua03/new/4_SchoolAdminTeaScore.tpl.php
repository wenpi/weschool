<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/style/css/old_css.css">
<body>
  <style>
  .bg-gradient{
    background-color: rgba(51,203,213,0.8);
    background-image: none;
  }
  </style>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div  class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
          <nav class="w-nav-menu nav-menu bg-gradient" role="navigation">
              <div class="nav-menu-header">
                <div class="logo"><?php  echo $_SESSION['school_name'];?></div>
              </div>
              <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("school_home")?>" data-load="1">
                <div class="icon-list-menu">
                  <div class="icon ion-ios-home-outline"></div>
                </div>
                <div class="nav-menu-titles">首页</div>
              </a>
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("SchoolAdminTeaScore",array("ac"=>"list"))?>" data-load="1">
                    <div class="icon-list-menu">
                    <div class="icon ion-ios-clock-outline"></div>
                    </div>
                    <div class="nav-menu-titles">本月</div>
               </a>
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("SchoolAdminTeaScore",array("ac"=>"year"))?>" data-load="1">
                    <div class="icon-list-menu">
                    <div class="icon  ion-ios-clock-outline"></div>
                    </div>
                    <div class="nav-menu-titles">今年</div>
               </a>
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("SchoolAdminTeaScore",array("ac"=>"day"))?>" data-load="1">
                    <div class="icon-list-menu">
                    <div class="icon  ion-ios-clock-outline"></div>
                    </div>
                    <div class="nav-menu-titles">今日</div>
               </a>               

              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
            </nav>                      
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $page_title;?></div>

          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="body"  style="padding-top:45px;" >
        <ul class="list list-messages" id='cotent'>
            <?php  if(is_array($out_list)) { foreach($out_list as $key => $row) { ?>
                <li class="list-message" data-ix="list-item">
                        <div class="w-clearfix column-left">
                              <div class="image-message background_img list_img"  style="background-image: url(<?php  echo D('teacher')->teacherImg($row['teacher_info']['teacher_id']);?>)"></div>
                        </div>
                        <div class="column-right">
                            <div class="message-title"><?php  echo $row['teacher_info']['teacher_realname'];?></div>
                            <div class="message-text" >积分：<?php  echo $row['all_num'];?></div>
                            <div class="message-text" >排名：<?php  echo $key+1;?></div>
                        </div>
                </li>
            <?php  } } ?>
        </ul>
      </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>