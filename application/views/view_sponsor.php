<link href="<?= base_url() ?>front_assets/sponsor/css/sponsor-home.css?v=<?= rand(1, 100) ?>" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.full.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.16/jquery.datetimepicker.css">

<?php
$sponsors_logo = ($sponsor->sponsors_logo == '') ? 'logo_placeholder.png' : $sponsor->sponsors_logo;
$sponsor_cover = ($sponsor->sponsor_cover == '') ? 'tiada_default_cover.jpg' : $sponsor->sponsor_cover;
?>

<main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?= base_url() ?>uploads/sponsors/<?= $sponsor_cover ?>?v=<?= rand(1, 100) ?>);background-size: 1930px;background-repeat: no-repeat;background-position: center;height: 600px;background-color: #272f31;">
        <span class="pull-right fishbowl" style="cursor: pointer;"><img src="<?= base_url() ?>front_assets/sponsor/images/fishbowl.png" style="width: 165px;margin-top: 30px;"><br><span style="color: white;font-size: 15px;">click to leave your card</span></span>
        <?php
        if ($sponsor->embed_code != '' && $sponsor->video_position == '1')
        {
            ?>
            <div id="tv-container">
                <div id="monitor">
                    <div id="monitorscreen">
                        <?= $sponsor->embed_code ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row m-b-30">
            <input type="hidden" id="view_sponsor_history_id" value="">
            <div class="col-md-4">
                <img class="sponsor-main-logo" src="<?= base_url() ?>uploads/sponsors/<?= $sponsors_logo ?>">
                <h1 class="sponsor-name">
                    <?= $sponsor->company_name ?>
                </h1>
                <?php
                if ($sponsor->about != '') {
                    echo '<div class="about-us-div">';
                    echo '<h3>About Us</h3>';
                    echo $sponsor->about;
                    echo '</div>';
                }
                ?>

                <?php
                if ($sponsor->embed_code != '' && $sponsor->video_position == '0') {
                    ?>
                    <div class="about-video">
                        <?= $sponsor->embed_code ?>
                    </div>
                    <?php
                }
                ?>

                <div class="clearfix m-b-25"></div>
                <?php
                if ($sponsor->website != '') {
                    echo '<a href="//' . $sponsor->website . '" target="_blank"><i class="fa fa-globe fa-3x" aria-hidden="true" style="color: #417cb0;"></i></a>';
                }
                if ($sponsor->twitter_id != '') {
                    echo '<a href="https://twitter.com/' . $sponsor->twitter_id . '" target="_blank"><i class="fa fa-twitter-square fa-3x m-l-10" aria-hidden="true" style="color: #1da1f2;;"></i></a>';
                }
                if ($sponsor->facebook_id != '') {
                    echo '<a href="https://facebook.com/' . $sponsor->facebook_id . '" target="_blank"><i class="fa fa-facebook-square fa-3x m-l-10" aria-hidden="true" style="color: #036ce4;"></i></a>';
                }
                if ($sponsor->linkedin_id != '') {
                    echo '<a href="https://www.linkedin.com/company/' . $sponsor->linkedin_id . '" target="_blank"><i class="fa fa-linkedin-square fa-3x m-l-10" aria-hidden="true" style="color: #0077b5;"></i></a>';
                }
                if ($sponsor->twitter_id != '') {
                    echo '<div class="col-md-12 m-t-20" style="height: 420px; overflow: scroll">
                            <a class="twitter-timeline" href="https://twitter.com/' . $sponsor->twitter_id . '?ref_src=twsrc%5Etfw">Tweets by ' . $sponsor->twitter_id . '</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                          </div>
                    ';
                }
                ?>
            </div>

            <div class="col-md-4">
                <div class="grpchat-margin"></div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Chat with <?= $sponsor->company_name ?>
                            <span class="schedule-meet-btn small-edit-btn badge badge-primary pull-right">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Schedule a meet
                            </span>
                            <span class="video-call-btn badge badge-primary pull-right">
                                <i class="fa fa-video-camera" aria-hidden="true"></i> Call
                            </span>
                        </h3>
                    </div>
                    <div id="chat-body" class="panel-body">
                        <ul class="chat">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <span class="oto-typing"></span><br>
                        <div class="input-group">
                            <input type="text" id="one-to-one-ChatText" class="form-control" placeholder="You can also press enter key to send">
                            <span class="input-group-btn">
                                <button class="btn btn-blue send-oto-chat-btn" type="button">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                </button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Resources
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group-flush resources-list">

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="grpchat-margin"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?= $sponsor->company_name ?> Group Chat
                        </h3>
                    </div>
                    <div id="grp-chat-body" class="panel-body">
                        <ul class="group-chat">

                        </ul>
                    </div>
                    <div class="panel-footer">
                        <span class="is-typing"></span><br>
                        <div class="input-group">
                            <input type="text" id="groupChatText" class="form-control" placeholder="You can also press enter key to send">
                            <span class="input-group-btn">
                                <button class="btn btn-blue send-grp-chat-btn" type="button">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php $meeting_room_allowed_sposors = array('22', '15', '36', '9', '7');
        if (in_array($sponsor->sponsors_id, $meeting_room_allowed_sposors))
        {
            echo '<a target="_blank" href="'.base_url().'sponsor-admin/VchatRoom/join/'.$sponsor->sponsors_id.'"><img src="'.base_url().'front_assets/sponsor/images/tx_flag_75.png"></a>';
        }
        ?>
        <hr>

    </div> <!-- /container -->

    <!-- Modal -->
    <div class="modal fade" id="videoCallModal" tabindex="-1" role="dialog" aria-labelledby="videoCallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoCallModalLabel">Calling <?= $sponsor->company_name ?></h5>
                </div>
                <div class="modal-body text-center">
                    <div class="video-call-parent">
                        <div id="videos-container">
                            <video class="myVideoTag" id="myVideoTag" autoplay muted="muted"></video>
                            <video class="theirVideoTag" id="theirVideoTag" autoplay></video>
                        </div>
                        <i aria-hidden="true" class="video-call-hangup fa fa-phone-square fa-4x" style="color: #ca0b0b;"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Schedule a meeting with <?= $sponsor->company_name ?></h5>
                </div>
                <div class="modal-body">
                    <h4> 30 minutes, starting from:</h4>
                    <div class="input-group">
                        <input id="selectedMeetingDateTime" type="text" class="form-control datetimepicker" placeholder="Choose your time slot from available date and times" readonly="readonly">
                        <span class="input-group-btn">
                            <button class="book-meet-btn btn btn-success" type="button">
                                <i class="fa fa-calendar-plus-o fa-2x" aria-hidden="true"></i> Book
                            </button>
                        </span>
                    </div>
                    <small>Available dates are highlighted in green</small>
                </div>
                <div class="modal-footer">
                    <small class="pull-left">All dates and times are in The North American Central Time Zone (CT)</small>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!--    <div class="modal fade" id="push_notification" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
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
    </div>-->
    <div class="modal fade" id="push_notification_sponsor" tabindex="-1" role="modal" aria-labelledby="modal-label" aria-hidden="true" style="display: none; text-align: left; right: unset;">
        <input type="hidden" id="push_notification_sponsor_id" value="">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 1px solid #ae0201;">
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
</main>
<script type="text/javascript">
    var page_link = $(location).attr('href');
    var user_id = <?= $this->session->userdata("cid") ?>;
    var page_name = "Sponsor View";
    var sponsor_id = <?= $sponsor->sponsors_id ?>;
    var company_name = "<?= str_replace(' ', '_', $sponsor->company_name) ?>";
    var company_name_orig = "<?= $sponsor->company_name ?>";
    var company_name_lower = "<?= strtolower($sponsor->company_name) ?>";
    var base_url = "<?= base_url() ?>";
    var sponsor_logo = "<?= $sponsor->sponsors_logo ?>";
    var user_name = "<?= $this->session->userdata('fullname') ?>";
    var user_type = "attendee";

    $(document).ready(function () {

        var url = $(location).attr('href');
        var segments = url.split('/');
        var segments_id = segments[6];
        if (window.history && window.history.pushState) {
            window.history.pushState(segments_id, null, './' + segments_id);
            $(window).on('popstate', function () {
                $.ajax({
                    url: "<?= base_url() ?>sponsor/update_viewsessions_history_open",
                    type: "post",
                    data: {'view_sponsor_history_id': $("#view_sponsor_history_id").val()},
                    dataType: "json",
                    success: function (data) {
                    }
                });

            });
        }

        var resolution = screen.width + "x " + screen.height + "y";
        $.ajax({
            url: "<?= base_url() ?>sponsor/add_viewsessions_history_open",
            type: "post",
            data: {'sponsor_id': sponsor_id, 'resolution': resolution},
            dataType: "json",
            success: function (data) {
                $("#view_sponsor_history_id").val(data.view_sponsor_history_id);
            }
        });


        $.ajax({
            url: "<?= base_url() ?>home/add_user_activity",
            type: "post",
            data: {'user_id': user_id, 'page_name': page_name, 'page_link': page_link},
            dataType: "json",
            success: function (data) {
            }
        });

        $('#mainMenuItems').append('' +
                '<li>' +
                '<a href="sponsor-admin/logout" style="color:#A9A9A9; font-size: 18px;">' +
                '<i class="fa fa-sign-out" style="color:#A9A9A9; font-size: 18px;"></i>' +
                'Logout' +
                '</a>' +
                '</li>');
    });
</script>
<script src="https://meet.yourconference.live/socket.io/socket.io.js"></script>
<script src="/SSEConnection/RTCMultiConnection.min.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/SSEConnection.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/attendee-sponsor-view.js?v=<?= rand(1, 100) ?>"></script>
<script src="https://blueimp.github.io/JavaScript-MD5/js/md5.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/group-chat.js?v=<?= rand(1, 100) ?>"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/one-to-one-chat-attendee.js?v=<?= rand(1, 100) ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        push_notification_sponsor();
        setInterval(push_notification_sponsor, 4000);
        function push_notification_sponsor()
        {
            var push_notification_id = $("#push_notification_sponsor_id").val();
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

