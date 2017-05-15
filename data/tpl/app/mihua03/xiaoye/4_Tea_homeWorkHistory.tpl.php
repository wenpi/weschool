<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
		<div class="ft">
            <div class="ft2"><a href="<?php  echo $this->createMobileUrl("tea_homeWork")?>">发布作业</a></div>
            <div class="ft1"><a href="<?php  echo $this->createMobileUrl("tea_homeWorkHistory")?>">作业记录</a></div>
		</div>
        <ul class="zy" id="homework_list">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/Tea_homeWorkHistory_ajax', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/Tea_homeWorkHistory_ajax', TEMPLATE_INCLUDEPATH));?>
        </ul>
        <div class="yck" id='end_text'></div>
        <?php  $center_class = 'cde'?>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    </div>
</body>
<script>
    var pager=1;
    function getHomeWorkList(){
    if(pager>0){
        $.ajax({
        url:"<?php  echo $this->createMobileUrl('Tea_homeWorkHistory',array('ac'=>'ajax'))?>",
        type:'post',
        data:{pager:pager},
        success:function(html){
            if(html && html !='done'){
                $("#homework_list").append(html);
                pager++;
            }else{
                $("#end_text").html("已经全部查看完了");
                pager = 0;
            }
        }
        });
    }
    }
    $(function(){
        getHomeWorkList();
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
        getHomeWorkList();
            }
        });
    });

</script>
</html>
