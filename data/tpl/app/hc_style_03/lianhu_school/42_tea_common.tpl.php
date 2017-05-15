<?php defined('IN_IA') or exit('Access Denied');?>    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script>
        var no_font  = '<i class="fa fa-times"></i> ';
        var yes_font = '<i class="fa fa-check-circle"></i> ';
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
        //发布作业点击班级
        function selectClass(obj){
            did = $(obj).attr('data-id');
            if( $("#class_id_"+did).prop("checked") ){
                    $("#class_id_"+did).prop("checked",false);
                    $(obj).find('.group-image').css("background-color","rgba(46,138,255,0.8)");  
                    $(obj).find('.font_img').html('');
            }else{
                    $("#class_id_"+did).prop("checked",true);
                    $(obj).find('.group-image').css("background-color","rgba(87,173,67,0.8)");  
                    $(obj).find('.font_img').html(yes_font);
            }
        }
        $(function(){
            width = $("#home_word_class_list").find('.grid-3-columns').width();
            $("#home_word_class_list").find('.group-image').height(width);
        });
    </script>
    <style>
         .group-image{
            background-color:rgba(46,138,255,0.8);
            background-image:url('');
            color:#fff;
            text-align:center;
            font-size:1.2em;
        }
        .group-image  div:first-child{
            padding-top:20px;
        }
        .select_span{
            width:100%;
            height:30px;
            overflow:hidden;
        }
        .left_title{
            float:left;
            width:30%;
            background-color:rgba(87,173,67,0.8);
            height:100%;
            line-height:30px;
            color:#fff;
            font-size:1.2em;
            text-align:center;
        }  
        .right_select{
            float:left;
            width:70%;
            height:100%;
            border:1px solid rgba(87,173,67,0.8);
            overflow:hidden;
        }
        .right_select select{
            margin:0px;
            appearance:none;
            width:120%;
            height:120%;
            padding-left:30%;
            position:relative;
            left:-5%;
            top:-8%;
        }
        .in_text textarea{
            width:100% !important;
            border:1px solid rgba(87,173,67,0.8);
        }
        .article_sub{
            background-color:rgba(87,173,67,0.8);
            margin-bottom:20px;
            border-top:0px;
            width:80%;
            margin:auto; 
             height:40px;
             border:none;
        }
        .toolbar-top-button{
            font-size:1.2em;
        }
        .end_text{
            height: 30px;
            text-align: center;
            line-height: 30px;
            color: #ff0033;
        }
    </style>