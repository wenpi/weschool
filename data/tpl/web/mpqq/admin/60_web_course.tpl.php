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
                                        <i class="fa fa-edit font-green-haze"></i>
                                        <span class="caption-subject bold uppercase">	<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                             <div class="form-group">
                                                     <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>课程名</label>
                                                       <div class="col-sm-10">
                                                                <input type="text" name="course_name" id="course_name" class="form-control" value='<?php  echo $result['course_name'];?>' />
                                                                <?php  if($ac=='edit') { ?>
                                                                <input type="hidden" name="cid"  class="form-control" value='<?php  echo $result['course_id'];?>' />
                                                                <?php  } ?>
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
                      </div>                 
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 当前学校的所有课程 </p>
                            </div>
                            <div class="portlet box green-turquoise">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-navicon"></i>课程列表 
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content  table-light "  id="sample_3" >
                                        <thead class="flip-content">
                                            <tr>
                                                <th width="20%"  class="numeric"> 课程ID </th>
                                                <th width="20%"> 	课程名 </th>
                                                <th> 是否为基础课程 </th>
                                                <th class="numeric">  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                                <tr>
                                                    <td><?php  echo $item['course_id'];?></td>
                                                    <td><?php  echo $item['course_name'];?></td>
                                                    <td><span class='label label-sm label-warning'>	<?php  if($item['course_basic'] ==1) { ?>是<?php  } else { ?>否<?php  } ?></span> </td>
                                                    <td>
                                                        <a href="<?php  echo $this->createWebUrl('course', array( 'ac' => 'edit','cid'=>$item['course_id'],'aw'=>1 ))?>" class="btn blue">  <i class="fa fa-edit"></i> 编辑</a>
                                                        <a href="<?php  echo $this->createWebUrl('course', array('ac' => 'delete','cid'=>$item['course_id'],'aw'=>1 ))?>" 
                                                            onclick="return confirm('此操作不可恢复，确认删除？');"
                                                            class="btn red" ><i class="fa fa-times"></i>删除
                                                        </a>
                                                        <?php  if($item['course_basic'] !=1) { ?>
                                                            <a href="<?php  echo $this->createWebUrl('course', array('ac' => 'update','cid'=>$item['course_id'] ,'aw'=>1 ))?>" 
                                                                onclick="return confirm('此操作会把此课程添加到所有班级中去');"
                                                                class="btn green" >设为基础课程
                                                            </a>
                                                        <?php  } else { ?>
                                                            <a href="<?php  echo $this->createWebUrl('course', array('ac' => 'update','delete'=>1,'cid'=>$item['course_id'],'aw'=>1 ))?>" 
                                                                class="btn green" >降为普通课程
                                                            </a>                         
                                                        <?php  } ?>
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
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>     
         </body>
    </html>