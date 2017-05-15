<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
   <style>
       .page-content{
           margin-left:0px !important;
       }
   </style>
    <div class="page-container">
        <div class="page-content-wrapper">
	    <div class="page-content" >
             <h1 class="page-title"> 公众号列表
                        <small>请选择你要管理的公众号</small>
              </h1>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                      <!-- BEGIN : LISTS -->
                    <div class="row">
                        <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <div class="col-lg-4" >
                            <div class="portlet light portlet-fit ">
                                <div class="portlet-body">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-news ext-1 font-white bg-grey-gallery">
                                            <div class="list-head-title-container">
                                                <h3 class="list-title"><?php  echo $row['name'];?></h3>
                                            </div>
                                            <div class="list-count pull-right bg-red"><?php  echo $row['rank'];?></div>
                                        </div>
                                        <div class="mt-list-container list-news ext-1"  style="min-height:200px;">
                                            <ul>
                                                <li class="mt-list-item">
                                                    <div class="list-icon-container">
                                                        <a href="<?php  echo $this->createWebUrl("adminloginCheck",array("uniacid"=>$row['uniacid'],'ac'=>'change' ));?> ">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="list-thumb">
                                                        <a href="<?php  echo $this->createWebUrl("adminloginCheck",array("uniacid"=>$row['uniacid'],'ac'=>'change' ));?> ">
                                                            <?php  $img = tomedia('headimg_'.$row['acid'].'.jpg');  ?>
                                                            <img alt="" src="<?php  if($img) { ?><?php  echo $img;?><?php  } ?>" onerror="this.src='<?php echo MODULE_URL;?>logo.png'"  width="100"/>
                                                        </a>
                                                    </div>
                                                    <div class="list-datetime bold uppercase font-red">  <?php  echo $row['setmeal']['groupname'];?> </div>
                                                    <div class="list-item-content">
                                                        <h3 class="uppercase">
                                                            <a href="<?php  echo $this->createWebUrl("adminloginCheck",array("uniacid"=>$row['uniacid'],'ac'=>'change' ));?>"><?php  echo $row['name'];?></a>
                                                        </h3>
                                                        <p><?php  echo $row['description'];?> </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                     
                        <?php  } } ?>
                     
                    </div>
                    <!-- END : LISTS -->      
                </div>
             </div>
              <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
          <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
    </body>
    </html>