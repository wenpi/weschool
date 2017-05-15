/**
 * Created by Administrator on 2016/10/18.
 */
$(function(){
    $(".accordion-heading > a").on('click',function(){
        var op = $(this).parent().next('.accordion-group');
        if(op.css('display') == 'none') {
            $(this).find('img').attr('src','/addons/lianhu_school/template/mobile/images/jianhao.png'); // 减号图片
            $(this).parent().css('border-bottom-left-radius','0');
            $(this).parent().css('border-bottom-right-radius','0');
            op.css('border-top-left-radius','0');
            op.css('border-top-right-radius','0');
            op.slideDown();
        } else {
            op.slideUp();
            $(this).parent().css('border-bottom-left-radius','5px');
            $(this).parent().css('border-bottom-right-radius','5px');
            op.css('border-top-left-radius','5px');
            op.css('border-top-right-radius','5px');
            $(this).find('img').attr('src','/addons/lianhu_school/template/mobile/images/jiahao.png'); // 加号图片
        }
    })
});
