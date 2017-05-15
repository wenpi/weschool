<?php defined('IN_IA') or exit('Access Denied');?>    <div class="modal fade draggable-modal" id="modal_notice" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
                        <h4 class="modal-title">提示消息</h4>
                    </div>
                <div class="modal-body">  </div>
            </div>
        </div>
    </div>
    <!--消息回执-->
    <div class="modal fade draggable-modal" id="msg_replay" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
                        <h4 class="modal-title">提示消息</h4>
                    </div>
                <div class="modal-body">  
                    <p class="text">

                    </p>
                    <p class="images">

                     </p>

                    <p class="voice">
                    </p>
            </div>
        </div>
    </div> 
    <div class="modal fade in" id="ajax" role="basic" aria-hidden="true" style="display: block; padding-right: 15px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?php echo MODULE_URL;?>/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                        <span> &nbsp;&nbsp;Loading... </span>
                </div>
                </div>
            </div>
        </div>
    <script>
            modal = 0;
            function showModel(model_id){
                modal == 1;
                $("#"+model_id).modal("show");
            }
            //隐藏
            function hiddenModel(model_id){
                modal == 0;
                $("#"+model_id).modal("hide");
            }           
    </script>