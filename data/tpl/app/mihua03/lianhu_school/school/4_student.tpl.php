<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_header', TEMPLATE_INCLUDEPATH)) : (include template('school/app_header', TEMPLATE_INCLUDEPATH));?>
<body>
  <section class="w-section mobile-wrapper">
    <div class="page-content" id="main-stack">
      <div class="w-nav navbar" data-collapse="all" data-animation="over-left" data-duration="400" data-contain="1" data-easing="ease-out-quint" data-no-scroll="1">
        <div class="w-container">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_left', TEMPLATE_INCLUDEPATH)) : (include template('school/app_left', TEMPLATE_INCLUDEPATH));?>
          <div class="wrapper-mask" data-ix="menu-mask"></div>
          <div class="navbar-title"><?php  echo $simple_title;?></div>
          <div class="w-nav-button navbar-button left" id="menu-button" data-ix="hide-navbar-icons">
            <div class="navbar-button-icon home-icon">
              <div class="bar-home-icon top"></div>
              <div class="bar-home-icon middle"></div>
              <div class="bar-home-icon bottom"></div>
            </div>
          </div>
        </div>
      </div>
    <div class="body">
        <div class="home-content">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/school_grade_class', TEMPLATE_INCLUDEPATH)) : (include template('school/school_grade_class', TEMPLATE_INCLUDEPATH));?>
          </div>
          <div class="home-content">
            <div class="text-new grey">
              <div class="separator-fields"></div>
              <h1 class="title-h1">学生绑定率!</h1>
              <div class="separator-fields"></div>
                <p class="description-new">被微信号绑定数超过一个的比例</p>
                  <div class="index_people">
                       <?php  echo $info['bangding_count'];?>/<?php  echo $info['count'];?> &nbsp;= &nbsp;<?php  echo $lv;?>
                  </div>
              <div class="separator-fields"></div>
              <div class="separator-fields"></div>
            </div>
          </div>
          <div class='table'>
              <table class="bordered">
                  <thead>
                  <tr>
                      <th>学生名</th>        
                      <th>是否绑定</th>
                  </tr>
                  </thead> 
                  <tbody>
                    <?php  if(is_array($student_list)) { foreach($student_list as $row) { ?>
                      <tr>
                        <td><?php  echo $row['student_name'];?></td>
                        <?php  if($row['fanid']>0 || $row['fanid1'] >0  || $row['fanid2']>0) { ?>
                          <td><code>绑定</code></td>
                        <?php  } else { ?>
                          <td>未绑定</td>
                        <?php  } ?>
                      </tr>
                    <?php  } } ?>
                  </tbody>
              </table>

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