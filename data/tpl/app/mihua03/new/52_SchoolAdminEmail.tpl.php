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
               <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("schoolAdminEmail",array("ac"=>'list'))?>" data-load="1">
                    <div class="icon-list-menu">
                      <div class="ion-ios-locked-outline"></div>
                    </div>
                    <div class="nav-menu-titles">未处理</div>
              </a>
              <a class="w-clearfix w-inline-block nav-menu-link" href="<?php  echo $this->createMobileUrl("schoolAdminEmail",array("ac"=>'new'))?>" data-load="1">
                    <div class="icon-list-menu">
                      <div class="ion-ios-unlocked-outline"></div>
                    </div>
                    <div class="nav-menu-titles">已处理</div>
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
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/SchoolAdminEmail_content', TEMPLATE_INCLUDEPATH)) : (include template('../new/SchoolAdminEmail_content', TEMPLATE_INCLUDEPATH));?>
        </ul>
      <h1 id='add_msg' style="text-align:center;font-size: 0.8rem; background:#fff; ">正在加载...</h1>  
      </div>
    </div>

  </section>
  <script>
      $(function(){
        var pager = 1;
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                if(pager==0) return false;
                pager++;       
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('SchoolAdminEmail')?>',
                type:'post',
                data:{s_n_page:pager,ac:'<?php  echo $ac;?>',ajax:1},
                dataType:'text',
                async:'false',
                success:function(html){
                        if(html =='done' ){
                            $("#add_msg").html("已经全部查看！");
                            pager=0;
                        }else{
                            $('#cotent').append(html);   
                        }
                    }
                });
            }
        });
      });
  </script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('school/app_footer', TEMPLATE_INCLUDEPATH)) : (include template('school/app_footer', TEMPLATE_INCLUDEPATH));?>
</body>
</html>