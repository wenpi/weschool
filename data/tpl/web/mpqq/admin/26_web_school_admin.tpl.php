<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增学校管理员<?php  } else { ?>修改<?php  } ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                    <div class='form-group form-md-line-input '>
                                                        <label class=" col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统账号(_先设置一个名字为“学校组”的用户组)</label>
                                                        <div class="col-sm-10">
                                                            <?php  if($ac=='edit') { ?>
                                                                <?php  echo $result['username'];?>
                                                            <?php  } else { ?>
                                                                <input name='passport' class='form-control' value=''>
                                                            <?php  } ?>
                                                        </div>	
                                                    </div>
                                                    <div class='form-group form-md-line-input '>
                                                        <label class=" col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统密码</label>
                                                        <div class="col-sm-10">
                                                            <input name='password' class='form-control' value='<?php  echo $result['password'];?>'>
                                                             <div class="form-control-focus"> </div>
                                                             <span class="help-block">留空不修改</span>
                                                        </div>	
                                                    </div>								
                                                    <?php  if($ac=='edit') { ?>
                                                        <div class='form-group form-md-line-input  '>
                                                            <label class=" col-md-2 control-label"><span class="required" aria-required="true"> * </span>状态</label>
                                                            <div class="col-sm-10">
                                                            <select name='status'  class='form-control' >
                                                                    <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                                    <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                                            </select>
                                                            </div>							
                                                        </div>
                                                    <?php  } ?>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                    </div>
                                                </div>
                                            </div>                                                                                
                                    </form>
                                  </div>    
                             </div>            
                      </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p>可以直接管理当前学校的人员 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>管理人员列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <!--<a href="#portlet-config" data-toggle="modal" class="config"> </a>-->
                                        <!--<a href="javascript:;" class="reload"> </a>-->
                                        <!--<a href="javascript:;" class="remove"> </a>-->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th width="20%" > 账号 </th>
                                                <th> 	学校 </th>
                                                <th >   状态 </th>
                                                <th >     </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['username'];?></td>
                                                <td><?php  echo $item['school_name'];?></td>
                                                <td>
                                                    <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='font-red-intense bold'>关闭</span><?php  } ?>
                                                </td>
                                                <td style="text-align:center;">
                                                <a href="<?php  echo $this->createWebUrl('school_admin', array('admin_id' => $item['admin_id'],'ac'=>'edit','aw'=>1))?>"
                                                        class="btn btn-default btn-sm"  title="编辑">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                </td>
                                            </tr>
                                            <?php  } } ?>                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>