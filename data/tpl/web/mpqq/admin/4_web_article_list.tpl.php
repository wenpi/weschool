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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class='form-group  form-md-line-input'>
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>选择分类</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="class_id">
                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                        <option disabled><?php  echo $row['class_name'];?></option>
                                                        <?php  if(is_array($row['low'])) { foreach($row['low'] as $val) { ?>
                                                            <option value='<?php  echo $val['class_id'];?>' <?php  if($result['class_id']== $val['class_id']) { ?>selected <?php  } ?>> &nbsp;&nbsp;<?php  echo $val['class_name'];?></option>
                                                        <?php  } } ?>
                                                    <?php  } } ?>
                                                </select>
                                            </div>
                                        </div>	  
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 文章名</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="article_title"  class="form-control" value='<?php  echo $result['article_title'];?>' />
                                                <?php  if($ac=='edit') { ?>
                                                <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['list_id'];?>' />
                                                <?php  } ?>
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 文章简介</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="article_intro" class="form-control" value='<?php  echo $result['article_intro'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                         <div class="form-group form-md-line-input">
                                            <label class="col-md-2 control-label">显示排序</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="class_sort" class="form-control" value='<?php  echo $result['class_sort'];?>' />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>                                       
                                       <div class="form-group">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>封面图</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_image('artice_img',$result['artice_img']);?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>文章内容</label>
                                                <div class="col-sm-10">
                                                    <?php  echo tpl_ueditor('article_content',$result['article_content']);?>
                                                </div>
                                        </div>   
                                        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/upFile', TEMPLATE_INCLUDEPATH)) : (include template('../admin/upFile', TEMPLATE_INCLUDEPATH));?>
                                        <div class='form-group'>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control"  >
                                                    <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='3' <?php  if(3 ==$result['status']) { ?> selected <?php  } ?>>关闭</option>
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
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选学生</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="./index.php" method="get" class="form-horizontal">
                                                    	<input type="hidden" name="c" value="site" />
                                                        <input type="hidden" name="a" value="entry" />
                                                        <input type="hidden" name="m" value="lianhu_school" />
                                                        <input type="hidden" name="do" value="article_list" />
                                                        <input type="hidden" name="ac" value="list" />
                                                        <input type="hidden" name="aw" value="1" />
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">文章分类</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control school_class_list" name="class_id" class="form-control"  >
                                                                        <option value="0">全部</option>
                                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                        <option disabled><?php  echo $row['class_name'];?></option>
                                                                        <?php  if(is_array($row['low'])) { foreach($row['low'] as $val) { ?>
                                                                            <option value='<?php  echo $val['class_id'];?>' <?php  if($_GPC['class_id'] == $val['class_id']) { ?> selected <?php  } ?>> &nbsp;&nbsp;<?php  echo $val['class_name'];?></option>
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
                                                                     <input type="submit" name="submit" class="btn blue" value="确认搜索"></button>
                                                                </div>
                                                            </div>
                                                    </div>   
                                                </form>
                                              </div>
                             </div>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>文章列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th > ID</th>
                                                <th>  文章名 </th>
                                                <th>  分类名 </th>
                                                <th>  添加时间 </th>
                                                <th > 状态 </th>
                                                <th > 排序 </th>
                                                <th >  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['list_id'];?></td>
                                                <td><?php  echo $item['article_title'];?></td>
                                                <td><?php  echo $class_article->className($item['class_id']);?></td>
                                                <td><?php  echo date("Y-m-d",$item['add_time']);?></td> 
                                                <td>
                                                    <?php  if($item['status'] ==1) { ?>正常<?php  } else { ?><span class='font-red-intense bold'>关闭</span><?php  } ?>
                                                </td>
                                                <td><?php  echo $item['class_sort'];?></td>
                                                <td style="text-align: center">
                                                    <a  href="<?php  echo $this->createWebUrl('article_list', array('id' => $item['list_id'],'ac'=>'edit'))?> " class="btn blue">
                                                                <i class="fa fa-edit"></i> 编辑 </a>
                                                    <a href="<?php  echo $this->createWebUrl('article_list', array('id' => $item['list_id'],'ac'=>'delete'))?>" 
                                                        onclick="return confirm('此操作不可恢复，确认删除？');"
                                                        class="btn red" title="删除"><i class="fa fa-trash-o"></i>
                                                        删除
                                                    </a>  
                                                    <a  target="_blank" href="<?php  echo $_W['siteroot'];?>app/<?php  echo $this->createMobileUrl('wapContent', array('aid' => $item['list_id']))?> " class="btn yellow">
                                                                <i class="fa fa-eye"></i> 访问 </a>                                                    
                                                </td>         
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                        <?php  echo $pager;?>
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