<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<?php
if (isset($cards) && !empty($cards))
{
}else{
    $booth_tracking = array();
    $unique_list =array();
}
?>
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

    .modal-dialog-xl {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-content-xl {
        height: auto;
        min-height: 100%;
        border-radius: 0;
    }

    #tracking-info-table_info{
        font-weight: bold;
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
                            <span style="font-size: 20px;font-weight: bold;margin-right: 90px;">vCards in the Fishbowl</span>
                            <!--                            <span style="margin-right: 90px;"><button class="btn btn-info more-tracking-info-bt">Show More Tracking Info</button></span>-->
                            <!-- Blog post-->
                            <div class="post-content post-single">
                                <!-- Blog image post-->
                                <div class="col-md-12 table-responsive" style="margin-top: 30px;">
                                    <table id="tracking-info-table" class="table table-bordered table-striped text-center ">
                                        <thead class="th_center">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Title</th>
                                            <th>Company</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Card Dropped At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($cards) && !empty($cards)) {
                                            foreach ($cards as $card) {
                                                ?>
                                                <tr>
                                                    <td><?= $card->first_name." ".$card->last_name ?></td>
                                                    <td><?= $card->email ?></td>
                                                    <td><?= $card->phone ?></td>
                                                    <td><?= $card->title ?></td>
                                                    <td><?= $card->company_name ?></td>
                                                    <td><?= $card->city ?></td>
                                                    <td><?= $card->address ?></td>
                                                    <td><?= $card->datetime ?></td>
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

<div id="moreTrackingModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-xl" role="document">
        <div class="modal-content modal-content-xl">
            <div class="modal-header">
                <h5 class="modal-title">More Tracking Info</h5>
            </div>
            <div class="modal-body">
                <p>Tracking data goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var page_link = $(location).attr('href');
    var user_id = <?= $this->session->userdata("sponsors_id") ?>;
    var page_name = "Sponsor Admin";
    var user_type = "sponsor";

    $(document).ready(function () {
        var trackingTable = $('#tracking-info-table').DataTable({
            "order": [[ 7, "desc" ]],
            "dom": '<"top"i>rt<"bottom"flp><"clear">'
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
            '<a href="<?= base_url() ?>sponsor-admin/home/logout" style="color:#A9A9A9; font-size: 18px;">' +
            '<i class="fa fa-sign-out" style="color:#A9A9A9; font-size: 18px;"></i>' +
            'Logout' +
            '</a>' +
            '</li>');
    });

    $('.more-tracking-info-bt').on('click', function () {
        $('#moreTrackingModal').modal('show');
    });

</script>

