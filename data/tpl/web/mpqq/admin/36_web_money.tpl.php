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
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增设备<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                       
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>付费时间限制</label>
                                            <div class="col-sm-10">
                                                <select name='limit_type' id="limit_type" class="form-control" >
                                                        <option value='1' <?php  if($result['limit_type']==1) { ?> selected <?php  } ?>>一次缴费，永远免费</option>
                                                        <option value='2' <?php  if($result['limit_type']==2) { ?> selected <?php  } ?>>按年</option>
                                                        <option value='3' <?php  if($result['limit_type']==3) { ?> selected <?php  } ?>>按月</option>
                                                </select>
                                            </div>	
                                        </div>	

                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>标题</label>
                                            <div class="col-sm-10">
                                                <input type='text' value='<?php  echo $result['limit_name'];?>' name='limit_name' class='form-control' >
                                                <?php  if($ac=='edit') { ?>
                                                <input type='hidden' value='<?php  echo $result['limit_id'];?>' name='limit_id'>
                                                <?php  } ?>
                                            </div>	
                                        </div>
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>金额</label>
                                            <div class="col-sm-10">
                                                <input type='text' value='<?php  echo $result['limit_much'];?>' name='limit_much' class='form-control' >
                                            </div>	
                                        </div>
                                        
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>限制模块</label>
                                            <div class="col-sm-10">
                                                请填写每个模块访问链接do=后面的关键字;如[do=lianhu&ac=list]则填写lianhu &nbsp;&nbsp;[可同时限制多个]
                                                <input type='text' value='<?php  echo $result['limit_module'];?>' name='limit_module' class='form-control' >
                                            </div>	
                                        </div>
                                            <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control">
                                                    <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>生效</option>
                                                    <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
                                            </select>
                                            </div>							
                                            </div>     
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
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p>  收费管理列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 收费管理列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th > 名称</th>
                                                <th > 金额</th>
                                                <th >发布时间</th>
                                                <th >收费机制</th>
                                                <th >参与人数</th>
                                                <th >目前总额</th>
                                                <th >状态</th>
                                                <th >操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr>
                                                    <td><?php  echo $row['limit_name'];?></td>
                                                    <td><?php  echo $row['limit_much'];?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$row['addtime'])?></td>
                                                    <td><?php  echo $limit_type_arr[$row['limit_type']]?></td>
                                                    <td><?php  echo $this->money_people_num($row['limit_id']);?></td>
                                                    <td><?php  echo $this->money_much($row['limit_id']);?></td>
                                                    <td> <?php  if($row['status']==1) { ?>生效中<?php  } else { ?>关闭<?php  } ?></td>
                                                    <td><a href="<?php  echo $this->createWebUrl('money',array('limit_id'=>$row['limit_id'],'ac'=>'edit','aw'=>1) )?>" class="btn btn-outline btn-circle dark btn-sm black"> <i class="fa fa-edit"></i>编辑</a>
                                                    <a href="<?php  echo $this->createWebUrl('moneylist',array('limit_id'=>$row['limit_id'],'ac'=>'list','aw'=>1) )?>" class="btn btn-outline btn-circle dark btn-sm black"> <i class="fa fa-eye"></i>查看缴费</a></td>
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