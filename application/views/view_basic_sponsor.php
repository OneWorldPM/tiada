<?php
$sponsors_logo = ($sponsor->sponsors_logo == '') ? 'logo_placeholder.png' : $sponsor->sponsors_logo;
$sponsor_cover = ($sponsor->sponsor_cover == '') ? 'tiada_default_cover.jpg' : $sponsor->sponsor_cover;
?>

<link rel="stylesheet" href="https://www.yourconference.live/demo//assets/css/sponsor_02.css" type="text/css">
<link href="<?= base_url() ?>front_assets/sponsor/css/sponsor-home.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<style>
    .header-transparent{
        background-color: white !important;
    }

    body{
        background-image: url(<?= base_url() ?>uploads/sponsors/<?= $sponsor_cover ?>?v=<?= rand(1, 100) ?>g) !important;
        background-attachment: fixed !important;
        height: 100vh !important;
        background-repeat: no-repeat !important;
        background-size: 100% 100% !important;
    }
</style>

<section id="sponsor_02">


    <div class="container">
        <div class="column mt-5">

            <div class="row lg-2 box-grid">
                <div class="container pt-4 pb-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4" style="padding-left: 30px;">
                            <a href="sponsor_01.php">
                                <strong>« Previous</strong>
                            </a>
                        </div>
                        <div class="col-lg-4" style="padding-left: 158px;">
                            <img src="<?= base_url() ?>uploads/sponsors/<?= $sponsors_logo ?>" alt="ow_logo" witdh="145" height="110px">
                        </div>
                        <div class="col-lg-4" style="padding-left: 300px;">
                            <a href="sponsor_03.php">
                                <strong>Next »</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row lg-10">
                <div class="container">
                    <div class="row justify-content-start align-items-start">
                        <div class="container mt-2">
                            <div class="row align-items-center justify-content-between">

                                <div class="col-lg-3 box-grid align-self-start">
                                    <div class="container">
                                        <div class="column justify-content-center align-items-center">
                                            <div class="row lg-2 mb-3 mt-3 ml-5">
                                                <h5 style="font-weight: bold;">SOCIAL MEDIA</h5>
                                            </div>
                                            <div class="row lg-10 mb-3">
                                                <a class="twitter-timeline" data-width="300" data-height="300" href="https://twitter.com/<?= $sponsor->twitter_id ?>">Tweets by @<?= $sponsor->twitter_id ?></a>
                                                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 box-grid align-self-start">
                                    <img src="https://www.yourconference.live/demo/assets/img/biz_hero.jpg" alt="biz_hero" style="width: 100%;">
                                </div>

                                <div class="col-lg-3 box-grid align-self-start">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                Chat with sponsor
                                            </h3>
                                        </div>
                                        <div id="grp-chat-body" class="panel-body">
                                            <ul class="chat">

                                                <li class="grp-chat left clearfix">
                                                    <span class="chat-img pull-left">
                                                        <img src="https://placehold.it/50/0caa25/fff&text=YN" alt="User Avatar" class="img-circle" />
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">Your Name</strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                        </div>
                                                        <p>
                                                            Hello?
                                                        </p>
                                                    </div>
                                                </li>

                                                <li class="grp-chat right clearfix">
                                                    <span class="chat-img pull-right">
                                                        <img src="<?= base_url() ?>uploads/sponsors/<?= $sponsors_logo ?>" alt="User Avatar" class="img-circle" />
                                                    </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                                            <strong class="pull-right primary-font"><?= $sponsor->company_name ?></strong>
                                                        </div>
                                                        <p>
                                                            Hi, welcome!
                                                        </p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="You can also press enter key to send">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-blue test-edit-btn" type="button">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="push_notification" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
        <input type="hidden" id="push_notification_id" value="">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 7px solid #ae0201;">
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
    <div class="modal fade" id="push_notification_sponsor" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
        <input type="hidden" id="push_notification_sponsor_id" value="">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 7px solid #ae0201;">
                <div class="modal-body">
                    <div class="row" style="padding-top: 10px; padding-bottom: 20px;">
                        <div class="col-sm-12">
                            <div style="color:#ae0201; font-size: 16px; font-weight: 800; " id="push_notification_message_sponsor"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close" style="padding: 10px; color: #fff; background-color: #ae0201; opacity: 1;" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url() ?>front_assets/sponsor/js/sponsor-home.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(function () {

        $('#grp-chat-body').scrollTop($('#grp-chat-body')[0].scrollHeight);

        $('#mainMenuItems').append('' +
                '<li>' +
                '<a href="sponsor-admin/logout" style="color:#A9A9A9; font-size: 18px;">' +
                '<i class="fa fa-sign-out" style="color:#A9A9A9; font-size: 18px;"></i>' +
                'Logout' +
                '</a>' +
                '</li>');
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        push_notification_admin();
        setInterval(push_notification_admin, 3000);

        push_notification_sponsor();
        setInterval(push_notification_sponsor, 3000);

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

        function push_notification_sponsor()
        {
            var push_notification_id = $("#push_notification_sponsor_id").val();
            var sponsor_id = <?= $sponsor->sponsors_id ?>;
            $.ajax({
                url: "<?= base_url() ?>push_notification/get_push_notification_sponsor",
                type: "post",
                data: {'sponsor_id': sponsor_id},
                dataType: "json",
                success: function (data) {
                    if (data.status == "success") {
                        if (push_notification_id == "0") {
                            $("#push_notification_sponsor_id").val(data.result.push_notification_id);
                        }
                        if (push_notification_id != data.result.push_notification_id) {
                            $("#push_notification_sponsor_id").val(data.result.push_notification_id);
                            $('#push_notification_sponsor').modal('show');
                            $("#push_notification_message_sponsor").text(data.result.message);
                        }
                    } else {
                        $('#push_notification_sponsor').modal('hide');
                    }
                }
            });
        }
    });
</script>
