<style>
    .post-info {
        margin-bottom: 0px; 
        opacity: 1; 
    }
    .post-item {
        border-bottom: 0px solid #9b9b9b;
        margin-bottom: 0px; 
        padding-bottom: 0px;
    }

    .hidden {
        visibility: hidden;
    }
    a:hover {
        color: #000 !important;
    }
</style>
<section class="parallax" style="background-image: url(<?= base_url() ?>front_assets/images/bubble_bg_1920.jpg); top: 0; padding-top: 0px;">
<!--<section class="parallax" style="background-image: url(<?= base_url() ?>front_assets/images/Sessions_BG_screened.jpg); top: 0; padding-top: 0px;">-->
    <div class="container container-fullscreen" >
        <div class="text-middle">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="font-weight: 600; font-size: 22px; padding-left: 30px; color: #ae0201;">My Swag Bag</h3>
                </div>
            </div>
            <?php if (isset($sponsor_resources) && !empty($sponsor_resources)) { ?>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">Resource files from booths</div>
                        <div class="panel-body">
                            <ul class="list-group resources-list">
                                <?php foreach ($sponsor_resources as $item) { ?>
                                    <div class="col-md-6 m-b-10 resource-item-div" resource-id="<?= $item->session_resource_id ?>">
                                        <li class="list-group-item">
                                            <h3><i class="fa fa-file-pdf-o " aria-hidden="true"></i><?= $item->item_name ?></h3>
                                            <a class="btn btn-sm btn-success" href="/tiadaannualconference/front_assets/sponsor/resources/<?= $item->file_name ?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i> Open</a>
                                        </li>
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="row">

                <div class="col-md-12">

                    <!-- CONTENT -->
                    <section class="content" style="padding: 0px 0;">
                        <div class="container" style=" background: rgba(250, 250, 250, 0.8); "> 
                            <!-- Blog post-->
                            <div class="post-content post-single"> 
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <table class="table table-bordered table-striped text-center ">
                                        <thead class="th_center">
                                            <tr>
                                                <th><b>Sessions to attend</b></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $session_limit = $this->common->get_roundtable_setting();
                                            ?>
                                        <input type="hidden" value="<?= $session_limit->per_attendee ?>" id="per_attendee">
                                        <!-- Blog image post-->
                                        <?php
                                        if (isset($all_sessions) && !empty($all_sessions)) {
                                            foreach ($all_sessions as $val) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="post-item">
                                                            <div class="post-image col-md-4 m-t-20"> 
                                                                <h6 style="font-weight: 600; font-size: 13px;"><?= $val->sessions_date . ' ' . date("h:i A", strtotime($val->time_slot)) . ' - ' . date("h:i A", strtotime($val->end_time)) ?></h6>
                                                            </div>
                                                            <div class="post-content-details col-md-8 m-t-10" style="text-align: left;">

                                                                <div class="post-title">
                                                                    <h3><a href="<?= base_url() ?>sessions/attend/<?= $val->sessions_id ?>" style="color: #ae0201; font-weight: 900;"><?= $val->session_title ?></a> </h3>
                                                                </div>
                                                                <?php
                                                                if (isset($val->presenter) && !empty($val->presenter)) {
                                                                    foreach ($val->presenter as $value) {
                                                                        ?>
                                                                        <div class="post-info" style="color: #000 !important; font-size: larger; font-weight: 700;"><span class="post-autor"><a href="#" data-presenter_photo="<?= $value->presenter_photo ?>" data-presenter_name="<?= $value->presenter_name ?>" data-designation="<?= $value->designation ?>" data-email="<?= $value->email ?>" data-company_name="<?= $value->company_name ?>" data-twitter_link="<?= $value->twitter ?>" data-facebook_link="<?= $value->facebook ?>" data-linkedin_link="<?= $value->linkin ?>" data-bio="<?= $value->bio ?>"  class="presenter_open_modul"><?= $value->presenter_name ?>, </a></span> <span class="post-category"> <?= $value->title ?></span> </div>
                                                                        <div class="post-info" style="color: #000 !important; font-size: larger; font-weight: 700;"><span class="post-category"> <?= $value->company_name ?></span> </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="post-description col-md-12">
                                                            <a class="button black-light button-3d rounded right" style="margin: 0px 0; padding: 7px;" href="<?= base_url() ?>sessions/attend/<?= $val->sessions_id ?>"><span>Attend</span></a>
                                                            <a class="button black-light button-3d rounded right save_to_swag_bag" data-sessions_id="<?= $val->sessions_id ?>" data-swag_bag_btn_status="0"   style="margin: 0px 5px 0px 0px; padding: 7px;"><?= ($val->status_my_swag_bag == 0) ? "Save to Itinerary" : "Remove from Itinerary" ?> </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Blog post--> 
                            </div>
                    </section>
                    <!-- END: SECTION --> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- CONTENT -->
                    <section class="content" style="padding: 0px 0;">
                        <div class="container" style=" background: rgba(250, 250, 250, 0.8); "> 
                            <!-- Blog post-->
                            <div class="post-content post-single"> 
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <table class="table table-bordered table-striped text-center ">
                                        <thead class="th_center">
                                            <tr>
                                                <th colspan="2"><b>Notes</b></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($briefcase_list) && !empty($briefcase_list)) {
                                                foreach ($briefcase_list as $val) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $val->session_title ?> </td>
                                                        <td> <?= $val->note ?></td>
                                                        <td> <a class="button black-light small" style="margin: 0px 0;" href="<?= base_url() ?>home/delete_note/<?= $val->sessions_cust_briefcase_id ?>"><span>Delete</span></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Blog post--> 
                            </div>
                    </section>
                    <!-- END: SECTION --> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- CONTENT -->
                    <section class="content" style="padding: 0px 0;">
                        <div class="container" style=" background: rgba(250, 250, 250, 0.8); "> 
                            <!-- Blog post-->
                            <div class="post-content post-single"> 
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <table class="table table-bordered table-striped text-center ">
                                        <thead class="th_center">
                                            <tr>
                                                <th colspan="2"><b>Resource</b></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($briefcase_list) && !empty($briefcase_list)) {
                                                foreach ($briefcase_list as $val) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $val->session_title ?></td>
                                                        <td>
                                                            <?php
                                                            if ($val->session_resource_id != "") {
                                                                $resource_details = $this->common->get_session_resource($val->session_resource_id);
                                                                if (!empty($resource_details)) {
                                                                    ?>
                                                                    <a href="<?= $resource_details->resource_link ?>" target="_blank"><?= $resource_details->link_published_name ?></a><br>
                                                                    <a href="<?= base_url() ?>uploads/resource_sessions/<?= $resource_details->resource_file ?>" download> <?= $resource_details->upload_published_name ?> </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td> <a class="button black-light small" style="margin: 0px 0;" href="<?= base_url() ?>home/delete_note/<?= $val->sessions_cust_briefcase_id ?>"><span>Delete</span></a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Blog post--> 
                            </div>
                    </section>
                    <!-- END: SECTION --> 
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
</section>
<script type="text/javascript">
    $(document).ready(function () {

        $('.btn_sign_up').on('click', function () {
            var sessions_id = $(this).attr("data-sessions_id");
            var user_limit = $(this).attr("data-user_limit");
            var total_user_limit = $("#per_attendee").val();
            if (user_limit < total_user_limit) {
                alertify.confirm('Are you sure you want to sign up for this roundtable session?', function (e) {
                    if (e) {
                        $.ajax({
                            url: "<?= base_url() ?>sessions/sign_up_sessions",
                            type: "post",
                            data: {'sessions_id': sessions_id},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == "success") {
                                    window.location.reload();
                                } else if (data.status == "exist") {
                                    alertify.alert('This is not available. Registration is limited to one concurrent roundtable per registrant.');
                                }
                            }
                        });
                    }
                });
            } else {
                alertify.alert('You have reached your roundtable limitation');
            }
        });

        $('.btn_unregister').on('click', function () {
            var sessions_id = $(this).attr("data-sessions_id");
            alertify.confirm('Are you sure you want to unregister for this roundtable session?', function (e) {
                if (e) {
                    $.ajax({
                        url: "<?= base_url() ?>sessions/unregister_sessions",
                        type: "post",
                        data: {'sessions_id': sessions_id},
                        dataType: "json", success: function (data) {
                            window.location.reload();
                        }
                    });
                }
            });
        });

        $('.save_to_swag_bag').on('click', function () {
            var sessions_id = $(this).attr("data-sessions_id");
            var status = $(this).attr("data-swag_bag_btn_status");
            $.ajax({
                url: "<?= base_url() ?>sessions/save_to_swag_bag",
                type: "post",
                data: {'sessions_id': sessions_id},
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                }
            });
        });

        $('#social_link_div').addClass('hidden');
        $("#social_link_div_show").hover(function () {
            $('#social_link_div').removeClass('hidden');
        }, function () {
            $('#social_link_div').addClass('hidden');
        });
        $(".presenter_open_modul").click(function () {
            var presenter_photo = $(this).attr("data-presenter_photo");
            var presenter_name = $(this).attr("data-presenter_name");
            var designation = $(this).attr("data-designation");
            var company_name = $(this).attr("data-company_name");
            var email = $(this).attr("data-email");
            var twitter_link = $(this).attr("data-twitter_link");
            var facebook_link = $(this).attr("data-facebook_link");
            var linkedin_link = $(this).attr("data-linkedin_link");
            var bio = $(this).attr('data-bio');
            $('#presenter_profile').attr('src', "<?= base_url() ?>uploads/presenter_photo/" + presenter_photo);
            $('#presenter_title').text(presenter_name + ", " + designation);
            $('#email').text(email);
            $('#company').text(company_name);
            $("#twitter_link").attr("href", twitter_link);
            $("#facebook_link").attr("href", facebook_link);
            $("#linkedin_link").attr("href", linkedin_link);
            $("#bio_text").text(bio);
            $('#modal').modal('show');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var page_link = $(location).attr('href');
        var user_id = <?= $this->session->userdata("cid") ?>;
        var page_name = "My Itinerary";
        $.ajax({
            url: "<?= base_url() ?>home/add_user_activity",
            type: "post",
            data: {'user_id': user_id, 'page_name': page_name, 'page_link': page_link},
            dataType: "json",
            success: function (data) {
            }
        });
    });
</script>
