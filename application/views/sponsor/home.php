<link href="<?= base_url() ?>front_assets/sponsor/css/sponsor-home.css?v=<?=rand(1, 100)?>" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
    <div class="jumbotron" id="sponsorCover" style="background-image: url(<?= base_url() ?>uploads/sponsors/<?= $sponsor_cover ?>?v=<?=rand(1, 100)?>);background-size: 1930px;background-repeat: no-repeat;background-position: center;height: 600px;background-color: #272f31;">
        <input type="file" id="coverupload" accept=".jpg,.jpeg,.png" style="display:none"/>
        <span class="cover-upload-btn small-edit-btn  badge badge-primary pull-right">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit cover
        </span>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row m-b-30">

            <div class="col-md-4">

                <div class="container" style="height: 220px;">
                    <img class="sponsor-main-logo" src="<?= base_url() ?>uploads/sponsors/<?=$sponsors_logo?>">
                    <input type="file" id="logoupload" accept=".jpg,.jpeg,.png" style="display:none"/>
                    <span class="logo-upload-btn small-edit-btn badge badge-primary">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit logo
                        </span>
                    <h1 class="sponsor-name">
                        <span class="company-name"><?=$company_name?></span>
                        <span class="name-edit-btn small-edit-btn badge badge-primary">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit name
                        </span>
                    </h1>
                </div>

            </div>

            <div class="col-md-4">
                <h3>About Us</h3>
                <textarea class="sponsor-about form-control" rows="7"><?=$about?></textarea>
                <span class="edit-about-btn badge badge-primary pull-right">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                </span>
            </div>

            <div class="col-md-4">
                <div class="clearfix m-b-25"></div>
                <div class="form-group">
                    <label class="sr-only" for="website"></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-globe fa-2x" style="color: #417cb0;" aria-hidden="true"></i>
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
                            <i class="fa fa-twitter-square fa-2x" style="color: #1da1f2;" aria-hidden="true"></i>
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
                            <i class="fa fa-facebook-square fa-2x" style="color: #036ce4;" aria-hidden="true"></i>
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
                            <i class="fa fa-linkedin-square fa-2x" style="color: #0077b5;" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="linkedinHandle" placeholder="Twitter handle" value="<?=$linkedin_id?>">
                        <div class="save-linkedin input-group-addon btn" type="button">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> save
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
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
                        <span class="is-typing"></span><br>
                        <div class="input-group">
                            <input type="text" id="groupChatText" class="form-control" placeholder="Can press enter to send">
                            <span class="input-group-btn">
                                <button class="btn btn-blue send-grp-chat-btn" type="button">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="grpchat-margin"></div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Attendees
                        </h3>
                    </div>
                    <div class="one-to-one-chat-body panel-body">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="oto-attendee-search form-control" placeholder="Search by name" aria-describedby="search-icon">
                                <span class="input-group-addon" id="search-icon">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="chat-users-list">
                                <ul class="attendees-chat-list list-group list-group-flush">
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="one-to-one-chat-panel panel panel-primary">
                                <div class="one-to-one-chat-heading panel-heading">
                                    <span class="selected-user-name-area" style="font-weight: bold;"></span>
                                    <h3 class="attendee-profile-btn pull-right">
                                        <span class="label label-info">
                                            <i class="fa fa-user" aria-hidden="true"></i> Profile
                                        </span>
                                    </h3>
                                </div>
                                <div class="oto-chat-body panel-body">
                                    <ul class="oto-messages">

                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <span class="oto-typing"></span><br>
                                    <div class="input-group">
                                        <input type="text" id="one-to-one-ChatText" class="form-control" placeholder="Can press enter to send">
                                        <span class="input-group-btn">
                                            <button class="btn btn-blue send-oto-chat-btn" type="button">
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

        <div class="row">
            <div id="availability-panel" class="panel panel-info">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fa fa-calendar" aria-hidden="true"></i> Set Availability of
                        <div class="dropdown" style="display: inline;">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="current-person-name">Select Person</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="agent-list dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li class="agent-list-item disabled-li" person="0"><a href="javascript:void(0);">Agent 1</a></li>
                                <li class="agent-list-item disabled-li" person="0" ><a href="javascript:void(0);">Agent 2</a></li>
                                <li role="separator" class="divider"></li>
                            </ul>
                            <input type="hidden" class="selected-agent">
                        </div>
                    </h2>
                </div>
                <div id="availability-body" class="panel-body collapse">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon" id="availablity-label">
                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Add another availability
                                </span>
                                <input type="text" class="form-control" id="availability-selector" name="availability-selector" aria-describedby="availablity-label">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="current-availability-panel panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Current Availability</h3>
                                </div>
                                <div class="current-availability-body panel-body">
                                    <ul class="current-availability-list list-group">
                                        <li class="current-availability-list-item list-group-item">empty</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

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

    <!-- Attendee profile-->
    <div id="attendeeProfileModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <span class="attendeeProfileModal-name"></span>
                        <span class="attendeeProfileModalSMIcons pull-right"></span><br>
                        <small class="attendeeProfileModalEmail pull-right"></small><br>
                        <small class="attendeeProfileModalPhone pull-right"></small>
                    </h4>
                </div>
                <div class="modal-body">
                    <p class="modal-profile-contents"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    var user_name = "<?= $company_name ?>";
    var user_name_lower = "<?= strtolower($company_name) ?>";
    var user_type = "sponsor";

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

        $('.agent-list').append('<li person="'+user_name_lower+'" class="agent-list-item"><a href="javascript:void(0);">'+user_name+'</a></li>');
    });

    function userProfileModal(userId) {
        $.get( "/tiadaannualconference/sponsor-admin/UserDetails/userDataById/"+userId, function(profile) {

            profile = JSON.parse(profile);

            var fullname = profile.first_name+' '+profile.last_name;
            if (fullname == ' ')
            {
                var fullname = 'Name Unavailable';
            }
            var nameAcronym = fullname.match(/\b(\w)/g).join('');
            var color = md5(nameAcronym+profile.cust_id).slice(0, 6);
            var userAvatarSrc = (profile.profile != '' && profile.profile != null)?'/tiadaannualconference/uploads/customer_profile/'+profile.profile:'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;
            var userAvatarAlt = 'https://placehold.it/50/'+color+'/fff&amp;text='+nameAcronym;


            $('.attendeeProfileModal-name').html(
                '<img src="'+userAvatarSrc+'" alt="User Avatar" onerror=this.src="'+userAvatarAlt+'" class="img-circle"> ' +
                fullname
            );

            $('.attendeeProfileModalSMIcons').html('');
            if (profile.facebook_id != '' && profile.facebook_id != null)
            {
                $('.attendeeProfileModalSMIcons').append('<a href="https://facebook.com/'+profile.facebook_id+'" target="_blank"><i class="fa fa-facebook fa-2x m-l-10" aria-hidden="true" style="color: #036ce4;"></i></a>');
            }
            if (profile.instagram_id != '' && profile.instagram_id != null)
            {
                $('.attendeeProfileModalSMIcons').append('<a href="https://instagram.com/'+profile.instagram_id+'" target="_blank"><i class="fa fa-instagram fa-2x m-l-10" aria-hidden="true" style="color: #c414a0;"></i></a>');
            }
            if (profile.twitter_id != '' && profile.twitter_id != null)
            {
                $('.attendeeProfileModalSMIcons').append('<a href="https://instagram.com/'+profile.twitter_id+'" target="_blank"><i class="fa fa-twitter fa-2x m-l-10" aria-hidden="true" style="color: #1da1f2;"></i></a>');
            }

            $('.attendeeProfileModalEmail').html('');
            if(profile.email != '' && profile.email != null)
            {
                $('.attendeeProfileModalEmail').html('<i class="fa fa-envelope" aria-hidden="true"></i> '+profile.email);
            }

            $('.attendeeProfileModalPhone').html('');
            if(profile.phone != '' && profile.phone != null){
                $('.attendeeProfileModalPhone').html('<i class="fa fa-phone-square" aria-hidden="true"></i> '+profile.phone);
            }

            $('.modal-profile-contents').text(' ');
            $('#attendeeProfileModal').modal('show');
        });
    }
</script>
<script src="https://meet.yourconference.live/socket.io/socket.io.js"></script>
<script src="/SSEConnection/RTCMultiConnection.min.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/SSEConnection.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/sponsor-home.js?v=<?=rand(1, 100)?>"></script>
<script src="https://blueimp.github.io/JavaScript-MD5/js/md5.js"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/group-chat.js?v=<?=rand(1, 100)?>"></script>
<script src="<?= base_url() ?>front_assets/sponsor/js/one-to-one-chat.js?v=<?=rand(1, 100)?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9.17.0/dist/sweetalert2.all.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

