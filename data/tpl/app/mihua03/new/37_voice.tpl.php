<?php defined('IN_IA') or exit('Access Denied');?>    <div class='voice_display' id='voice_display'>
        <div class='micro_voice_ico' ><i class="fa fa-microphone"></i><br>还可录<span id='end_sec'>60</span>秒、录音中...</div>
        <div id='voice_stop' class='button button-highlight button-rounded button-small'>停止录音</div>
     </div>

    <script>
        var do_end;
        function endSec(){
            val = $("#end_sec").html();
            if(val>5){
                val--;
                $("#end_sec").html(val);
            }else{
                clearInterval(do_end)
                toStopRecord("录制超过60秒，请重试");
            }
        }
        var voice = {
            localId: '',
            serverId: ''
        };   
        function chooseVoice () {
            wx.startRecord({
            cancel: function () {
                alert('您拒绝授权录音');
            }
        });
            $("#end_sec").html(60);
            do_end = setInterval("endSec()",1000);
            $("#voice_display").show();
        }
        //停止录音
        document.querySelector('#voice_stop').onclick = function () {
            toStopRecord("录制发生错误，请重试!");
        } 

        function toStopRecord(info){
            wx.stopRecord({
                success: function (res) {
                    voice.localId = res.localId;
                    $("#voice_display").hide();
                    uploadVoice();
                },
                fail: function (res) {
                    alert(info);
                }
            });
        }
        //上传录音
        function uploadVoice() {
            if (voice.localId == '') {
            return;
            }
            wx.uploadVoice({
            localId: voice.localId,
            success: function (res) {
                $("#uploadVoice").html("上传录音成功");
                insertVoiceValue(res.serverId);
                voice.serverId = res.serverId;
            }
            });
        };    
        function insertVoiceValue(value){
            $("#voice_value").html("<input type='hidden' name='voice_value' value='"+value+"' >");
        } 
    </script>