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
                <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                    <div class="w-dropdown dropdown-container" data-delay="0">
                        <div class="w-dropdown-toggle w-clearfix nav-menu-link dropdown">
                            <div class="icon-list-menu">
                                <div class="icon ion-person-stalker"></div>
                            </div>
                            <div class="nav-menu-titles"><?php  echo $row['grade_name'];?></div>
                            <div class="w-icon-dropdown-toggle dropdown-icon"></div>
                        </div>
                        <?php  if(is_array($row['second'])) { foreach($row['second'] as $item) { ?>
                            <nav class="w-dropdown-list drop-down-list">
                                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl('schoolAdminStudentRecord',array("cid"=>$item['class_id']));?>" data-load="1">
                                <div class="icon-list-menu">
                                    <div class="icon ion-android-contacts"></div>
                                </div>
                                <div class="nav-menu-titles"><?php  echo $item['class_name'];?></div>
                                </a>
                            </nav>
                        <?php  } } ?>
                    </div>                
                <?php  } } ?>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
            </nav>                      
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $grade_name;?><?php  echo $class_name;?>-学生列表</div>

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
            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                <li class="list-message" data-ix="list-item">
                    <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('schoolAdminStudentRecordInfo',array("id"=>$row['student_id']) )?>" data-load="1">
                    <div class="w-clearfix column-left">
                        <div class="image-message background_img list_img"  style="background-image: url(<?php  echo C('student')->studentImg($row['student_id']);?>)"></div>
                    </div>
                    <div class="column-right">
                        <div class="message-title" style="position: relative;top:10px; "><?php  echo $row['student_name'];?></div>
                        <div class="message-text " style="text-align: right;font-size: 0.6rem;"> 去给学生添加记录吧</div>
                    </div>
                    </a>
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