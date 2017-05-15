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
                                                <div class="form-group">
                                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>姓名</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="admin_name" id="admin_name" class="form-control" value='<?php  echo $result['admin_name'];?>' />
                                                            </div>
                                                 </div>
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span class="required" aria-required="true"> * </span>照片</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <?php  echo tpl_form_field_image('admin_img',$result['admin_img']);?>
                                                    </div>
                                                </div>	
                                                    <div class='form-group form-md-line-input '>
                                                        <label class=" col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统账号</label>
                                                        <div class="col-sm-10">
                                                            <?php  if($ac=='edit') { ?>
                                                                <?php  echo $result['passport'];?>
                                                            <?php  } else { ?>
                                                                <input name='passport' class='form-control' value=''>
                                                            <?php  } ?>
                                                        </div>	
                                                    </div>

                                                    <div class='form-group form-md-line-input '>
                                                        <label class=" col-md-2 control-label"><span class="required" aria-required="true"> * </span>系统密码</label>
                                                        <div class="col-sm-10">
                                                            <input name='password' class='form-control' value=''>
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
                                                                    <option value='0' <?php  if(0 ==$result['status'] && isset($result['status']) ) { ?> selected <?php  } ?>>关闭</option>
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
                                        <?php  if($have_up) { ?>
                                            <a href="<?php  echo $this->createWebUrl('school_admin',array('ac'=>'up_to_new') )?>"><button class="btn red" type="button">请马上点击此处升级到新的账户体系</button></a>	
                                        <?php  } ?>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
	
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th width="20%" > 账号 </th>
                                                <th> 	账号名 </th>
                                                <th> 	头像 </th>
                                                <th >   状态 </th>
                                                <th >   绑定人员 </th>
                                                <th >     </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['passport'];?></td>
                                                <td><?php  echo $item['admin_name'];?></td>
                                                <td><?php  if($item['admin_img']) { ?><img src='<?php  echo $_W['attachurl'].$item['admin_img']?>' width="50"><?php  } ?></td>
                                                <td>
                                                    <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='font-red-intense bold'>关闭</span><?php  } ?>
                                                </td>
                                                <td> 
                                                        <?php  if($item['mobile_uid']) { ?>
                                                        <?php  $fanid = $this->class_base->mobileGetFanidByUid($item['mobile_uid']);?>
                                                        <?php  echo $this->find_user($fanid);?>
                                                        <?php  } ?>
                                                </td>
                                                <td style="text-align:center;">
                                                    <a href="<?php  echo $this->createWebUrl('school_admin', array('admin_id' => $item['school_admin_id'],'ac'=>'edit'))?>"
                                                        class="btn btn-default btn-sm"  title="编辑">
                                                            <i class="fa fa-edit"></i> 编辑
                                                    </a>
                                                    <?php  if($item['mobile_uid']) { ?>
                                                     <a href="<?php  echo $this->createWebUrl('school_admin', array('admin_id' => $item['school_admin_id'],'ac'=>'unbundling'))?>"
                                                        class="btn btn-default btn-sm"  title="解绑">
                                                            <i class="fa fa-trash-o red"></i> 解绑
                                                     </a>                                                         
                                                    <?php  } ?>
                                                  
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