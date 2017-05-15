<?php defined('IN_IA') or exit('Access Denied');?>                     <div class="row">
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
                                            <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>部门名</label>
                                            <div class="col-sm-10">
                                                    <input type="text" name="department_name" id="department_name" class="form-control" value='<?php  echo $result['department_name'];?>' required <?php  if($op=='add_admin') { ?> readonly <?php  } ?> />
                                                    <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                         <?php  if($op!='add_admin') { ?> 
                                            <div class="form-group form-md-radios form-md-line-input  ">
                                                <label class="col-md-2 control-label"  >是否是主管维修</label>
                                                <div class="md-radio-inline">
                                                    <div class="md-radio">
                                                        <input type="radio"  id="radiol" class="md-radiobtn"  name="repair_fix"   value='1' <?php  if($result['repair_fix']==1) { ?> checked <?php  } ?>  />
                                                        <label for="radiol">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>主管</label>
                                                    </div>
                                                    <div class="md-radio">
                                                    <input type="radio"   id='radiol1' class="md-radiobtn" name="repair_fix"   value='0' <?php  if($result['repair_fix']==0) { ?> checked <?php  } ?> />
                                                        <label for="radiol1">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>不主管</label>
                                                    </div>
                                                </div>
                                            </div>   
                                        <?php  } else { ?>
                                        <?php  if($ac=='new') { ?>
                                            <div class="form-group  form-md-line-input">
                                                <label class="control-label col-md-2">选择雇员</label>
                                                    <div class="col-md-10">
                                                        <select name="db_admin_id[]" id='pre-selected-options'  multiple="multiple" class="multi-select"  >
                                                                <?php  if(is_array($school_all_list)) { foreach($school_all_list as $row) { ?>
                                                                <?php  if(!in_array($row['admin_id'],$depart_admin_id_arr) ) { ?>
                                                                    <option value='<?php  echo $row['admin_id'];?>'  ><?php  echo $row['admin_name'];?>【账号:<?php  echo $row['passport'];?>】</option>
                                                                <?php  } ?>
                                                                <?php  } } ?>
                                                        </select>
                                                </div>
                                            </div>  
                                        <?php  } else { ?>
                                            <div class='form-group  form-md-line-input'>
                                                <label class="  col-md-2 control-label"><span class="required" aria-required="true"> * </span>姓名</label>
                                                <div class="col-sm-10">
                                                        <input type="text" class="form-control" readonly value="<?php  echo $admin_re['admin_name'];?>"/>
                                                        <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                        <?php  } ?>
                                        <div class="form-group  form-md-line-input">
                                            <label class="control-label col-md-2">选择角色</label>
                                                <div class="col-md-10">
                                                       <select name="level" class="form-control"  >
                                                            <?php  if(is_array($class_department->level)) { foreach($class_department->level as $key => $row) { ?>
                                                             <option value='<?php  echo $key;?>' <?php  if($ad_re['level'] ==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                            <?php  } } ?>
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
                    </div>
                </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
                <link href="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
                <style> .ms-container{  width:700px; }  </style>
                <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" ></script>
                <script src="<?php echo MODULE_URL;?>/style/js/jquery.quicksearch.js" ></script>
                <script>
                    $('#pre-selected-options').multiSelect({
                        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='try \"张三\"'>",
                        selectionHeader: "<input type='text' class='search-input  form-control' autocomplete='off' placeholder='try \"李四\"'>",
                        afterInit: function(ms){
                            var that = this,
                                $selectableSearch = that.$selectableUl.prev(),
                                $selectionSearch = that.$selectionUl.prev(),
                                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
                            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                            });

                            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                            });
                        },
                        afterSelect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                        },
                        afterDeselect: function(){
                            this.qs1.cache();
                            this.qs2.cache();
                        }
                    });

                </script>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
         </body>
    </html>
