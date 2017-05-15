<?php defined('IN_IA') or exit('Access Denied');?><div class='main'>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                    <tr>
                        <th >发送类型</th>
                        <th >发送内容</th>
                        <th >发送时间</th>
                        <th >发送人</th>
                        <th >发送数量</th>
                        <th >状态</th>
                    </tr>
                </thead>			
                <tbody>
                    <?php  if(is_array($list)) { foreach($list as $row) { ?>
                        <tr>
                            <?php  $out= myclass\content::msgContent($row['queue_content'],$row['queue_type']);?>
                            <td><?php  echo myclass\type::msgType($row['queue_type']);?></td>
                            <td><?php  echo $out['content'];?></td>
                            <td><?php  echo date("Y-m-d H:i:s",$row['add_time'])?></td>
                            <td><?php  echo $out['name'];?></td>
                            <td><?php  echo $row['num'];?></td>
                            <td><?php  if($row['queue_status']==1) { ?>未发送<?php  } else { ?>已发送<?php  } ?></td>
                        </tr>
                    <?php  } } ?>
                    
                </tbody>
            </table>
            <?php  echo $pager;?>	
        </div>
</div>