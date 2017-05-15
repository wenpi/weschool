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
                            <?php  if(is_array($cclass_eduList->list_types)) { foreach($cclass_eduList->list_types as $row) { ?>
                                $("#<?php  echo $row['id'];?>").hide();
                                if(val == <?php  echo $row['type'];?>){
                                    $("#<?php  echo $row['id'];?>").show();
                                }
                            <?php  } } ?>
                            
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
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频名称</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="list_name" id="list_name" class="form-control" value='<?php  echo $result['list_name'];?>' required />
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频时长</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="list_min" id="list_min" class="form-control" value='<?php  echo $result['list_min'];?>' required />
                                                    </div>
                                                </div>                                                
                                                 <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频简介</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="list_intro"  required ><?php  echo $result['list_intro'];?></textarea>
                                                    </div>
                                                </div>       
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频分类</label>
                                                    <div class="col-sm-10">
                                                        <select name="class_id" class="form-control"  >
                                                                <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                  <option value='<?php  echo $row['class_id'];?>' disabled ><?php  echo $row['class_name'];?></option>
                                                                       <?php  if(is_array($row['list'])) { foreach($row['list'] as $val) { ?>
                                                                           <option value='<?php  echo $val['class_id'];?>' <?php  if($result['class_id'] == $val['class_id'] ) { ?> selected <?php  } ?> >&nbsp;&nbsp<?php  echo $val['class_name'];?></option>
                                                                       <?php  } } ?>
                                                                  <?php  } } ?>
                                                          </select>
                                                    </div>
                                                </div>                                                                   
                                                 <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">视频类型</label>
                                                    <div class="col-sm-10">
                                                        <select name='list_src_type'  class="form-control"  onchange="classLevel(this)">
                                                            <?php  if(is_array($cclass_eduList->list_types)) { foreach($cclass_eduList->list_types as $key => $row) { ?>
                                                                <?php  $selected = ""?>
                                                                <?php  if($result['list_src_type']==$row['type'] || (!$result['list_src_type'] && $key==0) ) { ?>
                                                                    <?php  $selected = "selected"?>
                                                                <?php  } ?>
                                                                 <option value='<?php  echo $row['type'];?>' <?php  echo $selected;?>><?php  echo $row['name'];?></option>
                                                            <?php  } } ?>
                                                        </select>                                                         
                                                    </div>
                                                </div>
                                                  <div id='m3u8' class="form-group form-md-line-input" <?php  if($result['list_src_type']!=0  ) { ?> style="display:none"<?php  } ?>>
                                                    <label class=" col-md-2 control-label">流地址</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="list_src" id="list_src" class="form-control" value='<?php  echo $result['list_src'];?>' placeholder="http:// 或者 https://"  />
                                                    </div>
                                                </div> 
                                                <div id='iframe' class="form-group form-md-line-input" <?php  if($result['list_src_type']!=1) { ?> style="display:none"<?php  } ?>>
                                                    <label class=" col-md-2 control-label">iframe模式</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="list_src_content" id="list_src_content" class="form-control" value='<?php  echo $result['list_src_content'];?>' placeholder="http:// 或者 https://"  />
                                                        <span class="help_block">获取iframe中src地址填写至此</span>
                                                    </div>
                                                </div> 
                                                <div id='href' class="form-group form-md-line-input" <?php  if($result['list_src_type']!=2 ) { ?> style="display:none"<?php  } ?>>
                                                    <label class=" col-md-2 control-label">跳转网址格式</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="list_src_content2"  class="form-control" value='<?php  echo $result['list_src_content'];?>' placeholder="http:// 或者 https://"  />
                                                    </div>
                                                </div> 

                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">封面图片</label>
                                                    <div class="col-sm-10">
                                                         <?php  echo tpl_form_field_image('list_img',$result['list_img']);?>
                                                    </div>
                                                </div>
                                                  <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='status'  class="form-control" >
                                                            <option value='0' <?php  if(0 ==$result['status']  ) { ?> selected <?php  } ?>>关闭</option>
                                                            <option value='1' <?php  if(1 ==$result['status']  ) { ?> selected <?php  } ?>>正常</option>
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
                        <div class='row'>
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>搜索 
                                            </div>
                                        </div>
                                           <div class="portlet-body form">
                                               <br>
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="edu_video_list" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="aw" value="1" />
                                                        <div class="form-group ">
                                                          <label class="control-label col-md-3">分类</label>
                                                             <div class="col-md-4">
                                                                        <select name="class_id" class="form-control"  >
                                                                            <option value='0'>全部</option>
                                                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                                <option value='<?php  echo $row['class_id'];?>' disabled ><?php  echo $row['class_name'];?></option>
                                                                                <?php  if(is_array($row['list'])) { foreach($row['list'] as $val) { ?>
                                                                                    <option value='<?php  echo $val['class_id'];?>' <?php  if($_GPC['class_id'] == $val['class_id'] ) { ?> selected <?php  } ?> >&nbsp;&nbsp<?php  echo $val['class_name'];?></option>
                                                                                <?php  } } ?>
                                                                            <?php  } } ?>
                                                                         </select>
                                                             </div>
                                                        </div>
                                                         <div class="form-group last">
                                                          <label class="control-label col-md-3">状态</label>
                                                             <div class="col-md-4">
                                                                        <select name="status" class="form-control">
                                                                            <option value='0'>全部</option>
                                                                            <option value="1" <?php  if($_GPC['status'] == '1') { ?> selected<?php  } ?>>正常</option>
                                                                            <option value="3" <?php  if($_GPC['status'] == '3') { ?> selected<?php  } ?>>关闭</option>
                                                                        </select>
                                                             </div>
                                                        </div>                                                       
                                                    <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-2 col-md-10">
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                     <button class="btn btn-default" type="button">总记录数：<?php  echo $video_result['count'];?></button>				
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>   
                                       </div>   
                                 </div>   
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>视频列表 </div>
                                        </div>
                                        <div class="portlet-body">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
                                                <thead>
                                                    <tr>
                                                        <th> 视频名称 </th>
                                                        <th> 视频分类 </th>
                                                        <th> 视频形式 </th>
                                                        <th> 长度（分钟） </th>
                                                        <th> 添加时间 </th>
                                                        <th> 状态 </th>
                                                        <th>  </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  if(is_array($video_list)) { foreach($video_list as $item) { ?>
                                                        <tr class="odd gradeX">
                                                            <td><?php  echo $item['list_name'];?></td>
                                                            <td><?php  echo $class_eduClass->className($item['class_id'])?> </td>
                                                            <td>
                                                                <?php  if(is_array($cclass_eduList->list_types)) { foreach($cclass_eduList->list_types as $row) { ?>
                                                                    <?php  if($item['list_src_type']==$row['type']) { ?>  <?php  echo $row['name'];?> <?php  } ?>
                                                                <?php  } } ?>
                                                            </td>
                                                            <td><?php  echo $item['list_min'];?></td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                            <td>
                                                                <?php  if($item['status']==1) { ?>
                                                                    开启
                                                                <?php  } else { ?>
                                                                    关闭
                                                                <?php  } ?>
                                                            </td>
                                                           <td style="text-align: center">
                                                               <a href="<?php  echo $this->createWebUrl('edu_video_list', array('ac' => 'edit','id'=>$item['list_id']))?>"  class="btn  blue"> <i class="fa fa-edit"></i>编辑</a>
                                                               <a href="<?php  echo $this->createWebUrl('edu_video_list', array('ac' => 'delete','id'=>$item['list_id']))?>"  class="btn red"> <i class="fa fa-times-circle-o"></i>删除</a>
                                                               <a href="<?php  echo $this->createWebUrl('views_log', array('ac' => 'video_list','id'=>$item['list_id']))?>"  class="btn  yellow"> <i class="fa fa-rss"></i>查看数：<?php  echo $item['views'];?></a>
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
                    </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
                </div>
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
          <?php  if($ac=='list') { ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>           
         <?php  } ?>
    </html>