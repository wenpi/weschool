<?php defined('IN_IA') or exit('Access Denied');?>    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/modals', TEMPLATE_INCLUDEPATH)) : (include template('../admin/modals', TEMPLATE_INCLUDEPATH));?>
        <script>
            function ajaxChange(obj,to_url){
                obj         = $(obj);
                id          = obj.attr('data-id');
                change_val  = obj.val();
                field_name  = obj.attr('data-name'); 
                $.ajax({
                    url:to_url,
                    type:"post",
                    data:{ field_name:field_name,change_val:change_val,id:id },
                    dataType:"json",
                    success:function(con){
                            $("#modal_notice").find('.modal-body').html(con.msg);
                            showModel('modal_notice');
                    }
                });
            }
        </script>