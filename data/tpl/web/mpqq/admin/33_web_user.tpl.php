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
                 <div class="row">
                        <div class="col-md-12  col-sm-12">
                            <?php  if($ac=='list') { ?>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>用户列表</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                        <thead>
                                            <tr>
                                                    <th>ID</th>
                                                    <th>账号名</th>
                                                    <th>昵称</th>
                                                    <th>图像</th>
                                                    <th>状态</th>
                                                    <th>功能组</th>
                                                    <th>数据组</th>
                                                    <th>操作</th>
                                                </tr>
                                           
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr class="odd gradeX">
                                                    <td><?php  echo $row['admin_id'];?></td>
                                                    <td><?php  echo $row['passport'];?></td>
                                                    <td><?php  echo $row['admin_name'];?></td>
                                                    <td><?php  if($row['admin_img']) { ?><img src='<?php  echo $_W['attachurl'].$row['admin_img']?>' width="50"><?php  } ?></td>
                                                    <td>
                                                        <?php  if($row['admin_status'] ==1) { ?>正常<?php  } else { ?><span class='font-red-intense bold'>关闭</span><?php  } ?>
                                                    </td>                                                    
                                                    <td><?php  if(!$row['db_group_id']) { ?>默认创建<?php  } else { ?><?php  echo $row['db_group_name'];?><?php  } ?></td>
                                                    <td><?php  if(!$row['data_group_id']) { ?>默认创建<?php  } else { ?><?php  echo $row['data_group_name'];?><?php  } ?></td>
                                                    <td> <a  href="<?php  echo $this->createWebUrl('user', array('id' => $row['admin_id'],'ac'=>'edit'))?> " class="btn btn-outline btn-circle btn-sm purple">
                                                                <i class="fa fa-edit"></i> 编辑 </a>
                                                         <a  href="<?php  echo $this->createWebUrl('user', array('id' => $row['admin_id'],'ac'=>'delete'))?> " class="btn btn-outline btn-circle btn-sm red">
                                                                <i class="fa fa-close"></i> 删除 </a>
                                                    </td>                                                   
                                                </tr>                                            
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                    <?php  echo $pager;?>
                                </div>
                            </div>
                            <?php  } ?>
                            <?php  if($ac=='new' || $ac=='edit') { ?>
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增管理员账号<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class='form-group  form-md-line-input'>
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>选择功能组</label>
                                            <div class="col-sm-10">
                                                <select id="db_id" class="form-control" name="db_id">
                                                        <option value='0' <?php  if($result['db_group_id']==0) { ?>selected<?php  } ?> >默认创建</option>
                                                    <?php  if(is_array($db_group_list)) { foreach($db_group_list as $row) { ?>
                                                        <option value='<?php  echo $row['group_id'];?>' <?php  if($result['db_group_id']==$row['group_id']) { ?>selected<?php  } ?> ><?php  echo $row['group_name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                         
                                            </div>
                                        </div>	  
                                        <div class='form-group  form-md-line-input'>
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>选择数据组</label>
                                            <div class="col-sm-10">
                                                <select id="data_id" class="form-control" name="data_id">
                                                        <option value='0' <?php  if($result['data_group_id']==0) { ?>selected<?php  } ?> >默认创建</option>
                                                    <?php  if(is_array($data_group_list)) { foreach($data_group_list as $row) { ?>
                                                        <option value='<?php  echo $row['group_id'];?>'  <?php  if($result['data_group_id']==$row['group_id']) { ?>selected<?php  } ?> ><?php  echo $row['group_name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>                                        
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 管理员名称</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="admin_name" id="admin_name" class="form-control" value='<?php  echo $result['admin_name'];?>' required />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 系统账号</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="passport" id="passport" class="form-control" value='<?php  echo $result['passport'];?>'required />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">系统密码</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="password" id="password" class="form-control" value=''   />
                                                <span class="help-block">编辑时不填写不改变原有密码</span>
                                            </div>
                                        </div>
												
                                        <div class="form-group">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>头像</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_image('admin_img',$result['admin_img']);?>
                                            </div>
                                        </div>				
                                        <?php  if($ac=='edit') { ?>
                                            <div class='form-group form-md-line-input '>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='admin_status' class="form-control"  >
                                                    <option value='1' <?php  if(1 ==$result['admin_status']) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='3' <?php  if(3 ==$result['admin_status']) { ?> selected <?php  } ?>>关闭</option>
                                                    <option value='4' <?php  if(4 ==$result['admin_status']) { ?> selected <?php  } ?>>删除</option>
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
                            <?php  } ?>
                        </div>
                    </div>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>