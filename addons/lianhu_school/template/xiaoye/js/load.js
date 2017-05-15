    //加载图片
    function displayImage(id_name,img_current){
            var img_urls    = [];
            var img_current = img_current;
            var obj         = $("#"+id_name);
            if(obj.find('img').length>0){
                $.each(obj.find('img'),function(i,e){
                    img_urls.push($(this).attr('src'));
                });
            }
            if(obj.find('.wx_img_list').length>0){
                $.each(obj.find('.wx_img_list'),function(i,e){
                    img_urls.push($(this).attr('data-src'));
                });                
            }
            // img_urls.pop()
            wx.previewImage({
                current: img_current,
                urls: img_urls
            });
    }
    function displayImageThis(img_current){
            var img_urls    = [];
            var img_current= img_current;
            img_urls.push(img_current);
            wx.previewImage({
                current: img_current,
                urls: img_urls
            });
    }
    //首页显示切换学生
    function changeDisplay(id_name){
        obj = $("#"+id_name);
        if(obj.attr('data-dis')=='yes'){
            obj.hide();
            obj.attr('data-dis','no');
        }else{
            obj.show();
            obj.attr('data-dis','yes');
        }
    }