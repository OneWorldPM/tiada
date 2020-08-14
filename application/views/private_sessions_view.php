<link href="<?= base_url() ?>assets/css/private-sessions.css?v=<?=rand(1, 100)?>" rel="stylesheet">


<?php
//echo "<pre>";
//print_r($sessions);
//echo"</pre>";

?>

<main role="main" class="container text-center">
    <div>
        <h1>
            <?=$sessions->session_title?>
        </h1>
        <small class="lead"><?=$sessions->sessions_description?></small>
    </div>
</main>

<div class="row m-t-20 camera-feeds">



    <div class="col-md-3">
        <video id="localVideo" autoplay muted playsinline width="100%"></video>
        <span class="name-tag">You</span>
         <!-- <div class="soundbar"><span class="currentVolume"></span></div> -->
    </div>

<!--    <div class="col-md-12">-->
<!--        <div class="feed-control-icons m-t-15 m-b-15">-->
<!--            <div class="mute-mic-btn m-b-20">-->
<!--                <i class="fa fa-microphone-slash fa-3x mute-mic-btn-icon" aria-hidden="true" style="color:#ff422b;"></i>-->
<!--                <small>Mute</small>-->
<!--            </div>-->
<!--            <div class="share-screen-btn">-->
<!--                <i class="fa fa-desktop fa-3x share-screen-btn-icon" aria-hidden="true" style="color:#6f8de3;"></i>-->
<!--                <small>Share Screen</small>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>


<script>
    var round_table_id = <?=$sessions->sessions_id?>;
    var atttendee_name = "<?= $this->session->userdata('fullname') ?>";
    var attendee_id = "<?= $this->session->userdata('cid') ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="<?= base_url() ?>assets/js/private-sessions.js?v=<?=rand(1, 100)?>"></script>
<script type="text/javascript">
    pageReady();
</script>
<div class="modal fade" id="push_notification" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
    <input type="hidden" id="push_notification_id" value="">
    <div class="modal-dialog">
        <div class="modal-content" style="border: 1px solid #ae0201;">
            <div class="modal-body">
                <div class="row" style="padding-top: 10px; padding-bottom: 20px;">
                    <div class="col-sm-12">
                        <div style="color:#ae0201; font-size: 16px; font-weight: 800; " id="push_notification_message"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" style="padding: 10px; color: #fff; background-color: #ae0201; opacity: 1;" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        push_notification_admin();
        setInterval(push_notification_admin, 3000);
        function push_notification_admin()
        {
            var push_notification_id = $("#push_notification_id").val();

            $.ajax({
                url: "<?= base_url() ?>push_notification/get_push_notification_admin",
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        if (push_notification_id == "0") {
                            $("#push_notification_id").val(data.result.push_notification_id);
                        }
                        if (push_notification_id != data.result.push_notification_id) {
                            $("#push_notification_id").val(data.result.push_notification_id);
                            $('#push_notification').modal('show');
                            $("#push_notification_message").text(data.result.message);
                        }
                    } else {
                        $('#push_notification').modal('hide');
                    }
                }
            });
        }
    });
</script>
