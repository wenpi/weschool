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
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增视频<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>视频名</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="video_name" id="video_name" class="form-control" value='<?php  echo $result['video_name'];?>' />
                                                        <?php  if($ac=='edit') { ?>
                                                        <input type="hidden" name="id"  class="form-control" value='<?php  echo $result['video_id'];?>' />
                                                        <?php  } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频方式</label>
                                                    <div class="col-sm-10">
                                                        <select name='video_type' class="form-control" onchange="videoChange(this)">
                                                            <option value='1' <?php  if(1 ==$result['video_type']) { ?> selected <?php  } ?>>流地址模式</option>
                                                            <option value='2' <?php  if(2 ==$result['video_type']) { ?> selected <?php  } ?>>富文本模式</option>
                                                        </select>                       
                                                    </div>
                                                </div>
                                                <div class='form-group form-md-line-input' id='video_html_content' <?php  if($result['video_type']==1 || !$result['video_type'] ) { ?> style="display:none" <?php  } ?> >
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>视频内容</label>
                                                    <div class="col-sm-10">
                                                        <?php  echo tpl_ueditor('html_content',$result['html_content']);?>
                                                    </div>	
                                                </div>
                                                <div class="form-group" id="video_url"  <?php  if($result['video_type']==2 ) { ?> style="display:none" <?php  } ?>>
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频取流地址</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="video_url" id="video_url" class="form-control" value='<?php  echo $result['video_url'];?>' />
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频可看的开始时间（24小时制）</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="begin_time" id="begin_time" class="form-control" value='<?php  echo $result['begin_time'];?>' placeholder="08:00:00"/>
                                                    </div>
                                                </div> 

                                                <div class="form-group form-md-line-input">
                                                    <label class=" col-md-2 control-label"><span style='color:red'>*</span>视频可看的结束时间（24小时制）</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="end_time" id="end_time" class="form-control" value='<?php  echo $result['end_time'];?>'  placeholder="18:00:00"/>
                                                    </div>
                                                </div> 
                                
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>视频封图</label>
                                                    <div class="col-sm-10">
                                                        <?php  echo tpl_form_field_image('video_img',$result['video_img']);?>
                                                    </div>
                                                </div> 
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                                    <div class="col-sm-10">
                                                        <select name='status'  class="form-control"  >
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
                                <p> 视频头列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>视频头列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                                    <tr>
                                                        <th>视频ID</th>
                                                        <th>视频名</th>
                                                        <th>视频起止时间</th>
                                                        <th>今日被查看数</th>
                                                        <th>历史被查看数</th>
                                                        <th ></th>
                                                    </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td><?php  echo $item['video_id'];?></td>
                                                <td><?php  echo $item['video_name'];?></td>
                                                <td><?php  echo $item['begin_time'];?>---<?php  echo $item['end_time'];?></td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td style="text-align:right;">
                                                    <a href="<?php  echo $this->createWebUrl('video', array('ac' => 'edit','id'=>$item['video_id'],'aw'=>1))?>" class="btn btn-outline btn-circle dark btn-sm black"> <i class="fa fa-edit"></i> 编辑</a>
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