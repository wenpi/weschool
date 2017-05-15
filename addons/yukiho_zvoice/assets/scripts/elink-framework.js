/**
 * 检查对象是否为空
 * @param $
 */
(function($){
  $.isBlank = function(obj){
    return(!obj || $.trim(obj) === "");
  };
  $.isFunction = function(obj){
	  return jQuery.type(obj) === "function";
  };
})(jQuery);

// 通用弹窗方法
function showModal(meta,call){
	if(meta.modal===undefined) meta.modal="remoteModal";
	console.log(meta);
    $("#"+meta.modal+"Content").load(meta.link+"?"+$.param(meta));
    $("#"+meta.modal).modal('show');
    if(jQuery.type(call) === "function"){
        $("#"+meta.modal).one('hidden.bs.modal', function (e) {
        	call(g_callback,meta);
        });
    }
}

/*
 * ajax调用service方法
 */
function callService(clazz, method, params, callBack, async) {
	if(clazz && method) {
		ajax("/elink/common/service", {clazz : clazz, method : method, params : params}, function(data) {
			callBack(data.result);
		}, async);
	}
}

/*
 * 请求Ajax 带返回值
 */
function ajax(url, params, callBack, async) {
	var response;
	if(async===undefined) async=true;
	$.ajax({
        type: 'post',
        dataType: "json", 
        url: url,
        data: params,
        cache: false,
        async: async,
        success: function (data) {
        	response = callBack(data);
        },
        error: function (data) {
        	msgBox('发生错误，请查看日志！', "error");
        }
    });
	return response;
}

/**
 * 是否是UUID格式
 * @param str
 * @returns {Boolean}
 */
function isId(str){
	return str!==undefined && str.length == 32;
}

/*
 * 自动获取页面控件值
 */
function getFormVals(element) {
    var reVal = "";
    $(element).find('input,select,textarea').each(function (r) {
        var id = $(this).attr('id');
        var value = $(this).val();
        var type = $(this).attr('type');
        switch (type) {
            case "checkbox":
                if ($(this).prop("checked")) {
                    reVal += '"' + id + '"' + ':' + '"1",'
                } else {
                    reVal += '"' + id + '"' + ':' + '"0",'
                }
                break;
            default:
                reVal += '"' + id + '"' + ':' + '"' + $.trim(value) + '",'
                break;
        }
    });
    reVal = reVal.substr(0, reVal.length - 1);
    return jQuery.parseJSON('{' + reVal + '}');
}

/*
 * 自动给控件赋值
 */
function setFormVals(data) {
    for (var key in data) {
        var id = $('#' + key); 
        if(jQuery.type(data[key]) === "string"){
            var value = $.trim(data[key]).replace("&nbsp;", "");
            var type = id.attr('type');
            switch (type) {
                case "checkbox":
                    if (value == 1) {
                        id.attr("checked", 'checked');
                    } else {
                        id.removeAttr("checked");
                    }
                    break;
                default:
                    id.val(value);
                    break;
            }
        }else if(jQuery.type(data[key]) === "object"){
        	$('#'+key+'id').val(data[key].id);
        	$('#'+key+'idspan').text(data[key].name);
        }
    }
}

/*
 * 接受地址栏参数
 */
function getUrlParam() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

/*
 * 自动给控件赋值、对Lable
 */
function setLables(data,prefix) {
	if(!prefix.length){
		prefix = "";
	}
    for (var key in data) {
        var id = $('#' + prefix + key);
        var value = $.trim(data[key]).replace("&nbsp;", "");
        id.text(value);
    }
}
/*
 * 给单个控件赋值
 */
function setLable(field, value, text) {
    $('#'+field).val(value);
    $('#'+field+'span').text($.trim(text).replace("&nbsp;", ""));
}

/*
 * 提醒框
 */
function bingo(msg,call) {
	noty({
        text        : msg,
        type        : "success",
        dismissQueue: true,
        layout      : 'center',
        timeout     : 2000,
        closeWith   : ['click'],
        theme       : 'defaultTheme',
		callback: {
			onShow: function() {},
			afterShow: call,
			onClose: function() {},
			afterClose: function() {},
			onCloseClick: function() {}
		}
    });
}

function warn(msg,call) {
	noty({
        text        : msg,
        type        : "warning",
        dismissQueue: true,
        layout      : 'center',
        timeout     : 2000,
        closeWith   : ['click'],
        theme       : 'defaultTheme',
		callback: {
			onShow: function() {},
			afterShow: call,
			onClose: function() {},
			afterClose: function() {},
			onCloseClick: function() {}
		}
    });
}

function error(msg,call) {
	noty({
        text        : msg,
        type        : "danger",
        dismissQueue: true,
        layout      : 'center',
        timeout     : 2000,
        closeWith   : ['click'],
        theme       : 'defaultTheme',
		callback: {
			onShow: function() {},
			afterShow: call,
			onClose: function() {},
			afterClose: function() {},
			onCloseClick: function() {}
		}
    });
}

/*
 * 确定框
 */
function confirmBox(msg, type, callback) {
    noty({
        text        : msg,
        type        : type,
        dismissQueue: true,
        layout       : 'center',
        theme       : 'defaultTheme',
        buttons     : [
            {addClass: 'btn btn-primary', text: '确定', onClick: function ($noty) {
                	$noty.close();
                	callback();
            	}
            },
            {addClass: 'btn btn-danger', text: '取消', onClick: function ($noty) {$noty.close();}}
        ]
    });
}

String.prototype.endWith=function(endStr){
	  var d=this.length-endStr.length;
	  return (d>=0&&this.lastIndexOf(endStr)==d)
}
