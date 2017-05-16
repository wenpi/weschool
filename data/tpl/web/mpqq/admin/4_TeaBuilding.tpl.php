<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $this->school_info['school_name']?></h1>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> <?php  echo $title;?>  </p>
                            </div>
                            <?php  if($ac=='new' || $ac=='edit') { ?>
                              <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">	<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                             <div class = "form-group">
                                                     <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>楼栋名</label>
                                                     <div class="col-sm-10">
                                                                 <input name='building_name' class='form-control ' value='<?php  echo $result['building_name'];?>'>
                                                      </div>
                                                      <?php  if($ac=='edit') { ?>
                                                        <input type="hidden" name="building_id" value="<?php  echo $_GPC['id'];?>">
                                                      <?php  } ?>
                                              </div>  
                                              <div class="form-group">
                                                <label class="col-md-2 control-label"  >状态</label>
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio" name="status" id="radio6" class="md-radiobtn"  value='1' <?php  if($ac=='new') { ?> checked <?php  } else { ?> <?php  if($result['status']==1) { ?> checked <?php  } ?> <?php  } ?> />
                                                        <label for="radio6">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>正常</label>
                                                    </div>
                                                    <div class="md-radio">
                                                    <input type="radio"   name="status" id='radio7'   class="md-radiobtn" value='0' <?php  if($ac=='edit') { ?> <?php  if($result['status']==0) { ?> checked <?php  } ?>  <?php  } ?>/>
                                                        <label for="radio7">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>注销</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="提交">
                                                    </div>
                                                </div>
                                            </div>                                                                                
                                    </form>
                                  </div>    
                             </div>  
                            <?php  } else { ?>
                            <div class="portlet box green-turquoise">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-navicon"></i><?php  echo $title;?>列表 </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content" >
                                        <thead class="flip-content">
                                        <tr>
                                            <th>ID</th>
                                            <th>楼栋号</th>
                                            <th>状态</th>
                                            <th>添加时间</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                    <tr>
                                                        <td><?php  echo $item['building_id'];?></td>
                                                        <td><?php  echo $item['building_name'];?></td>
                                                        <td><?php  echo statusTable($item['status'])?></td>
                                                        <td><?php  echo timeToStr($item['add_time'])?></td>
                                                        <td style="text-align: left">
                                                                <a  href="<?php  echo $this->createWebUrl('teaBuilding',array("id"=>$item['building_id'],'ac'=>'edit' ) );?> " class="btn blue">
                                                                <i class="fa fa-edit"></i> 编辑 </a>
                                                                <a  href="<?php  echo $this->createWebUrl('teaBuilding',array("id"=>$item['building_id'],'ac'=>'delete' ) );?> " class="btn red">
                                                                <i class="fa fa-close"></i> 删除 </a>
                                                        </td>
                                                    </tr>
                                            <?php  } } ?>                                    
                                        </tbody>
                                    </table>
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