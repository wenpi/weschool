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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增年级<?php  } else { ?>编辑<?php  } ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>年级名字</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="年级名字" value="<?php  echo $result['grade_name'];?>" name='grade_name' required >
                                               		<?php  if($ac=='edit') { ?>
					                                	<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['grade_id'];?>' />
						                            <?php  } ?>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>                
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span style='color:red'>*</span>入学年份</label>
                                                <div class="col-md-10">
                                                    <input type="number" name="in_school_year" id="in_school_year" class="form-control" value='<?php  echo $result['in_school_year'];?>' />
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">请填写实际的入学年份</span>
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
                                <p> 当前学校所有的年级（包含已经毕业离校的年级） </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>年级列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <!--<a href="#portlet-config" data-toggle="modal" class="config"> </a>-->
                                        <!--<a href="javascript:;" class="reload"> </a>-->
                                        <!--<a href="javascript:;" class="remove"> </a>-->
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th width="10%"  class="numeric"> 年级ID </th>
                                                <th> 	显示年级名 </th>
                                                <th class="numeric"> 入学年份 </th>
                                                <th class="numeric"> 班级数 </th>
                                                <th class="numeric">  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td  class="numeric"> <?php  echo $item['grade_id'];?> </td>
                                                <td> <a href='<?php  echo $this->createWebUrl('class',array('grade_id'=>$item['grade_id'],'aw'=>1 ))?>'><?php  echo $item['grade_name'];?> </td>
                                                <td class="numeric"> <?php  echo $item['in_school_year'];?></td>
                                                <td class="numeric"> <?php  echo $this->grade_class_num($item['grade_id']);?> </td>
                                                <td><a  href="<?php  echo $this->createWebUrl('grade', array('ac' => 'edit','id'=>$item['grade_id'],'aw'=>1))?>" class="btn btn-outline btn-circle btn-sm purple">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
                                                <a href="<?php  echo $this->createWebUrl('grade', array('ac' => 'delete','id'=>$item['grade_id'] ,'aw'=>1 ))?>" 
                                                    onclick="return confirm('此操作不可恢复，确认删除？');"
                                                    class="btn btn-outline btn-circle dark btn-sm black" title="删除"><i class="fa fa-trash-o"></i>
                                                    删除
                                                </a>               
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