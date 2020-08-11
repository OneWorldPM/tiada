<style>
    .post-info {
        margin-bottom: 0px; 
        opacity: 1; 
    }
    .post-item {
        border-bottom: 2px solid #9b9b9b;
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
                    <!-- CONTENT -->
                    <section class="content" style="min-height: 700px;">
                        <div class="container" style=" background: rgba(250, 250, 250, 0.8); "> 
                            <!-- Blog post-->
                            <div class="post-content post-single"> 
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <table class="table table-bordered table-striped text-center ">
                                        <thead class="th_center">
                                            <tr>
                                                <th>User ID</th>
                                                <th>Full Name</th>
                                                <th>Phone No.</th>
                                                <th>Email</th>
                                                <th>IP Address</th>
                                                <th>Operating System</th>
                                                <th>Browser</th>
                                                <th>Resolution</th>
                                                <th>Entry Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($booth_tracking) && !empty($booth_tracking)) {
                                                foreach ($booth_tracking as $val) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $val->user_id ?></td>
                                                        <td><?= $val->first_name . ' ' . $val->last_name ?></td>
                                                        <td><?= $val->phone ?></td>
                                                        <td><?= $val->email ?></td>
                                                        <td><?= $val->ip_address ?></td>
                                                        <td><?= $val->operating_system ?></td>
                                                        <td><?= $val->computer_type ?></td>
                                                        <td><?= $val->resolution ?></td>
                                                        <td><?= date("Y-m-d h:i:s", strtotime($val->start_date_time)) ?></td>
                                                        <td>
                                                            <?php if ($val->end_date_time != '') { ?>
                                                                <?= date("Y-m-d h:i:s", strtotime($val->end_date_time)) ?>
                                                            <?php } else { ?>
                                                                -
                                                            <?php } ?>
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
        </div>
    </div>
</section>

<script type="text/javascript">
    var page_link = $(location).attr('href');
    var user_id = <?= $this->session->userdata("sponsors_id") ?>;
    var page_name = "Sponsor Admin";
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
                '<a href="<?= base_url() ?>sponsor-admin/home/logout" style="color:#A9A9A9; font-size: 18px;">' +
                '<i class="fa fa-sign-out" style="color:#A9A9A9; font-size: 18px;"></i>' +
                'Logout' +
                '</a>' +
                '</li>');
    });
</script>
