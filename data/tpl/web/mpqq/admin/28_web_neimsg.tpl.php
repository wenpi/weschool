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
                <?php  if($op =='edit'|| $op =='new' ) { ?>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">	<?php  if($ac=='new') { ?>新增站内信<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
               
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>公告标题</label>
                                                <div class="col-md-10">
                                                 		<input type="text" name="msg_title" id="msg_title" class="form-control" value='<?php  echo $result['msg_title'];?>' required/>
                                                        <?php  if($op=='edit') { ?>
                                                          <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['msg_id'];?>' />
                                                        <?php  } ?>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>    
                                            
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>封面图</label>
                                                <div class="col-md-10">
                                                    <?php  echo tpl_form_field_image('img',$result['img']);?>
                                                </div>
                                            </div> 

                                            <div class="form-group  form-md-line-input ">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>公告详细内容</label>
                                                <div class="col-sm-10">
                                                    <?php  echo tpl_ueditor('msg_content',$result['msg_content']);?>
                                                </div>
                                            </div>															
                                            <?php  if($op=='edit') { ?>
                                                <div class='form-group  form-md-line-input '>
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>公告可见状态</label>
                                                <div class="col-sm-10">
                                                <select name='status' class='form-control'>
                                                        <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                        <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
                                                </select>
                                                </div>							
                                                </div>
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
                <?php  if($op=='display') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 公告列表 </p>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>公告列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content" id="sample_3">
                                        <thead class="flip-content">
                                            <tr>
                                                <th >ID</th>
                                                <th >标题</th>
                                                <th >添加时间</th>
                                                <th >状态</th>
                                                <th ></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['msg_id'];?></td>
                                                <td><?php  echo $item['msg_title'];?></td>
                                                <td><?php  if($item['add_time']) { ?><?php  echo date("Y-m-d H:i:s",$item['add_time'])?><?php  } else { ?><?php  echo date("Y-m-d H:i:s",$item['addtime'])?><?php  } ?></td>
                                                <td>
                                                    <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?>
                                                </td>
                                                </td>
                                                <td style="text-align:right;">
                                                    <a href="<?php  echo $this->createWebUrl('neimsg', array('id' => $item['msg_id'],'op'=>'edit','aw'=>1))?>" class="btn blue"  >
                                                        <i class="fa fa-pencil"></i>编辑</a>
                                                    <a href="<?php  echo $this->createWebUrl('neimsg', array('id' => $item['msg_id'], 'op'=>'delete','aw'=>1))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn red"  >
                                                        <i class="fa fa-times"></i>删除</a>
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
     <?php  if($op=='display') { ?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>   
     <?php  } ?>
         </body>
    </html>