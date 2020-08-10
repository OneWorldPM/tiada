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
         <!-- <div class="soundbar"><span class="currentVolume"></span></div> -->
    </div>

    <div class="col-md-12">
        <div class="feed-control-icons m-t-15 m-b-15">
            <div class="mute-mic-btn m-b-20">
                <i class="fa fa-microphone-slash fa-3x mute-mic-btn-icon" aria-hidden="true" style="color:#ff422b;"></i>
                <small>Mute</small>
            </div>
            <div class="share-screen-btn">
                <i class="fa fa-desktop fa-3x share-screen-btn-icon" aria-hidden="true" style="color:#6f8de3;"></i>
                <small>Share Screen</small>
            </div>
        </div>
    </div>
</div>


<script>
    var round_table_id = <?=$sessions->sessions_id?>;
    var atttendee_name = "<?= $this->session->userdata('fullname') ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="<?= base_url() ?>assets/js/private-sessions.js?v=<?=rand(1, 100)?>"></script>
<script type="text/javascript">
    pageReady();
</script>
