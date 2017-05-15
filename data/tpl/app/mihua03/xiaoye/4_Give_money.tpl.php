<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>

<div class="z_main">
 <div class="head">
    <a href="<?php  echo $this->createMobileUrl('give_money') ?>" class="pp"><p>待缴费</p></a>
    <a href="<?php  echo $this->createMobileUrl('giveMoneyHistory') ?>"><p>已缴费</p></a>
    <a href="<?php  echo $this->createMobileUrl('moneyReback') ?>"><p>已退费</p></a>
 </div>
 <div id="firstpane" class="menu_list">
	<h3 class="jf">
		<p><?php  echo $info;?></p>
		<img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jt-x-s-h.png">
	</h3>
    <div style="display:block" class="menu_body">
	    <ul class="z_txx">
        <?php  if(is_array($arr)) { foreach($arr as $row) { ?>
            <li>
                <a href="<?php  echo $this->createMobileUrl('give_money_order',array('lid'=>$row['limit_id']));?>">
					<div class="z_pp1">
					<label for="checkbox-21">✔</label>
					</div>
					<div class="z_txx2" style="width: auto; margin-top: 0px;"><?php  echo $row['name'];?>:<?php  echo $row['money'];?>元</div>
                </a>
	    	</li>
        <?php  } } ?>
         <?php  if(!$arr) { ?>
                <li>
                    <a href="javascript:;">
                    <div class="z_pp1">
                        <label for="checkbox-21">✔</label>
                    </div>
                    <div class="z_txx2"style="width: auto;margin-top: 0px;">暂无缴费</div>
                    </a>
                </li>            
        <?php  } ?>
	    </ul>
	</div>
    </div>
</div>
<script>
$(document).ready(function(){
	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.jf").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.jf").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
});
</script>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>