<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <script src="<?php echo MODULE_URL;?>admin/js/util.js"   type="text/javascript"></script>
         <script src="<?php echo MODULE_URL;?>admin/js/require.js"    type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>admin/js/config.js" type="text/javascript"></script>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
       <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> 
                            <small> 系统参数设置【每个公众号需要单独设置】 </small> 
                    </h1>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 系统常规参数</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-body">
                                                        <div class="form-group form-md-line-input">
                                                            <label class=" col-md-2 control-label">应用名</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control" value="<?php  echo S('base','getKeywordContent',array('name'))?>" />
                                                            </div>
                                                          </div>

                                                          
                                                        <div class="form-group form-md-line-input">
                                                            <label class="col-md-2 control-label">版权年份设置</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="yeas" class="form-control" value="<?php  echo S('base','getKeywordContent',array('yeas'))?>" />
                                                            </div>
                                                       </div>

                                                        <div class="form-group form-md-line-input">
                                                            <label class="col-md-2 control-label">版权信息</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="copyright" class="form-control" value="<?php  echo S('base','getKeywordContent',array('copyright'))?>" />
                                                            </div>
                                                       </div>
                                                      <div class="form-group form-md-line-input">
                                                                <label class=" col-md-2 control-label">应用Logo(150px*30px):</label>
                                                                <div class="col-sm-10">
                                                                     <?php  echo tpl_form_field_image('logo',S('base','getKeywordContent',array('logo')) );?>
                                                                </div>
                                                      </div> 		    
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-10">
                                                    			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                                                <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                    </div>
             </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>
           