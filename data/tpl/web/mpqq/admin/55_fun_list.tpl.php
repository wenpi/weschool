<?php defined('IN_IA') or exit('Access Denied');?>                    <?php  $power_list= D('power')->power_list; ?>
                    <?php  if(is_array($power_list)) { foreach($power_list as $row) { ?>
                      <div class="col-md-6 col-sm-12">
                            <div class="portlet light portlet-fit portlet-datatable ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase"><?php  echo $row['name'];?></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                            <tr>
                                                <th class="table-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_5 .checkboxes" data-key="<?php  echo $row['key_word'];?>"  onclick="powerCheckBox(this)" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th> 功能名 </th>
                                                <th> 识别关键词 </th>
                                                <th> 功能关键词 </th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($row['low_list'])) { foreach($row['low_list'] as $value) { ?>
                                                <tr class="odd gradeX">
                                                    <td>
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="checkboxes <?php  echo $row['key_word'];?>" value="<?php  echo $value['fun'];?>" name="fun_list[]" <?php  if($fun_key_word_list ) { ?> <?php  if(in_array($value['fun'],$fun_key_word_list) ) { ?> checked <?php  } ?> <?php  } ?>/>
                                                            <span></span>
                                                        </label>
                                                    </td>
                                                    <td>  <?php  echo $value['name'];?></td>
                                                    <td>
                                                         <?php  echo $value['key_word'];?>
                                                    </td>
                                                    <td> <?php  echo $value['fun'];?> </td>
                                                </tr>                                            
                                            <?php  } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php  } } ?>
                    <script>
                        function powerCheckBox(obj){
                            key_word = $(obj).attr('data-key');
                            if($('.'+key_word).prop('checked'))
                                $('.'+key_word).prop('checked',false);
                            else 
                                $('.'+key_word).prop('checked',true);
                        }
                    </script>