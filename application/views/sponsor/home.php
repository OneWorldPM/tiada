<link href="<?= base_url() ?>front_assets/sponsor/css/sponsor-home.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<?php
$sponsors_logo = ($sponsors_logo == '')?'logo_placeholder.png':$sponsors_logo;
$sponsors_cover = ($sponsor_cover == '')?'sponsor-cover-default.jpg':$sponsor_cover;

?>

<main role="main">

    <?php
    if ($embed_code != '') {
        ?>
        <div class="vod-container">
            <?= $embed_code ?>
        </div>
        <?php
    }
    ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background-image: url(<?= base_url() ?>uploads/sponsors/<?= $sponsor_cover ?>?v=<?=rand(1, 100)?>);background-size: 1930px;background-repeat: no-repeat;background-position: center;height: 600px;background-color: #272f31;">
        <span class="edit-cover-btn badge badge-primary pull-right">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit cover
        </span>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row m-b-30">

            <div class="col-md-4">

                <div class="container" style="height: 220px;">
                    <img class="sponsor-main-logo" src="<?= base_url() ?>uploads/sponsors/<?=$sponsors_logo?>">
                    <span class="test-edit-btn badge badge-primary">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit logo
                        </span>
                    <h1 class="sponsor-name">
                        <span class="company-name"><?=$company_name?></span>
                        <span class="name-edit-btn small-edit-btn badge badge-primary">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit name
                        </span>
                    </h1>
                </div>

                <h3>About Us</h3>
                <textarea class="sponsor-about form-control" rows="7"><?=$about?></textarea>
                <span class="edit-about-btn badge badge-primary pull-right">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                </span>
                <div class="clearfix m-b-25"></div>
                <div class="form-group">
                    <label class="sr-only" for="website"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="website" placeholder="Website" value="<?=$website?>">
                        <div class="save-website input-group-addon btn" type="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="sr-only" for="twitterHandle"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="twitterHandle" placeholder="Twitter handle" value="<?=$twitter_id?>">
                        <div class="save-twitter input-group-addon btn" type="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="sr-only" for="facebookHandle"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="facebookHandle" placeholder="Facebook handle" value="<?=$facebook_id?>">
                        <div class="save-facebook input-group-addon btn" type="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="sr-only" for="linkedinHandle"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="linkedinHandle" placeholder="Twitter handle" value="<?=$linkedin_id?>">
                        <div class="save-linkedin input-group-addon btn" type="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="grpchat-margin"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Group Chat
                            <span class="clear-group-chat-btn badge badge-primary pull-right">
                                <i class="fa fa-trash" aria-hidden="true"></i> clear
                            </span>
                            <span class="save-group-chat-btn badge badge-primary pull-right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> save
                            </span>
<!--                            <span class="test-edit-btn badge badge-primary pull-right">-->
<!--                                <i class="fa fa-calendar" aria-hidden="true"></i> schedule-->
<!--                            </span>-->
                        </h3>
                    </div>
                    <div id="grp-chat-body" class="panel-body">
                        <ul class="group-chat">

                        </ul>
                    </div>
                    <div class="panel-footer">
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

            <div class="col-md-4">
                <div class="grpchat-margin"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Attendees
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="fa fa-circle" style="color:#3fdd3b;" aria-hidden="true"></i> Shannon Morton
                                <span class="chat-now-badge badge">Chat now</span>
                                <span class="profile-badge badge">Profile</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-circle" style="color:#3fdd3b;" aria-hidden="true"></i> Mark Rosenthal
                                <span class="chat-now-badge badge">Chat now</span>
                                <span class="profile-badge badge">Profile</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-circle" style="color:#ffa633;" aria-hidden="true"></i> John Brown
                                <span class="chat-now-badge badge">Chat now</span>
                                <span class="profile-badge badge">Profile</span>
                            </li>
                            <li class="list-group-item">
                                <i class="fa fa-circle" style="color:#3fdd3b;" aria-hidden="true"></i> John Doe
                                <span class="chat-now-badge badge">Chat now</span>
                                <span class="profile-badge badge">Profile</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <hr>

    </div> <!-- /container -->

    <!-- Modal -->
    <div class="modal fade" id="videoCallModal" tabindex="-1" role="dialog" aria-labelledby="videoCallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoCallModalLabel">Attendee online</h5>
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                        <span aria-hidden="true">&times;</span>-->
<!--                    </button>-->
                </div>
                <div class="modal-body text-center">
                    <div class="video-call-parent">
                        <div id="videos-container">
                            <video class="myVideoTag" id="myVideoTag" autoplay></video>
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

</main>

<script type="text/javascript">
    var page_link = $(location).attr('href');
    var user_id = <?= $this->session->userdata("sponsors_id") ?>;
    var page_name = "Sponsor Admin";
    var sponsor_id = <?= $sponsors_id ?>;
    var company_name = "<?= str_replace(' ', '_', $company_name) ?>";
    var company_name_orig = "<?= $company_name ?>";
    var base_url = "<?= base_url() ?>";
    var sponsor_logo = "<?= $sponsors_logo ?>";

    $(document).ready(function () {

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
<script src="<?= base_url() ?>front_assets/sponsor/js/sponsor-home.js?v=<?=rand(1, 100)?>"></script>
<script src="https://blueimp.github.io/JavaScript-MD5/js/md5.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/group-chat.js?v=<?=rand(1, 100)?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

