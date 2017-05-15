<?php defined('IN_IA') or exit('Access Denied');?>              <?php  if($file_list) { ?>
                      <?php  if(is_array($file_list)) { foreach($file_list as $row) { ?>
                                 <tr>
	                                <td class='file_name' data-id="<?php  echo $row['id'];?>" data-status='1' ><?php  echo $row['file_name'];?></td>
                                     <td><?php  echo $row['file_local'];?></td>
                                     <td><?php  echo $row['version'];?></td>
                                     <td id='status<?php  echo $row['id'];?>'>未更新</td>
                                 </tr>
                         <?php  } } ?>
               <?php  } ?>
            <script>
                var page=0; 
                var xid=0;
                $(function(){
                    //检测文件更新
                    showModel("modal_notice");
                    $("#modal_notice").find('.modal-body').html("正在获取更新数据中，请稍等，对比数据<code id='data_list'>1-51</code>条中【总文件大约：1400】<br><span class='font-red'>[每次最多获取200个更新文件，可以多次更新检测是否更新完]</span>");
                    updateSort(0);
                });
                function updateSort(sort){
                    $.ajax({
                        url:'<?php  echo $this->createWebUrl("NoBeginAjax");?>',
                        type:'post',
                        async:'false',
                        data:{sort:sort,ac:'updateSort'},
                        dataType:'json',
                        success:function(obj){
                            if(obj.status=='done'){
                                //获取文件
                                getNeedUpdateFile();
                            }else if(obj.next_sort){
                                pages = obj.next_sort+50;
                                str   = obj.next_sort+"-"+pages;
                                $("#data_list").html(str);
                                updateSort(obj.next_sort);
                            }else{
                                $("#modal_notice").find('.modal-body').html("发送错误，请检查");
                            }
                        }
                    });
                }
                function getNeedUpdateFile(){
                      hiddenModel("modal_notice");
                      $.ajax({
                        url:'<?php  echo $this->createWebUrl("NoBeginAjax");?>',
                        type:'post',
                        async:'false',
                        data:{ac:'getFileList'},
                        dataType:'json',
                        success:function(obj){
                            if(obj.list){
                                var html ='';
                                $.each(obj.list,function(i,e){
                                    html += "<tr>";
                                    html += " <td class='file_name' data-id='"+e.id+"' data-status='1' > "+e.file_name+"</td>";
                                    html += "<td>"+e.file_local+"</td>";
                                    html += "<td>"+e.version+"</td>";
                                    html += "<td id='status"+e.id+"' >未更新</td>";
                                    html += "</tr>";
                                });
                                $("#file_list").html(html);
                                getNextSend();
                            }else{
                                // showModel("modal_notice");
                                // $("#modal_notice").find('.modal-body').html("无需更新！");
                            }
                        }
                    });
                }
                function updateFile(){
                        if(confirm("确认将进入更新进程，未更新完请勿关闭此网页")){
                            getNextSend();
                        }
                }
                function getNextSend(){
                    var send = false;
                    all_list = $('.file_name');
                    $.each(all_list,function(i,e){
                        if($(this).attr('data-status')==1){
                            ajaxUp($(this).attr("data-id"),$(this));
                            send=true;
                            return false;
                        }
                    });
                    if(!send){
                            // showModel("modal_notice");
                            $("#modal_notice").find('.modal-body').html("<span style='color:red'>更新完成，如有文件没更新成功，可以修改权限后再试</div>");
                            return true; 
                        }
                }
                function ajaxUp(file_id,obj){
                    $.ajax({
                    type:"POST",
                    url:'<?php  echo $this->createWebUrl("NoBeginAjax");?>',            
                    async:'false',
                    dataType:'json',
                    data:{file_id:file_id,ac:'update_file'},
                    success:function(dataJson){
                        changeStatus(dataJson.status,dataJson.end_time,obj,file_id,dataJson.msg);
                    } 
                });
                }    
                function changeStatus(status,end_time,obj,file_id,msg){
                    obj.attr('data-status',status);
                    if(status==2){
                        $("#status"+file_id+"").html('<code><i class="fa fa-check"></i>更新成功</code>');     
                    }
                    if(status==1){
                        //先跳过，下次再更新
                        obj.attr('data-status',3);
                        $("#status"+file_id+"").html('<i class="fa fa-close"></i>'+msg);     
                    }		
                    if(status!=10){
                        getNextSend();
                    }	
                    if(status==10){
                        
                    }
                }
            </script>                                           