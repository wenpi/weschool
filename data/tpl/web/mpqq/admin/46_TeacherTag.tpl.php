<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> 
                            <small> <?php  echo $title;?> </small>
                    </h1>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 新增标签</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>标签名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="标签名" name='tag_name' required autofocus>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="hidden" name="ac" value="new">
                                                        <input type="submit" name="submit" class="btn blue" value="确认">
                                                    </div>
                                                </div>
                                            </div>                                                                                
                                    </form>
                                  </div>    
                             </div> 
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>标签列表 <b class="font-red"><?php  echo $out_msg;?></b></div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                        <tr>
                                            <th>名称<b class="font-red">【点击标签名编辑，点击其他区域提交】</b></th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr>
                                                        <td><input value='<?php  echo $item['tag_name'];?>' data-id ='<?php  echo $item['tag_id'];?>' data-name='tag_name' onblur="ajaxChange(this,'<?php  echo $this->createWebUrl('teacherTag',array('ac'=>'edit'))?>')" class="col-md-4 font-blue-steel"></td>
                                                        <td>
                                                                <a  href="<?php  echo $this->createWebUrl('teacherTag',array("id"=>$item['tag_id'],'ac'=>'delete' ) );?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-close"></i> 删除 </a>
                                                        </td>
                                                    </tr>
                                                    <?php  } } ?>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
           
                        </div>
                    </div>
        </div>
        </div>

         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/ajaxChange', TEMPLATE_INCLUDEPATH)) : (include template('../admin/ajaxChange', TEMPLATE_INCLUDEPATH));?>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>