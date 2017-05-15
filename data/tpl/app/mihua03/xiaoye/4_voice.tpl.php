<?php defined('IN_IA') or exit('Access Denied');?>    <div class='voice_display' id='voice_display'>
        <div class='micro_voice_ico' ><i class="fa fa-microphone"></i><br>可录60秒、录音中...</div>
        <div id='voice_stop' class='button button_yellow'>停止录音</div>
     </div>
    <script>
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
            $("#voice_display").show();
        }
        //停止录音
        document.querySelector('#voice_stop').onclick = function () {
            wx.stopRecord({
            success: function (res) {
                voice.localId = res.localId;
                $("#voice_display").hide();
                uploadVoice();
            },
            fail: function (res) {
                alert(JSON.stringify(res));
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
                $("#voice_success").show();
                insertVoiceValue(res.serverId);
                voice.serverId = res.serverId;
            }
            });
        };    
        function insertVoiceValue(value){
            $("#voice_value").html("<input type='hidden' name='voice_value' value='"+value+"' >");
        } 
    </script>