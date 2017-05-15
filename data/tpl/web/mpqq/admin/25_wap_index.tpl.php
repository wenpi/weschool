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
                                        <span class="caption-subject bold uppercase"> <?php  if($ac=='new') { ?>新增<?php  } else { ?>编辑<?php  } ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>命名</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="命名" value="<?php  echo $result['info_name'];?>" name='info_name' required >
                                               		<?php  if($ac=='edit') { ?>
					                                	<input type="hidden" name="id"  class="form-control" value='<?php  echo $result['info_id'];?>' />
						                            <?php  } ?>
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>               
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">系统内置识别关键词</label>
                                                <div class="col-md-10">
                                                    <select id="sys_key" class="form-control" name="sys_key">
                                                        <?php  if(is_array($class_wap->wap_index)) { foreach($class_wap->wap_index as $row) { ?>
                                                            <option value='<?php  echo $row['key'];?>'><?php  echo $row['name'];?></option>
                                                        <?php  } } ?>
                                                    </select>
                                                </div>
                                            </div>  

                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">自定义识别关键词【填写此，系统内置关键词无效】</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"   value="<?php  echo $result['key_word'];?>" name='key_word'   >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>   
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">调用功能关键词</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"   value="<?php  echo $result['fun_name'];?>" name='fun_name'   >
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">与跳转地址互斥</span>
                                                </div>
                                            </div>                                                                                         
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">文字内容</label>
                                                <div class="col-md-10">
                                                    <input type="number" name="text_content" id="text_content" class="form-control" value='<?php  echo $text_content;?>' />
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">与图片内容是互斥，填写了则不读去图片内容</span>
                                                </div>
                                            </div>
                                             <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label">图片内容</label>
                                                <div class="col-md-10">
                                                   <?php  echo tpl_form_field_image('img_content',$img_content);?>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">与文字内容是互斥</span>
                                                </div>
                                            </div>           
                                            <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>跳转地址</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="带有http://" value="<?php  echo $result['info_url'];?>" name='info_url'   >
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div> 

                                              <div class="form-group form-md-line-input">
                                                <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>排序</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"  placeholder="排序" value="<?php  echo $result['sort'];?>" name='sort' required >
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">越大越靠前</span>
                                                </div>
                                            </div>   
                                           <div class="form-group form-md-radios form-md-line-input  ">
                                            <label class="col-md-2 control-label"  >状态</label>
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio"  id="radiol" class="md-radiobtn"  name="status"   value='1' <?php  if($result['status']==1) { ?> checked <?php  } ?>  />
                                                    <label for="radiol">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>正常</label>
                                                </div>
                                                <div class="md-radio">
                                                  <input type="radio"   id='radiol1' class="md-radiobtn" name="status"   value='2' <?php  if($result['status']==2) { ?> checked <?php  } ?> />
                                                    <label for="radiol1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>删除</label>
                                                </div>
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
                                <p> 当前学校官网可调用的信息列表 </p>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>信息列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> 名字 </th>
                                                <th> 关键词 </th>
                                                <th> 调用功能<br>会替代URL </th>
                                                <th> URL </th>
                                                <th> 排序 </th>
                                                <th> 添加时间 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td> <?php  echo $item['info_name'];?> </td>
                                                <td> <?php  echo $item['key_word'];?></td>
                                                <td> <?php  echo $item['fun_name'];?></td>
                                                <td> <?php  echo $item['info_url'];?></td>
                                                <td> <?php  echo $item['sort'];?></td>
                                                <td> <?php  echo date("Y-m-d H:i:s" ,$item['add_time']) ?></td>
                                                <td><a  href="<?php  echo $this->createWebUrl('wap_index', array('ac' => 'edit','id'=>$item['info_id'] ))?>" class="btn btn-outline btn-circle btn-sm purple">
                                                            <i class="fa fa-edit"></i> 编辑 </a>
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