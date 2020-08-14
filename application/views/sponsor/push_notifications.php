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
            <div class="row m-t-15">
                <div class="col-md-8 col-md-offset-2">
                    <form name="frm_credit" id="frm_credit" method="POST" action="">
                        <div class="panel panel-primary" id="panel5">
                            <div class="panel-heading">
                                <h4 class="panel-title text-white">Push Notifications</h4>
                            </div>
                            <div class="panel-body bg-white" style="border: 1px solid #b2b7bb;">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <label>Select Sponsor :</label>
                                            <select class="form-control" id="sponsors_id" name="sponsors_id">
                                                <option value="">Select Sponsor</option>
                                                <?php
                                                if (isset($sponsor) && !empty($sponsor)) {
                                                    foreach ($sponsor as $val) {
                                                        ?>
                                                        <option value="<?= $val->sponsors_id ?>"><?= $val->company_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Message :</label>
                                            <textarea name="message" id="message" rows="3" class="form-control" placeholder="Enter Message..." style="color: #5b5b60"></textarea>
                                        </div>
                                        <h5 class="over-title margin-bottom-15">
                                            <button type="button" id="save_btn" name="save_btn" class="btn btn-green add-row">
                                                Save
                                            </button>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- CONTENT -->
                    <section class="content" style="min-height: 700px; padding: 0px 0">
                        <div class="container" style=" background: rgba(250, 250, 250, 0.8); "> 
                            <!-- Blog post-->
                            <div class="post-content post-single"> 
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <h4 class="panel-title text-white">Push Notifications</h4>
                                    <table class="table table-striped table-bordered table-hover table-full-width" id="plan_table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Sponsor</th>
                                                <th>Message</th>
                                                <th>Action</th>                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($push_notifications)) {
                                                foreach ($push_notifications as $val) {
                                                    ?>
                                                    <tr>
                                                        <td><?= date("Y-m-d", strtotime($val->notification_date)) ?></td>
                                                        <td><?= $val->company_name ?></td>
                                                        <td><?= $val->message ?></td>
                                                        <td> 
                                                            <?php if ($val->status == 0) { ?>
                                                                <a class="btn btn-success btn-sm" href="<?= base_url() . 'sponsor-admin/push_notifications/send_notification/' . $val->push_notification_id.'?sponsor_id='.$val->sponsors_id ?>">
                                                                    <i class="fa fa-send"></i> Send Notification
                                                                </a>
                                                            <?php } else { ?>
                                                                <a class="btn btn-danger btn-sm" href="<?= base_url() . 'sponsor-admin/push_notifications/close_notification/' . $val->push_notification_id ?>">
                                                                    Close
                                                                </a>
                                                            <?php } ?>
                                                            <a class="btn btn-danger btn-sm delete_promo_code" href="<?= base_url() . 'sponsor-admin/push_notifications/delete_push_notifications/' . $val->push_notification_id ?>">
                                                                <i class="fa fa-trash-o"></i> Delete
                                                            </a>
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
<?php
$msg = $this->input->get('msg');
switch ($msg) {
    case "S":
        $m = "Message Added Successfully...!!!";
        $t = "success";
        break;
    case "U":
        $m = "Message Updated Successfully...!!!";
        $t = "success";
        break;
    case "D":
        $m = "Message Delete Successfully...!!!";
        $t = "success";
        break;
    case "E":
        $m = "Something went wrong, Please try again!!!";
        $t = "error";
        break;
    default:
        $m = 0;
        break;
}
?>

<script>
    $(document).ready(function () {
<?php if ($msg): ?>
            alertify.<?= $t ?>("<?= $m ?>");
<?php endif; ?>

        $('#save_btn').click(function () {
            if ($('#sponsors_id').val() == '') {
                alertify.error('Please Select Sponsor');
                return false;
            } else if ($('#message').val() == '') {
                alertify.error('Please Enter Message');
                return false;
            } else {
                $('#frm_credit').attr('action', '<?= base_url() ?>sponsor-admin/push_notifications/add_push_notifications');
                $('#frm_credit').submit();
                return true;
            }
        });
    });
</script>

