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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>分类名</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"   value="<?php  echo $result['class_name'];?>" name='class_name' required >
                                                        <?php  if($ac=='edit') { ?>
                                                            <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['class_id'];?>' />
                                                        <?php  } ?>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div>   
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>排序</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"  value="<?php  echo $result['class_sort'];?>" name='class_sort'  >
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div>  
                                                 <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label">分类级别</label>
                                                    <div class="col-sm-10">
                                                        <select name='type'  class="form-control"  onchange="classLevel(this)">
                                                            <option value='1' <?php  if(1 == $result['type'] || !$result['type']  ) { ?> selected <?php  } ?>>一级</option>
                                                            <option value='2' <?php  if(2 == $result['type']) { ?> selected <?php  } ?>>二级</option>
                                                        </select>                                                         
                                                    </div>
                                                </div>
                                                  <div id='pid' class="form-group form-md-line-input" <?php  if(!$result['pid'] && !$result['type'] ) { ?> style="display:none"<?php  } ?>>
                                                    <label class=" col-md-2 control-label">父级分类</label>
                                                    <div class="col-sm-10">
                                                        <select name='pid'  class="form-control" >
                                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                               <option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id'] == $result['pid']) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>                       
                                                    </div>
                                                </div>                                                                                          
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>展示图片</label>
                                                    <div class="col-md-10">
                                                       <?php  echo tpl_form_field_image('class_img',$result['class_img']);?>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                            </div>  
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
                                                <div class="col-sm-10">
                                                    <?php  $type_list = $class_article->type;?>
                                                <select name='class_type' class="form-control">
                                                    <?php  if(is_array($type_list)) { foreach($type_list as $k => $row) { ?>
                                                        <option value='<?php  echo $k;?>' <?php  if($k == $result['class_type']) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                    <?php  } } ?>
                                                </select>
                                                </div>	
                                            </div>
                                            
                                            <div class='form-group form-md-line-input '>
                                                <label class="col-md-2 control-label">选择年级【只有在限制类型为学生时有用】</label>
                                                <div class="col-sm-10">
                                                <select name='grade_id' class="form-control">
                                                    <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                        <option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id'] ==$result['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                    <?php  } } ?>
                                                </select>
                                                </div>	
                                            </div>

                                           <div class='form-group form-md-line-input ' >
                                                <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                <div class="col-sm-10 ">
                                                <select name='status' class="form-control" >
                                                        <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                        <option value='2' <?php  if(2 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
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
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>文章分类列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>分类名</th>
                                                <th>排序</th>
                                                <th>级别</th>
                                                <th>分类限制</th>
                                                <th>限制年级 </th>
                                                <th>状态 </th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr class="success">
                                                <td>  <?php  echo $item['class_name'];?></td>
                                                <td>  <?php  echo $item['class_sort'];?>  </td>
                                                <td>  <?php  echo $item['type'];?>  </td>
                                                <td> <?php  $type_list = $class_article->type;?>
                                                    <?php  if(is_array($type_list)) { foreach($type_list as $k => $v) { ?>
                                                        <?php  if($k==$item['class_type']) { ?>
                                                            <?php  echo $v;?>
                                                        <?php  } ?>
                                                    <?php  } } ?>
                                                </td>
                                                <td> <?php  if($item['grade_id'] && $item['class_type'] =='student' ) { ?><?php  echo $this->gradeName($item['grade_id']);?><?php  } else { ?>无 <?php  } ?> </td>
                                                <td> <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?></td>
                                                <td style="text-align: center">
                                                    <a  href="<?php  echo $this->createWebUrl('article_class', array('ac' => 'edit','id'=>$item['class_id'] ))?>" class="btn blue">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                 <a  target="_blank" href="<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('wapArticle', array('cid' => $item['class_id']))?> " class="btn yellow">
                                                                <i class="fa fa-eye"></i> 访问 </a>   
                                                </td>                          
                                            </tr>
                                            <?php  if(is_array($item['list'])) { foreach($item['list'] as $val) { ?>
                                              <tr >
                                                <td>  <?php  echo $val['class_name'];?></td>
                                                <td>  <?php  echo $val['class_sort'];?>  </td>
                                                <td>  <?php  echo $val['type'];?>  </td>
                                                <td> <?php  $type_list = $class_article->type;?>
                                                    <?php  if(is_array($type_list)) { foreach($type_list as $k => $v) { ?>
                                                        <?php  if($k==$val['class_type']) { ?>
                                                            <?php  echo $v;?>
                                                        <?php  } ?>
                                                    <?php  } } ?>
                                                </td>
                                                <td> <?php  if($val['grade_id'] && $val['class_type'] =='student' ) { ?><?php  echo $this->gradeName($val['grade_id']);?><?php  } else { ?>无 <?php  } ?> </td>
                                                <td> <?php  if($val['status'] ==1) { ?>正常<?php  } else { ?>关闭<?php  } ?></td>
                                                <td  style="text-align: center"><a  href="<?php  echo $this->createWebUrl('article_class', array('ac' => 'edit','id'=>$val['class_id'] ))?>" class="btn blue">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                 <a  target="_blank" href="<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('wapArticle', array('cid' => $val['class_id']))?> " class="btn yellow">
                                                                <i class="fa fa-eye"></i> 访问 </a>   
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