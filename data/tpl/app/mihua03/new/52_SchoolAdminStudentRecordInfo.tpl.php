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
                <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("schoolAdminStudentRecord",array("cid"=>$student_info['class_id']))?>" data-load="1">
                    <div class="icon-list-menu">
                    <div class="icon ion-reply"></div>
                    </div>
                    <div class="nav-menu-titles">回到列表</div>
               </a>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
              <div class="separator-bottom"></div>
            </nav>                      
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $student_info['student_name'];?>-记录列表</div>

          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
          <a class="w-inline-block navbar-button right" href="<?php  echo $this->createMobileUrl('schoolAdminStudentRecordInfoAdd',array("id"=>$student_id))?>" data-load="1" data-ix="search-box">
            <div class="navbar-button-icon smaller icon ion-compose"></div>
          </a>
        </div>
      </div>
      <div class="body"  style="padding-top:45px;" >
        <ul class="list list-messages" id='cotent'>
            <?php  if(is_array($re['list'])) { foreach($re['list'] as $row) { ?>
                <li class="list-message" data-ix="list-item">
                    <a class="w-clearfix w-inline-block" href="<?php  echo $this->createMobileUrl('schoolAdminStudentRecordInfoEdit',array("id"=>$row['work_id']) )?>" data-load="1">
                        <div class="w-clearfix column-left">
                            <div class="image-message"><img src="<?php  if($row['img']) { ?> <?php  echo $this->imgFrom($row['img']);?> <?php  } else { ?> <?php  echo C('student')->studentImg($row['student_id']);?> <?php  } ?>">
                            </div>
                        </div>
                        <div class="column-right">
                            <div class="message-title"><?php  echo $row['word'];?></div>
                            <div class="message-text"><?php  echo $row['content'];?></div>
                            <div class="message-text " style="text-align: right;font-size: 0.6rem;"> <?php  echo date("Y-m-d H:i:s",$row['addtime']);?></div>
                        </div>
                    </a>
                </li>
            <?php  } } ?>
        </ul>
      </div>
    </div>

  </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>