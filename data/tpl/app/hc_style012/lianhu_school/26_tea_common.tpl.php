<?php defined('IN_IA') or exit('Access Denied');?>    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script>
        //教师端删除操作
        function deleteThis(id,type){
            $.ajax({
                url:'<?php  echo $this->createMobileUrl("ajax")?>',
                type:'post',
                dataType:'json',
                data:{id:id,type:type,ac:'tea_delete'},
                success:function(obj){
                    if(obj.errcode==0){
                        alert("删除成功！");
                        $("#"+type+'_'+id).remove();   
                    }
                }
            });
        }
    </script>