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
                    <script>
                        function classLevel(obj){
                            val = $(obj).val();
                            if(val==2){
                                $("#pid").show();
                            }else{
                                $("#pid").hide();
                            }
                        }
                    </script>
                     <div class="row">
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                       
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>分类名称</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="class_name" id="class_name" class="form-control" value='<?php  echo $result['class_name'];?>' required />
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>排序</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="sort" id="sort" class="form-control" value='<?php  echo $result['sort'];?>' required />
                                                    </div>
                                                </div>
                                                 <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">分类级别</label>
                                                    <div class="col-sm-10">
                                                        <select name='class_level'  class="form-control"  onchange="classLevel(this)">
                                                            <option value='1' <?php  if(1 == $result['class_level'] || !$result['class_level']  ) { ?> selected <?php  } ?>>一级</option>
                                                            <option value='2' <?php  if(2 == $result['class_level']) { ?> selected <?php  } ?>>二级【二级分类下才可以添加视频】</option>
                                                        </select>                                                         
                                                    </div>
                                                </div>
                                                  <div id='pid' class="form-group form-md-line-input" <?php  if($result['class_level']==1 || !$result ) { ?> style="display:none"<?php  } ?>>
                                                    <label class=" col-md-2 control-label">父级分类</label>
                                                    <div class="col-sm-10">
                                                        <select name='pid'  class="form-control" >
                                                            <?php  if(is_array($top_video_class_list)) { foreach($top_video_class_list as $row) { ?>
                                                               <option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id'] == $result['pid']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>                       
                                                    </div>
                                                </div> 

                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">分类图片</label>
                                                    <div class="col-sm-10">
                                                         <?php  echo tpl_form_field_image('class_img',$result['class_img']);?>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>是否只有校内可看</label>
                                                    <div class="col-sm-10">
                                                        <select name='limit_display'  class="form-control" >
                                                            <option value='1' <?php  if(1 ==$result['limit_display']) { ?> selected <?php  } ?>>限制</option>
                                                            <option value='0' <?php  if(0 ==$result['limit_display']) { ?> selected <?php  } ?>>不限制</option>
                                                        </select>                       
                                                    </div>
                                                </div>                -->
                                                  <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='status'  class="form-control" >
                                                            <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                            <option value='0' <?php  if(0 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
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
                                <p> 视频分类列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>视频分类列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>视频分类名</th>
                                                <th>级别</th>
                                                <th>排序</th>
                                                <th>图片</th>
                                                <!--<th>是否限制</th>-->
                                                <th>状态</th>
                                                <th>添加时间</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr class="success">
                                                    <td><?php  echo $item['class_name'];?></td>
                                                    <td><?php  echo $item['class_level'];?></td>
                                                    <td><?php  echo $item['sort'];?></td>
                                                    <td><img src='<?php  echo $_W['attachurl'];?><?php  echo $item['class_img'];?>' width="50"></td>
                                                    <!--<td><?php  if($item['limit_display']==1) { ?>限制<?php  } else { ?>不限制<?php  } ?></td>-->
                                                    <td><?php  if($item['status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'edit','id'=>$item['class_id']))?>"  class="btn btn-outline btn-circle s btn-sm black"> <i class="fa fa-edit"></i>编辑</a>
                                                        <?php  if($item['next_count']==0) { ?>
                                                            <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'delete','id'=>$item['class_id']))?>"  class="btn btn-outline btn-circle s btn-sm dark"> <i class="fa fa-times-circle-o"></i>删除</a>
                                                        <?php  } ?>
                                                    </td>
                                                </tr>
                                                <?php  if(is_array($item['list'])) { foreach($item['list'] as $val) { ?>
                                                  <tr>
                                                    <td><?php  echo $val['class_name'];?></td>
                                                    <td><?php  echo $val['class_level'];?></td>
                                                    <td><?php  echo $val['sort'];?></td>
                                                    <td><img src='<?php  echo $_W['attachurl'];?><?php  echo $val['class_img'];?>' width="50"></td>
                                                    <!--<td><?php  if($val['limit_display']==1) { ?>限制<?php  } else { ?>不限制<?php  } ?></td>-->
                                                    <td><?php  if($val['status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$val['add_time']);?></td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'edit','id'=>$val['class_id']))?>"  class="btn btn-outline btn-circle  btn-sm black"> <i class="fa fa-edit"></i>编辑</a>
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'delete','id'=>$item['class_id']))?>"  class="btn btn-outline btn-circle s btn-sm dark"> <i class="fa fa-times-circle-o"></i>删除</a>
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