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
                                $("#limit_display_area").hide();
                            }else{
                                $("#pid").hide();
                                $("#limit_display_area").show();
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

                                                <div id='limit_display_area' <?php  if(2 == $result['class_level']) { ?> style="display: none" <?php  } ?> >
                                                     <div class='form-group form-md-line-input'>
                                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
                                                            <div class="col-sm-10">
                                                                <select name='limit_display' id="limit_type" class="form-control" >
                                                                        <option value='0' <?php  if($result['limit_display'] ==0) { ?>selected<?php  } ?>> 全校可看 </option>
                                                                        <option value='1' <?php  if($result['limit_display'] ==1) { ?>selected<?php  } ?>> 年级限制 </option>
                                                                        <option value='2' <?php  if($result['limit_display'] ==2) { ?>selected<?php  } ?>> 教师可看 </option>
                                                                </select>
                                                            </div>	
                                                      </div>

                                                    <div class="form-group form-md-line-input">
                                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制具体</label>
                                                            <div class="col-sm-10" id='limit_content' data-type='<?php  echo $result['limit_display'];?>'>
                                                                <?php  if($result['limit_display'] ==0) { ?>无<?php  } ?>
                                                                <?php  if($result['limit_display'] ==1) { ?>
                                                                    <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                                        <input  name='limit_content[]' type='checkbox' value='<?php  echo $row['grade_id'];?>' <?php  if(in_array($row['grade_id'],$limit_arr)) { ?> checked <?php  } ?>><?php  echo $row['grade_name'];?>&nbsp;&nbsp;
                                                                    <?php  } } ?>
                                                                <?php  } ?>
                                                            </div>
                                                        </div>

                                                </div>

                                                <div class='form-group form-md-line-input' <?php  if(1 != $result['limit_display']) { ?> style="display: none;" <?php  } ?>>
                                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
                                                        <div class="col-sm-10">
                                                            <select name='limit_type' id="limit_type" class="form-control" >
                                                                <?php  if(is_array($appointment_limit)) { foreach($appointment_limit as $key => $row) { ?>
                                                                    <option value='<?php  echo $key;?>' <?php  if($limit_type==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                                <?php  } } ?>
                                                            </select>
                                                        </div>	
                                                </div>

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
                    <script>
                        $(function(){
                                var grade_html='';
                               <?php  if(is_array($grade_list)) { foreach($grade_list as $key => $row) { ?>
                                    grade_html +="<input value='<?php  echo $row['grade_id'];?>' type='checkbox' onclick='checkbox(this)' name='limit_content[]'><?php  echo $row['grade_name'];?>&nbsp;&nbsp;";
                                <?php  } } ?>
                                var data_type=new Array();
                                $('#limit_type').change(function(){
                                    var val=$(this).val();
                                        var limit_type=$('#limit_content').attr('data-type');
                                        limit_type=limit_type ? limit_type :0;
                                        data_type[limit_type]=$('#limit_content').html();
                                        $('#limit_content').attr('data-type',val);
                                        if(!data_type[val]){
                                            if(val==1){
                                                var content=grade_html;
                                            }else if(val==0){
                                                var content='无';
                                            }else if(val==2){
                                                var content='无';
                                            }
                                            $('#limit_content').html(content);
                                        }else{
                                            $('#limit_content').html(data_type[val]);
                                        }
                                });
                        });
                        function checkbox(obj){
                            if($(obj).is(":checked")){
                                $(obj).attr('checked','checked');
                            }else{
                                $(obj).attr('checked',false);
                            }
                        }

                    </script>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p> 视频分类列表 </p>
                            </div>
                            <div class="portlet box green-turquoise">
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
                                                <th>是否限制</th>
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
                                                    <td><?php  if($item['limit_display']==1) { ?>限制<?php  } else if($item['limit_display']==2) { ?>限制老师<?php  } else { ?>不限制<?php  } ?></td>
                                                    <td><?php  if($item['status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                    <td  style="text-align:left;"  > 
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'edit','id'=>$item['class_id']))?>"  class="btn blue"  > <i class="fa fa-edit"></i>编辑</a>
                                                        <?php  if($item['next_count']==0) { ?>
                                                            <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'delete','id'=>$item['class_id']))?>" class="btn red"  > <i class="fa fa-times-circle-o"></i>删除</a>
                                                        <?php  } ?>
                                                    </td>
                                                </tr>
                                                <?php  if(is_array($item['list'])) { foreach($item['list'] as $val) { ?>
                                                  <tr>
                                                    <td><?php  echo $val['class_name'];?></td>
                                                    <td><?php  echo $val['class_level'];?></td>
                                                    <td><?php  echo $val['sort'];?></td>
                                                    <td><img src='<?php  echo $_W['attachurl'];?><?php  echo $val['class_img'];?>' width="50"></td>
                                                    <td><span class="font-red">无</span></td>
                                                    <td><?php  if($val['status']==1) { ?>可用<?php  } else { ?>注销<?php  } ?></td>
                                                    <td><?php  echo date("Y-m-d H:i:s",$val['add_time']);?></td>
                                                    <td style="text-align:left;" >
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'edit','id'=>$val['class_id']))?>"    class="btn blue"  > <i class="fa fa-edit"></i>编辑</a>
                                                        <a href="<?php  echo $this->createWebUrl('edu_video_class', array('ac' => 'delete','id'=>$item['class_id']))?>"  class="btn red" > <i class="fa fa-times-circle-o"></i>删除</a>
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