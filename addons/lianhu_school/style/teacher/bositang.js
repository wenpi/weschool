// JavaScript Document

$(document).ready(function(){
		a_height()
		$(window).resize(function(){
			a_height()
			})
		
		//鼠标滚动方法
		$(window).scroll(function(){
			ScollPostion();
			})
		//滚动条位置
		 function  ScollPostion() {
			var t
			if (document.documentElement && document.documentElement.scrollTop) {
				t = document.documentElement.scrollTop;
			} else if (document.body) {
				t = document.body.scrollTop;
			}
			
		  if(t==0){
			  $('.dao_top').css('display','none');
			  }else{
				   $('.dao_top').css('display','block');
				  }	
    }
			//头部导航
			top_nav();
			//就业体系
	        obtain();
			//立即申请试听
			apply_box();
			
		})
	//首页a标签的高
	function a_height(){
			var a_width=$('.icon .icon_right div a').width();
			$('.icon .icon_right div a').css('height',a_width+'px');
			}
	//头部导航
	function top_nav(){
		$('.t_icon').click(function(){
			$('.box_top_nav').show();
			})
		$(".top_nav").click(function(event){
            event.stopPropagation();
        });
		$('.box_top_nav').click(function(){
			$(this).hide();
			})
		}
	//就业体系
	function obtain(){
		$('.obtain_a span').click(function(){
			var is_boolean=$(this).parent().next().is(":visible");
			if(is_boolean==false){
				$('.obtain_info').hide();
				$('.obtain_a span').css({'background':'url(templates/images/icon_17.png)','background-repeat':'no-repeat','background-position':'right center'});
				$(this).css({'background':'url(templates/images/icon_18.png)','background-repeat':'no-repeat','background-position':'right center'}).parent().next().show();
				$(this).css({'background':'url(templates/images/icon_18.png)','background-repeat':'no-repeat','background-position':'right center'}).parent().addClass('obtain_a_bottom');
				}else{
					$('.obtain_info').hide();
					$('.obtain_a span').css({'background':'url(templates/images/icon_17.png)','background-repeat':'no-repeat','background-position':'right center'});
					$('.obtain_a').removeClass('obtain_a_bottom');
					}
			})
		}
	//立即申请试听
	function apply_box(){
		$('.course_a').click(function(){
			$('.box').show();
			})
		$(".box_relative").click(function(event){
            event.stopPropagation();
        });
		$('.box_top').click(function(){
			$('.box').hide();
			})
		$('.btn_close').click(function(){
			$('.box').hide();
			})
		$('.box').click(function(){
			$(this).hide();
			})
		}