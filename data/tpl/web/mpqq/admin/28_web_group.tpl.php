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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>编辑<?php  } ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>组名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="组名" value="<?php  echo $result['group_name'];?>" name='group_name' required >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                             </div>                
                                            <?php  if(!$_GPC['db']) { ?>
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>分类</label>
                                                <div class="col-md-10">
                                                    <select name="type" class="form-control" onchange="dataTypeChange(this) " >
                                                                <option value="all" >全局</option>
                                                        <?php  if(is_array($type_list)) { foreach($type_list as $row) { ?>
                                                            <option value="<?php  echo $row['key'];?>"   <?php  if($row['key'] == $result['type'] ) { ?> selected <?php  } ?>  ><?php  echo $row['name'];?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                </div>
                                             </div>    
                                           <?php  } ?>
                                           <div class="form-group form-md-radios form-md-line-input ">
                                            <label class="col-md-2 control-label"  >状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="radion" class="md-radiobtn" name="status"   value='1' <?php  if($result['status']==1) { ?> checked <?php  } ?>   />
                                                    <label for="radion">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>正常</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"    id='radion1' class="md-radiobtn" name="status"   value='0' <?php  if($result['status']==0) { ?> checked <?php  } ?>   />
                                                    <label for="radion1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>关闭</label>
                                                </div>
                                            </div>
                                        </div>                                            
                                        <?php  if($_GPC['db']) { ?>
                                            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/fun_list', TEMPLATE_INCLUDEPATH)) : (include template('../admin/fun_list', TEMPLATE_INCLUDEPATH));?>
                                        <?php  } else { ?>
                                            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/data_list', TEMPLATE_INCLUDEPATH)) : (include template('../admin/data_list', TEMPLATE_INCLUDEPATH));?>
                                        <?php  } ?>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="确认">
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
                        <div class="col-md-6">
                            <div class="note note-success">
                                <p>功能组[限制用户功能] </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>功能组列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 组名 </th>
                                                <th> 状态 </th>
                                                <th> 添加时间 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($db_list)) { foreach($db_list as $item) { ?>
                                            <tr>
                                               <td><?php  echo $item['group_name'];?></td>                 
                                               <td><?php  if($item['status']==1) { ?>正常 <?php  } else { ?>关闭<?php  } ?></td>                 
                                               <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>                 
                                               <td style="text-align: center">
                                                   <a  href="<?php  echo $this->createWebUrl('group', array('ac' => 'edit','gid'=>$item['group_id'],'db'=>1 ))?>" class="btn blue">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                               </td>
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="note note-success"> 
                                <p>数据组 [限制用户可以管理的公众号，学校]</p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>数据组列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 组名 </th>
                                                <th> 类型 </th>
                                                <th> 状态 </th>
                                                <th> 添加时间 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($data_list)) { foreach($data_list as $item) { ?>
                                            <tr>
                                               <td><?php  echo $item['group_name'];?></td>                 
                                               <td><?php  echo $class_power->distinguishGroupType($item['type'])?></td>                 
                                               <td><?php  if($item['status']==1) { ?>正常 <?php  } else { ?>关闭<?php  } ?></td>                 
                                               <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>                 
                                               <td style="text-align: center">
                                                   <a  href="<?php  echo $this->createWebUrl('group', array('ac' => 'edit','gid'=>$item['group_id'],'data'=>1 ))?>" class="btn blue">
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