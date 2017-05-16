<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/codemirror/lib/codemirror.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/codemirror/theme/neat.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/codemirror/theme/ambiance.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/codemirror/theme/material.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo MODULE_URL;?>/assets/global/plugins/codemirror/theme/neo.css" rel="stylesheet" type="text/css" />
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
                                        <i class=" fa fa-plus  font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>菜单名</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"   value="<?php  echo $result['caidan_name'];?>" name='caidan_name' required >
                                                        <?php  if($ac=='edit') { ?>
                                                            <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['caidan_id'];?>' />
                                                        <?php  } ?>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div> 
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>链接地址</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"   value="<?php  echo $result['caidan_url'];?>" name='caidan_url' required  placeholder="http://baidu.com" >
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div> 
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>菜单图标</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"   value="<?php  echo $result['caidan_font'];?>" name='caidan_font' required  >
                                                        <div class="form-control-focus"> </div>
                                                        <span class="">[填写格式：fa fa-*]<a target="_blank" href='http://fontawesome.io/icons/'>(http://fontawesome.io/icons/)</a>[不要使用最新的图标]</span>
                                                    </div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">分类</label>
                                                    <div class="col-sm-10">
                                                        <select name='class_id'  class="form-control" >
                                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                               <option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id'] == $result['class_id']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>                       
                                                    </div>
                                            </div>                                                                                          
                                           <div class='form-group form-md-line-input ' >
                                                <label class=" col-md-2 control-label">状态</label>
                                                <div class="col-sm-10 ">
                                                <select name='status' class="form-control" >
                                                        <?php  echo S('fun','statusOut',array(intval($result['status'])))?>
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
                        <div class="col-md-8">
                            <div class="portlet box green-turquoise ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-flag"></i>菜单分类列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll ">
                                    <table class="table table-bordered table-striped table-condensed flip-content table-light"  >
                                        <thead class="flip-content">
                                            <tr>
                                                <th>名</th>
                                                <th>网址</th>
                                                <th>图标 </th>
                                                <th>状态 </th>
                                                <th style="text-align:center;"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($class_list)) { foreach($class_list as $item) { ?>
                                            <tr class="success">
                                                <td><?php  echo $item['class_name'];?></td>
                                                <td></td>
                                                <td> <i class="<?php  echo $item['class_font'];?>"></i></td>
                                                <td> <span class="label label-sm label-warning" > <?php  echo S('fun','statusTable',array($item['status']))?></span> </td>
                                                <td> <a   class="btn btn-outline btn-circle btn-sm my_btn_class " href="<?php  echo $this->createWebUrl('caidanClass', array('ac' => 'edit','id'=>$item['class_id'] ))?>" >
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                            </tr>
                                                <?php  if(is_array($item['list'])) { foreach($item['list'] as $val) { ?>
                                                <tr >
                                                    <td> <?php  echo $val['caidan_name'];?></td>
                                                    <td> <?php  echo $val['caidan_url'];?></td>
                                                    <td> <i class="<?php  echo $val['caidan_font'];?>"></i></td>
                                                    <td><span class="label label-sm label-warning" > <?php  echo S('fun','statusTable',array($val['status']))?> </span> </td>
                                                    <td>
                                                                <a href="<?php  echo $this->createWebUrl('caidan', array('id' => $val['caidan_id'],'ac'=>'edit' ))?>"
                                                                    class="btn btn-outline btn-circle btn-sm my_btn_class " >
                                                                    <i class="fa fa-edit"></i> 编辑
                                                                </a>
                                                    </td>                          
                                                </tr>                                          
                                                <?php  } } ?>
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