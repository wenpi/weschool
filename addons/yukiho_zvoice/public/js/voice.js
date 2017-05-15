var voice = {};
var recording = false;
var localId = null;
var timer = null;
var post = {};
post.timelong = 0;
posting = false;

voice.show = function(){
    console.log(_follow);
    console.log(_openid);
    if(_follow == 0 || _openid.length < 4){

        $.modal({
            title:'请扫码关注后发言',
            text: '<img src="'+_qrcode+'" style="width:100%;"/>',
            buttons: []
        });
        return '';
    }
    wx.ready(function(){
        /**$.modal({
            title:'语音录制',
            text: $('#voicePanel').html(),
            buttons: []
        });*/
		$('#answerBtn').hide();
		$('#voicePanel').show();
    });
}

voice.play = function(){
    if(!post.localId){
        warn("请先录音!");
        return '';
    }
    wx.ready(function(){
        wx.playVoice({
            localId: post.localId,
            success: function(e) {
                playing = true;
				$('#record1').html('<i class="fa fa-volume-up"></i> 试听中...');
            },
            error:function(){
                warn("开启录音失败");
                return '';
            }
        });
        wx.onVoicePlayEnd({    
			success: function (e) { 
				$('#record1').html("<i class='fa fa-volume-up'></i> 再试听一次");
			}
        });
    });
}

voice.restart= function(){
    post.timelong = 0;
    recording = false;
    voice.start();
	$('#record2').hide();
	$('#record3').hide();
}

voice.restop = function(){
	setTimeout(function(){
		$('#record1').unbind("click").click(voice.play);
		$('#record1').html("<i class='fa fa-volume-up'></i> 试听"+post.timelong+"秒录音");
		$('#record2').show();
		$('#record2').unbind("click").click(voice.restart);
		$('#record2').html("<i class='fa fa-repeat'></i> 重录");
		$('#record3').show();
	},1000);
}

voice.stop = function(callback){
    wx.ready(function(){
        wx.stopRecord({
            success: function (res) {
                post.localId = res.localId;
                recording = false;
				voice.restop();
            }
        });
    });
}

/*$(function(){
 voice.timer();
 })*/

voice.timer = function(){
    return setTimeout(function(){
        post.timelong = post.timelong + 1;
        $('#record1').html('<i class="fa fa-pause"></i> 点击暂停（录音中：'+post.timelong+'秒）');
        if(recording){
            timer = voice.timer();
        }
    },1000);
}

voice.start = function(e){
    console.log(e);
    if(recording){
        voice.stop();
        //$('.fa-pause').addClass('fa-play').removeClass('fa-pause');
    }
    wx.ready(function(){
        wx.startRecord({
            cancel: function() {
                warn("你拒绝了录音");
                return ;
            },
            success: function() {
                recording = true;
                recording = true;
                //$('.fa-play').addClass('fa-pause').removeClass('fa-play');
				//$('#record1').unbind("click");
                timer = voice.timer();
				$('#record1').unbind("click").click(function(){
					voice.stop();
				});
            }
        });
        wx.onVoiceRecordEnd({
            complete: function(e) {
                post.localId = e.localId;
                recording = false;
                warn("录音时间已达上限60秒");
				voice.restop();
            }
        });
    })
}


