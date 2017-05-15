<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
           <link href="<?php echo MODULE_URL;?>/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="profile-sidebar">
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <div class="profile-userpic">
                                            <img src="<?php  echo $_W['attachurl'];?><?php  echo $result['admin_img'];?>" class="img-responsive" alt=""> </div>
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php  echo $admin_result['info']['admin_name'];?></div>
                                        </div>
                                  
                                        <div class="profile-usermenu">
                                            <ul class="nav">
                                                <li class="active">
                                                    <a href="javascript:;">
                                                        <i class="icon-settings"></i> 账户设置</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">个人中心</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">个人信息</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <form role="form" action="" method="post" enctype="multipart/form-data" >
                                                                <div class="form-group">
                                                                    <label class="control-label">姓名</label>
                                                                    <input type="text" placeholder="John" class="form-control" name="admin_name" value="<?php  echo $admin_result['info']['admin_name'];?>"/> </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="control-label">头像</label>
                                                                    <?php  echo tpl_form_field_image('admin_img',$result['admin_img']);?>
                                                                <div class="form-group">
                                                                    <label class="control-label">联系电话</label>
                                                                    <input type="text" placeholder="180 0000 0000" class="form-control" name="phone" value='<?php  echo $result['phone'];?> '/> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">修改密码</label>
                                                                    <input type="text" placeholder="留空不修改" class="form-control" name="password" /> </div>
                                                                <div class="margiv-top-10">
                                                                    <input type="submit" class="btn green" name="submit" value="保存">
                                                                    <a href="#" class="btn default"> 取消 </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>